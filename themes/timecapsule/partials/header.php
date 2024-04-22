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

<style>

    
#page-topbar {
    align-items: center; /* Centrer les éléments verticalement */
    justify-content: space-between; /* Répartir l'espace entre les éléments */
    border: 4px solid black; /* Bordure du header */
    padding: 0px; /* Espace intérieur autour des éléments */
    
}

.language-selector {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   2px solid black; /* Bordure pour chaque zone */
    padding: 0px;
    flex-grow: 1; /* Les éléments prennent l'espace disponible */
}

.control-buttons {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
    flex-grow: 1; /* Les éléments prennent l'espace disponible */
}

.control-buttons-spin {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  2px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
    flex-grow: 1; /* Les éléments prennent l'espace disponible */
}

/* Spécifique pour les logos pour ne pas prendre trop de place */
.navbar-brand-box {
    border: 2px solid black; /* Bordure pour chaque zone */
    margin:0;
    padding: 0px;
    flex-grow: 0;
    flex-basis: 200px; /* Largeur fixe pour le logo */
    flex-shrink: 0;

}

.center-buttons {
    /* Centrer les boutons au milieu */
    display: flex;
    justify-content: center;
    align-items: stretch; /* Les enfants s'étendent pour remplir l'espace vertical */
    flex-grow: 1;
    height: 100%; /* Assurez-vous que le conteneur prend toute la hauteur nécessaire */
    color: hsl(0deg, 100%, 100%);
    text-shadow: 2px 2px 3px black;
}

.buttons-propos, .buttons-jeter, .buttons-trouver  {
    display: flex; /* Permet l'alignement interne du texte */
    align-items: center; /* Centre le texte verticalement */
    justify-content: center; /* Centre le texte horizontalement */
    background-color: transparent; /* Fond transparent */
    color: white; /* Texte en blanc pour le contraste */
    font-size: 20px; /* Taille de texte grande */
    width: 100%; /* Prendre toute la largeur du conteneur */
    border: none; /* Suppression de la bordure par défaut des boutons si utilisé */
    text-decoration: none; /* Pas de soulignement du texte */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre subtile pour un effet 3D */
    transition: all 0.3s ease; /* Transition douce pour les interactions */
    font-family: 'Franklin Gothic Heavy', sans-serif; /* Utilisation de la police */
}

.buttons-propos:hover,.buttons-jeter:hover,.buttons-trouver:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
    transform: translateY(-2px); /* Léger effet de soulèvement au survol */
}

.buttons-selected {
    text-decoration: underline #88ff88;
}

.buttons-selected:hover {
    text-decoration: underline #88ff88;
}


.center-buttons:active {
    text-decoration: underline #88ff88;
}

.right-controls {
    display: flex;
    align-items: center;
    margin-left: auto; /* Pousser tous les éléments de ce conteneur vers la droite */
    
}

.buttons-jeter {
    border-right:  1px solid black; /* Bordure pour chaque zone */
}

.buttons-trouver {
    border-right:  1px solid black; /* Bordure pour chaque zone */
}

.language-selector, .control-buttons {
    display: flex;
    align-items: center;
    justify-content: center; /* Centrer le contenu des zones */
}

.control-buttons > button {
    margin: 0 5px; /* Espacer les boutons */
}

</style>

<header id="page-topbar">
    <div class="navbar-header">
        <div class="navbar-brand-box">
            <a href="<?php echo ''.BASEPATH.'';?>" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo.png';?>" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo-dark.png';?>" alt="" height="32">
                </span>
            </a>

            <a href="<?php echo ''.BASEPATH.'';?>" class="logo logo-light">
                <span class="logo-sm">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo.png';?>" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo ''.BASEPATH.'themes/'.THEME.'/assets/images/logo-light.png';?>" alt="" height="32">
                </span>
            </a>
        </div>

        <div class="center-buttons">
            <button type="button" class="buttons-selected buttons-jeter text-uppercase btn header-item waves-effect ">
                Jeter
            </button>
        </div>
        <div class="center-buttons">
            <button type="button" class="buttons-trouver text-uppercase btn header-item waves-effect">
                Trouver
            </button>
        </div>
        <div class="center-buttons">
            <button type="button" class="buttons-propos text-uppercase btn header-item waves-effect">
                A propos
            </button>
        </div>

        <div class="right-controls">
            <div class="language-selector">
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
            </div>
            <div class="control-buttons">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
                </div>
            </div>
            <div class="control-buttons-spin">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect" data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</header>

