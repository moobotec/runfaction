<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: header.php
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
use Steampixel\Component;

$hasflag = $this->prop('has-flag', [
  'type' => 'boolean',
  'required' => false,
  'default' => false
]);

$hasapp = $this->prop('has-app', [
  'type' => 'boolean',
  'required' => false,
  'default' => false
]);

$hasfullsceen = $this->prop('has-fullsceen', [
  'type' => 'boolean',
  'required' => false,
  'default' => false
]);

$hasnotification = $this->prop('has-notification', [
  'type' => 'boolean',
  'required' => false,
  'default' => false
]);

$haschangetheme = $this->prop('has-changetheme', [
  'type' => 'boolean',
  'required' => false,
  'default' => false
]);

$name = $this->prop('name', [
  'type' => 'string',
  'required' => true
]);

$firstname = $this->prop('firstname', [
  'type' => 'string',
  'required' => true
]);

?>

<header id="page-topbar">
<div class="navbar-header">
    <div class="d-flex">

        <?=Component::create('content/objet/header-logo') ?>

        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
        </button>
       
    </div>

    <div class="d-flex">

    <?php
      if ( $hasflag == true ) echo Component::create('content/objet/header-flag');

      if ( $hasapp == true ) echo Component::create('content/objet/header-app');

      if ( $hasfullsceen == true ) echo Component::create('content/objet/header-fullscreen');
      
      if ( $hasnotification == true ) echo Component::create('content/objet/header-notification');

      echo Component::create('content/objet/header-user')->assign(['name' => $name,'firstname' => $firstname, 'has-fullscreen' => true ]);
      
      if ( $haschangetheme == true ) echo Component::create('content/objet/header-changetheme');
    ?>
    </div>
</div>
</header>