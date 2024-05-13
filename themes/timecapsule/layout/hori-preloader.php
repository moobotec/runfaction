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

  <div id="modal-info-coordinate" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title"> Information sur les coordonnées cartographiques </h3>
                  <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
              </div>
              <div class="modal-body">
                  <i class="fa fa-search-plus" aria-hidden="true"></i> Le système cartographique choisi pour représenter les coordonnées est le <a target="_blank" href="https://fr.wikipedia.org/wiki/WGS_84">WGS84</a>.
                  <br>
                  <i class="fa fa-search-plus" aria-hidden="true"></i> Les limites imposées par le système <a target="_blank" href="https://fr.wikipedia.org/wiki/WGS_84">WGS84</a> sont de [-180.0° à 180.0°].
              </div>
              <div class="modal-footer">
              <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light" data-bs-dismiss="modal" ><h4 key="modal-close">Fermer</h4></button>
              </div>
          </div>
      </div>
    </div>


    <?=Component::create('content/objet/modal-cookies')?>
    <?=Component::create('content/objet/modal-configuration')?>
    <?=Component::create('content/objet/modal-datetime')?>
    <?=Component::create('content/objet/modal-location')?>

    <?=Component::create('partials/preloader') ?>

    <div id="layout-wrapper">

      <?=Component::create('partials/header')->assign(['name' => $name,'firstname' => $firstname , 'has-fullsceen' => true]) ?>
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
