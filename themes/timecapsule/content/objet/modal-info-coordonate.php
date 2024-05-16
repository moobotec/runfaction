<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-info-coordonate.php
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
   =    * 16/05/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
?>
<div id="modal-info-coordinate" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" key="modal-info-coord-title">Informations sur les coordonnées cartographiques</h3>
                <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
            </div>
            <div class="modal-body" key="modal-info-coord-body">
                <i class="fa fa-search-plus" aria-hidden="true"></i> Le système cartographique choisi pour représenter les coordonnées est le <a target="_blank" href="https://fr.wikipedia.org/wiki/WGS_84">WGS84</a>.
                <br>
                <i class="fa fa-search-plus" aria-hidden="true"></i> Les limites imposées par le système <a target="_blank" href="https://fr.wikipedia.org/wiki/WGS_84">WGS84</a> sont de [-180.0° à 180.0°].
            </div>
            <div class="modal-footer">
            <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light" data-bs-dismiss="modal" ><h4 key="modal-close">Fermer</h4></button>
            </div>
        </div>
    </div>
</div>