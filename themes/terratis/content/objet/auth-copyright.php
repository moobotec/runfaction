<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: auth-copyright.php
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
   =    * 22/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$divclass = $this->prop('div-class', [
    'type' => 'string',
    'required' => true
]);
?>

<div class="<?=$divclass ?>">
    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Celios. Conçu par Celios</p>
</div>