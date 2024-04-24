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
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/app.min.css?='.time().'" id="app-style" rel="stylesheet" type="text/css" />
<!-- toastr Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
';