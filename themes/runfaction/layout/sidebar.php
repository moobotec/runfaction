<?php

/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: sidebar.php
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
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
namespace Steampixel;
// Get the component props
$lang = $this->prop('lang', [
  'type' => 'string',
  'required' => true
]);

$title = $this->prop('title', [
  'type' => 'string',
  'required' => true
]);

$pages = $this->prop('pages', [
  'type' => 'string',
  'required' => true
]);

$dataSidebar = $this->prop('data-sidebar', [
  'type' => 'string',
  'required' => true
]);

if ( empty($_SESSION['authenticated']) || $_SESSION['authenticated'] == "" )
{
    header("Location: /404.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/style')->assign(['pages'=>$pages])->render() ?>
  </head>
  
  <body data-sidebar="<?=$dataSidebar ?>">

    <div id="layout-wrapper">

      <?=Component::create('partials/header') ?>
      <?=Component::create('partials/navigation') ?>

      <div class="main-content">
          <div class="page-content">
              <div class="container-fluid">
                <?=Component::create('partials/content') ?>
              </div>
          </div>
      </div>

    </div>
    <?=Component::create('partials/rightbar')->render() ?>
    <?=Component::create('partials/variables')->render() ?>
    <?=Component::create('partials/javascript')->assign(['pages'=>$pages])->render() ?>
    <?=Component::create('partials/execution')->assign(['pages'=>$pages])->render() ?>
  </body>
</html>
