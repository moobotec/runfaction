
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
                    <div class="mb-4 mb-md-5">
                        <a href="#" class="d-block auth-logo">
                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-dark.png" alt="" height="32" class="auth-logo-dark">' ?>
                        <?php echo '<img src="'.BASEPATH.'themes/runfaction/assets/images/logo-light.png" alt="" height="18" class="auth-logo-light">' ?>
                        </a>
                    </div>
                    <div class="my-auto">
                        
                        <div>
                            <h5 class="text-primary">Content de vous revoir !</h5>
                            <p class="text-muted">Connectez-vous pour démarrer votre session.</p>
                        </div>

                        <div class="mt-4">
                            <form action="" method="" onsubmit="loginUser(); return false;">

                                <div class="mb-3">
                                    <label for="username" class="form-label">Email *</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="login" name="login" placeholder="Email" value="daumanddavid@hotmail.fr">
                                        <div class="btn btn-light " type="button" ><i class="mdi mdi-email-outline"></i></div>
                                    </div>
                                </div>
        
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe *</label>
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
                                
                                <div class="mt-3 d-grid">
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
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Moobotec. Conçu avec <i class="mdi mdi-heart text-danger"></i> par Moobotec</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>