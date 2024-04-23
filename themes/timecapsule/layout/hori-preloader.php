<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: hori-preloader.php
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
namespace Steampixel;
// Get the component props
$lang = $this->prop('lang', [
  'type' => 'string',
  'required' => true
]);

$title = $this->prop('title', [
  'type' => 'string',
  'required' => true
]);
$pages = $this->prop('pages', [
  'type' => 'string',
  'required' => true
]);

$firstname = "";
$name = "";
?>


<!DOCTYPE html>
<html lang="<?=$lang ?>">
  <head>
    <?=Component::create('partials/title')->assign(['title'=>$title])->render() ?>
    <?=Component::create('partials/meta')->render() ?>
    <?=Component::create('partials/style')->assign(['pages'=>$pages])->render() ?>
  <style>
    .close-btn-pre {
        position: absolute;
        top: 10px;
        right: 10px;


        color: black; /* Change as needed */
        font-size: 24px;
        cursor: pointer;
    }
    #rangeValue1 {
        font-size: 18px; /* Augmente la taille du texte à 18px */
        background: transparent;
        padding: 3px 10px;
        white-space: nowrap;
        color: black; /* Assurez-vous que le texte est visible, adaptez selon votre design */
    }
    #rangeValue2 {
        font-size: 18px; /* Augmente la taille du texte à 18px */
        background: transparent;
        padding: 3px 10px;
        white-space: nowrap;
        color: black; /* Assurez-vous que le texte est visible, adaptez selon votre design */
    }
    #rangeValue3 {
        font-size: 18px; /* Augmente la taille du texte à 18px */
        background: transparent;
        padding: 3px 10px;
        white-space: nowrap;
        color: black; /* Assurez-vous que le texte est visible, adaptez selon votre design */
    }
    </style>

  </head>
  
  <body data-topbar="dark" data-layout="horizontal">


    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Configuration</h3>
                    <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
                </div>
                <div class="modal-body">
                  <p>Cras mattis consectetur purus sit amet fermentum.
                      Cras justo odio, dapibus ac facilisis in,
                      egestas eget quam. Morbi leo risus, porta ac
                      consectetur ac, vestibulum at eros.</p>
                  <p>Praesent commodo cursus magna, vel scelerisque
                      nisl consectetur et. Vivamus sagittis lacus vel
                      augue laoreet rutrum faucibus dolor auctor.</p>
                  <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                      Praesent commodo cursus magna, vel scelerisque
                      nisl consectetur et. Donec sed odio dui. Donec
                      ullamcorper nulla non metus auctor
                      fringilla.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light"><h4>Appliquer les changements</h4></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="datetimeModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Modifier la date courante</h3>
                    <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
                </div>
                <div class="modal-body">

                <div class="row">
                    <div class="col-auto">
                        <h2 class="pt-2"><i class="bx bx-time-five"></i></h2>
                    </div>
                    <div class="col-10">
                        <h2 class="my-1" id="clockUtc">[ xxx ][ xx xxxx ][ xx : xx : xx ]</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <h2 class="pt-2"><i class="bx bx-time-five"></i></h2>
                    </div>
                    <div class="col-10">
                        <h2 class="my-1" id="clockGmt">[ xxx ][ xx xxxx ][ xx : xx : xx ] GMT [x]</h2>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4">
                        <div class="mt-4">
                            <h5 class="font-size-14 pb-4">Année</h5>
                            <input type="select" class="form-select" min="-10000" max="10000" id="customNumber1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mt-4">
                            <h5 class="font-size-14 pb-4">Mois</h5>
                            <span id="rangeValue2" style="position: absolute; margin-top: -30px; margin-left: -7px;"></span>
                            <input type="range" class="form-range" min="1" max="12" id="customRange2">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mt-4">
                            <h5 class="font-size-14 pb-4">Jour</h5>
                            <span id="rangeValue3" style="position: absolute; margin-top: -30px; margin-left: -1px;"></span>
                            <input type="range" class="form-range" min="1" max="31" id="customRange3">
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <h5 class="font-size-14">Heure</h5>
                            <p class="card-title-desc">Range inputs have implicit values for min and
                                max—0 and 100, respectively.</p>
                            <input type="range" class="form-range" min="1" max="24" id="customRange4">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <h5 class="font-size-14">Minute</h5>
                            <p class="card-title-desc">By default, range inputs “snap” to integer
                                values. To change this, you can specify a <code>step</code> value.</p>
                            <input type="range" class="form-range" min="1" max="60" id="customRange5">
                        </div>
                    </div>
                   
                </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light"><h4>Appliquer les changements</h4></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="positionModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Modifier votre position</h3>
                    <button type="button" class="close-btn-pre" data-bs-dismiss="modal" >✖</button>
                </div>
                <div class="modal-body">
                  <p>Cras mattis consectetur purus sit amet fermentum.
                      Cras justo odio, dapibus ac facilisis in,
                      egestas eget quam. Morbi leo risus, porta ac
                      consectetur ac, vestibulum at eros.</p>
                  <p>Praesent commodo cursus magna, vel scelerisque
                      nisl consectetur et. Vivamus sagittis lacus vel
                      augue laoreet rutrum faucibus dolor auctor.</p>
                  <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                      Praesent commodo cursus magna, vel scelerisque
                      nisl consectetur et. Donec sed odio dui. Donec
                      ullamcorper nulla non metus auctor
                      fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="buttons-position btn btn-light header-item btn waves-effect waves-light"><h4>Appliquer les changements</h4></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>

    <div id="layout-wrapper">

      <?=Component::create('partials/header')->assign(['name' => $name,'firstname' => $firstname , 'has-fullsceen' => true]) ?>
      <?=Component::create('partials/navigation')->assign(['pages'=>$pages]) ?>

      <div class="main-content">
          <div class="page-content-1">

                <?=Component::create('partials/content') ?>

          </div>
      </div>

      

    </div>
    <?=Component::create('partials/variables') ?>
    <?=Component::create('partials/javascript')->assign(['pages'=>$pages]) ?>
    <?=Component::create('partials/execution')->assign(['pages'=>$pages]) ?>

  </body>
  
</html>
