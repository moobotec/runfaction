
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
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
                    <div class="mb-4 mb-md-5">
                        <a href="#" class="d-block auth-logo">
                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-dark.png" alt="" height="32" class="auth-logo-dark">' ?>
                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-light.png" alt="" height="18" class="auth-logo-light">' ?>
                        </a>
                    </div>
                    <div class="my-auto">
                        <div class="mt-4">
                            <form action="" method="" onsubmit="createUser(); return false;">
                                <div class="text-center" id="step1" style="display:block">
                                    <div id="boxMsg" style="display:block">
                                        <h5 class="text-primary">Je m'inscris en tant que ...</h5>
                                        <p class="text-muted">Faites votre choix parmis c'est trois propositions.</p>
                                    </div>
                                    <button type="button"  id="btnTypeSportif" class="btn btn-block btn-light btn-lg border center">
                                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/maillot_100_62.png" alt="Sportif" class="img-fluid" style="opacity: .8">' ?>
                                        <span class="ml-2">Sportif</span>
                                    </button>
                                    <div class="d-flex p-3">
                                        <hr class="light" />
                                        <span>ou</span>
                                        <hr class="light" />
                                    </div>
                                    <button type="button"  id="btnTypeEntraineur" class="btn btn-block btn-light btn-lg border center">
                                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/sifflet_100_80.png" alt="Entraineur" class="img-fluid" style="opacity: .8">' ?>
                                        <span class="ml-2">Entraineur</span>
                                    </button>
                                    <div class="d-flex p-3">
                                        <hr class="light" />
                                        <span >ou</span>
                                        <hr class="light" />
                                    </div>
                                    <button type="button"  id="btnTypeAssociation" class="btn btn-block btn-light btn-lg border center">
                                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/immeuble_100_127.png" alt="Association" class="img-fluid" style="opacity: .8">' ?>
                                        <span class="ml-2">Association</span>
                                    </button>
                                    <div class="pt-2"><small> &Eacute;tape 1/2 </small></div>
                                </div>
                                <div id="step2" style="display:none">
                                    <div class="text-center" id="boxMsg" style="display:block">
                                        <h5 class="text-primary">Et je remplis le formulaire ...</h5>
                                        <p class="text-muted">Veuillez renseigner quelques informations pour compléter votre inscription.</p>
                                    </div>
                                    <div id="block_name_user" style="display:none">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="user_lastname" name="user_lastname" placeholder="Prénom" value="Henri" maxlength="50" autocomplete="given-name">
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
                                    <div class="row">
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
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="user_agree_terms" name="user_agree_terms" required="required" checked>
                                        <label class="form-check-label" for="remember">
                                            J’accepte <a href="#">les conditions générales et politiques de confidentialité</a>
                                        </label>
                                    </div>
                                    <hr>
                                    <div class="text-center row pt-2">
                                        <div class="col-6">
                                            <button type="button" id="btnTypeRedo" class="btn btn-light waves-effect waves-light"><i class="fas fa-undo"></i> Retour</button>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"><i style="color: #00f791;" class="fas fa-check-circle"></i> M'inscrire</button>
                                        </div>
                                    <!-- /.col -->
                                    </div>
                                    <div class="pt-4 text-center"><small> &Eacute;tape 2/2 </small></div>
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
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Moobotec. Conçu avec <i class="mdi mdi-heart text-danger"></i> par Moobotec</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>