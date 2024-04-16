<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: settings.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
namespace Steampixel;

global $param_lang;
global $param_title;
$pages = "admin/settings";

Component::create('layout/sidebar')->assign([
  'title' => $param_title,
  'lang' =>  strtolower($param_lang),
  'pages' =>  $pages,
  'data-sidebar' =>  "dark"
])->print();

//compoment create by theme
Portal::send('contents-main',Component::create('content/page/'.$pages.'') );

?>
