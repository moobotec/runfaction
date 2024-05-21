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

.modal-content {
    border: 2px solid black; /* Ajoute une bordure noire de 10px */
    border-radius: 0; /* Supprime les bordures arrondies */
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

.weather {
    background-color: #A9D3E0;
    border: 5px solid #88ff88;
    border-radius: 4px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    height: 95%;
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.weather-header {
    display: flex;
    justify-content: space-between;
    align-items: l;
    border-bottom: 1px solid #88ff88;
}

.weather-info {
    margin-top: 10px;
}

.weather-info p {
    text-align :center;
}

.weather-header h2 {
    font-size: 40px;
    margin-right: 10px;
}

.weather-header i {
    font-size: 50px;
    margin-left: auto;
}

.file-upload {
    margin-top: 10px;
}
.drop-zone-2 {
    height: auto;
    border-top: 2px dashed #000;
    text-align: center;
    margin-top: 5px;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 4px;
}

.drop-zone {
    height: auto;
    border: 2px dashed #000;
    text-align: center;
    margin-top: 5px;
    padding-left: 10px;
    padding-right: 10px;
    background-color: #A9D3E0;
    border-radius: 4px;
}

.drop-zone .file-info-container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 0px;
    padding-top: 10px;
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.drop-zone .zone {
    height: 100%;
    padding-bottom: 40px;
}

.drop-zone .bottle {
    padding-top: 40px;
    padding-bottom: 20px;
}

.buttons-drop-zone  {
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

.buttons-step  {
    display: flex; /* Permet l'alignement interne du texte */
    align-items: center; /* Centre le texte verticalement */
    justify-content: right; /* Centre le texte horizontalement */
    background-color: transparent; /* Fond transparent */
    color: white; /* Texte en blanc pour le contraste */
    font-size: 20px; /* Taille de texte grande */
    border: none; /* Suppression de la bordure par défaut des boutons si utilisé */
    text-decoration: none; /* Pas de soulignement du texte */
    transition: all 0.3s ease; /* Transition douce pour les interactions */
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
    margin-top: 5px;
    border-radius: 4px;
}

.leaflet-map-custom {
    margin : 0;
    padding : 0;
    border: 5px solid #88ff88;
    border-radius: 4px;
  height: 335px;
  width: 100%; }
  .leaflet-map.leaflet-container {
    z-index: 99; }

.mailbox-messages > .table {
  margin: 0;
}

.mailbox-controls {
  padding: 5px;
}

.mailbox-controls.with-border {
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.mailbox-read-info {
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  padding: 10px;
}

.mailbox-read-info h3 {
  font-size: 20px;
  margin: 0;
}

.mailbox-read-info h5 {
  margin: 0;
  padding: 5px 0 0;
}

.mailbox-read-time {
  color: #999;
  font-size: 13px;
}

.mailbox-read-message {
  padding: 10px;
}

.mailbox-attachments {
  padding-left: 0;
  list-style: none;
}

.mailbox-attachments li {
  border: 1px solid #88ff88;
  float: left;
  margin-bottom: 10px;
  margin-right: 10px;
  width: 200px;
}

.mailbox-attachment-name {
  color: #666;
  font-weight: 700;
}

.mailbox-attachment-icon,
.mailbox-attachment-info,
.mailbox-attachment-size {
  display: block;
}

.mailbox-attachment-info {
  background-color: #A9D3E0;
  padding: 10px;
}

.mailbox-attachment-size {
  color: #999;
  font-size: 12px;
}

.mailbox-attachment-size > span {
  display: inline-block;
  padding-top: .75rem;
}

.mailbox-attachment-icon {
  color: #666;
  font-size: 65px;
  max-height: 132.5px;
  padding: 20px 10px;
  text-align: center;
}

.mailbox-attachment-icon.has-img {
  padding: 0;
}

.mailbox-attachment-icon.has-img > img {
  height: auto;
  max-width: 100%;
}

.my-image {
    width: 100px;
    height: 100px;
    object-fit: contain;
}

.content-success {
    padding: 10px;
    margin-top: 5px;
    border: 2px solid #88ff88;
    border-radius: 4px;
    background-color: #A9D3E0;
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.content-success input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #88ff88;
    border-radius: 4px;
    background-color: #A9D3E0;
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.corner-image-bottom-right {
    position: absolute;
    bottom: 1px; /* Distance du bas du div */
    right: 1px;  /* Distance du côté droit du div */
    width: 20%;   /* Largeur relative au div parent */
    height: auto; /* Maintenir le ratio d'aspect */
    max-width: 100px; /* Taille maximale de l'image */
    max-height: 100px; /* Hauteur maximale de l'image */
    opacity: 0; /* Rendre l'image invisible par défaut */
    transition: opacity 0.3s ease; /* Transition douce pour l'opacité */
}

.corner-image-bottom-left {
    position: absolute;
    bottom: 1px; /* Distance du bas du div */
    left: 1px;  /* Distance du côté droit du div */
    width: 20%;   /* Largeur relative au div parent */
    height: auto; /* Maintenir le ratio d'aspect */
    max-width: 100px; /* Taille maximale de l'image */
    max-height: 100px; /* Hauteur maximale de l'image */
    opacity: 0; /* Rendre l'image invisible par défaut */
    transition: opacity 0.3s ease; /* Transition douce pour l'opacité */
}

.corner-image-top-right {
    position: absolute;
    top: 1px; /* Distance du bas du div */
    right: 1px;  /* Distance du côté droit du div */
    width: 20%;   /* Largeur relative au div parent */
    height: auto; /* Maintenir le ratio d'aspect */
    max-width: 100px; /* Taille maximale de l'image */
    max-height: 100px; /* Hauteur maximale de l'image */
    opacity: 0; /* Rendre l'image invisible par défaut */
    transition: opacity 0.3s ease; /* Transition douce pour l'opacité */
}

.corner-image-top-left {
    position: absolute;
    top: 1px; /* Distance du bas du div */
    left: 1px;  /* Distance du côté droit du div */
    width: 20%;   /* Largeur relative au div parent */
    height: auto; /* Maintenir le ratio d'aspect */
    max-width: 100px; /* Taille maximale de l'image */
    max-height: 100px; /* Hauteur maximale de l'image */
    opacity: 0; /* Rendre l'image invisible par défaut */
    transition: opacity 0.3s ease; /* Transition douce pour l'opacité */
}

.corner-image-bottom-right:hover, .corner-image-bottom-left:hover,.corner-image-top-right:hover, .corner-image-top-left:hover {
    opacity: 1; /* Afficher l'image au survol */
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
            <div class="throw-message">
                <div id="firstStepThrow">
                    <div class="content m-auto">
                        <div class="left-side">
                            <form>
                                <div class="message-header">
                                <h3 for="title">Titre</h3><p class="pt-3"> 100 / 100 caractères </p>
                                </div>
                                <input type="text" id="title" name="title" maxlength="100">
                                <div class="message-header">
                                <h3 for="message">Message</h3><p class="pt-3"> 250 / 250 caractères </p>
                                </div>
                                <textarea id="message" name="message" maxlength="250"></textarea>
                            </form>
                        </div>
                        <div class="right-side">
                            <div class="weather">
                                <div class="weather-header">
                                    <h2>12°</h2>
                                    <i class="fas fa-cloud-sun"></i>
                                </div>
                                <div class="weather-info">
                                    <div class="d-flex flex-column p-1">
                                        <p>Ciel dégagé mais quelques pluies sont à prévoir en fin d'après midi</p>
                                        <p>Vitesse du vent : 5m/s</p>
                                        <p>Coefficient de marée : 90</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-upload pb-3">
                        <div class="drop-zone" onmouseover="changeImage('mouseover')" onmouseout="changeImage('mouseout')">
                            <div class="file-info-container">
                                <p class="file-info">Formats de fichiers acceptés : JPG, PNG, MP4, MOV, WebM, TXT, DOCX, PDF</p>
                                <p class="file-info">Jusqu'à 50 Mo</p>
                            </div>
                            <div class="zone d-flex flex-column">
                                <div class="bottle" >
                                    <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/empty-bottle.png';?>" alt="Bottle">
                                </div>
                                <div>
                                    <h2>Glissez-déposez</h2>
                                </div>
                                <div>
                                    <h5>votre fichier ici</h5>
                                </div>
                                <div>
                                    <h5>ou</h5>
                                </div>
                                <div>
                                    <button  type="button" class="buttons-drop-zone btn btn-light waves-effect waves-light">Choisissez un fichier</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <button type="button" class="buttons-step btn btn-light waves-effect waves-light" id="restartThrow"><i class="p-2 mdi mdi-refresh"></i> Recommencer</button>
                        <button type="button" class="buttons-step btn btn-light waves-effect waves-light" id="nextThrow" >Suivant <i class="p-2 mdi mdi-arrow-right-bold-outline"></i></button>
                    </div>
                    <div class="d-flex justify-content-end p-1">
                    </div>    
                </div> 
                <div id="secondStepThrow">
                    <div class="content m-auto">
                        <div class="left-side">
                            <form>
                                <h3>Date</h3> <input type="text" value="2024 / 15 mai / 09:20:56" disabled/> 
                                <h3>Titre</h3> <input type="text" value="Mon premier message à la mer" disabled/>
                                <h3>Message</h3> <textarea id="message" name="message" maxlength="250" disabled>Je suis heureux dans la vie, je n'ai rien à dire.</textarea>
                            </form>
                        </div>
                        <div class="right-side-second">
                        <div id="leaflet-map-popup" class="leaflet-map-custom"></div>
                        </div>
                    </div>
                    <div class="file-upload pb-3">
                        <div class="drop-zone-2">
                            <div class="p-4 form-group row">
                                <div class="col-sm-12">
                                <ul class="mailbox-attachments" id="listFile_1" style="display:block">   
                                    <li id="indexFile_1_1"><span class="mailbox-attachment-icon" style="background-color:#F8F9FA;"><i class="far fa-file-pdf"></i></span><div class="mailbox-attachment-info"><span class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> 2024-OJS063-00185709-fr-ts.pdf</span><span class="mailbox-attachment-size clearfix mt-1"><span>99.82 KiB</span></div></li>    
                                    <li id="indexFile_1_1"><span class="mailbox-attachment-icon" style="background-color:#F8F9FA;"><i class="far fa-file-pdf"></i></span><div class="mailbox-attachment-info"><span class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> 2024-OJS063-00185709-fr-ts.pdf</span><span class="mailbox-attachment-size clearfix mt-1"><span>99.82 KiB</span></div></li>    
                                </ul>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <button type="button" class="buttons-step btn btn-light waves-effect waves-light" id="previousThrow"><i class="p-2 mdi mdi-arrow-left-bold-outline"></i> Retour</button>
                        <button type="button" class="buttons-step btn btn-light waves-effect waves-light" id="validThrow">Jeter <i class="p-2 mdi mdi-email-send-outline"></i></button>
                    </div>
                </div> 

                <div id="delayStepThrow">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="content-success m-auto">
                                <div class=""> 
                                    <div class="p-2">
                                        <div class="text-center">
                                            <div class="bottle mb-4" >
                                                <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/bottle_delay.gif';?>" alt="Bottle">
                                            </div>
                                            <div class="mb-4">
                                                <hr>
                                                <p class="text-muted"><em>"Dans le ballet infini des vagues, une bouteille, abandonnée à son sort, danse au gré des courants, voguant vers l'inconnu. Elle est le messager muet des hommes, porteur d'un secret enfoui dans son ventre de verre. Lancée à la mer, elle entame un voyage poétique, une odyssée solitaire à travers les océans."</em></p>
                                            </div>
                                            <div class="m-4">
                                                <div class="progress progress-xl">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div id="endStepThrow">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="content-success m-auto">
                                <div class=""> 
                                    <div class="p-2">
                                        <div class="text-center">
                                        <div class="bottle mb-4" >
                                            <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/bottle_parchemin.png';?>" alt="Bottle">
                                        </div>
                                            <div class=" mt-2 pr-1" >
                                                <h4 class="pb-2">Partagez votre geste !</h4>
                                                <h5 class="pb-2">Scannez ce QrCode :</h5>
                                                <img  class="my-image p-2" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/qrcode1.png';?>" alt="qrcode">
                                                <h5 class="pt-2">Ou copiez ce lien :</h5>
                                                <input type="text" class="text-center" value="http://otot/1254545454g54dgqsddsfdsf" disabled />
                                            </div>
                                            <div class="mt-2">
                                            <hr>
                                            <div class="p-2">
                                                <i class="bx bxl-twitter"></i>
                                                <i class="bx bxl-discord"></i>
                                                <i class="bx bxl-facebook-circle"></i>
                                                <i class="bx bxl-whatsapp"></i>
                                                </div>
                                                <p class="text-muted"><em>"Dans le ballet infini des vagues, une bouteille, abandonnée à son sort, danse au gré des courants, voguant vers l'inconnu. Elle est le messager muet des hommes, porteur d'un secret enfoui dans son ventre de verre. Lancée à la mer, elle entame un voyage poétique, une odyssée solitaire à travers les océans."</em></p>
                                                <div class="d-flex justify-content-center mt-2">
                                                    <button type="button" id="resetThrow" class="buttons-step btn btn-light waves-effect waves-light" >Lancer une nouvelle bouteille</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-sea">&Agrave; la mer.</h2></div>
            <img class="corner-image-bottom-right" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/throw.jpg';?>" alt="Bottle" />
        </div>
        <div id="zone2" class="zone-top-right col-6 d-flex" style="background-color: lightgreen;" onclick="expandZone('zone2')">
            <button class="close-btn" onclick="closeZone(event, 'zone2')">✖</button>
            <div class="dig-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-hole">Dans un trou.</h2></div>
            <img class="corner-image-bottom-left" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/dig.jpg';?>" alt="Bottle">
        </div>
        <div id="zone3" class="zone-bottom-left col-6 d-flex" style="background-color: lightcoral;" onclick="expandZone('zone3')">
            <button class="close-btn" onclick="closeZone(event, 'zone3')">✖</button>
            <div class="space-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-space">Dans l'espace.</h2></div>
            <img class="corner-image-top-right" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/space.jpg';?>" alt="Bottle">
        </div>
        <div id="zone4" class="zone-bottom-right  col-6 d-flex" style="background-color: lightgoldenrodyellow;" onclick="expandZone('zone4')">
            <button class="close-btn" onclick="closeZone(event, 'zone4')">✖</button>
            <div class="time-message text-center">
                <h1> Bientôt disponible. </h1>
            </div>
            <div class="content-zone-text m-auto"><h2 key="t-time">Dans le temps.</h2></div>
            <img class="corner-image-top-left" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/time.jpg';?>" alt="Bottle">
        </div>
    </div>
</div>

<script>
function changeImage(event) {
    const imgElement = document.getElementById('bottle-image');
    if (event === 'mouseover') {
        imgElement.src = '<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/empty-bottle-without-cap.png';?>';
    } else if (event === 'mouseout') {
        imgElement.src = '<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/empty-bottle.png';?>';
    }
}
</script>
                               