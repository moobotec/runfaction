<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: hori-preloader.php
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

$firstname = "";
$name = "";
?>


<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/style')->assign(['pages'=>$pages])->render() ?>
  </head>
  
  <body data-topbar="dark" data-layout="horizontal">

    <?=Component::create('content/objet/modal-info-coordonate')?>
    <?=Component::create('content/objet/modal-info-file-format')?>
    <?=Component::create('content/objet/modal-cookies')?>
    <?=Component::create('content/objet/modal-configuration')?>
    <?=Component::create('content/objet/modal-datetime')?>
    <?=Component::create('content/objet/modal-location')?>

    <?=Component::create('partials/preloader') ?>

    <div id="layout-wrapper">

      <?=Component::create('partials/header')->assign(['pages'=>$pages,'name' => $name,'firstname' => $firstname , 'has-fullsceen' => true]) ?>
      <?=Component::create('partials/navigation')->assign(['pages'=>$pages]) ?>

      <div class="main-content">
          <div class="page-content-1">

                <?=Component::create('partials/content') ?>

          </div>
      </div>

    </div>
    <?=Component::create('partials/variables') ?> 
    <?=Component::create('partials/javascript')->assign(['pages'=>$pages]) ?>
    <?=Component::create('partials/execution')->assign(['pages'=>$pages]) ?>

  </body>
  
</html>
