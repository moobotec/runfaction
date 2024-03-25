
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
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
    <form id="critariaSearchForm">
    <div class="form-group row">
        <label for="critaria_search_name" class="col-sm-3 col-form-label">Nom :</label>
        <div class="input-group col-sm-4">
            <input type="text" class="form-control" id="critaria_search_name" name="critaria_search_name" placeholder="Dupont">
        </div>
    </div>
    <div class="form-group row">
        <label for="critaria_search_lastname" class="col-sm-3 col-form-label">Prénom :</label>
        <div class="input-group col-sm-4">
            <input type="text" class="form-control" id="critaria_search_lastname" name="critaria_search_lastname" placeholder="Jean Pierre">
        </div>
    </div>
    <div class="form-group row">
        <label for="critaria_search_date_option" class="col-sm-2 col-form-label text-truncate">Dates d'inscription :</label>
        <select id="critaria_search_date_option" class="custom-select col-sm-1 pl-1 pr-1">
            <option value=""></option>
            <option value="-">Entre</option>
            <option value="<">Inférieure à</option>
            <option value=">">Supérieure à</option>
            <option value="==">&Eacute;gale à</option>
            <option value="!=">Différent de</option>
        </select>
        <div class="input-group col-sm-4 date" id="datetimepicker1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="critaria_search_date_start" disabled />
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
        <label for="critaria_search_date_end" class="col-sm-1 col-form-label text-center"> et </label>
        <div class="input-group col-sm-4 date" id="datetimepicker2" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="critaria_search_date_end" disabled />
            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="critaria_role" class="col-sm-3 col-form-label">Rôle :</label>
        <div class="input-group col-sm-4">
            <select name="critaria_role" id="critaria_role" class="select2" multiple="multiple" data-placeholder="Faire une sélection parmi cette liste" style="width: 100%;">
                <option value="1">Administrateur</option>
                <option value="2">Manager</option>
                <option value="3">Consultant</option>
                <option value="4">Technicien</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="critaria_search_state" class="col-sm-3 col-form-label">Etat :</label>
        <div class="input-group col-sm-4">
            <select name="critaria_search_state" id="critaria_search_state" class="select2" multiple="multiple" data-placeholder="Faire une sélection parmi cette liste" style="width: 100%;">
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
    <div class="form-group row">
        <label for="critaria_search_number_max" class="col-sm-3 col-form-label text-truncate">Nombre maximum de ligne :</label>
        <div class="input-group col-sm-4">
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

<div class="row">
    <div class="col-12">
    <table id="table_users" class="table table-striped table-bordered"></table>
    </div>
</div>
<!-- end page title -->