<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: header-app.php
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

<div class="dropdown d-none d-lg-inline-block ms-1">
<button type="button" class="btn header-item noti-icon waves-effect"
data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="bx bx-customize"></i>
</button>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
    <div class="px-lg-2">
        <div class="row g-0">
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/github.png';?>" alt="Github">
                    <span>GitHub</span>
                </a>
            </div>
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/bitbucket.png';?>" alt="bitbucket">
                    <span>Bitbucket</span>
                </a>
            </div>
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/dribbble.png';?>" alt="dribbble">
                    <span>Dribbble</span>
                </a>
            </div>
        </div>

        <div class="row g-0">
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/dropbox.png';?>" alt="dropbox">
                    <span>Dropbox</span>
                </a>
            </div>
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/mail_chimp.png';?>" alt="mail_chimp">
                    <span>Mail Chimp</span>
                </a>
            </div>
            <div class="col">
                <a class="dropdown-icon-item" href="#">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/brands/slack.png';?>" alt="slack">
                    <span>Slack</span>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
