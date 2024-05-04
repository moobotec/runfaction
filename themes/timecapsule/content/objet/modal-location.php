<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-location.php
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
   =    * 04/05/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
?>
<div id="positionModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel" key="modal-position-title">Modifier votre position</h3>
                <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
            </div>
            <div class="modal-body">

            <div class="pb-3 my-1 row">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <h2 class="p-3"><i class="bx bx-street-view"></i></h2>
                    </div>
                    <div class="">
                        <h2 class="p-3" id="posCurrent"> 0.000° ?, 0.000° ?, ????, Terre </h2>
                    </div>
                </div>
            </div>
                <div class="auto-search-wrapper loupe">
                <input
                    type="text"
                    autocomplete="off"
                    id="search"
                    class="full-width"
                    placeholder="Rechercher un lieu"
                />
                </div>
                <hr>
                <div id="map" class="modal-body leaflet-map"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light"><h4 key="modal-apply">Appliquer les changements</h4></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->