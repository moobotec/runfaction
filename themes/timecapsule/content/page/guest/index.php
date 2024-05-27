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

<div class="d-flex justify-content-between">
    <div class="col-lg-5">
        <div class="cla-vertical-center-container">
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
            <button type="button" id="btnDatetimeModal" class="cla-button-date btn header-item waves-effect" data-bs-toggle="modal" data-bs-target="#datetimeModal">
            <h1 class="pt-3"> <i class="bx bx-time-five"></i></h1><h1 class="p-1 my-2" id="clock"> [ xxx ][ xx xxxx ][ xx : xx : xx ]</h1>
            </button>
            </div>
            <div class="row">
            <button type="button" id="btnPositionModal" class="cla-button-position btn header-item waves-effect" data-bs-toggle="modal" data-bs-target="#positionModal">
            <h3 class="pt-3"><i class="bx bx-street-view"></i></h3><h3 class="p-1 my-2 "id="position" ></i></h3>
            </button>
            </div>
        </div>
    </div>
</div>
<div class="p-0">
    <div class="row g-0 ">
        <div id="zone1" class="cla-zone-top-left col-6 d-flex" style="background-color: lightblue;" onclick="expandZone('zone1')">
            <button class="cla-close-btn" onclick="closeZone(event, 'zone1')">✖</button>
            <div class="cla-throw-message">
                <div id="firstStepThrow">
                    <div class="cla-content-message m-auto">
                        <div class="cla-left-side-message">
                            <form>
                                <div class="cla-header-message">
                                    <h3 for="title" key="t-title-message">Titre</h3><div class="cla-count-text-container"><p class="pt-3" id="titleCharacterCount" >100 / 100</p><p class="pt-3" key="t-character">caractères</p></div>
                                </div>
                                <input type="text" id="throw-title" name="title" maxlength="100" value="Le bonheur est dans le près.">
                                <div class="cla-header-message">
                                    <h3 for="message" key="t-body-message">Message</h3><div class="cla-count-text-container"><p class="pt-3 ml-1" id="bodyCharacterCount">250 / 250</p><p class="ml-1 pt-3" key="t-character">caractères</p></div>
                                </div>
                                <textarea id="throw-message" name="message" maxlength="250">La vérité si je mens, le bonheur est dans le près.</textarea>
                            </form>
                        </div>
                        <div class="cla-right-side-message">
                            <div class="cla-weather">
                                <div class="cla-weather-header">
                                    <h2>12°</h2>
                                    <i class="fas fa-cloud-sun"></i>
                                </div>
                                <div class="cla-weather-info">
                                    <div class="d-flex flex-column p-1">
                                        <p key="t-weather-info-1">Ciel dégagé mais quelques pluies sont à prévoir en fin d'après midi</p>
                                        <p key="t-weather-info-2">Vitesse du vent : 5m/s</p>
                                        <p key="t-weather-info-3">Coefficient de marée : 90</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="cla-file-upload pb-3">
                        <div class="cla-drop-zone" onmouseover="changeImage('mouseover')" onmouseout="changeImage('mouseout')" id="drop-zone-file">
                            <div class="cla-file-info-container">
                                <div class="d-flex justify-content-between ">
                                    <div class="m-0 p-0">
                                        <p class="file-info" key="t-format-message">Formats de fichiers acceptés : ZIP, TXT, PDF, etc.</p> 
                                    </div>
                                    <div class="m-0 p-0">
                                        <p class="file-info"><button type="button" class="btn btn-tool auto" id="btn-modal-info-file-format"><i class="fas fa-info-circle"></i></button> </p> 
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="m-0 p-0">
                                        <p class="file-info" key="t-size-message">Jusqu'à 50 Mo pour un maximum de 5 fichiers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cla-zone d-flex flex-column">
                                <ul class="cla-file-attachments" id="listFile" style="display: none;"></ul>
                                <div id="msgInfo">
                                    <div class="cla-bottle">
                                        <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/empty-bottle.png';?>" alt="Bottle">
                                    </div>
                                    <div>
                                        <h2 key="t-action-message">Glissez-déposez</h2>
                                    </div>
                                    <div>
                                        <h5 key="t-file-message-1">votre fichier ici</h5>
                                    </div>
                                    <div>
                                        <h5 key="t-file-message-2">ou</h5>
                                    </div>
                                </div>
                                <div>
                                    <button  type="button" id="btn-throw-file-message" class="cla-button-drop-zone btn btn-light waves-effect waves-light" onclick="document.getElementById('throw-file-message').click();"><div key="t-choose-file-message">Choisissez un ou plusieurs fichiers</div><input type="file" name="throw-file-message" id="throw-file-message" style="display: none;" multiple></button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <button type="button" class="cla-button-step btn btn-light waves-effect waves-light" id="restartThrow" key="t-btn-restart-message"><i class="p-2 mdi mdi-refresh"></i> Recommencer</button>
                        <button type="button" class="cla-button-step btn btn-light waves-effect waves-light" id="nextThrow" key="t-btn-next-message">Suivant <i class="p-2 mdi mdi-arrow-right-bold-outline"></i></button>
                    </div>
                    <div class="d-flex justify-content-end p-1">
                    </div>    
                </div> 
                <div id="secondStepThrow">
                    <div class="cla-content-message m-auto">
                        <div class="cla-left-side-message">
                            <form>
                                <h3 key="t-date-message">Date</h3> <input type="text" id="check-throw-date"  value="" disabled/> 
                                <h3 key="t-title-message">Titre</h3> <input type="text" id="check-throw-title" value="" disabled/>
                                <h3 key="t-body-message">Message</h3> <textarea  id="check-throw-message" name="message" disabled></textarea>
                            </form>
                        </div>
                        <div class="cla-right-side-message-2">
                            <div id="leaflet-map-popup" class="cla-leaflet-map-custom"></div>
                        </div>
                    </div>
                    <div class="cla-file-upload pb-3">
                        <div class="cla-drop-zone" id="drop-zone-file">
                            <div class="cla-zone d-flex flex-column pt-4">
                                <ul class="cla-file-attachments" id="checkListFile" style="display: none;"></ul>
                                <div id="checkMsgInfo">
                                    <div class="cla-bottle pb-4">
                                        <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/empty-bottle.png';?>" alt="Bottle">
                                    </div>
                                    <div>
                                        <h5 key="t-none-file">Aucun fichier n'a été téléversé.</h5>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <button type="button" class="cla-button-step btn btn-light waves-effect waves-light" id="previousThrow" key="t-btn-previous-message"><i class="p-2 mdi mdi-arrow-left-bold-outline"></i> Retour</button>
                        <button type="button" class="cla-button-step btn btn-light waves-effect waves-light" id="validThrow" key="t-btn-throw-message">Jeter <i class="p-2 mdi mdi-email-send-outline"></i></button>
                    </div>
                </div> 

                <div id="delayStepThrow">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="cla-content-success m-auto">
                                <div class=""> 
                                    <div class="p-2">
                                        <div class="text-center">
                                            <div class="cla-bottle mb-4" >
                                                <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/bottle_delay.gif';?>" alt="Bottle">
                                            </div>
                                            <div class="mb-4">
                                                <hr>
                                                <p class="text-muted" key="t-quote-message"><em>"Dans le ballet infini des vagues, une bouteille, abandonnée à son sort, danse au gré des courants, voguant vers l'inconnu. Elle est le messager muet des hommes, porteur d'un secret enfoui dans son ventre de verre. Lancée à la mer, elle entame un voyage poétique, une odyssée solitaire à travers les océans."</em></p>
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
                            <div class="cla-content-success m-auto">
                                <div class=""> 
                                    <div class="p-2">
                                        <div class="text-center">
                                        <div class="cla-bottle mb-4" >
                                            <img id="bottle-image" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/bottle_parchemin.png';?>" alt="Bottle">
                                        </div>
                                            <div class=" mt-2 pr-1" >
                                                <h4 class="pb-2" key="t-endstep-message-1">Partagez votre geste !</h4>
                                                <h5 class="pb-2" key="t-endstep-message-2">Scannez ce QrCode :</h5>
                                                <img  class="cla-qrcode-image p-2" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/qrcode1.png';?>" alt="qrcode">
                                                <h5 class="pt-2" key="t-endstep-message-3">Ou copiez ce lien :</h5>
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
                                                <p class="text-muted" key="t-quote-message"><em>"Dans le ballet infini des vagues, une bouteille, abandonnée à son sort, danse au gré des courants, voguant vers l'inconnu. Elle est le messager muet des hommes, porteur d'un secret enfoui dans son ventre de verre. Lancée à la mer, elle entame un voyage poétique, une odyssée solitaire à travers les océans."</em></p>
                                                <div class="d-flex justify-content-center mt-2">
                                                    <button type="button" id="resetThrow" class="cla-button-step btn btn-light waves-effect waves-light" key="t-btn-reset-throw-message">Lancer une nouvelle bouteille</button>
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
            <div class="cla-content-zone-text m-auto"><h2 key="t-sea">&Agrave; la mer.</h2></div>
        </div>
        <div id="zone2" class="cla-zone-top-right col-6 d-flex" style="background-color: lightgreen;" onclick="expandZone('zone2')">
            <button class="cla-close-btn" onclick="closeZone(event, 'zone2')">✖</button>
            <div class="cla-dig-message text-center">
                <h1 key="t-coming-soon"> Bientôt disponible. </h1>
            </div>
            <div class="cla-content-zone-text m-auto"><h2 key="t-hole">Dans un trou.</h2></div>
        </div>
        <div id="zone3" class="cla-zone-bottom-left col-6 d-flex" style="background-color: lightcoral;" onclick="expandZone('zone3')">
            <button class="cla-close-btn" onclick="closeZone(event, 'zone3')">✖</button>
            <div class="cla-space-message text-center">
                <h1 key="t-coming-soon"> Bientôt disponible. </h1>
            </div>
            <div class="cla-content-zone-text m-auto"><h2 key="t-space">Dans l'espace.</h2></div>
        </div>
        <div id="zone4" class="cla-zone-bottom-right  col-6 d-flex" style="background-color: lightgoldenrodyellow;" onclick="expandZone('zone4')">
            <button class="cla-close-btn" onclick="closeZone(event, 'zone4')">✖</button>
            <div class="cla-time-message text-center">
                <h1 key="t-coming-soon"> Bientôt disponible. </h1>
            </div>
            <div class="cla-content-zone-text m-auto"><h2 key="t-time">Dans le temps.</h2></div>
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
                               