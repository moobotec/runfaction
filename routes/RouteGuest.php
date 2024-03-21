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

require_once 'thirdparty/Steampixel/route.php';

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

/*Route::add('/', function() {
    make_page('guest/signin','views/guest/signin.php');
});

Route::add('/index.php', function() {
    make_page('guest/signin','views/guest/signin.php');
});

Route::add('/signin.php', function() {
    make_page('guest/signin','views/guest/signin.php');
}, 'get');

Route::add('/askresetpassword.php', function() {
    make_page('guest/askresetpassword','views/guest/askresetpassword.php');
}, 'get');

Route::add('/signup.php', function() {
    make_page('guest/signup','views/guest/signup.php');
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
            make_page('guest/reset','views/guest/reset.php');
        }
        else
        {
            header('HTTP/1.0 404 Not Found');
            make_page(strtolower($level).'/404','views/'.strtolower($level).'/404.php');
        }
    }
    else
    {
        header('HTTP/1.0 404 Not Found');
        make_page(strtolower($level).'/404','views/'.strtolower($level).'/404.php');
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
            make_page('guest/check','views/guest/check.php');
        }
        else
        {
            header('HTTP/1.0 404 Not Found');
            make_page(strtolower($level).'/404','views/'.strtolower($level).'/404.php');
        }
    }
    else
    {
        header('HTTP/1.0 404 Not Found');
        make_page(strtolower($level).'/404','views/'.strtolower($level).'/404.php');
    }
}, 'get');
*/

?>