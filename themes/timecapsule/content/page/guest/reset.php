<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: reset.php
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
   =    * 28/05/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
use Steampixel\Component;

?>

<style>

.bg-overlay {
  position: absolute;
  height: 100%;
  width: 100%;
  left: 0;
  bottom: 0;
  right: 0;
  top: 0;
  opacity: 0.6;
  background-color: #000;
}

hr.light { 
    width:30%; 
    margin:0 auto; 
    border:0px none white; 
    border-bottom:2px solid lightgrey; 
}

.circle {
  display: inline-block;
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: #00f791;
  text-align: center;
  line-height: 15px;
  margin: 0 2px;
}


</style>

<div class="row g-0">

    <?=Component::create('content/objet/auth-carousel') ?>

    <div class="col-xl-3">
        <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">
                    
                    <?=Component::create('content/objet/auth-logo')->assign(['div-class' => "mb-4 mb-md-5", 'mx-auto' => false]) ?>

                    <div class="my-auto">

                        <?=Component::create('content/objet/auth-title')->assign(['title' => "Changement de mot de passe !", 
                                                                                'subtitle' => "Je voudrais le changer par ..."]) ?>

                        <div class="mt-4">
                            <form action="" method="" onsubmit="resetPassword(); return false;">
            
                                <div class="mb-3">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Entrer le nouveau mot de passe" aria-label="Password" aria-describedby="password-addon" id="user_password_0" name="user_password_0" required="required" value="" autocomplete="">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Répeter le mot de passe" aria-label="Password" aria-describedby="repeat_password-addon" id="user_password_1" name="user_password_1" required="required" value="" autocomplete="">
                                        <button class="btn btn-light " type="button" id="repeat_password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <small>Il convient d’éviter les mots de passe faciles à découvrir. 
                                        <a data-toggle="tooltip" data-placement="top" title="Cliquez pour plus d'information" type="button"  name="expandContent" id="expandInfoPassword" ><i style="color: #01a3f3;" class="fas fa-info-circle"></i></a></small>
                                        <div class="card-body pt-2 showInfoPassword" style="display:none">
                                            <small class="circle">1</small><small>Le mot de passe ne doit pas dépasser 32 caractères et comporter au moins 8 caractères</small><br>
                                            <small class="circle">2</small><small>Le mot de passe doit comporter au moins un caractère spécial et un chiffre</small><br>
                                            <small class="circle">3</small><small>Le mot de passe ne doit pas comporter d'espace</small><br>
                                            <small class="circle">4</small><small>Le mot de passe doit être différent du mot de passe actuel</small><br>
                                            <small class="circle">5</small><small>Et pour finir les mots de passe renseignés ne doivent pas être différents.</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-4 d-grid">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Confirmer le nouveau mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?=Component::create('content/objet/auth-copyright')->assign(['div-class' => "mt-4 mt-md-5 text-center"]) ?>

                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>