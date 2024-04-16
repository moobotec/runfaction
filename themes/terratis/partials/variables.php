<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: variables.php
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
use Moobotec\SessionMoobotec;

global $param_racine;
global $param_environement;
global $param_bdd;
global $param_version;
echo '<script> var pathnameMoobotec = "'.$param_racine.'";</script>';
echo '<script> var environnementMoobotec = "'.$param_environement.'";</script>';
echo '<script> var baseMoobotec = "'.$param_bdd.'";</script>';
echo '<script> var versionMoobotec = "'.$param_version.'";</script>';
echo '<script> var countDownEcart = 300000;</script>';
echo '<script> var session_id = "'.SessionMoobotec::getSessionId().'";</script>';
echo '<script> var deleted_time = "'.SessionMoobotec::getValueUserSession('deleted_time').'";</script>';
echo '<script> var is_cookie = "'.SessionMoobotec::isRememberUser().'";</script>';
echo '<script> var ip_public = "'.get_public_ip_func().'";</script>';
echo '<script> var ip_local = "'.get_ip_func().'";</script>';
echo '<script> var error_reporting = "'.error_reporting().'";</script>';
?>
