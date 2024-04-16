<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  TimeCapsule 
   =
   =  FICHIER: header.php
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
use Steampixel\Component;

?>


<header id="page-topbar">
<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->

        <div class="navbar-brand-box">
            <a href="<?php echo ''.BASEPATH.'';?>" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo.svg';?>" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo-dark.png';?>" alt="" height="32">
                </span>
            </a>

            <a href="<?php echo ''.BASEPATH.'';?>" class="logo logo-light">
                <span class="logo-sm">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo-light.svg';?>" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo-light.png';?>" alt="" height="32">
                </span>
            </a>
        </div>

    </div>

    <div class="d-flex">


        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img id="header-lang-img" src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/us.jpg';?>" alt="Header Language" height="16">
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/us.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                </a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/spain.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/germany.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/italy.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/flags/russia.jpg';?>" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                </a>
            </div>
        </div>

        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                <i class="bx bx-fullscreen"></i>
            </button>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                <i class="bx bx-cog bx-spin"></i>
            </button>
        </div>

    </div>
</div>
</header>