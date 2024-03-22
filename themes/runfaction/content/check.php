
<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: check.php
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
use Carbon\Carbon;
use Steampixel\Component;

global $globaluser;
$getDateTime = 0;
$getEmail = "";
if ($globaluser != null)
{
    $getDateTime = Carbon::createFromTimestamp($globaluser->lastupdatedate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->toISOString();
    $getEmail = $globaluser->email; 
}
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

<?php 
 echo 'body {
    background-image: url(\''.BASEPATH.'themes/runfaction/assets/images/bg-auth-overlay.png\');
    background-size: cover;
    background-position: center;
  }';
?>

</style>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?=Component::create('content/auth-logo')->assign(['div-class' => "text-center mb-5 text-muted", 'mx-auto' => true]) ?>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-7">
                <div class="card">

                    <div class="card-body">

                        <div class="p-2">
                            <div class="text-center">

                                <div class="avatar-md mx-auto">
                                    <div class="avatar-title rounded-circle bg-light">
                                        <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <div class="p-2 mt-4">

                                <h4 >Vérification de votre adresse email</h4>
                                <p class="text-muted">Veuillez renseigner les 5 caractères du code que vous avez reçu à l'adresse : <b><?php echo $getEmail;  ?></b> </p>

                                <div class="row pb-3">
                            <div class="col-md-12 overlay">
                                <h1 id="counter" class="text-center m-auto"></h1>
                            </div>
                        </div>

                                            <form action="" method="" onsubmit="checkCode(); return false;">
        <div class="row justify-content-center">
            
        
          
        
        
            <div class="col-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 2,event)" maxLength="1"
                        id="code_input_1" name="code1" autocomplete="off" >
                </div>
            </div>

            <div class="col-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                        id="code_input_2" name="code2" autocomplete="off">
                </div>
            </div>

            <div class="col-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 4,event)" maxLength="1"
                        id="code_input_3" name="code3" autocomplete="off">
                </div>
            </div>
            
            <div class="col-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                        id="code_input_4" name="code4" autocomplete="off">
                </div>
            </div>

            <div class="col-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center" onkeyup="touchCode(this, 6,event)" maxLength="1" 
                        id="code_input_5" name="code5">
                </div>
            </div>
          </div>

          <div class="text-center mb-3">
                <div class="row pt-2">
                    <div class="col-6">
                        <button type="button" id="btnResendCode" class="btn btn-light btn-sm waves-effect waves-light"><i class="fas fa-undo"></i> Renvoyer un code</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i style="color: #00f791;" class="fas fa-check-circle"></i> Confirmer</button>
                    </div>
                </div>
            </div>
       
      </form>
      <hr>
      <div class="text-center">
      <small> Si vous ne trouvez pas l'e-mail dans votre boîte de réception, veuillez vérifier votre dossier de courrier indésirable (spams). </small>
      </div>

                                </div>

                            </div>
                        </div>

                        <div class="mt-3 text-center">
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Moobotec. Conçu avec <i class="mdi mdi-heart text-danger"></i> par Moobotec</p>
                </div>

                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>


<!--
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
     end col -->
<!--
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
                            <h5 class="text-primary">Vérification de votre adresse email</h5>
                            <p class="text-muted">Veuillez renseigner les 5 caractères du code que vous avez reçu à l'adresse : <b><?php echo $getEmail;  ?></b> </p>
                        </div>

                        <div class="row pb-3">
                            <div class="col-md-12 overlay">
                                <h1 id="counter" class="text-center m-auto"></h1>
                            </div>
                        </div>


                        <div class="mt-4">
                           

                        <form action="" method="" onsubmit="checkCode(); return false;">
        <div class="row p-2 justify-content-center">
            <div class="col-4 col-sm-3 col-md-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 2,event)" maxLength="1"
                        id="code_input_1" name="code1" autocomplete="off" >
                </div>
            </div>

            <div class="col-4 col-sm-3 col-md-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 3,event)" maxLength="1"
                        id="code_input_2" name="code2" autocomplete="off">
                </div>
            </div>

            <div class="col-4 col-sm-3 col-md-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 4,event)" maxLength="1"
                        id="code_input_3" name="code3" autocomplete="off">
                </div>
            </div>
            
            <div class="col-4 col-sm-3 col-md-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center"
                        onkeyup="touchCode(this, 5,event)" maxLength="1"
                        id="code_input_4" name="code4" autocomplete="off">
                </div>
            </div>

            <div class="col-4 col-sm-3 col-md-2">
                <div class="mb-3 text-center">
                    <input type="text"
                        class="form-control form-control-lg text-center" onkeyup="touchCode(this, 6,event)" maxLength="1" 
                        id="code_input_5" name="code5">
                </div>
            </div>
          </div>

          <div class="text-center mb-3">
                <div class="row pt-2">
                    <div class="col-6">
                        <button type="button" id="btnTypeRedo" class="btn btn-light btn-sm waves-effect waves-light"><i class="fas fa-undo"></i> Renvoyer un code</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i style="color: #00f791;" class="fas fa-check-circle"></i> Confirmer</button>
                    </div>
                </div>
            </div>
       
      </form>
      <hr>
      <div class="text-center">
      <small> Si vous ne trouvez pas l'e-mail dans votre boîte de réception, veuillez vérifier votre dossier de courrier indésirable (spams). </small>
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
     end col 
</div>-->

<script>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
</script>