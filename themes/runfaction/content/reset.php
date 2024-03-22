<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
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
   =    * 21/03/2024 : David DAUMAND
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
    <div class="col-xl-9">
        <div class="auth-full-bg pt-lg-5 p-4">
            <div class="w-100">
                <div class="bg-overlay"></div>
                <div class="d-flex h-100 flex-column">
                    <div class="p-4 mt-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="text-center">
                                    <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">13M</span>+ d'adeptes de la course à pied</h4>
                                    <div dir="ltr">
                                        <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                            <div class="item">
                                                <div class="py-3">
                                                    <p class="font-size-16 mb-4">" Courir, c’est trouver sa liberté, sa force, son équilibre. "</p>
                                                    <div>
                                                        <h4 class="font-size-16 text-primary">Emil Zátopek</h4>
                                                        <p class="font-size-14 mb-0">- (1922 - 2000)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="py-3">
                                                    <p class="font-size-16 mb-4">" Le secret pour courir longtemps est de s'entraîner progressivement, de se fixer des objectifs et de ne jamais abandonner. "</p>
                                                    <div>
                                                        <h4 class="font-size-16 text-primary">Amby Burfoot</h4>
                                                        <p class="font-size-14 mb-0">- 1946 (Âge: 77 ans)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
    
    <div class="col-xl-3">
        <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">
                    <?=Component::create('content/auth-logo')->assign(['div-class' => "mb-4 mb-md-5", 'mx-auto' => false]) ?>

                    <div class="my-auto">
                        <div>
                            <h5 class="text-primary">Changement de mot de passe !</h5>
                            <p class="text-muted">Je voudrais le changer par ...</p>
                        </div>
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
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Moobotec. Conçu avec <i class="mdi mdi-heart text-danger"></i> par Moobotec</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>