<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: header-flag.php
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

?>

<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img id="header-lang-img" src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/us.jpg';?>" alt="Header Language" height="16">
    </button>
    <div class="dropdown-menu dropdown-menu-end">

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/us.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
        </a>
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/spain.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/germany.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/italy.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/flags/russia.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
        </a>
    </div>
</div>