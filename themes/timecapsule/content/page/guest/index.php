<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: index.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: La nouvelle application de bouteille à la mer 
   =
   =  INTERVENTION:
   =
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

?>

<style>

html, body {
    height: 100vh;
    margin: 0;
    padding: 0;
}

.col-6 {
    width: calc(50%); /* Ajuster la hauteur pour éviter les débordements */
    height: calc(50%); /* Ajuster la hauteur pour éviter les débordements */
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: transform .2s ease-in-out;

}

.col-6:first-child { background-color: lightblue; }
.col-6:nth-child(2) { background-color: lightgreen; }
.col-6:nth-child(3) { background-color: lightcoral; }
.col-6:last-child { background-color: lightgoldenrodyellow; }

.col-6:hover {
    transform: scale(0.95);
}

.h2:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
    transform: translateY(-2px); /* Léger effet de soulèvement au survol */
}

.col-6:hover {
    text-decoration: underline #88ff88;
}

.col-12 {
    width: calc(50%); /* Ajuster la hauteur pour éviter les débordements */
    height: calc(50%); /* Ajuster la hauteur pour éviter les débordements */
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: transform .2s ease-in-out;

}

.col-12:hover {
    text-decoration: underline #88ff88;
}

.zone-top-left {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 1px solid black; /* Bordure pour chaque zone */
    border-left:   2px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-top-right {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  2px solid black; /* Bordure pour chaque zone */
    border-bottom: 1px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-bottom-left {
    border-top:    1px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   2px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-bottom-right {
    border-top:    1px solid black; /* Bordure pour chaque zone */
    border-right:  2px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.page-content-1
{
    margin-top: 80px;
    margin-left: 5px;
    margin-right: 5px;
}
.container-aligner {
    display: flex; /* Utilise Flexbox */
    align-items: center; /* Centre verticalement le contenu */
    height: 100%; /* Hauteur complète de la fenêtre de visualisation */
}

.buttons-date, .buttons-position  {
    display: flex; /* Permet l'alignement interne du texte */
    align-items: center; /* Centre le texte verticalement */
    justify-content: right; /* Centre le texte horizontalement */
    background-color: transparent; /* Fond transparent */
    color: white; /* Texte en blanc pour le contraste */
    font-size: 20px; /* Taille de texte grande */
    width: 100%; /* Prendre toute la largeur du conteneur */
    border: none; /* Suppression de la bordure par défaut des boutons si utilisé */
    text-decoration: none; /* Pas de soulignement du texte */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre subtile pour un effet 3D */
    transition: all 0.3s ease; /* Transition douce pour les interactions */
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.buttons-date:hover,.buttons-position:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
    transform: translateY(-2px); /* Léger effet de soulèvement au survol */
}

h1,h2
{
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.vh-100 { height: 100vh; } /* Assurez-vous que le conteneur principal occupe toute la hauteur de la fenêtre */
.col-6 { height: 38vh; } /* Définit une hauteur de 40% de la hauteur de la fenêtre pour chaque zone */
.col-12 { height: 75vh; } /* Définit une hauteur de 40% de la hauteur de la fenêtre pour chaque zone */

.d-flex { 
    display: flex; 
    align-items: center; /* Centre les éléments verticalement */
    justify-content: center; /* Centre les éléments horizontalement */
}

.row div {
    transition: all 0.5s ease-in-out;
    overflow: hidden;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background: none;
    color: black; /* Change as needed */
    font-size: 24px;
    cursor: pointer;
    display: none; /* Initially hidden */
}

.content-zone-text {
    transition: opacity 3s ease-in-out;
    opacity: 1; /* Fully visible initially */
}
.hidden-content-zone-text {
    opacity: 0; /* Fully transparent */
}

</style>

<div class="d-flex justify-content-between">
    <div class="col-lg-6">
        <div class="container-aligner">
            <h1 id="zoneTitle" class="p-1" style="text-decoration: underline #88ff88;">Une bouteille ...</h1>
        </div>
    </div>
    <div class="col-lg-6 ">
        <div class="w-100">
            <div class="row">
            <button type="button" class="buttons-date btn header-item waves-effect">
            <h1 class="pt-3"> <i class="bx bx-time-five"></i></h1><h1 class="p-1 my-2" id="clock"> [ xxx ][ xx xxxx ][ xx : xx : xx ]</h1>
            </button>
            </div>
            <div class="row">
            <button type="button" class="buttons-position btn header-item waves-effect">
            <h1 class="p-1 my-2"><i class="bx bx-street-view"></i> Limoges, France, Terre</h1>
            </button>
            </div>
        </div>
    </div>
</div>
<div class="p-0  vh-100">
    <div class="row g-0 ">
        <div id="zone1" class="zone-top-left col-6 d-flex" style="background-color: lightblue;" onclick="expandZone('zone1')">
            <button class="close-btn" onclick="closeZone(event, 'zone1')">✖</button>
            <div class="content-zone-text m-auto"><h2>&Agrave; la mer.</h2></div>
        </div>
        <div id="zone2" class="zone-top-right col-6 d-flex" style="background-color: lightgreen;" onclick="expandZone('zone2')">
            <button class="close-btn" onclick="closeZone(event, 'zone2')">✖</button>
            <div class="content-zone-text m-auto"><h2>Dans un trou.</h2></div>
        </div>
        <div id="zone3" class="zone-bottom-left  col-6 d-flex" style="background-color: lightcoral;" onclick="expandZone('zone3')">
            <button class="close-btn" onclick="closeZone(event, 'zone3')">✖</button>
            <div class="content-zone-text m-auto"><h2>Dans l'espace.</h2></div>
        </div>
        <div id="zone4" class="zone-bottom-right  col-6 d-flex" style="background-color: lightgoldenrodyellow;" onclick="expandZone('zone4')">
            <button class="close-btn" onclick="closeZone(event, 'zone4')">✖</button>
            <div class="content-zone-text m-auto"><h2>Dans le temps.</h2></div>
        </div>
    </div>
</div>

<script>
     function expandZone(selectedZoneId) {
        const zoneTitle = document.getElementById('zoneTitle');
        const zones = ['zone1', 'zone2', 'zone3', 'zone4'];
        zones.forEach(zone => {
            const element = document.getElementById(zone);
            const closeButton = element.querySelector('.close-btn');
            const content = element.querySelector('.content-zone-text');
            const h2 = element.querySelector('h2');
            if (zone === selectedZoneId) {
                element.style.flex = "1 1 100%";
                element.classList.add('col-12');
                element.classList.remove('col-6');
                element.style.height = "75vh";
                closeButton.style.display = 'block'; // Show close button
                content.classList.add('hidden-content-zone-text');
                zoneTitle.innerHTML = "Une bouteille " + h2.innerHTML.toLowerCase();
            } else {
                element.style.width = "0";
                element.style.height = "0";
                element.style.opacity = "0";
                closeButton.style.display = 'none'; // Hide close button
                content.classList.add('hidden-content-zone-text');
            }
        });
    }

    function closeZone(event, zoneId) {

        const zones = ['zone1', 'zone2', 'zone3', 'zone4'];
        const zoneTitle = document.getElementById('zoneTitle');
        
        zoneTitle.innerHTML = "Une bouteille ...";
       
        zones.forEach(zone => {
            const element = document.getElementById(zone);
            const closeButton = element.querySelector('.close-btn');
            const content = element.querySelector('.content-zone-text');
            if (zone === zoneId) {
                element.classList.remove('col-12');
                element.classList.add('col-6');
                element.style.flex = "0 0 50%";
                element.style.height = "38vh";
                closeButton.style.display = 'none'; // Hide close button
                content.classList.remove('hidden-content-zone-text');
            } else {
                element.style.width = "50%";
                element.style.height = "38vh";
                element.style.opacity = "1";
                content.classList.remove('hidden-content-zone-text');
            }
        });

        event.stopPropagation(); // Prevent the expandZone event

    }

    function updateClock() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.toLocaleString('fr-FR', { month: 'long' });
        const day = now.getDate();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        
        document.getElementById('clock').textContent = `[ ${year} ][ ${day} ${month} ][ ${hours} : ${minutes} : ${seconds} ]`;
    }

    // Mise à jour de l'horloge chaque seconde
    setInterval(updateClock, 1000);

    // Initialiser l'horloge immédiatement au chargement de la page
    updateClock();
</script>