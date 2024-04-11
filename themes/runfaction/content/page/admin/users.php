
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: users.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: FrontEnd / Backend de suivie des performances pour les sportifs, entraineurs et associations
   =
   =  INTERVENTION:
   =
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

?>

<style>
.page-link {
  font-size: 8pt;
}
.pagination {
    --bs-pagination-border-radius : 0.2rem;
}
</style>

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Admin - Users</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin - Users</a></li>
                    <li class="breadcrumb-item active">Admin - Users</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="critariaSearchForm">
                        <div class="mb-3 row">
                            <label for="critaria_search_name" class="col-md-2 col-form-label">Nom :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="critaria_search_name" name="critaria_search_name" placeholder="Dupont">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="critaria_search_lastname" class="col-md-2 col-form-label">Prénom :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="critaria_search_lastname" name="critaria_search_lastname" placeholder="Jean Pierre">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="critaria_search_date_option" class="col-md-2 col-form-label text-truncate">Dates d'inscription :</label>
                            <div class="col-sm-2">
                            <select id="critaria_search_date_option" class="form-select pl-1 pr-1">
                                <option value=""></option>
                                <option value="-">Entre</option>
                                <option value="<">Inférieure à</option>
                                <option value=">">Supérieure à</option>
                                <option value="==">&Eacute;gale à</option>
                                <option value="!=">Différent de</option>
                            </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control" data-date-container='#datetimepicker1' data-provide="datepicker"
                                    data-date-format="MM yyyy" data-date-min-view-mode="1" data-date-language="fr-fr">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group" id="datetimepicker2" data-target-input="nearest">
                                    <input type="text" class="form-control" data-date-container='#datetimepicker2' data-provide="datepicker"
                                    data-date-format="MM yyyy" data-date-min-view-mode="1" data-date-language="fr-fr">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>


                        </div>
                        <div class="mb-3 row">
                            <label for="critaria_role" class="col-md-2 col-form-label">Rôle :</label>
                            <div class="col-md-10">
                                <select name="critaria_role" id="critaria_role" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Faire une sélection parmi cette liste" style="width: 100%;">
                                    <option value="1">Administrateur</option>
                                    <option value="2">Manager</option>
                                    <option value="3">Consultant</option>
                                    <option value="4">Technicien</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="critaria_search_state" class="col-md-2 col-form-label">Etat :</label>
                            <div class="col-md-10">
                            <select name="critaria_search_state" id="critaria_search_state" class="select2 form-control select2-multiple"
                                                            multiple="multiple" data-placeholder="Faire une sélection parmi cette liste" style="width: 100%;">

                                    <option value="1">Inscription en cours</option>
                                    <option value="2">Validé</option>
                                    <option value="3">Modification en cours</option>
                                    <option value="4">Bannie</option>
                                    <option value="5">Supprimé</option>
                                    <option value="6">En attente</option>
                                    <option value="7">Annulé</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="critaria_search_number_max" class="col-md-2 col-form-label text-truncate">Nombre maximum de ligne :</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" id="critaria_search_number_max" name="critaria_search_number_max" value="1000" min="1" max="50000">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="justify-content-start pt-2">
                                <small>- Soit une seule date (inférieure,surpérieure,égale ou différente), soit un créneau composé de deux dates </small><br />
                                <small>- Attention : un très grand nombre de lignes impliquera forcement un chargement plus long des données et un blocage du navigateur </small><br />
                            </div>
                            <div class="justify-content-end pt-2">
                                <button id="button_critaria_search" type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                                <button type="button" onclick="reset_critere_recherche()" class="btn btn-danger btn-sm">Effacer tous les critères</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="table_users" class="table table-striped table-bordered"></table>
                </div>
            </div>
        </div>
    </div>
<!-- end page title -->