<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-configuration.php
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
<div id="configurationModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel" key="modal-configuration-title">Configuration</h3>
                <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
            </div>
            <div class="modal-body">
            <p class="card-title-desc" key="modal-datetime-utc" >Vous pouvez changer le notation de l'heure.</p>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label" key="modal-notation">Notation</label>
                <div class="col-md-5">
                    <select id="selectNotation" class="form-select">
                        <option value="24h" key="modal-notation-24">24 heures</option>
                        <option value="12h" key="modal-notation-12">12 heures</option>
                    </select>
                </div>
            </div>
            <p class="card-title-desc" key="modal-config-theme" >Vous pouvez changer le thème.</p>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label" key="modal-theme">Thème</label>
                <div class="col-md-5">
                    <select id="selectTheme" class="form-select">
                        <option value="light-mode-switch" key="modal-theme-light">Clair</option>
                        <option value="dark-mode-switch" key="modal-theme-dark">Sombre</option>
                    </select>
                </div>
            </div>
            <p class="card-title-desc" key="modal-config-sync" >Vous pouvez activer ou non la synchronisation de l'horloge courante.</p>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label" key="modal-sync">Synchronisation</label>
                <div class="col-md-5">
                    <select id="selectSync" class="form-select">
                        <option value="sync" key="modal-sync-yes">Oui</option>
                        <option value="no-sync" key="modal-sync-no">Non</option>
                    </select>
                </div>
            </div>
            <p class="card-title-desc" key="modal-config-carto" >Vous pouvez changer le fond de carte.</p>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label" key="modal-carto">Fond de carte</label>
                <div class="col-md-8 ">
                    <select id="selectCarto" class="form-select">
                    <option value="http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" >OSM-Org : http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png</option>
                    <option value="http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png" >OSM-Fr : http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png</option>
                    <option value="http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png" >Humanitaire-Fr : http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png</option>
                    <option value="http://{s}.tile.osm.org/{z}/{x}/{y}.png" >OpenStreetMap : http://{s}.tile.osm.org/{z}/{x}/{y}.png</option>
                    <option value="http://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png" >OSM – Deutschland : http://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png</option>
                    <option value="http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png" >CartoDB : http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png</option>
                    </select>
                </div>
            </div>
            <p class="card-title-desc" key="modal-datetime-utc" >Vous pouvez changer les paramètres sur les cookies.</p>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Cookie</label>
                <div class="col-md-5">
                    <button type="button" id="btResetCookies" class="btn btn-primary waves-effect waves-light" key="modal-reset-cookies">
                        <i class="bx bx-smile font-size-16 align-middle me-2"></i> Réinitialiser
                    </button>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btConfigModify" class="buttons-position btn btn-light header-item waves-effect waves-light"><h4 key="modal-apply">Appliquer les changements</h4></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->