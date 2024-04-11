<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: auth-title.php
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
   =    * 22/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$title = $this->prop('title', [
    'type' => 'string',
    'required' => true
]);

$subtitle = $this->prop('subtitle', [
    'type' => 'string',
    'required' => true
]);

?>

<div>
    <h5 class="text-primary"><?=$title ?></h5>
    <p class="text-muted"><?=$subtitle ?></p>
</div>
