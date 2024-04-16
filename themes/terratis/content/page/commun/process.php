
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: process.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: Plannificateur de lacher de moustique stérilisé
   =
   =  INTERVENTION:
   =
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

?>

<style>
    #map {
        height: 450px;
    }
</style>

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Interventions</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Interventions</a></li>
                    <li class="breadcrumb-item active">Interventions</li>
                </ol>
            </div>

        </div>
</div>
</div>
<div class="row">
    <div class="input-group col-12">
        <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Configurateur</h5>
                        <p class="card-title-desc">Veuillez configurer une tournée avant de procéder au calcul.</p>

                        <form id="form" action="calcul_trajet.php" method="post">

                            <input type="hidden" name="latitude" id="latitude"  readonly>
                            <input type="hidden" name="longitude" id="longitude" readonly>
                            <textarea id="polygoneArea" name="polygoneArea" rows="5" cols="33" style="display:none"></textarea>

                            <div class="row mb-4">
                                <label for="distance_tis" class="col-sm-4 col-form-label">Porté d'un TIS (m)</label>
                                <div class="col-sm-8">
                                    <input type="number" id="distance_tis" name="distance_tis" class="form-control" id="horizontal-email-input" value="100">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Nombre de TIS </label>
                                <div class="col-sm-8">
                                    <input type="number" id="nbr_tis" class="form-control" id="horizontal-email-input" value="100">
                                </div>
                            </div>
                           
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Déplacement</label>
                                <select id="formrow-inputState" class="form-select">
                                    <option value="1">A pied</option>
                                    <option value="2">En deux roues</option>
                                    <option value="3">En véhicule motorisé</option>
                                    <option value="4">En drone (non prévue)</option>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="floatingCheck">
                                    <label class="form-check-label" for="floatingCheck">
                                        Simuler le trajet du tisseur
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md" id="btnCompute" data-nlok-ref-guid="dbb46135-c689-4bd2-e0d7-261bab83252c">Calculer le trajet</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
                <!-- end col -->
            <div class="px-2 col-9">
                <div id="map"></div>
                <!-- end card body -->
            </div>
                <!-- end card -->
        </div>
            <!-- end col -->
    </div>
</div>
        <div class="row pt-1">
            <div class="col-12">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Résultats en quelques chiffres</h5>
                       
                        <div class="">
                            
                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Temps de calcul</label>
                                <div class="col-sm-8">
                                    <input type="text" id="temps_total" class="form-control" id="horizontal-email-input" value="0" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Distance rue (km)</label>
                                <div class="col-sm-8">
                                    <input type="text" id="distance_street" class="form-control" id="horizontal-email-input" value="0" readonly>
                                </div>
                            </div>
                        
                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Distance parcourue (km)</label>
                                <div class="col-sm-8">
                                    <input type="text" id="distance_total" class="form-control" id="horizontal-email-input" value="0" readonly>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Nombre total de TIS </label>
                                <div class="col-sm-8">
                                    <input type="text" id="tis_total" class="form-control" id="horizontal-email-input" value="0" readonly>
                                </div>
                            </div>

                        </div>

                    </div>

            </div>
        </div>


    </div>
</div>
<!-- end page title -->