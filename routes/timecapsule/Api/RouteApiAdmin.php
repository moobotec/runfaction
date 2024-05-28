<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: RouteApiAdmin.php
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
   =    * 28/05/2024 : David DAUMAND
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