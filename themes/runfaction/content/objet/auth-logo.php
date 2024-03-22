<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: auth-logo.php
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

$divclass = $this->prop('div-class', [
    'type' => 'string',
    'required' => true
]);

$mxauto = $this->prop('mx-auto', [
    'type' => 'boolean',
    'required' => true
]);

$classImg = "";
if ($mxauto == true)
{
    $classImg = "mx-auto";
}

?>

<div class="<?=$divclass ?>">
    <?php echo '<a href="'.BASEPATH.'" class="d-block auth-logo">' ?>
    <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-dark.png" alt="" height="32" class="auth-logo-dark '.$classImg.'">' ?>
    <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-light.png" alt="" height="18" class="auth-logo-light '.$classImg.'">' ?>
    </a>
</div>