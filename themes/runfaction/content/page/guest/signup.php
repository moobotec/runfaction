
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: signup.php
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
    
    <?=Component::create('content/objet/auth-carousel') ?>
    
    <div class="col-xl-3">
        <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">

                    <?=Component::create('content/objet/auth-logo')->assign(['div-class' => "mb-4 mb-md-5", 'mx-auto' => false]) ?>

                    
                    <div class="my-auto">
                        <div class="mt-4">
                            <form action="" method="" onsubmit="createUser(); return false;">
                                <div id="step1" style="display:block">
                                    <div id="boxMsg" style="display:block">

                                        <?=Component::create('content/objet/auth-title')->assign(['title' => "Je m'inscris en tant que ...", 
                                                                                                    'subtitle' => "Faites votre choix parmis c'est trois propositions."]) ?>

                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button type="button"  id="btnTypeSportif" class="btn btn-block btn-light btn-lg border center">
                                            <?php echo '<img src="'.BASEPATH.'themes/'.THEME.'/assets/images/maillot_100_62.png" alt="Sportif" class="img-fluid" style="opacity: .8">' ?>
                                            <span class="ml-2">Sportif</span>
                                        </button>
                                        <div class="d-flex p-3">
                                            <hr class="light" />
                                            <span>ou</span>
                                            <hr class="light" />
                                        </div>
                                        <button type="button"  id="btnTypeEntraineur" class="btn btn-block btn-light btn-lg border center">
                                            <?php echo '<img src="'.BASEPATH.'themes/'.THEME.'/assets/images/sifflet_100_80.png" alt="Entraineur" class="img-fluid" style="opacity: .8">' ?>
                                            <span class="ml-2">Entraineur</span>
                                        </button>
                                        <div class="d-flex p-3">
                                            <hr class="light" />
                                            <span >ou</span>
                                            <hr class="light" />
                                        </div>
                                        <button type="button"  id="btnTypeAssociation" class="btn btn-block btn-light btn-lg border center">
                                            <?php echo '<img src="'.BASEPATH.'themes/'.THEME.'/assets/images/immeuble_100_127.png" alt="Association" class="img-fluid" style="opacity: .8">' ?>
                                            <span class="ml-2">Association</span>
                                        </button>
                                        <div class="pt-2"><small> &Eacute;tape 1/2 </small></div>
                                    </div>
                                </div>
                                <div id="step2" style="display:none">
                                    <div id="boxMsg" style="display:block">

                                        <?=Component::create('content/objet/auth-title')->assign(['title' => "Et je remplis le formulaire ...", 
                                                                                                    'subtitle' => "Veuillez renseigner quelques informations pour compléter votre inscription."]) ?>

                                    </div>
                                    <hr>
                                    <div id="block_name_user" style="display:none">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="Prénom" value="Henri" maxlength="50" autocomplete="given-name">
                                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nom" value="LaTuche" maxlength="50" autocomplete="family-name">
                                                <div class="btn btn-light" type="button" ><i class="mdi mdi-account-outline"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="block_name_assoc" style="display:none">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="user_assoc_name" name="user_assoc_name" placeholder="Nom de l'association" maxlength="100">
                                                <div class="btn btn-light" type="button" ><i class="mdi mdi-office-building-outline"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="block_address" style="display:none">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Adresse postale" maxlength="255" autocomplete="street-address">
                                                <div class="btn btn-light" type="button" ><i class="mdi mdi-map-marker-outline"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="block_mobile" style="display:none">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="user_telephone" name="user_telephone" placeholder="Numéro de téléphone" pattern="^0[6-7]([\-. ]?[0-9]{2}){4}$" maxlength="14" autocomplete="tel">
                                                <div class="btn btn-light" type="button" ><i class="mdi mdi-cellphone"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Entrer votre email" required="required" value="" autocomplete="email">
                                            <div class="btn btn-light" type="button" ><i class="mdi mdi-email-outline"></i></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon" id="user_password_0" name="user_password_0" required="required" value="2X6k3H^ae~3,fE" autocomplete="new-password">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                        <small>Il convient d’éviter les mots de passe faciles à découvrir. 
                                        <a data-toggle="tooltip" data-placement="top" title="Cliquez pour plus d'information" type="button"  name="expandContent" id="expandInfoPassword" ><i style="color: #01a3f3;" class="fas fa-info-circle"></i></a></small>
                                            <div class="card-body pt-2 showInfoPassword" style="display:none">
                                            <small class="circle">1</small><small>Le mot de passe ne doit pas dépasser 32 caractères et comporter au moins 8 caractères</small><br>
                                            <small class="circle">2</small><small>Le mot de passe doit comporter au moins un caractère spécial et un chiffre</small><br>
                                            <small class="circle">3</small><small> Le mot de passe ne doit pas comporter d'espace</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mx-1">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" id="user_agree_terms" name="user_agree_terms" required="required" checked>
                                            <label class="form-check-label" for="remember">
                                                J’accepte <a href="#">les conditions générales et politiques de confidentialité</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-center mb-3">
                                        <div class="row pt-2">
                                            <div class="col-6">
                                                <button type="button" id="btnTypeRedo" class="btn btn-light btn-sm waves-effect waves-light"><i class="fas fa-undo"></i> Retour</button>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i style="color: #00f791;" class="fas fa-check-circle"></i> M'inscrire</button>
                                            </div>
                                        <!-- /.col -->
                                        </div>
                                    
                                        <div class="pt-4 "><small> &Eacute;tape 2/2 </small></div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <p class="mb-1">
                                <?php echo '<a href="'.BASEPATH.'signin.php" class="fw-medium text-primary">Déjà inscrit ? Me connecter</a>' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?=Component::create('content/objet/auth-copyright')->assign(['div-class' => "mt-4 mt-md-5 text-center"]) ?>

                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>