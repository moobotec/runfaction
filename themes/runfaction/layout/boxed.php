<?php

/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: content.php
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
?>

<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/style')->assign(['pages'=>$pages])->render() ?>
  </head>
  <?php 
   if ($pages == "guest/signin" 
   || $pages == "guest/askresetpassword" 
   || $pages == "guest/signup" 
   || $pages == "guest/reset" )
   {
      echo '<body class="auth-body-bg">';
   }
   else { echo '<body>'; }  ?>
    <div>
      <div class="container-fluid p-0">
        <?=Component::create('partials/content') ?>
      </div>
    </div>
    <?=Component::create('partials/variables')->render() ?>
    <?=Component::create('partials/javascript')->assign(['pages'=>$pages])->render() ?>
    <?=Component::create('partials/execution')->assign(['pages'=>$pages])->render() ?>
  </body>
</html>
