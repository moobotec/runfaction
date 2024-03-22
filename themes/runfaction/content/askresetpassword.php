<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: askresetpassword.php
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
                            <h5 class="text-primary">Mot de passe oublié !</h5>
                            <p class="text-muted">Entrez votre adresse email afin que les instructions vous soient envoyées.</p>
                        </div>
                        <div class="mt-4">
                            <form action="" method="" onsubmit="askResetPassword(); return false;">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="login" name="login" placeholder="Entrer votre email" required>
                                        <div class="btn btn-light " type="button" ><i class="mdi mdi-email-outline"></i></div>
                                    </div>
                                </div>
                                <div class="mt-4 d-grid">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Réinitialiser mon mot de passe</button>
                                </div>
                            </form>
                            <hr>
                            <div class="mt-3 text-center">
                                <?php echo '<p>Je me souviens de mon mot de passe , <a class="fw-medium text-primary" href="'.BASEPATH.'signin.php" >je peux me connecter.</a></p>' ?>
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