
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: signin.php
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
    
    <?=Component::create('content/objet/auth-carousel') ?>

    <div class="col-xl-3">
        <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">

                    <?=Component::create('content/objet/auth-logo')->assign(['div-class' => "mb-4 mb-md-5", 'mx-auto' => false]) ?>

                    <div class="my-auto">
                        
                        <?=Component::create('content/objet/auth-title')->assign(['title' => "Content de vous revoir !", 
                                                                                'subtitle' => "Connectez-vous pour démarrer votre session."]) ?>

                        <div class="mt-4">
                            <form action="" method="" onsubmit="loginUser(); return false;">

                                <div class="mb-3">
                                    <label for="login" class="form-label">Email *</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="login" name="login" placeholder="Email" value="daumanddavid@hotmail.fr">
                                        <div class="btn btn-light " type="button" ><i class="mdi mdi-email-outline"></i></div>
                                    </div>
                                </div>
        
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon" id="password" name="password" value="pi">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                
                                <div class="mt-4 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Se connecter</button>
                                </div>

                            </form>
                            <hr>
                            <div class="mt-3 text-center">
                                <p><?php echo '<a class="fw-medium text-primary" href="'.BASEPATH.'askresetpassword.php" >J\'ai oublié mon mot de passe.</a>' ?></p>
                                <p><?php echo '<a class="fw-medium text-primary" href="'.BASEPATH.'signup.php" >Je ne suis pas encore inscrit.</a>' ?></p>
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