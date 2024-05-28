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

  sleep(1);

  $post['title'];
  $post['message'];
  $post['date'];
  $post['position'];
  $post['language'];
  $post['fileCount'];
  $post['files'];

  /*
  gCurrentPosition.valid = false;
  gCurrentPosition.latitude = null;
  gCurrentPosition.longitude = null;
  gCurrentPosition.country = null;
  gCurrentPosition.planet = null;
  gCurrentPosition.galaxy = null;
  gCurrentPosition.id = null;
  */

  ob_start();
  passthru('/usr/bin/python3 '.$param_root.'script/timecapsule/throw.py '.$post['position']['latitude'].' '.$post['position']['longitude'].' '.$param_root.'script/timecapsule');
  $output = ob_get_clean(); 

  $messages = array();
  array_push($messages,array(
    'id' => 501,
    'type' => 'msg',
    'level' => 'warning',
    'texte' => $output
  ));
  $response["error"] = true;
  $response["message"] = $messages;

  return_json_http_response(true,$response);

}, 'post');


?>