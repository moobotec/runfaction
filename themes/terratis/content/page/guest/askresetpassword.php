<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: askresetpassword.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: Plannificateur de lacher de moustique stérilisé
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
  opacity: 0.2;
  background-color: #000;
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

                        <?=Component::create('content/objet/auth-title')->assign(['title' => "Mot de passe oublié !", 
                                                                                'subtitle' => "Entrez votre adresse email afin que les instructions vous soient envoyées."]) ?>

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

                    <?=Component::create('content/objet/auth-copyright')->assign(['div-class' => "mt-4 mt-md-5 text-center"]) ?>

                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>