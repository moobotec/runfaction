<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: find.php
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
    transition: transform .2s ease-in-out;
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

h1,h2,h3
{
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.col-6 { height: 38vh; } /* Définit une hauteur de 40% de la hauteur de la fenêtre pour chaque zone */
.col-12 { height: 75vh; } /* Définit une hauteur de 40% de la hauteur de la fenêtre pour chaque zone */

.d-flex { 
    display: flex; 
    align-items: center; /* Centre les éléments verticalement */
    justify-content: center; /* Centre les éléments horizontalement */
}

#zone1, #zone2, #zone3, #zone4  {
    transition: all 0.5s ease-in-out;
    overflow: hidden;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
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

.throw-message {
    display: none; /* Initially hidden */
    /* border: 2px dashed #000; */
    width: 90%;
    padding-top: 20px;
    height: auto;
}

.dig-message,
.space-message,
.time-message
{
    display: none; /* Initially hidden */
}

.content {
    display: flex;
    justify-content: space-between;
}

.left-side{
    flex: 1.5;
    padding: 10px;
     /*border: 2px dashed #000; */
}

.right-side {
    flex: 1;
    padding-top: 30px;
    padding-left: 30px;
    /*border: 2px dashed #000; */
}

.right-side-second {
    flex: 1;
    /*border: 2px dashed #000; */
}

form {
    display: flex;
    flex-direction: column;
}

head {
    display: flex;
    flex-direction: column;
}

.head h3
{
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #88ff88;
    border-radius: 4px;
    background-color: #A9D3E0;
}

.left-side h3 {
    margin-top: 10px;
    font-size: 20px;
}

.content  input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #88ff88;
    border-radius: 4px;
    background-color: #A9D3E0;
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

textarea {
    resize: none;
    height: 100px;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: l;
}


</style>

<div class="d-flex justify-content-between">
    <div class="col-lg-5">
        <div class="container-aligner">
            <h1 id="zoneTitle" class="p-1" style="text-decoration: underline #88ff88;display:block;" key="t-bottle">Une bouteille ...</h1>
            <h1 id="zoneTitle-zone1" class="p-1" style="text-decoration: underline #88ff88;display:none;" key="t-bottle-sea">Une bouteille à la mer.</h1>
            <h1 id="zoneTitle-zone2" class="p-1" style="text-decoration: underline #88ff88;display:none;" key="t-bottle-hole">Une bouteille dans un trou.</h1>
            <h1 id="zoneTitle-zone3" class="p-1" style="text-decoration: underline #88ff88;display:none;" key="t-bottle-space">Une bouteille dans l'espace.</h1>
            <h1 id="zoneTitle-zone4" class="p-1" style="text-decoration: underline #88ff88;display:none;" key="t-bottle-time">Une bouteille dans le temps.</h1>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="w-100">
            <div class="row">
            <button type="button" class="buttons-date btn header-item waves-effect" data-bs-toggle="modal" data-bs-target="#datetimeModal">
            <h1 class="pt-3"> <i class="bx bx-time-five"></i></h1><h1 class="p-1 my-2" id="clock"> [ xxx ][ xx xxxx ][ xx : xx : xx ]</h1>
            </button>
            </div>
            <div class="row">
            <button type="button" class="buttons-position btn header-item waves-effect" data-bs-toggle="modal" data-bs-target="#positionModal">
            <h3 class="pt-3"><i class="bx bx-street-view"></i></h3><h3 class="p-1 my-2 "id="position" ></i></h3>
            </button>
            </div>
        </div>
    </div>
</div>
<div class="p-0">
    <div class="row g-0 ">
        <div id="zone1" class="zone-top-left col-6 d-flex" style="background-color: lightblue;" onclick="expandZone('zone1')">
            <button class="close-btn" onclick="closeZone(event, 'zone1')">✖</button>
            <div class="throw-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-sea">&Agrave; la mer.</h2></div>
        </div>
        <div id="zone2" class="zone-top-right col-6 d-flex" style="background-color: lightgreen;" onclick="expandZone('zone2')">
            <button class="close-btn" onclick="closeZone(event, 'zone2')">✖</button>
            <div class="dig-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-hole">Dans un trou.</h2></div>
        </div>
        <div id="zone3" class="zone-bottom-left col-6 d-flex" style="background-color: lightcoral;" onclick="expandZone('zone3')">
            <button class="close-btn" onclick="closeZone(event, 'zone3')">✖</button>
            <div class="space-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-space">Dans l'espace.</h2></div>
        </div>
        <div id="zone4" class="zone-bottom-right  col-6 d-flex" style="background-color: lightgoldenrodyellow;" onclick="expandZone('zone4')">
            <button class="close-btn" onclick="closeZone(event, 'zone4')">✖</button>
            <div class="time-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-time">Dans le temps.</h2></div>
        </div>
    </div>
</div>


                               