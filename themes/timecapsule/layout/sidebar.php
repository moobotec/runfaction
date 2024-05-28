<?php

/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
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
use Moobotec\SessionMoobotec;

if ( empty($_SESSION['authenticated']) || $_SESSION['authenticated'] == "" )
{
    header("Location: /404.php");
    exit();
}

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


$firstname = SessionMoobotec::getValueUserSession('firstname');
$name = SessionMoobotec::getValueUserSession('name');

?>

<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/admin/style')->assign(['pages'=>$pages])->render() ?>
  </head>
  
  <body class="hold-transition" data-sidebar="<?=$dataSidebar ?>">

     <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
          <?php echo '<img src="'.BASEPATH.'themes/'.THEME.'/assets/images/logo.png" class="animation__shake" height="32" alt="RunfactionLog" >' ?>
    </div>

    <div id="layout-wrapper">

      <?=Component::create('partials/admin/header')->assign(['name' => $name,'firstname' => $firstname , 'has-fullsceen' => true, 'has-flag' => true ]) ?>
      <?=Component::create('partials/admin/navigation')->assign(['pages'=>$pages]) ?>

      <div class="main-content">
          <div class="page-content">
              <div class="container-fluid">
                <?=Component::create('partials/content') ?>
              </div>
          </div>
      </div>

    </div>
    <?=Component::create('partials/admin/rightbar') ?>
    <?=Component::create('partials/variables') ?>
    <?=Component::create('partials/admin/javascript')->assign(['pages'=>$pages]) ?>
    <?=Component::create('partials/execution')->assign(['pages'=>$pages]) ?>
  </body>
</html>
