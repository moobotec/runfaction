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
            <div class="cla-throw-message text-center">
                <h1 key="t-coming-soon"> Bientôt disponible. </h1>
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


                               