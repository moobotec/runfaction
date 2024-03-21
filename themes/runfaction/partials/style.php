<?php

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);

echo '<!-- App favicon -->
<link rel="icon" sizes="any" type="image/x-icon" href="'.BASEPATH.'themes/runfaction/assets/images/favicon.ico">';

if ($pages == "guest")
{
    echo '<!-- owl.carousel css -->
    <link rel="stylesheet" href="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="'.BASEPATH.'themes/runfaction/assets/libs/owl.carousel/assets/owl.theme.default.min.css">';
}

echo '<!-- Bootstrap Css -->
<link href="'.BASEPATH.'themes/runfaction/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="'.BASEPATH.'themes/runfaction/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="'.BASEPATH.'themes/runfaction/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />';
?>