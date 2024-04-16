
(function ($) {
  'use strict'

  var $sidebar = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)
  
  $container.append('<a class="nav-link" data-widget="fullscreen" href="#" role="button">Basculer en plein écran</a>\
  <hr class="mb-2"/>\
  <h6>Ip local : </h6> <div class="d-flex"><span class="mb-3">'+ip_local+'</span></div>\
  <h6>Ip public : </h6> <div class="d-flex"><span class="mb-3">'+ip_public+'</span></div>\
  <h6>Identifiant de session : </h6> <div class="d-flex"><span class="mb-3">'+session_id+'</span></div>\
  <h6>Date de connexion :</h6> <div class="d-flex"><span class="mb-3">'+timeConverter(deleted_time)+'</span></div>\
  <h6>Persistance connexion :</h6> <div class="d-flex"><span class="mb-3">'+((is_cookie == 1)? 'Oui':'Non')+'</span></div>\
  <h6>Environnement :</h6> <div class="d-flex"><span class="mb-3">'+environnementCelios+'</span></div>\
  <h6>Error Reporting :</h6> <div class="d-flex"><span class="mb-3">'+error_reporting+'</span></div>\
  <h6>Base BDD :</h6> <div class="d-flex"><span class="mb-3">'+baseCelios+'</span></div>\
  <h6>Version :</h6> <div class="d-flex"><span class="mb-3">'+versionCelios+'</span></div>\
  <h6>Chargée en :</h6> <div class="d-flex"><span id="execution-time" class="mb-3"> 0s </span></div>' )

  const allstars = document.querySelectorAll('.fa-star')
  allstars.forEach(star => {
    star.onclick = () => {
        let starlevel = star.getAttribute('data-num')
        allstars.forEach(el => { //loop through stars again to compare the clicked star to all other stars
           if(starlevel < el.getAttribute('data-num')) {
                el.classList.remove('fas')
                el.classList.add('far')
           }
           else {
              el.classList.remove('far')
              el.classList.add('fas')
           }
        });
    }
  });

  /*$('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })*/

})(jQuery)

/*
 * La fonction jQuery.extend() est utilisée pour étendre la fonction de tri de la bibliothèque DataTables avec une nouvelle fonction de tri appelée "date-euro".
 * Cette fonction de tri permet de trier les colonnes contenant des dates au format "JJ/MM/AAAA HH:mm:ss" de manière ascendante ou descendante.
 */
jQuery.extend(jQuery.fn.dataTableExt.oSort, {
  "date-euro-pre": function (a) {
      var x;
      if (a.trim() !== '') {
          var frDatea = a.trim().split(' ');
          var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [0o00, 0o00, 0o00];
          var frDatea2 = frDatea[0].split('/');
          x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + ((undefined != frTimea[2]) ? frTimea[2] : 0)) * 1;
      }
      else {
          x = Infinity;
      }
      return x;
  },

  "date-euro-asc": function (a, b) {
      return a - b;
  },

  "date-euro-desc": function (a, b) {
      return b - a;
  }
});

function readUrl(input,idInput) {
  var url = input.value;
  var ext = url.substr(url.lastIndexOf('.') + 1);
  if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
  {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#imagePreview').css('background-image', 'url('+ e.target.result +')');
          $('#imagePreview').hide();
          $('#imagePreview').fadeIn(650);
          document.getElementById(idInput).value = remove_accents(input.files[0].name);
      }
      reader.readAsDataURL(input.files[0]);
  }else{
       //$(\'#imagePreview\').css(\'background-image\', \'url(\''.BASEPATH.'assets/images/180.png\')\');
       document.getElementById(idInput).value = "";
  }
}

function readSendImage(input,idInput) 
{
  if (input.files && input.files[0]) 
  {
    readUrl(input,idInput);
  }
}

$("#imageVignette").change(function(){
  readSendImage(this,'input_imageVignette');
});

function show_user_profil()
{
    window.location.href = window.location.origin + '/profil.php';
}

function deconnexion_user()
{
    window.location.href = window.location.origin + '/logout.php';
}


function financial(x) {
return Number.parseFloat(x).toFixed(2);
}

// (Supposons que vous ayez une fonction qui est appelée lorsqu'un formulaire est soumis)
function tempsProcessing(id,startTime) {
    // Enregistrez le moment du deuxième submit
    var stopTime = new Date();

    // Calculez l'intervalle en millisecondes
    var intervalleEnMillisecondes = stopTime - startTime;

    // Convertissez l'intervalle en secondes
    var intervalleEnSecondes = intervalleEnMillisecondes / 1000;

    // Calcul des heures, minutes et secondes
    var heures = Math.floor(intervalleEnSecondes / 3600);
    var minutes = Math.floor((intervalleEnSecondes % 3600) / 60);
    var secondes = Math.floor(intervalleEnSecondes % 60);

    // Construisez la chaîne de temps au format HH:MM:SS (si heures ou minutes sont différents de zéro)
    var formatTime = "";
    if (heures > 0) {
        formatTime += heures + "h ";
    }
    if (minutes > 0) {
        formatTime += minutes + "min ";
    }
    formatTime += secondes + "s";

    document.getElementById(id).value = formatTime;
}

var startTime = null;
var markers = [];
var lines = [];

var isSimulated = false;

$( document ).ready(function() {

// Nom de la ville que tu veux centrer sur la carte
let cityName = 'Limoges , France';

// URL du service de géocodage Nominatim de OpenStreetMap
var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + cityName;

// Fetch API pour obtenir les coordonnées géographiques de la ville
fetch(url)
    .then(response => response.json())
    .then(data => {
        // Obtenir les coordonnées géographiques de la ville
        var lat = data[0].lat;
        var lon = data[0].lon;

        // Initialiser la carte Leaflet et la centrer sur les coordonnées de la ville
        var map = L.map('map').setView([lat, lon], 15); // Utilise les coordonnées et un zoom de 12

        const areaSelection = new window.leafletAreaSelection.DrawAreaSelection(
        {onPolygonReady: function (polygon) {
            const preview = document.getElementById('polygoneArea');
            preview.value = JSON.stringify(polygon.toGeoJSON(3), undefined, 2);
            preview.scrollTop = preview.scrollHeight;
            }
        });

        map.addControl(areaSelection);

        // Ajouter une couche de tuiles OpenStreetMap
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        L.control.scale().addTo(map);
      
        // Créer un groupe de calques pour les marqueurs
        var markerPointInterst = L.layerGroup().addTo(map);
        var markerTraceRoute = L.layerGroup().addTo(map);
        var markerStartEnd = L.layerGroup().addTo(map);

        // Créer des boutons pour chaque groupe de calques
        var button1 = createToggleButton("Liste des points de lachage", markerPointInterst);
        var button2 = createToggleButton("Route à suivre", markerTraceRoute);
        var button3 = createToggleButton("Point de départ et d'arrivée", markerStartEnd);

        // Ajouter tous les boutons à la carte
        button1.addTo(map);
        button2.addTo(map);
        button3.addTo(map);

        // Fonction utilitaire pour créer un bouton et associer un gestionnaire d'événements
        function createToggleButton(label, layerGroup) {
            var button = L.control({ position: 'topright' });

            button.onAdd = function (map) {
                var btn = L.DomUtil.create('button', 'toggle-button');
                btn.innerHTML = label;

                // Gestionnaire d'événements pour basculer l'affichage des calques
                btn.onclick = function () {
                    if (map.hasLayer(layerGroup)) {
                        map.removeLayer(layerGroup);
                    } else {
                        layerGroup.addTo(map);
                    }
                };

                return btn;
            };
            return button;
        }

        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const preview = document.getElementById('polygoneArea');
            if (preview.value == null || preview.value == "")
            {
                alert("Veuillez choisir une zone ");
                return false;
            } 
            
        clearMarkersAndLines(map);
            
        document.getElementById("btnCompute").disabled = true;
        
        var formData = new FormData(this);

        startTime = new Date();

        console.log("... start processing ... ");
        
        fetch('calcul_trajet.php', {
                method: 'POST',
                body: formData
            })                
            .then(response => response.text())
            .then(dataJson => {
                                
                if (dataJson != null && dataJson != "")
                {
                    var parsedData = JSON.parse(dataJson);
                    var points_interet = parsedData.points_interet;
                    var gpxData = parsedData.trace_gpx;
                    var street_length_total = parsedData.street_length_total;
                    var total_distance = parsedData.total_distance;

                    document.getElementById("btnCompute").disabled = false;
                    
                    isSimulated = $('#floatingCheck').prop('checked');

                    if (isSimulated == true)
                    {
                        // affichage des points de départ et d'arrivé pour parcourir tout le polygone sélectionnée
                        var parser = new DOMParser();
                        var xmlDoc = parser.parseFromString(gpxData, "text/xml");
                        var trkpts = xmlDoc.getElementsByTagName("trkpt");

                        var latStart = trkpts[0].getAttribute("lat");
                        var lonStart = trkpts[0].getAttribute("lon");

                        addStartTooltipPoint(markerStartEnd,latStart,lonStart);

                        var latEnd = trkpts[trkpts.length-2].getAttribute("lat");
                        var lonEnd = trkpts[trkpts.length-2].getAttribute("lon");

                        addEndTooltipPoint(markerStartEnd,latEnd,lonEnd);

                        points_interet.forEach(poi => {
                            addInterestPoint(markerPointInterst,poi.latitude,poi.longitude);
                        });

                        var points = parseGPX(gpxData);
                    
                        var parser = new DOMParser();
                        var xmlDoc = parser.parseFromString(gpxData, "text/xml");
                        var firstWpt = xmlDoc.getElementsByTagName("wpt")[0];
                        var lat = parseFloat(firstWpt.getAttribute("lat"));
                        var lon = parseFloat(firstWpt.getAttribute("lon"));
    
                        // Centrer la carte sur les coordonnées du premier point
                        map.setView([lat, lon], 15); // Remplacez le zoom (12) par le niveau de zoom souhaité

                        addMarkerAndLine(0,points,markerTraceRoute);
                    }
                    else
                    {
                        // affichage de la trace complette
                          // Parser le contenu GPX
                        var gpx = new L.GPX(gpxData, {
                            async: true,
                            marker_options: {
                                startIconUrl: '',
                                endIconUrl: '',
                                shadowUrl: '',
                                wptIconUrls: null  // Masquer les autres points en utilisant null
                            },
                            polyline_options: {
                                color: 'blue',
                                opacity: 0.75,
                                weight: 3,
                                lineCap: 'round'
                            }
                        }).on('loaded', function(e) {
                            map.fitBounds(e.target.getBounds());

                            // affichage des points de départ et d'arrivé pour parcourir tout le polygone sélectionnée
                            var parser = new DOMParser();
                            var xmlDoc = parser.parseFromString(gpxData, "text/xml");
                            var trkpts = xmlDoc.getElementsByTagName("trkpt");
                        
                            var latStart = trkpts[0].getAttribute("lat");
                            var lonStart = trkpts[0].getAttribute("lon");

                            addStartTooltipPoint(markerStartEnd,latStart,lonStart);

                            var latEnd = trkpts[trkpts.length-2].getAttribute("lat");
                            var lonEnd = trkpts[trkpts.length-2].getAttribute("lon");
                          
                            addEndTooltipPoint(markerStartEnd,latEnd,lonEnd);

                            points_interet.forEach(poi => {
                                addInterestPoint(markerPointInterst,poi.latitude,poi.longitude);
                                addCircle(markerPointInterst,poi.latitude,poi.longitude,document.getElementById("distance_tis").value)
                            });
                            
                            tempsProcessing("temps_total",startTime);

                        }).addTo(markerTraceRoute);
                    }

                    document.getElementById("tis_total").value = points_interet.length * document.getElementById("nbr_tis").value;
                    document.getElementById("distance_street").value = financial(street_length_total/1000);
                    document.getElementById("distance_total").value = financial(total_distance/1000);
                }
                
            })
            .catch(error => { document.getElementById("btnCompute").disabled = false; console.log('Erreur:', error); });
        });
        
    })
    .catch(error => console.log('Erreur lors de la récupération des coordonnées :', error));
    // Tableaux pour stocker les marqueurs et les lignes ajoutés

    // Appeler la fonction pour supprimer tous les marqueurs et les traits
    clearMarkersAndLines();

});

function addStartTooltipPoint(map,lat,long) {
    // Ajouter un point personnalisé avec une icône et un tooltip
    var customIcon = L.icon({
        iconUrl: 'themes/terratis/assets/images/pin-icon-start.png',
        iconSize: [25, 41], // Taille de l'icône
        iconAnchor: [12, 41], // Point d'ancrage de l'icône
        popupAnchor: [0, -41] // Point d'ancrage du tooltip
    });
    var customMarker = L.marker([lat, long], {icon: customIcon}).addTo(map); // Coordonnées du point et icône personnalisée
    customMarker.bindPopup("<b>Traitement</b><br>Point de départ."); // Contenu du tooltip personnalisé
}

function addEndTooltipPoint(map,lat,long) {
    // Ajouter un point personnalisé avec une icône et un tooltip
    var customIcon = L.icon({
        iconUrl: 'themes/terratis/assets/images/pin-icon-end.png',
        iconSize: [25, 41], // Taille de l'icône
        iconAnchor: [12, 41], // Point d'ancrage de l'icône
        popupAnchor: [0, -41] // Point d'ancrage du tooltip
    });
    var customMarker = L.marker([lat, long], {icon: customIcon}).addTo(map); // Coordonnées du point et icône personnalisée
    customMarker.bindPopup("<b>Traitement</b><br>Point d'arrivé."); // Contenu du tooltip personnalisé
}

function addInterestPoint(map,lat,long) {
    // Ajouter un point personnalisé avec une icône et un tooltip
    var customIcon = L.icon({
        iconUrl: 'themes/terratis/assets/images/beachflag.png',
        iconSize: [25, 41], // Taille de l'icône
        iconAnchor: [12, 41], // Point d'ancrage de l'icône
        popupAnchor: [0, -41] // Point d'ancrage du tooltip
    });
    var customMarker = L.marker([lat, long], {icon: customIcon}).addTo(map); // Coordonnées du point et icône personnalisée
    customMarker.bindPopup("<b>Traitement</b><br>Libèrer les moustiques ici."); // Contenu du tooltip personnalisé
}

function addCircle(map,lat, lng, radius) {
    L.circle([lat, lng], {
        radius: radius,
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5
    }).addTo(map);
}

// Fonction pour analyser les données GPX
function parseGPX(gpxData) {
    // Initialiser un tableau pour stocker les points
    var points = [];

    // Créer un objet DOM pour interagir avec le XML
    var parser = new DOMParser();
    var xmlDoc = parser.parseFromString(gpxData, "text/xml");

    // Trouver tous les éléments <trkpt>
    var trkpts = xmlDoc.getElementsByTagName("trkpt");

    // Parcourir tous les éléments <trkpt> et extraire les coordonnées
    for (var i = 0; i < trkpts.length; i++) {
        var trkpt = trkpts[i];
        var lat = trkpt.getAttribute("lat");
        var lon = trkpt.getAttribute("lon");

        // Ajouter les coordonnées au tableau de points
        points.push({ lat: parseFloat(lat), lon: parseFloat(lon) });
    }

    // Retourner le tableau de points
    return points;
}


// Fonction récursive pour ajouter des marqueurs à la carte et construire les traits
function addMarkerAndLine(index,points,map) {
    // Si tous les points ont été ajoutés, terminer la fonction
    if (index >= points.length) {
        return;
    }

    // Ajouter le marqueur pour le point actuel
    var point = points[index];
    var marker = L.marker([point.lat, point.lon]).addTo(map);

    // Ajouter le marqueur au tableau de marqueurs
    markers.push(marker);

    // Si ce n'est pas le premier point, construire un trait entre ce point et le précédent
    if (index > 0) {
        var prevPoint = points[index - 1];
        var line = L.polyline([
            [prevPoint.lat, prevPoint.lon],
            [point.lat, point.lon]
        ]).addTo(map);
        
        // Ajouter la ligne au tableau de lignes
        lines.push(line);
    }

    // Appeler récursivement la fonction pour le prochain point avec un léger délai
    setTimeout(function() {
        
        if (index > 0) {
            map.removeLayer(markers[index - 1]);
        }
        
        addMarkerAndLine(index + 1,points,map);
    }, 100);
}
  
  
  // Fonction pour supprimer tous les marqueurs et les traits de la carte
function clearMarkersAndLines(map) {
    // Supprimer tous les marqueurs de la carte
    for (var i = 0; i < markers.length; i++) {
        map.removeLayer(markers[i]);
    }
    markers = []; // Effacer le tableau de marqueurs

    // Supprimer tous les traits de la carte
    for (var j = 0; j < lines.length; j++) {
        map.removeLayer(lines[j]);
    }
    lines = []; // Effacer le tableau de traits
}
  
