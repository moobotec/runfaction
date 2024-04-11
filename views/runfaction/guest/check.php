<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: check.php
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
 * ========================================================================= */
/** @file  */

namespace Steampixel;

global $param_lang;
global $param_title;
$pages = "guest/check";

Component::create('layout/boxed')->assign([
  'title' => $param_title,
  'lang' =>  strtolower($param_lang),
  'pages' =>  $pages
])->print();

//compoment create by theme
Portal::send('contents-main',Component::create('content/page/'.$pages.'') );
?>