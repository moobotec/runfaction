<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  TimeCapsule 
   =
   =  FICHIER: RouteGuest.php
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
   =
 * ========================================================================= */
/** @file  */

use Steampixel\route;
use Steampixel\Component;

Route::add('/', function() {
    Component::create('guest/index')->print();
}, 'get');

Route::add('/index.php', function() {
    Component::create('guest/index')->print();
}, 'get');

?>