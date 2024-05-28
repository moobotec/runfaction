<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
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

<div class="language-selector">
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img id="header-lang-img" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/french.jpg';?>" alt="Header Language" height="16">
        </button>
        <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="fr">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/french.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-fr">Français</span>
            </a>
            
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/us.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-en">Anglais</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/spain.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-es">Espagnol</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/germany.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-gr">Allemand</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/italy.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-it">Italien</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/russia.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle" key="t-ru">Russe</span>
            </a>
        </div>
    </div>
</div>
