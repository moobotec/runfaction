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

    .h2-like {
        font-size: 1.5rem; /* Taille de police similaire à celle de <h2> dans Bootstrap */
        font-weight: bold; /* Gras comme un titre <h2> */
        /* Ajouter d'autres styles de <h2> si nécessaire */
    }

    .hover-text {
        font-size: 1.3rem; /* Taille de police similaire à celle de <h2> dans Bootstrap */
        color: lightgrey; /* Gris */
        font-weight: bold; /* Gras comme un titre <h2> */
        /* Ajouter d'autres styles de <h2> si nécessaire */
        pointer-events: none; /* Empêche le texte d'interférer avec les événements de la souris */
    }

    .sign-text-top
    {
        width: 100%; 
        text-align: center; 
        display: block;
        bottom: 100%; /* Position par rapport au haut de l'input */
        transform: translateY(-10px); /* Ajustez cette valeur pour décaler le texte vers le haut */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }
    
    .sign-text-bottom
    {
        width: 100%; 
        text-align: center; 
        display: block;
        top: 100%; /* Position par rapport au bas de l'input */
        transform: translateY(10px); /* Ajustez cette valeur pour décaler le texte vers le bas */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }

    [class*="top-text"]
    {
        width: 100%; 
        text-align: center; 
        display: block;
        bottom: 100%; /* Position par rapport au haut de l'input */
        transform: translateY(-10px); /* Ajustez cette valeur pour décaler le texte vers le haut */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }

    [class*="bottom-text"]
    {
        width: 100%; 
        text-align: center; 
        display: block;
        top: 100%; /* Position par rapport au bas de l'input */
        transform: translateY(10px); /* Ajustez cette valeur pour décaler le texte vers le bas */
        transition: visibility 0.2s, opacity 0.2s ease-in-out; /* Ajout d'une transition pour le changement visuel */
        opacity: 0; /* Rend le texte transparent initialement */
        visibility: hidden; /* Rend le texte non visible initialement */
    }

    .input-wrapper
    {
        position: relative;
        padding-top: 10px; /* Ajuster selon besoin pour plus d'espace au-dessus */
        padding-bottom: 10px; /* Ajuster selon besoin pour plus d'espace en dessous */
        display: inline-block; /* Assurez-vous que le wrapper ne prend que l'espace nécessaire */
    }

    .form-control.form-control-lg {
        height: 60px; /* Hauteur plus grande de l'input pour augmenter la zone cliquable */
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
                <p class="card-title-desc">Ceci est la date courante en UTC, mise à jour en temps réel.</p>
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
                <p class="card-title-desc">Modifiez la date et l'heure actuelles en choisissant parmi les options suivantes : <code>Année</code>, <code>Jour - Mois</code>, ou <code>Heure - Minute</code>.</p>
                <div class="my-3 row">
                <div class="d-flex justify-content-around text-center">
                    <button type="button" id="btClockYear" class="buttons-change p-2 btn header-item waves-effect">
                        
                        <h2 class="my-1" id="clockYear">[ xxx ]</h2>
                    </button>
                    <button type="button" id="btClockMonthDay" class="buttons-change p-2 btn header-item waves-effect">
                        
                        <h2 class="my-1" id="clockMonthDay">[ xx xxxx ]</h2>
                    </button>
                    <button type="button" id="btClockTime" class="buttons-change p-2 btn header-item waves-effect">
                        
                        <h2 class="my-1" id="clockTime">[ xx : xx ]</h2>
                    </button>
                    </div>
                </div>

                <div id="modifYear" class="my-3" style="display:none">
                    <form action="" method="" onsubmit="modifYear(); return false;">
                        <p class="card-title-desc">Vous pouvez ajuster l'<code>Année</code> selon vos besoins.</p>
                        <div class="row text-center">
                            <div class="d-flex justify-content-around">
                                <div class="text-center input-wrapper" style="position: relative;"> 
                                    <div class="hover-text sign-text-top"> + </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchSign(this,event)" 
                                        onwheel="adjustSignOnScroll(event, this)"
                                        maxLength="1"
                                        id="sign_year_input" name="sign" autocomplete="off" value="+">
                                    <div class="hover-text sign-text-bottom"> - </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;"> 
                                    <div class="hover-text top-text-1"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 2, event, 'code_year_input_', 7)" 
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_1" name="code1" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-1"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-2"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 3,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_2" name="code2" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-2"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-3"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 4,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_3" name="code3" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-3"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-4"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 5,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_4" name="code4" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-4"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-5"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 6,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_5" name="code5" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-5"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-6"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 7,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_6" name="code6" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-6"> 0 </div>
                                </div>
                                <div class="text-center input-wrapper" style="position: relative;">
                                    <div class="hover-text top-text-7"> 0 </div>
                                    <input type="text"
                                        class="form-control form-control-lg text-center h2-like"
                                        onkeyup="touchCode(this, 8,event,'code_year_input_',7)"
                                        onwheel="adjustValueOnScroll(event, this)"
                                        maxLength="1"
                                        id="code_year_input_7" name="code7" autocomplete="off" value="0">
                                    <div class="hover-text bottom-text-7"> 0 </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="modifMonthDay" style="display:none">
                    <form action="" method="" onsubmit="modifMoisJour(); return false;">
                        <p class="card-title-desc">Vous pouvez ajuster <code>Jour - Mois</code> selon vos besoins.</p>
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
                        <p class="card-title-desc">Vous pouvez ajuster <code>Heure - Minute</code> selon vos besoins.</p>
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
