<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: style.php
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

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);

echo '<!-- App favicon -->
<link rel="icon" sizes="any" type="image/x-icon" href="'.BASEPATH.'themes/'.THEME.'/assets/images/favicon.ico">';

echo '<!-- Bootstrap Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/css/app.min.css?='.time().'" id="app-style" rel="stylesheet" type="text/css" />
<!-- toastr Css-->
<link href="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<!-- autocomplete -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomickigrzegorz/autocomplete@2.0.1/dist/css/autocomplete.min.css"/>';

echo '<style>
    .close-btn-pre {
        position: absolute;
        top: 10px;
        right: 10px;


        color: black; /* Change as needed */
        font-size: 24px;
        cursor: pointer;
    }

    .buttons-change:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
        transform: translateY(-2px); /* Léger effet de soulèvement au survol */
    }

    .buttons-change:hover > h2 {
    text-decoration: underline #88ff88;
    }

    .active {
        text-decoration: underline #88ff88;
    }

    .h2-like {
        font-size: 1.5rem; /* Taille de police similaire à celle de <h2> dans Bootstrap */
        font-weight: bold; /* Gras comme un titre <h2> */
        /* Ajouter d\'autres styles de <h2> si nécessaire */
    }

    .hover-text {
        font-size: 1.3rem; /* Taille de police similaire à celle de <h2> dans Bootstrap */
        color: lightgrey; /* Gris */
        font-weight: bold; /* Gras comme un titre <h2> */
        /* Ajouter d\'autres styles de <h2> si nécessaire */
        pointer-events: none; /* Empêche le texte d\'interférer avec les événements de la souris */
    }

    [class*="top-text"]
    {
        width: 100%; 
        text-align: center; 
        display: block;
        bottom: 100%; /* Position par rapport au haut de l\'input */
        transform: translateY(-10px); /* Ajustez cette valeur pour décaler le texte vers le haut */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d\'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }

    [class*="bottom-text"]
    {
        width: 100%; 
        text-align: center; 
        display: block;
        top: 100%; /* Position par rapport au bas de l\'input */
        transform: translateY(10px); /* Ajustez cette valeur pour décaler le texte vers le bas */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d\'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }

    .input-wrapper
    {
        position: relative;
        padding-top: 10px; /* Ajuster selon besoin pour plus d\'espace au-dessus */
        padding-bottom: 10px; /* Ajuster selon besoin pour plus d\'espace en dessous */
        display: inline-block; /* Assurez-vous que le wrapper ne prend que l\'espace nécessaire */
    }

    .form-control.form-control-lg {
        height: 60px; /* Hauteur plus grande de l\'input pour augmenter la zone cliquable */
    }

    .select2-container {
    z-index: 999999 !important; /* Augmentez le z-index */

    }

    </style>';
