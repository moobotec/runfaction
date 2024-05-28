#!/usr/bin/env python3
#=========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET: TimeCapsule
#   =
#   =  FICHIER: throw.py
#   =
#   =  VERSION: 1.0.0
#   =
#   =  SYSTEME: Linux,windows
#   =
#   =  LANGAGE: Langage PHP
#   =
#   =  BUT: La nouvelle application de bouteille à la mer 
#   =
#   =  INTERVENTION:
#   =
#   =    * 27/05/2024 : David DAUMAND
#   =        Creation du module.
# * ========================================================================= */
#/** @file  */
import sys

import osmnx as ox
import pandas as pd
import geopandas as gpd
import matplotlib.pyplot as plt
from shapely.geometry import Point, Polygon, box
from shapely.ops import unary_union
import os,sys
import random
import time

if len(sys.argv) < 4:
    print("Usage: python3 throw.py <latitude> <longitude> <path>")
    sys.exit(1)

# Définir une fonction pour extraire les plages dans une zone spécifique
def extract_beaches(polygon):
    tags = {'natural': 'beach','surface': 'sand'}
    beaches = ox.geometries.geometries_from_polygon(polygon, tags=tags)
    return beaches

# Fonction pour diviser un polygone en sous-régions
def subdivide_polygon(polygon, max_area=1.0):
    minx, miny, maxx, maxy = polygon.bounds
    width = maxx - minx
    height = maxy - miny
    x_splits = int(width // max_area) + 1
    y_splits = int(height // max_area) + 1
    sub_polygons = []
    for i in range(x_splits):
        for j in range(y_splits):
            sub_minx = minx + i * max_area
            sub_maxx = minx + (i + 1) * max_area
            sub_miny = miny + j * max_area
            sub_maxy = miny + (j + 1) * max_area
            sub_box = box(sub_minx, sub_miny, sub_maxx, sub_maxy)
            sub_polygon = polygon.intersection(sub_box)
            if not sub_polygon.is_empty:
                sub_polygons.append(sub_polygon)
    return sub_polygons

def get_location_type(lat, lon, countries_gdf, oceans_gdf):
    # Create a point geometry from the latitude and longitude
    point = Point(lon, lat)
    
    # Check if the point is within any of the country polygons
    for country in countries_gdf.itertuples():
        if country.geometry.contains(point):
            return f"Land ({country.NAME})"
    
    # Check if the point is within any of the ocean polygons
    for ocean in oceans_gdf.itertuples():
        if ocean.geometry.contains(point):
            return f"Water ({ocean.featurecla})"
    
    return 'Unknown'

# Fonction pour vérifier si un polygone a un trait de côte
def has_coastline(polygon, world):
    # Vérifier l'intersection avec les frontières du monde (mer et terre)
    world_polygons = [poly for poly in world['geometry'] if isinstance(poly, Polygon)]
    coastline = unary_union(world_polygons).boundary
    return polygon.intersects(coastline)

# Vérifier si un pays a un trait de côte en intersectant avec les océans
def has_coastline_v2(polygon, oceans):
    return polygon.intersects(unary_union(oceans['geometry']))

latitude = float(sys.argv[1])
longitude = float(sys.argv[2])

# Load the country boundaries and ocean boundaries from shapefiles
countries_shapefile = sys.argv[3]+"/NaturalEarth/ne_110m_admin_0_countries/ne_110m_admin_0_countries.shp"
oceans_shapefile = sys.argv[3]+"/NaturalEarth/ne_110m_ocean/ne_110m_ocean.shp"

countries_gdf = gpd.read_file(countries_shapefile)
oceans_gdf = gpd.read_file(oceans_shapefile)

# Check if the given coordinates fall within a country or an ocean
location_type = get_location_type(latitude, longitude, countries_gdf, oceans_gdf)
print(f"The location ({latitude}, {longitude}) is in {location_type}.")

# Filtrer les pays ayant une ligne côtière (ceux qui ne sont pas enclavés)
coastal_countries = countries_gdf[countries_gdf['geometry'].apply(lambda x: has_coastline(x, oceans_gdf))]

# Sélectionner un pays au hasard parmi ceux ayant une ligne côtière
random_country = coastal_countries.sample(n=1).iloc[0]
country_name = random_country['NAME']
country_geom = random_country['geometry']

print(f"Pays sélectionné : {country_name}")

# Diviser le pays sélectionné en sous-régions
sub_polygons = subdivide_polygon(country_geom, max_area=0.1)

print(f"Nombre de sous-régions: {len(sub_polygons)}")

# Filtrer les sous-régions qui ont un trait de côte
coastal_sub_polygons = [sub_polygon for sub_polygon in sub_polygons if has_coastline(sub_polygon, oceans_gdf)]

print(f"Nombre de sous-régions ayant un trait de côte : {len(coastal_sub_polygons)}")

all_beaches = []

# Extraire les plages pour chaque sous-région
for sub_polygon in coastal_sub_polygons:
    try:
        beaches = extract_beaches(sub_polygon)
        if not beaches.empty:
            all_beaches.append(beaches)
        time.sleep(0.3)  # Pause pour éviter de surcharger l'API
    except Exception as e:
        time.sleep(0.3)  # Pause pour éviter de surcharger l'API
    
if all_beaches:
    beaches_gdf = gpd.GeoDataFrame(pd.concat(all_beaches, ignore_index=True))
else:
    print("Aucune plage trouvée.")
    beaches_gdf = gpd.GeoDataFrame()

# Sélectionner une plage au hasard
if not beaches_gdf.empty:
    random_beach = beaches_gdf.sample(n=1).iloc[0]
    beach_name = random_beach.get('name', 'Unknown')
    beach_location = random_beach.geometry

    result = {
        "country": country_name,
        "beach_name": beach_name,
        "latitude": beach_location.centroid.y,
        "longitude": beach_location.centroid.x
    }

    print(f"Plage sélectionnée : {result['beach_name']}")
    print(f"Latitude : {result['latitude']}")
    print(f"Longitude : {result['longitude']}")

else:
    print(f"Aucune plage trouvée dans le pays sélectionné : {country_name}.")