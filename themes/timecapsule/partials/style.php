<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: style.php
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

echo '<!-- App favicon -->
<link rel="icon" sizes="any" type="image/x-icon" href="'.BASEPATH.'themes/'.THEME.'/assets/images/favicon.ico">';

echo '<!-- Bootstrap Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/app.min.css?='.time().'" id="app-style" rel="stylesheet" type="text/css" />';

if (str_contains($pages,"index") || str_contains($pages,"find") )
{
    echo '<!-- Timecapsule Css-->
    <link href="'.BASEPATH.'themes/'.THEME.'/assets/css/timecapsule.css?='.time().'" id="timecapsule-style" rel="stylesheet" type="text/css" />';
}
else
{
    echo '<!-- Timecapsule Css-->
    <link href="'.BASEPATH.'themes/'.THEME.'/assets/css/timecapsule-about.css?='.time().'" id="timecapsule-style" rel="stylesheet" type="text/css" />';
}

echo '<!-- toastr Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<!-- autocomplete -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomickigrzegorz/autocomplete@2.0.1/dist/css/autocomplete.min.css"/>';

