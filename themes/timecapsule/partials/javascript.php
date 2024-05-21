<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  TimeCapsule 
   =
   =  FICHIER: javascript.php
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
   =    * 16/04/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);
    
echo '<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/jquery/jquery.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/simplebar/simplebar.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/node-waves/waves.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/axios/axios.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/gh/tomickigrzegorz/autocomplete@2.0.1/dist/js/autocomplete.min.js"></script>';

echo '<!-- Base js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/base.js?='.time().'"></script>';

if (str_contains($pages,"index") || str_contains($pages,"find") )
{
     echo '<!-- func.global js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.global.js?='.time().'"></script>
     <!-- func.time js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.time.js?='.time().'"></script>
     <!-- func.location js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.location.js?='.time().'"></script>
     <!-- func.lang js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.lang.js?='.time().'"></script>
     <!-- func.gen js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.gen.js?='.time().'"></script>
     <!-- func.cookie js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.cookie.js?='.time().'"></script>
     <!-- func.theme js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/func/func.theme.js?='.time().'"></script>
     ';
     echo '<!-- Timecapsule js -->
     <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/timecapsule.js?='.time().'"></script>';
}



echo '<!-- App js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/app.js"></script>';

?>