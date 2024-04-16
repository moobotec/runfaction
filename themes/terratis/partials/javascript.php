<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: javascript.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: Plannificateur de lacher de moustique stérilisé
   =
   =  INTERVENTION:
   =
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);
    
echo '<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/jquery/jquery.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/simplebar/simplebar.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/node-waves/waves.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/toastr/build/toastr.min.js"></script>
<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/axios/axios.min.js"></script>';

if (str_contains($pages,"guest"))
{
    echo '<!-- owl.carousel js -->
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <!-- auth-2-carousel init -->
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/pages/auth-2-carousel.init.js"></script>';
}
else
{
    echo '<!-- jquery-validation -->
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/jquery-validation/jquery.validate.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/jquery-validation/additional-methods.min.js"></script>';

    echo '<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net/js/dataTables.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>';

    echo '<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>';

    

    echo '<script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/moment/moment.js"></script>';

    echo '<!-- Select2 -->
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/libs/select2/js/select2.full.min.js"></script>';

}

echo '<!-- Base js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/base.js?='.time().'"></script>';

if (str_contains($pages,"guest"))
{
  echo '<!-- Base js -->
  <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/guest.js?='.time().'"></script>';
}
else
{

  if (str_contains($pages,"admin"))
  {
    echo '<!-- Base js -->
    <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/admin.js?='.time().'"></script>';
  }

  echo '<!-- Base js -->
  <script src="'.BASEPATH.'themes/'.THEME.'/assets/js/moobotec.js?='.time().'"></script>';
}

echo '<!-- App js -->
<script src="'.BASEPATH.'themes/'.THEME.'/assets/js/app.js"></script>';

if (!str_contains($pages,"guest"))
{

  echo '<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

        <script src="https://unpkg.com/@bopen/leaflet-area-selection@0.6.1/dist/index.umd.js"></script>

        <script src="https://unpkg.com/leaflet-gpx/gpx.js"></script>';
}

?>