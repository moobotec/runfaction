<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  TimeCapsule 
   =
   =  FICHIER: throw.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

namespace Steampixel;

global $param_lang;
global $param_title;
$pages = "guest/index";

Component::create('layout/hori-preloader')->assign([
  'title' => $param_title,
  'lang' =>  strtolower($param_lang),
  'pages' =>  $pages
])->print();

//compoment create by theme
Portal::send('contents-main',Component::create('content/page/'.$pages.'') );

?>