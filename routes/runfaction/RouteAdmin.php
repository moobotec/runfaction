<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: RouteAdmin.php
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
   =
 * ========================================================================= */
/** @file  */

use Steampixel\route;
use Steampixel\Component;


Route::add('/', function() {
    Component::create('commun/index')->print();
});

Route::add('/index.php', function() {
    Component::create('commun/index')->print();
});

Route::add('/profil.php', function() {
    Component::create('commun/user/profil')->print();
});

Route::add('/runs.php', function() {
    Component::create('commun/runs')->print();
});

Route::add('/events.php', function() {
    Component::create('commun/events')->print();
});


Route::add('/admin/main.php', function() {
    Component::create('admin/main')->print();
});

Route::add('/admin/users.php', function() {
    Component::create('admin/users')->print();
});

Route::add('/admin/user.php', function() {
    Component::create('admin/user')->print();
});

Route::add('/admin/settings.php', function() {
    Component::create('admin/settings')->print();
});

?>