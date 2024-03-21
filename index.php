<?php

// Use this namespace
use Steampixel\Route;
use Steampixel\Component;
use Steampixel\Portal;
use RunFaction\SessionMoobotec;

require 'thirdparty/Steampixel/route.php';
require 'thirdparty/Steampixel/component.php';
require 'thirdparty/Steampixel/portal.php';
require 'thirdparty/Carbon/autoload.php';

include_once("common/session.php");

SessionMoobotec::errorReportingSession();
SessionMoobotec::strictModeSession(1);

include_once("common/common.php"); 

SessionMoobotec::initSession();

include_once("controllers/user/UserController.php");
include_once("controllers/email/EmailController.php");

// Define a global basepath
define('BASEPATH',$param_protocole.'://'.$param_server_principal_domaine.$param_racine);
define('BASE',$param_racine);

// Define our theme
define('THEME','runfaction');

// Add the folders where the components live
Component::addFolder('themes/'.THEME);

// Add the contents folder
Component::addFolder('views');

// Start up the magic portal engine
Portal::init();

$level = SessionMoobotec::getLevel();
if ($level != "None" && !empty($level))
{
    include 'routes/Route'.$level.'.php';
    include 'routes/Api/RouteApi'.$level.'.php';
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
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  header('HTTP/1.0 405 Method Not Allowed');
});

// Run the router
Route::run(BASE);

// Activer le mode sensible à la casse, les barres obliques de fin et le mode de correspondance multiple en définissant les paramètres sur true
//Route::run(BASE, true, true, true);

// Compose, print, render and copy together all the portal magic
Portal::compose();
