<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: style.php
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

echo '<!-- App favicon -->
<link rel="icon" sizes="any" type="image/x-icon" href="'.BASEPATH.'themes/runfaction/assets/images/favicon.ico">';

if (str_contains($pages,"guest"))
{
    echo '<!-- owl.carousel css -->
    <link rel="stylesheet" href="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/assets/owl.theme.default.min.css">';
}

echo '<!-- Bootstrap Css -->
<link href="'.BASEPATH.'themes/runfaction/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="'.BASEPATH.'themes/runfaction/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="'.BASEPATH.'themes/runfaction/assets/css/app.min.css?='.time().'" id="app-style" rel="stylesheet" type="text/css" />
<link href="'.BASEPATH.'themes/runfaction/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
';


?>