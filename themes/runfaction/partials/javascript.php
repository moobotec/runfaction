<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: javascript.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);
    

echo '<script src="'.BASEPATH.'themes/runfaction/assets/libs/jquery/jquery.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/simplebar/simplebar.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/node-waves/waves.min.js"></script>';

if ($pages == "guest")
{
    echo '<!-- owl.carousel js -->
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <!-- auth-2-carousel init -->
    <script src="'.BASEPATH.'themes/runfaction/assets/js/pages/auth-2-carousel.init.js"></script>';
}

echo '<!-- App js -->
<script src="'.BASEPATH.'themes/runfaction/assets/js/app.js"></script>';

?>