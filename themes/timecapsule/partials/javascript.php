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
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/axios/axios.min.js"></script>';

echo '<!-- Base js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/base.js?='.time().'"></script>';

echo '<!-- App js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/app.js"></script>';

?>