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
                <p class="card-title-desc">Ceci est la date courante</p>
                <div class="my-3 row">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <h2 class="pt-3"><i class="bx bx-time-five"></i></h2>
                    </div>
                    <div class="">
                        <h2 class="my-1" id="clockUtcGmt">[ xxx ][ xx xxxx ][ xx : xx : xx ]</h2>
                    </div>
                </div>
                </div>


                <p class="card-title-desc">Vous pouvez changer la date courante en selectionnant <code>Année</code> ou <code>Jour - Mois</code> ou <code>Heure - Minute</code>.</p>
                <div class="my-3 row">
                <div class="d-flex justify-content-around text-center">
                    <button type="button" id="btClockYear" class="buttons-change p-2 btn header-item waves-effect">
                        <h4 class="my-1">Année</h4>
                        <h2 class="my-1" id="clockYear">[ xxx ]</h2>
                    </button>
                    <button type="button" id="btClockMonthDay" class="buttons-change p-2 btn header-item waves-effect">
                        <h4 class="my-1">Jour - Mois</h4>
                        <h2 class="my-1" id="clockMonthDay">[ xx xxxx ]</h2>
                    </button>
                    <button type="button" id="btClockTime" class="buttons-change p-2 btn header-item waves-effect">
                        <h4 class="my-1">Heure - Minute</h4>
                        <h2 class="my-1" id="clockTime">[ xx : xx ]</h2>
                    </button>
                    </div>
                </div>

                <div id="modifYear" style="display:none">
                    <form action="" method="" onsubmit="modifMoisJour(); return false;">
                        <p class="card-title-desc">Vous pouvez changer <code>Année</code>.</p>

                        <div class="row  text-center">
                            <div class="d-flex justify-content-around">
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> [ </h2>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> +/- </h2>
                                </div>
                            </div>
                            <div class="">
                                <div class=" text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 2,event)" maxLength="1"
                                        id="code_input_1" name="code1" autocomplete="off" value="0" >
                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                                        id="code_input_2" name="code2" autocomplete="off" value="0">
                                </div>
                            </div>

                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                                        id="code_input_2" name="code2" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 4,event)" maxLength="1"
                                        id="code_input_3" name="code3" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                                        id="code_input_4" name="code4" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                                        id="code_input_4" name="code4" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                                        id="code_input_4" name="code4" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> ] </h2>
                                </div>
                            </div>
                        </div>
                        </div>

                    </form>
                </div>

                <div id="modifMonthDay" style="display:none">
                    <form action="" method="" onsubmit="modifMoisJour(); return false;">
                        <p class="card-title-desc">Vous pouvez changer <code>Jour - Mois</code>.</p>


                        <div class="row justify-content-center text-center">
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> [ </h2>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 2,event)" maxLength="1"
                                        id="code_input_1" name="code1" autocomplete="off" value="0" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                                        id="code_input_2" name="code2" autocomplete="off" value="0">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3 text-center">
                                    <h2 class="my-1" id="clockTime">janvier</h2>
                                </div>
                            </div>
                          
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> ] </h2>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

                <div id="modifTime" style="display:none">
                    <form action="" method="" onsubmit="modifHeureMinute(); return false;">
                        <p class="card-title-desc">Vous pouvez changer <code>Heure - Minute</code>.</p>
                        <div class="row justify-content-center text-center">
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> [ </h2>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 2,event)" maxLength="1"
                                        id="code_input_1" name="code1" autocomplete="off" value="0" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                                        id="code_input_2" name="code2" autocomplete="off" value="0">
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id="clockMonthDay"> : </h2>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 4,event)" maxLength="1"
                                        id="code_input_3" name="code3" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 text-center">
                                    <input type="text"
                                        class="form-control form-control-lg text-center"
                                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                                        id="code_input_4" name="code4" autocomplete="off" value="0">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="border">
                                    <h2 class="my-1" id=""> ] </h2>
                                </div>
                            </div>
                        </div>
                    </form>
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
