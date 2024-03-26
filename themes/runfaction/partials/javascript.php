<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: javascript.php
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

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);
    
echo '<script src="'.BASEPATH.'themes/runfaction/assets/libs/jquery/jquery.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/simplebar/simplebar.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/node-waves/waves.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/toastr/build/toastr.min.js"></script>
<script src="'.BASEPATH.'themes/runfaction/assets/libs/axios/axios.min.js"></script>';

if (str_contains($pages,"guest"))
{
    echo '<!-- owl.carousel js -->
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <!-- auth-2-carousel init -->
    <script src="'.BASEPATH.'themes/runfaction/assets/js/pages/auth-2-carousel.init.js"></script>';
}
else
{
    echo '<!-- jquery-validation -->
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/jquery-validation/jquery.validate.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/jquery-validation/additional-methods.min.js"></script>';

    echo '<script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net/js/dataTables.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>';

    echo '<script src="'.BASEPATH.'themes/runfaction/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>';

    

    echo '<script src="'.BASEPATH.'themes/runfaction/assets/libs/moment/moment.js"></script>';

    echo '<!-- Select2 -->
    <script src="'.BASEPATH.'themes/runfaction/assets/libs/select2/js/select2.full.min.js"></script>';

}

echo '<!-- Base js -->
<script src="'.BASEPATH.'themes/runfaction/assets/js/base.js?='.time().'"></script>';

if (str_contains($pages,"guest"))
{
  echo '<!-- Base js -->
  <script src="'.BASEPATH.'themes/runfaction/assets/js/guest.js?='.time().'"></script>';
}
else
{

  if (str_contains($pages,"admin"))
  {
    echo '<!-- Base js -->
    <script src="'.BASEPATH.'themes/runfaction/assets/js/admin.js?='.time().'"></script>';
  }

  echo '<!-- Base js -->
  <script src="'.BASEPATH.'themes/runfaction/assets/js/moobotec.js?='.time().'"></script>';
}

echo '<!-- App js -->
<script src="'.BASEPATH.'themes/runfaction/assets/js/app.js?='.time().'"></script>';

?>