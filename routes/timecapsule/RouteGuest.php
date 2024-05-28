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
use Moobotec\SessionMoobotec;

Route::add('/', function() {
    Component::create('guest/index')->print();
}, 'get');

Route::add('/index.php', function() {
    Component::create('guest/index')->print();
}, 'get');

Route::add('/throw.php', function() {
    Component::create('guest/throw')->print();
}, 'get');

Route::add('/find.php', function() {
    Component::create('guest/find')->print();
}, 'get');

Route::add('/about.php', function() {
    Component::create('guest/about')->print();
}, 'get');


//partie connection

Route::add('/signin.php', function() {
    Component::create('guest/signin')->print();
}, 'get');
  
/*Route::add('/signup.php', function() {
    Component::create('guest/signup')->print();
}, 'get');*/

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

/*Route::add('/check.php/(.+)/(.+)', function($matches,$codefirst) 
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
}, 'get');*/

?>