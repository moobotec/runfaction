<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: variables.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
use Moobotec\SessionMoobotec;

global $param_racine;
global $param_environement;
global $param_bdd;
global $param_version;

echo '<script>';
echo 'var pathnameMoobotec = "'.$param_racine.'";';
echo 'var environnementMoobotec = "'.$param_environement.'";';
echo 'var baseMoobotec = "'.$param_bdd.'";';
echo 'var versionMoobotec = "'.$param_version.'";';
echo 'var countDownEcart = 300000;';
echo 'var session_id = "'.SessionMoobotec::getSessionId().'";';
echo 'var deleted_time = "'.SessionMoobotec::getValueUserSession('deleted_time').'";';
echo 'var is_cookie = "'.SessionMoobotec::isRememberUser().'";';
echo 'var ip_public = "'.get_public_ip_func().'";';
echo 'var ip_local = "'.get_ip_func().'";';
echo 'var error_reporting = "'.error_reporting().'";';
echo 'var error_reporting = "'.error_reporting().'";';

$infoNavigateur = get_position();
$latitude = ( $infoNavigateur['geoplugin_latitude'] != null ) ? $infoNavigateur['geoplugin_latitude'] : null;
$longitude = ( $infoNavigateur['geoplugin_longitude'] != null ) ? $infoNavigateur['geoplugin_longitude'] : null;

echo 'var latitudeNavigator = '.$latitude.';';
echo 'var longitudeNavigator = '.$longitude.';';

echo '</script>';
?>
