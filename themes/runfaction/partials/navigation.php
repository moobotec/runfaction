<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: navigation.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

use Steampixel\Component;

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);

?>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <?=Component::create('content/objet/menu-link')->assign(['title' => "Tableau de bord" , 'icon' => "bx-home-circle" , 'page' => "" , 'active' => ($pages == "commun/index")  ]) ?>

                <?=Component::create('content/objet/menu-link')->assign(['title' => "Evènements sportif" , 'icon' => "bx-layout" , 'page' => "events.php" ]) ?>

                <?=Component::create('content/objet/menu-link')->assign(['title' => "Courses" , 'icon' => "bx-layout" , 'page' => "runs.php" ]) ?>

                <?=Component::create('content/objet/menu-title')->assign(['title' => "Administration"]) ?>

                <?=Component::create('content/objet/menu-link')->assign(['title' => "Tableau de bord" , 'icon' => "bx-home-circle" , 'page' => "admin/main.php" , 'active' => ($pages == "admin/main")  ]) ?>

                <?=Component::create('content/objet/menu-link')->assign(['title' => "Utilisateurs" , 'icon' => "bx-layout" , 'page' => "admin/users.php" , 'active' => ($pages == "admin/users")  ]) ?>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
