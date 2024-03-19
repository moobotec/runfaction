<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: RunFaction
   =
   =  FICHIER: main.inc.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: 
   =
   =  INTERVENTION:
   =
   =    * 04/03/2024 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

$level = "None";

if ($_SERVER['HTTP_HOST'] != $param_server_principal_domaine && $param_environement != 'prod')
{
    $param_server_principal_domaine = $_SERVER['HTTP_HOST'];
}

// Define a global basepath
define('BASEPATH',$param_protocole.'://'.$param_server_principal_domaine.$param_racine);
define('BASE',$param_racine);

function start_main() {
    global $param_lang;
    echo '<!DOCTYPE html><html lang="'.strtolower($param_lang).'">';
}

function end_main() {
    echo '</html>';
}

function start_body() 
{
    echo '<body data-sidebar="dark">';
}

function end_body() {
    echo '</body>';
}

function start_head() {
     echo '<head>';
}

function end_head() {
    
    echo '</head>';
}

function beginLayoutWrapper() 
{    
    echo '<div id="layout-wrapper">';
}

function endLayoutWrapper() 
{
    echo '</div>';
}

function makeMeta()
{
    global $param_protocole;
    global $param_server_principal_domaine;
    global $param_title;
    global $param_racine;
    global $param_description;
    global $param_keyword;
    global $param_cache;
    global $param_revisit;
    global $param_copyright;
    global $param_indexation;
    global $param_auteur;
    global $param_lang;
    
    echo'<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="identifier-url" content="'.$param_protocole.'://'.$param_server_principal_domaine.$param_racine.'" />
    <meta name="title" content="'.$param_title.'" />
    <meta name="description" content="'.$param_description.'" />
    <meta name="abstract" content="'.$param_description.'" />
    <meta name="keywords" content="'.$param_keyword.'" />
    <meta name="author" content="'.$param_auteur.'" />
    <meta name="generator" content="Celios" />
    <meta name="publisher" content="Celios" />';
    
    if ($param_cache == true)
    {
        echo '<meta http-equiv="pragma" content="no-cache" />';
    }

    echo '<meta name="revisit-after" content="'.$param_revisit.'" />
    <meta name="language" content="'.strtoupper($param_lang).'" />
    <meta name="copyright" content="'.$param_copyright.'" />
    <meta name="robots" content="'.$param_indexation.'" />';
}

function title($label = '') 
{
    global $param_title;
    if ($label != '')
    {
        echo '<title>'.$param_title.' - '.$label.'</title>';
    }
    else
    {
        echo '<title>'.$param_title.'</title>';
    }
}

function vendor_stylesheet() 
{
    echo '<!-- DataTables -->
    <link href="'.BASEPATH.'assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="'.BASEPATH.'assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Responsive datatable examples -->
    <link href="'.BASEPATH.'assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     
    <!-- Bootstrap Css -->
    <link href="'.BASEPATH.'assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="'.BASEPATH.'assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="'.BASEPATH.'assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Toastr Css-->
    <link href="'.BASEPATH.'assets/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/@bopen/leaflet-area-selection@0.6.1/dist/index.css" />
    ';

}

function main_stylesheet()
{
    echo '<link href="'.BASEPATH.'assets/css/terratis.css" rel="stylesheet" type="text/css" />';
}

function main_scripts() 
{
    echo '<script src="'.BASEPATH.'assets/js/terratis.js"></script>';
}

function vendor_scripts() 
{    
    
    echo '<!-- JAVASCRIPT -->
         <script src="'.BASEPATH.'assets/libs/jquery/jquery.min.js"></script>';
    
    echo '<script src="'.BASEPATH.'assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="'.BASEPATH.'assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="'.BASEPATH.'assets/libs/simplebar/simplebar.min.js"></script>
        <script src="'.BASEPATH.'assets/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="'.BASEPATH.'assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="'.BASEPATH.'assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="'.BASEPATH.'assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="'.BASEPATH.'assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Bootstrap rating js -->
        <script src="'.BASEPATH.'assets/libs/bootstrap-rating/bootstrap-rating.min.js"></script>
        <script src="'.BASEPATH.'assets/js/pages/rating-init.js"></script>
        
        <!-- Datatable init js -->
        <script src="'.BASEPATH.'assets/js/pages/datatables.init.js"></script>';
        
        echo '<!-- toastr plugin -->
        <script src="'.BASEPATH.'assets/libs/toastr/build/toastr.min.js"></script>
        <script src="'.BASEPATH.'assets/js/pages/toastr.init.js"></script>

        <script src="'.BASEPATH.'assets/js/app.js"></script>
        
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

        <script src="https://unpkg.com/@bopen/leaflet-area-selection@0.6.1/dist/index.umd.js"></script>
        ';
}

function header_document() 
{    
    echo '<header id="page-topbar-aide">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="'.BASEPATH.'" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="'.BASEPATH.'assets/images/logo-icon.svg" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="'.BASEPATH.'assets/images/logo-icon.svg" alt="" height="40" class="pb-1" >
                        <span class="ml-2 px-3" style="font-size: 22px;color: #000000; "><b>TERRATIS</b></span>
                    </span>
                </a>
                <a href="'.BASEPATH.'" class="logo logo-light ">
                    <span class="logo-sm">
                        <img src="'.BASEPATH.'assets/images/logo-icon.svg" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="'.BASEPATH.'assets/images/logo-icon.svg" alt="" height="40" class="pb-1">
                        <span class="ml-2 px-3" style="font-size: 22px;color: #000000; "><b>TERRATIS</b></span>
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
            <div class="d-flex">
                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Rechercher ..." aria-label="Recipient\'s username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
               
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    
                echo '<div class="d-inline-block avatar-xs"><span class="avatar-title rounded-circle">D</span></div>';

                
                echo '<span class="d-none d-xl-inline-block ms-1" key="t-name">David DAUMAND</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="bx bx-user-circle font-size-20 align-middle me-1"></i> <span key="t-profile">Mon compte</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="icon-deconnexion font-size-16 align-middle me-1"></i> <span key="t-logout">Se déconnecter</span></a>
                    </div>
                </div>

            </div>
        </div>
    </header>';
}

function footer() 
{
    echo '<br>';   
    echo '<div class="footer bg-transparent">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 font-size-11 text-secondary d-flex justify-content-center">
                    <span class="text-uppercase">© <script>document.write(new Date().getFullYear())</script> Terratis</span>
                    <ul class="m-0 list-inline">
                        <li class="list-inline-item ms-3 me-0 ps-3 border-start border-secondary">
                            <a href="#" class="text-decoration-underline text-secondary">Déclaration de confidentialité</a>
                        </li>
                        <li class="list-inline-item ms-3 me-0 ps-3 border-start border-secondary">
                            <a href="#" class="text-decoration-underline text-secondary">Conditions générales d\'utilisation</a>
                        </li>
                        <li class="list-inline-item ms-3 me-0 ps-3 border-start border-secondary">
                            <a href="#" class="text-decoration-underline text-secondary">Mentions légales</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';
}

function menu() 
{    
    echo'<div class="vertical-menu">
        <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" >
                        <i class="icon-demandes"></i>
                        <span key="t-layouts" style="color: #000000;">Liste des traitements</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true">
                        <li><a href="'.BASEPATH.'jobs.php" key="t-request" style="color: #000000;">Traitements en cours<span class="badge rounded-pill bg-aide" hidden>1</span></a></li>
                        <li><a href="'.BASEPATH.'histo_jobs.php" key="t-histo-request" style="color: #000000;">Historique des traitements</a></li>
                        <li><a href="'.BASEPATH.'process.php" key="t-create-request" style="color: #000000;">Planifier un traitement</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon-interventions"></i>
                        <span key="t-layouts" style="color: #000000;">Interventions des Tisseurs</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="true">
                        <li><a href="'.BASEPATH.'interventions.php" key="t-intervention" style="color: #000000;">Interventions à venir<span class="badge rounded-pill " hidden>0</span></a></li>
                        <li><a href="'.BASEPATH.'histo_interventions.php" key="t-interventions" style="color: #000000;">Historique des interventions</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="border-bottom border-gray">
                    <a href="'.BASEPATH.'contact.php" class="waves-effect">
                        <i class="icon-contact"></i>
                        <span key="t-contact" style="color: #000000;">Contacter l\'administrateur</span>
                    </a>
                </li>
                <li>
                    <a href="'.BASEPATH.'logout.php" class="waves-effect">
                        <i class="icon-deconnexion"></i>
                        <span key="t-logout" style="color: #000000;">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->';
}

function start_document() 
{
    start_main();
    start_head();
    title();
    makeMeta();
    vendor_stylesheet();
    main_stylesheet();
    end_head();
    start_body();
    beginLayoutWrapper();
    header_document();
    menu();
}

function end_document() 
{
    footer();
    endLayoutWrapper();
    vendor_scripts();
    main_scripts();
    end_body();
    end_main();
}

function start_page($title) 
{
    echo '<div class="main-content">
        <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-28">'.$title.'</h4>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-12">';
}

function end_page()
{
    echo '</div></div></div></div></div>';
}

function header_page($idTable,$colonneName,$downloadCsv="",$deleteAll="",$addEntry="") 
{
    echo '<div class="card"><div class="card-body"><p class="card-title-desc">';
    if ($addEntry != "")
    {
        echo '<a href="'.BASEPATH.$addEntry.'" class="btn btn-success btn-sm pull-left" style="padding-bottom: 7px;" ><i class="fa fa-plus-circle"></i></a>';
    }
    if ($downloadCsv != "" )
    {
        echo '<a href="'.BASEPATH.$downloadCsv.'" class="btn btn-info btn-sm pull-left" style="padding-bottom: 7px;" ><i class="fa fa-download"></i></a>';
    }
    if ($deleteAll != "")
    {
        echo '<a href="'.BASEPATH.$deleteAll.'" class="btn btn-danger btn-sm pull-left" style="padding-bottom: 7px;" ><i class="fa fa-trash"></i></a>';
    }
    echo '</p>';
    echo '<table id="'.$idTable.'" class="table table-bordered dt-responsive nowrap w-100"><thead><tr>'.$colonneName.'</tr></thead><tbody>';
}

function end_header_page() 
{
    echo '</tbody></table></div></div>';
}

?>
