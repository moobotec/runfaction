<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: RouteAdmin.php
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

Route::add('/settings.php', function() {
    Component::create('commun/user/settings')->print();
});

Route::add('/process.php', function() {
    Component::create('commun/process')->print();
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