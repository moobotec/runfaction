<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: RouteApiGuest.php
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
use Carbon\Carbon;

function filter_string_polyfill(string $string): string
{
    $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
    return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
}

function runInBackground($cmd, &$pid) {
  // Préparez la commande pour être exécutée en arrière-plan
  $fullCmd = $cmd . " > /dev/null 2>&1 & echo $!";
  // Exécutez la commande et récupérez le PID
  $pid = shell_exec($fullCmd);
}

function isProcessRunning($pid) {
  // Vérifiez si le processus avec le PID donné est toujours en cours d'exécution
  $result = shell_exec(sprintf("ps %d", $pid));
  // Si le PID n'est pas trouvé dans la liste des processus actifs, renvoyez false
  if (count(preg_split("/\n/", $result)) > 2) {
      return true;
  }
  return false;
}

Route::add('/throw.php', function() {

  global $param_root;

  $post = $_POST;

  if($_SERVER['REQUEST_METHOD'] ==='POST' && empty($post)) {
    $post = json_decode(file_get_contents('php://input'),true); 
    $postjson = json_encode($post ?? parse_str(file_get_contents("php://input"),$postjson) ?? []);
  }
  foreach ($post as $key => $value) {
      if (is_scalar($value) || is_string($value)) {
          $post[$key] = filter_var($value, FILTER_CALLBACK, array('options' => 'filter_string_polyfill'));
      }
  }

  $latitude = $post['position']['latitude'];
  $longitude = $post['position']['longitude'];
  $cmd = "/usr/bin/python3 " . $param_root . "script/timecapsule/throw.py " . $latitude . " " . $longitude . " " . $param_root . "script/timecapsule";
  
  runInBackground($cmd, $pid);

  // Boucle d'attente pour vérifier si le processus est toujours en cours d'exécution
  $max_wait_time = 60; // Maximum wait time in seconds
  $interval = 5; // Interval to check in seconds
  $elapsed_time = 0;

  while ($elapsed_time < $max_wait_time) {
      if (!isProcessRunning($pid)) {
          $response["error"] = false;
          $response["message"] = json_encode(array('status' => 'completed'));
          return_json_http_response(true,$response);
          exit;
      }
      sleep($interval);
      $elapsed_time += $interval;
  }

  $response["error"] = false;
  $response["message"] = json_encode(array('status' => 'running', 'pid' => $pid));
  return_json_http_response(true,$response);

}, 'post');


//partie connection

Route::add('/signin.php', function() 
{ 
  $controller = new UserController();
  $controller->checkAndSessionUserToJson();
}, 'post');

/*Route::add('/signup.php', function() 
{ 
  $controller = new UserController();
  $controller->addUserToJson();
}, 'post');*/

/*Route::add('/askresendvalidation.php/(.+)/(.+)', function($matches,$codefirst) 
{
  $controller = new UserController();
  $controller->askResendValidationUserToJson($matches,$codefirst);
}, 'get');

Route::add('/check.php/(.+)/(.+)', function($matches,$codefirst) 
{
  $controller = new UserController();
  $controller->checkValidationUserToJson($matches,$codefirst);
}, 'post');*/

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