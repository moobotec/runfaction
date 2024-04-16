<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis 
   =
   =  FICHIER: index.php
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
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

echo '
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 align-self-center">
            <div class="card text-center"> 
                <div class="card-title">
                    <br><h4><span class="txt-bleu"> Bienvenue sur votre espace dédié.</span></h4>
                </div>
                <div class="card-body">
                    <a href="'.BASEPATH.'process.php" type="button" class="btn btn-success waves-effect waves-light rounded-pill font-size-15" >Planifier un nouveau traitement</a>                           
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center align-items-center">
        
        <div class="card text-center">
            <div class="card-title">
                <br><h4><span class="black">Votre parcours sur Terratis en 5 étapes !</span></h4>
            </div>

            <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-4 col-md-2">
                    <img src="'.BASEPATH.'themes/'.THEME.'/assets/images/logos-etapes/etape1-removebg-preview.png" height="90" width="90">
                    <h5><span class="txt-bleu">ÉTAPE 1</span></h5>
                    <p class="black"><a href="'.BASEPATH.'process.php">Planifier un traitement</a></p>                                    
                </div>
                <div class="col-4 col-md-2">
                    <img  src="'.BASEPATH.'themes/'.THEME.'/assets/images/logos-etapes/etape2-removebg-preview.png" height="90" width="90">
                    <h5><span class="txt-bleu">ÉTAPE 2</span></h5>
                    <p class="black">Recevez les propositions</p>                                    
                </div>
                <div class="col-4 col-md-2">
                    <img src="'.BASEPATH.'themes/'.THEME.'/assets/images/logos-etapes/etape3-removebg-preview.png" height="90" width="90">
                    <h5><span class="txt-bleu">ÉTAPE 3</span></h5>
                    <p class="black">Sélectionnez votre Tisseur</p>                                    
                </div>
                <div class="col-4 col-md-2">
                    <img src="'.BASEPATH.'themes/'.THEME.'/assets/images/logos-etapes/etape4-removebg-preview.png" height="90" width="90">
                    <h5><span class="txt-bleu">ÉTAPE 4</span></h5>
                    <p class="black">Payer la prestation</p>                                    
                </div>
                <div class="col-4 col-md-2">
                    <img src="'.BASEPATH.'themes/'.THEME.'/assets/images/logos-etapes/etape5-removebg-preview.png" height="90" width="90">
                    <h5><span class="txt-bleu">ÉTAPE 5</span></h5>
                    <p class="black">Suivez l\'intervention</p>                                   
                </div>
            </div>
            </div>
        </div>
    </div>
</div>';
?>


<!-- end page title -->