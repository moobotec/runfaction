<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: UserController.php
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
   =    * 23/02/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

include_once("models/AbstractModelEmail.php");

/**
 * EmailController
 * Says control to a email send.
 *
 */
class EmailController extends AbstractModelEmail
{
    public function sendSignupByEmail($email,$firstname,$iduuid,$codefirst,$password = "")
    {
        $this->title = 'Bienvenue sur Run Faction !';
        $url = $this->path.'check.php/'. $iduuid.'/'. $codefirst;
        $this->body = '<h5>Bonjour '.$firstname.' voici votre mail de validation. </h5><br> F&#233;licitations, votre compte a &#233;t&#233; cr&#233;&#233; 
        avec succ&#232;s ! Vous pouvez maintenant y acc&#233;der.<br> Pour cela, vous aurez besoin des informations suivantes : <br>
        <br><label>- Votre identifiant de connexion : <b>'.$email.'</b>  </label>
        <br>Vous pouvez changer les informations relatives &#224; votre compte ainsi que votre mot de passe dans la section "Compte".<br><br>
        Veuillez cliquer sur le texte ci-dessous pour valider votre compte : <font color="#01a3f3"><a href=\''.$url.'\'>Confirmez !</a></font>
        <br><br><label>- Votre code de validation - </label>
        <input type="text" pattern="\d*" maxlength="1" style="width:2em" value="'.$codefirst[0].'" disabled>
        <input type="text" pattern="\d*" maxlength="1" style="width:2em" value="'.$codefirst[1].'" disabled>
        <input type="text" pattern="\d*" maxlength="1" style="width:2em" value="'.$codefirst[2].'" disabled>
        <input type="text" pattern="\d*" maxlength="1" style="width:2em" value="'.$codefirst[3].'" disabled>
        <input type="text" pattern="\d*" maxlength="1" style="width:2em" value="'.$codefirst[4].'" disabled>';
        if ($password != "")
        {
            $this->body .= '<br><br>Le mot de passe temporaire est : <b> '.$password.' </b> <br><br>Avec le temps, 
            il n\'est pas recommand&#233; d\'utiliser ce mot passe pour vous authentifier sur Run Faction.';
        }
        $this->subject = 'Inscription sur Run Faction';
        self::send($email,'RunFaction.fr');
    }
        
    public function sendResetPasswordByEmail($email,$iduuid,$codereset)
    {
        $this->title = 'R&#233;initialisation de votre mot de passe';
        $url = $this->path.'reset.php/'. $iduuid.'/'. $codereset;
        $this->body = 'Votre mot de passe oubli&#233; ? Pas de panique ! Cliquez simplement sur le bouton ci-dessous et suivez les indications. 
                        Vous serez de retour sur les pistes en un rien de temps.<br><br><font color="#01a3f3">
                        <a  href=\''.$url.'\'> R&#233;initialiser votre mot de passe </a></font><br><br>';
        $this->subject = 'Réinitialisation de votre mot de passe';
        $this->send($email,'RunFaction.fr');
    }
}


?>
