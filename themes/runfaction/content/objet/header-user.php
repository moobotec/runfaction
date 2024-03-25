<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: header-user.php
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

$name = $this->prop('name', [
    'type' => 'string',
    'required' => true
]);

$firstname = $this->prop('firstname', [
    'type' => 'string',
    'required' => true
]);

?>

<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/users/avatar-1.jpg';?>"
            alt="Header Avatar">
        <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?=$firstname ?> <?=$name ?></span>
        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <a class="dropdown-item" href="<?php echo ''.BASEPATH.'profil.php';?>"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profil</span></a>
        <a class="dropdown-item d-block" href="<?php echo ''.BASEPATH.'settings.php';?>"><span class="badge bg-success float-end mx-1">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Paramètres</span></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="<?php echo ''.BASEPATH.'logout.php';?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Déconnexion</span></a>
    </div>
</div>
