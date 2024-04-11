<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: NotificationUser.php
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
   =    * 19/12/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

include_once("models/AbstractModel.php");

/**
 * NotificationUser Class
 * Provides access to the "NotificationUser" database table.
 */
class NotificationUser extends AbstractModel
{
    /**
     *  Three columns,
     *
     *      - The ID
     *      - Type de notification.
     *      - Severité
     *      - The notification's description.
     */    
    public static $data = array(
        array(
            'id' => 500,
            'type' => 'msg',
            'level' => 'info',
            'texte' => 'L\'utilisateur a été ajouté avec succès'
        ),
        array(
            'id' => 501,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Vous devez d\'abord suivre la procédure de validation de votre compte.'
        ),
        array(
            'id' => 502,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Vous devez d\'abord suivre la procédure de modification de votre mot de passe.'
        ),
        array(
            'id' => 503,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Vous avez été bannis temporairement. Soyez patient tout va rentrer dans l\'ordre.'
        ),
        array(
            'id' => 504,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Votre compte a été supprimer. Veuillez contacter Pro Stride si vous considérerez que c\'est annormal.'
        ),
        array(
            'id' => 505,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Veuillez utiliser des informations de compte valide.'
        ),
        array(
            'id' => 506,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : impossible d\'ajouter un utilisateur.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
        array(
            'id' => 507,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : impossible de modifier un utilisateur.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
        array(
            'id' => 508,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : impossible de consulter les informations utilisateurs.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
        array(
            'id' => 509,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe actuel n\'est pas différent de celui-ci.'
        ),
        array(
            'id' => 510,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Les mots de passe ne doivent pas être différents.'
        ),
        array(
            'id' => 511,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe doit comporter au moins 8 caractères.'
        ),
        array(
            'id' => 533,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe ne doit pas dépasser 32 caractères.'
        ),
        array(
            'id' => 534,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le numéro de mobile n\'est pas correctement renseigné.'
        ),
        array(
            'id' => 512,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe doit comporter au moins un caractère.'
        ),
        array(
            'id' => 513,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe doit comporter au moins un chiffre.'
        ),
        array(
            'id' => 514,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe doit comporter au moins un caractère spécial.'
        ),
        array(
            'id' => 515,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe ne doit pas comporter d\'espace.'
        ),
        array(
            'id' => 516,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Ce pseudo existe déjà.'
        ),
        array(
            'id' => 517,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Veuillez accepter les Conditions d\'Utilisation.'
        ),
        array(
            'id' => 518,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'L\'adresse email est invalide.'
        ),
        array(
            'id' => 519,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Tous les champs doivent être remplis.'
        ),
        array(
            'id' => 520,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le pseudo ne doit pas comporter d\'espace.'
        ),
        array(
            'id' => 521,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le pseudo ne doit pas comporter de caractères spéciaux.'
        ),
        array(
            'id' => 522,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le pseudo ne doit pas dépasser 64 caractères et comporter au moins 4 caractères.'
        ),
        array(
            'id' => 523,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : il n\'est pas possible d\'avoir plusieurs utilisateur avec le même uuid.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ), 
        array(
            'id' => 524,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : la procédure de validation de votre compte est bancale.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
         array(
            'id' => 525,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : la procédure de modification de votre mot de passe est bancale.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
        array(
            'id' => 526,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Erreur interne : impossible de supprimer les informations utilisateurs.<br>Veuillez nous excuser pour la gêne occasionnée mais une erreur interne vient de se produire.'
        ),
        array(
            'id' => 527,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Opération interdite.'
        ),
        array(
            'id' => 528,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Les mots de passe doivent être différents.'
        ),
        array(
            'id' => 529,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Cette adresse email existe déjà.'
        ),
        array(
            'id' => 530,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Veuillez entrer un code de validation correct.'
        ),
        array(
            'id' => 531,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le mot de passe actuel n\'est pas correcte.'
        ),
        array(
            'id' => 535,
            'type' => 'msg',
            'level' => 'warning',
            'texte' => 'Le délai imparti de 5 minutes pour valider votre compte avec le code reçu par email est écoulé.'
        ),
        array(
            'id' => 532,
            'type' => 'error',
            'level' => 'critique',
            'texte' => 'Exception : '
        ),
    );
}

?>