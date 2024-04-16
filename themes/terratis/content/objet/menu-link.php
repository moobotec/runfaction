<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: menu-link.php
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
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
//

$title = $this->prop('title', [
    'type' => 'string',
    'required' => true
]);

$icon = $this->prop('icon', [
    'type' => 'string',
    'required' => true
]);

$page = $this->prop('page', [
    'type' => 'string',
    'required' => true
]);

$active = $this->prop('active', [
    'type' => 'boolean',
    'required' => false,
    'default' => false
]);

?>

<li>
    <?php echo '<a href="'.BASEPATH.$page.'" class="waves-effect '.(($active == true) ? 'active' : '').'">'?>
        <i class="bx <?=$icon?>"></i>
        <span key="t-<?=str_replace(" ","-",strtolower($title))?>"><?=$title?></span>
    </a>
</li>
