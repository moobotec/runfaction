<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: index.php
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
   =    * 12/12/2023 : David DAUMAND
   =        Creation du module.
   =    * 15/02/2024 : David DAUMAND
   =        Test Github
 * ========================================================================= */
/** @file  */

// Use this namespace
use Steampixel\Route;
use Steampixel\Component;
use Steampixel\Portal;
use Moobotec\SessionMoobotec;

require 'thirdparty/Steampixel/route.php';
require 'thirdparty/Steampixel/component.php';
require 'thirdparty/Steampixel/portal.php';
require 'thirdparty/Carbon/autoload.php';

// attention le theme est rempli par le script d'install
define('THEME','');

include_once("common/session.php");

SessionMoobotec::errorReportingSession();
SessionMoobotec::strictModeSession(1);

include_once("common/common.php"); 

SessionMoobotec::initSession();

include_once('controllers/'.THEME.'/user/UserController.php');
include_once('controllers/'.THEME.'/email/EmailController.php');

if ($_SERVER['HTTP_HOST'] != $param_server_principal_domaine && $param_environement != 'PROD')
{
    $param_server_principal_domaine = $_SERVER['HTTP_HOST'];
}

// Define a global basepath
define('BASEPATH',$param_protocole.'://'.$param_server_principal_domaine.$param_racine);
define('BASE',$param_racine);

// Add the folders where the components live
Component::addFolder('themes/'.THEME);

// Add the contents folder
Component::addFolder('views/'.THEME);

// Start up the magic portal engine
Portal::init();

$level = SessionMoobotec::getLevel();
if ($level != "None" && !empty($level))
{
    include 'routes/'.THEME.'/Route'.$level.'.php';
    include 'routes/'.THEME.'/Api/RouteApi'.$level.'.php';
}

Route::add('/logout.php', function() {
    SessionMoobotec::removeSession();
    $redirectLocation = "Location: ".BASEPATH;
    header($redirectLocation);
}, 'get');

// Add a 404 not found route
Route::pathNotFound(function($path) {
  global $level;
  header('HTTP/1.0 404 Not Found');
  Component::create('commun/404')->assign(['level'=>$level])->print();
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  global $level;
  header('HTTP/1.0 405 Method Not Allowed');
  Component::create('commun/error')->assign(['level'=>$level])->print();
});

// Run the router
Route::run(BASE);

// Activer le mode sensible à la casse, les barres obliques de fin et le mode de correspondance multiple en définissant les paramètres sur true
//Route::run(BASE, true, true, true);

// Compose, print, render and copy together all the portal magic
Portal::compose();
