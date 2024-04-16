#!/usr/bin/env python
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  Poc Terratis
#   =
#   =  FICHIER: calcul_trajet.py
#   =
#   =  VERSION: 1.0.0
#   =
#   =  SYSTEME: Linux
#   =
#   =  LANGAGE: Langage Python
#   =
#   =  BUT: Plannificateur de lacher de moustique stérilisé
#   =
#   =  INTERVENTION:
#   =
#   =    * 04/03/2024 : David DAUMAND
#   =        Creation du module.
#   =
# * ========================================================================= */
#/** @file  */

from libs.tools import *
from libs.graph_route import plot_graph_route
from libs.gpx_formatter import TEMPLATE, TRACE_POINT

import sys,json; 

import numpy as np

import datetime

import networkx as nx
import osmnx as ox
from shapely.geometry import Polygon

from network import Network
from network.algorithms import hierholzer

from geopy.distance import geodesic

def calculate_interest_point(route, radius_meters):
    pois = []

    # Ajout du premier point de la route à la liste des points d'intérêt
    pois.append(route[0])

    # Parcours de la route
    for i in range(1, len(route)):
        lat, lon = route[i]
        last_poi_lat, last_poi_lon = pois[-1]

        # Calcul de la distance entre le nouveau point et le dernier point d'intérêt
        distance = geodesic((last_poi_lat, last_poi_lon), (lat, lon)).meters

        # Vérification si le point actuel est suffisamment éloigné du dernier point d'intérêt
        if distance >= radius_meters:
            # Vérification si le point actuel ne chevauche pas les points existants dans pois
            valid_point = True
            for existing_lat, existing_lon in pois:
                existing_distance = geodesic((existing_lat, existing_lon), (lat, lon)).meters
                if existing_distance < radius_meters:
                    valid_point = False
                    break
            if valid_point:
                pois.append((lat, lon))

    return pois


print(sys.argv[1])
data = json.loads(sys.argv[1])

CUSTOM_FILTER = (
    '["highway"]["area"!~"yes"]["highway"!~"bridleway|bus_guideway|bus_stop|construction|'
    'cycleway|elevator|footway|motorway|motorway_junction|motorway_link|escalator|proposed|'
    'construction|platform|raceway|rest_area|path|service"]["access"!~"customers|no|private"]'
    '["public_transport"!~"platform"]["fee"!~"yes"]["foot"!~"no"]["service"!~"drive-through|'
    'driveway|parking_aisle"]["toll"!~"yes"]'
)

polygon_coordinates = data['geometry']['coordinates'][0]

polygon = Polygon(polygon_coordinates)

# Créer un objet graphique à partir des coordonnées du polygone avec OSMnx
org_graph = ox.graph_from_polygon(polygon,custom_filter=CUSTOM_FILTER)

#location = "The Grange, Edinburgh, Scotland"
#org_graph = ox.graph_from_place(location, custom_filter=CUSTOM_FILTER)


""" Simplifying the original directed multi-graph to undirected, so we can go both 
    ways in one way streets """
graph = ox.utils_graph.get_undirected(org_graph)


odd_degree_nodes = get_odd_degree_nodes(graph)
pair_weights = get_shortest_distance_for_odd_degrees(graph, odd_degree_nodes)
matched_edges_with_weights = min_matching(pair_weights)

# List all edges of the extended graph including original edges and edges from minimal matching
single_edges = [(u, v) for u, v, k in graph.edges]
added_edges = get_shortest_paths(graph, matched_edges_with_weights)
edges = map_osmnx_edges2integers(graph, single_edges + added_edges)

# Finds the Eulerian path
network = Network(len(graph.nodes), edges, weighted=True)
eulerian_path = hierholzer(network)
converted_eulerian_path = convert_integer_path2osmnx_nodes(eulerian_path, graph.nodes())
double_edge_heap = get_double_edge_heap(org_graph)

# Finds the final path with edge IDs
final_path = convert_path(graph, converted_eulerian_path, double_edge_heap)
coordinates_path = convert_final_path_to_coordinates(org_graph, final_path)

# Initialisez les limites avec des valeurs extrêmes pour les coordonnées
min_x, min_y = float('inf'), float('inf')
max_x, max_y = float('-inf'), float('-inf')

# Parcourez les nœuds du graphe pour trouver les coordonnées extrêmes
#for node, data in org_graph.nodes(data=True):
#    x, y = data['x'], data['y']
#    min_x = min(min_x, x)
#    min_y = min(min_y, y)
#    max_x = max(max_x, x)
#    max_y = max(max_y, y)

# Créez un polygone à partir des limites extrêmes
#polygon = Polygon([(min_x, min_y), (min_x, max_y), (max_x, max_y), (max_x, min_y)])

pois = calculate_interest_point(coordinates_path,float(data['distance']))

# Route statistics from OSMnx 
# Calculer les statistiques de base du graphe
stats = ox.basic_stats(org_graph)

# Extraire la longueur totale du chemin
street_length_total = stats['street_length_total']


nodes = list(org_graph.nodes(data=True))
lats = [node[1]['y'] for node in nodes]
lons = [node[1]['x'] for node in nodes]
center_lat, center_lon = np.mean(lats), np.mean(lons)

trace_points = "\n\t\t\t".join([TRACE_POINT.format(
    lat=lat, lon=lon, id=i, timestamp=datetime.datetime.now().isoformat()
) for i, (lat, lon) in enumerate(coordinates_path)])

gpx_payload = TEMPLATE.format(
    name="Name your everystreet route",
    trace_points=trace_points,
    center_lat=center_lat,
    center_lon=center_lon
)

#print(gpx_payload)

with open("./OUT/gpx_output.gpx", "w") as f:
    f.write(gpx_payload)

total_distance = sum(geodesic(coordinates_path[i], coordinates_path[i+1]).meters for i in range(len(coordinates_path) - 1))

# Générer les données JSON
json_data = {
    "points_interet": [{"latitude": poi[0], "longitude": poi[1]} for poi in pois],
    "center_lat": center_lat,
    "center_lon": center_lon,
    "street_length_total": street_length_total,
    "total_distance": total_distance,
    "trace_gpx": gpx_payload
}

# Écrire dans un fichier JSON
with open("./OUT/output.json", "w") as json_file:
    json.dump(json_data, json_file, indent=2)