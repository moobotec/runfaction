<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: RouteApiAdmin.php
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
   =    * 18/12/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

use Steampixel\route;
use Carbon\Carbon;

Route::add('/admin/users/(.+)', function($command) {
    
    $controller = new UserController($command);
    $controller->getUsersToJson();
}, 'post');

Route::add('/calcul_trajet.php', function() {
  include 'process/calcul_trajet.php'; 
}, 'post');

Route::add('/phpinfo', function() {
  phpinfo();
});

Route::add('/known-routes', function() {

  $routes = Route::getAll();
  echo '<ul>';
  foreach($routes as $route) {
  echo '<li>'.$route['expression'].' ('.$route['method'].')</li>';
  }
  echo '</ul>';

});

?>