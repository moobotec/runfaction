<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: RouteApiGuest.php
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

include_once('common/session.php');

use Steampixel\route;
require_once 'thirdparty/Steampixel/route.php';

use Carbon\Carbon;

Route::add('/signin.php', function() 
{ 
  $controller = new UserController();
  $controller->checkAndSessionUserToJson();
}, 'post');

Route::add('/signup.php', function() 
{ 
  $controller = new UserController();
  $controller->addUserToJson();
}, 'post');

Route::add('/askresendvalidation.php/(.+)/(.+)', function($matches,$codefirst) 
{
  $controller = new UserController();
  $controller->askResendValidationUserToJson($matches,$codefirst);
}, 'get');

Route::add('/check.php/(.+)/(.+)', function($matches,$codefirst) 
{
  $controller = new UserController();
  $controller->checkValidationUserToJson($matches,$codefirst);
}, 'post');

Route::add('/askresetpassword.php', function() 
{ 
  $controller = new UserController();
  $controller->askResetPasswordUserToJson();
}, 'post');

Route::add('/reset.php/(.+)/(.+)', function($matches,$codereset) 
{
  $controller = new UserController();
  $controller->checkResetPasswordUserToJson($matches,$codereset);
}, 'post');


?>