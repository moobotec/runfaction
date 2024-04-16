<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: style.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);

echo '<!-- App favicon -->
<link rel="icon" sizes="any" type="image/x-icon" href="'.BASEPATH.'themes/'.THEME.'/assets/images/favicon.ico">';

if (str_contains($pages,"guest"))
{
    echo '<!-- owl.carousel css -->
    <link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/owl.carousel/assets/owl.theme.default.min.css">';
}
else
{

  echo '<link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" >';

  echo '<link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
  <link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/@chenfengyuan/datepicker/datepicker.min.css">';

  echo '<link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
      <link rel="stylesheet" href="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">';
  
}

echo '<!-- Bootstrap Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/app.min.css?='.time().'" id="app-style" rel="stylesheet" type="text/css" />
<!-- toastr Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />

<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/celios.css?='.time().'" rel="stylesheet" type="text/css" />

';

if (!str_contains($pages,"guest"))
{

echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/@bopen/leaflet-area-selection@0.6.1/dist/index.css" />';

}
?>

<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />