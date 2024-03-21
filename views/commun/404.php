<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: 404.php
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

namespace Steampixel;
// Get the component props
$level = $this->prop('level', [
  'type' => 'string',
  'required' => true
]);

?>

<html lang="en"><head>
        
        <meta charset="utf-8">
        <title>404 Error Page | Skote - Admin &amp; Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin &amp; Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?php echo ''.BASEPATH.'themes/runfaction/assets/css/bootstrap.min.css';?>" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="<?php echo ''.BASEPATH.'themes/runfaction/assets/css/icons.min.css';?>" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="<?php echo ''.BASEPATH.'themes/runfaction/assets/css/app.min.css';?>" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
                            <h4 class="text-uppercase">Sorry, page not found</h4>
                            <div class="mt-5 text-center">
                                <a class="btn btn-primary waves-effect waves-light" href="<?php echo ''.BASEPATH.'index.php';?>">Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-xl-6">
                        <div>
                            <img src="<?php echo ''.BASEPATH.'themes/runfaction/assets/images/error-img.png';?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="<?php echo ''.BASEPATH.'themes/runfaction/assets/libs/jquery/jquery.min.js';?>"></script>
        <script src="<?php echo ''.BASEPATH.'themes/runfaction/assets/libs/bootstrap/js/bootstrap.bundle.min.js';?>"></script>
        <script src="<?php echo ''.BASEPATH.'themes/runfaction/assets/libs/metismenu/metisMenu.min.js';?>"></script>
        <script src="<?php echo ''.BASEPATH.'themes/runfaction/assets/libs/simplebar/simplebar.min.js';?>"></script>
        <script src="<?php echo ''.BASEPATH.'themes/runfaction/assets/libs/node-waves/waves.min.js';?>"></script>

        <script src=""<?php echo ''.BASEPATH.'themes/runfaction/assets/js/app.js';?>"></script>

    

</body></html>
