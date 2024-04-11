<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: RouteGuest.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

use Steampixel\route;
use Steampixel\Component;
use RunFaction\SessionMoobotec;

Route::add('/', function() {
    Component::create('guest/signin')->print();
}, 'get');

Route::add('/index.php', function() {
    Component::create('guest/signin')->print();
}, 'get');

Route::add('/signin.php', function() {
    Component::create('guest/signin')->print();
}, 'get');
  
Route::add('/signup.php', function() {
    Component::create('guest/signup')->print();
}, 'get');

Route::add('/askresetpassword.php', function() {
    Component::create('guest/askresetpassword')->print();
}, 'get');


Route::add('/reset.php/(.+)/(.+)', function($matches,$codereset) 
{
    global $globaluser;
    $level =  SessionMoobotec::getLevel();
    $controller = new UserController();
    $return = $controller->getUserByUuid($matches);
    if ( $return["error"] == null)
    {
        $globaluser = $return["user"];
        if ($codereset == $globaluser->codereset)
        {
            Component::create('guest/reset')->print();
        }
        else
        {
            header('HTTP/1.0 404 Not Found');
            Component::create('commun/404')->assign(['level'=>$level])->print();
        }
    }
    else
    {
        header('HTTP/1.0 404 Not Found');
        Component::create('commun/404')->assign(['level'=>$level])->print();
    }
}, 'get');

Route::add('/check.php/(.+)/(.+)', function($matches,$codefirst) 
{
    global $globaluser;
    $level =  SessionMoobotec::getLevel();
    $controller = new UserController();
    $return = $controller->getUserByUuid($matches);
    if ( $return["error"] == null)
    {
        $globaluser = $return["user"];
        if ($codefirst == $globaluser->codefirst)
        {
            Component::create('guest/check')->print();
        }
        else
        {
            header('HTTP/1.0 404 Not Found');
            Component::create('commun/404')->assign(['level'=>$level])->print();
        }
    }
    else
    {
        header('HTTP/1.0 404 Not Found');
        Component::create('commun/404')->assign(['level'=>$level])->print();
    }
}, 'get');


?>