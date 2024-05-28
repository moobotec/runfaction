<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
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
   =    * 28/05/2024 : David DAUMAND
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
    background-image: url(\''.BASEPATH.'themes/'.THEME.'/assets/images/bg-auth-overlay.png\');
    background-size: cover;
    background-position: center;
  }';
?>

</style>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?=Component::create('content/objet/auth-logo')->assign(['div-class' => "text-center mb-5 text-muted", 'mx-auto' => true]) ?>
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

                        <?=Component::create('content/objet/auth-copyright')->assign(['div-class' => "mt-3 text-center"]) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
</script>