<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: User.php
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

include_once("models/user/NotificationUser.php");

/**
 * User Class
 * Provides access to the "User" database table.
 */
class User extends ModelSqlite3
{
    public static $stateTxtToId = array(
        'inscription_en_cours' => 1,
        'valider' => 2,
        'modification_en_cours' => 3,
        'banni' => 4,
        'supprimer' => 5,
        'en_attente' => 6,
        'annuler' => 7) ;

   public function __construct($data = false) {
        $schema = array(
            'iduuid'     => SQLITE3_TEXT,
            'number'     => SQLITE3_TEXT,
            'name'    => SQLITE3_TEXT,
            'firstname' => SQLITE3_TEXT,
            'email' => SQLITE3_TEXT,
            'pseudo' => SQLITE3_TEXT,
            'password' => SQLITE3_TEXT,
            'description' => SQLITE3_TEXT,
            'telephone' => SQLITE3_TEXT,
            'condition_utilisation' => SQLITE3_INTEGER,
            'skills' => SQLITE3_TEXT,
            'rating' => SQLITE3_INTEGER,
            'notification' => SQLITE3_INTEGER,
            'enterprise' => SQLITE3_TEXT,
            'functionpro' => SQLITE3_TEXT,
            'telephonepro' => SQLITE3_TEXT,
            'insertdate' => SQLITE3_TEXT,
            'lastupdatedate' => SQLITE3_TEXT,
            'idcategoryrole' => SQLITE3_INTEGER,
            'idcategorystatus' => SQLITE3_INTEGER,
            'region_id' => SQLITE3_INTEGER,
            'subregion_id' => SQLITE3_INTEGER,
            'country_id' => SQLITE3_INTEGER,
            'state_id' => SQLITE3_INTEGER,
            'city_id' => SQLITE3_INTEGER,
            'codereset' => SQLITE3_TEXT,
            'codefirst' => SQLITE3_TEXT,
            'address_1' => SQLITE3_TEXT,
            'address_2' => SQLITE3_TEXT,
            'address_3' => SQLITE3_TEXT
        );
       
        $bannedSchema = ['id','password'];
    
        parent::__construct($schema,$bannedSchema, $data);
    }
    
    public static function getUserByPseudo($pseudo) {
        return self::getAllBy('pseudo', $pseudo);
    }
    
    public static function getUserByUuid($iduuid) {
        return self::getAllBy('iduuid', $iduuid);
    }
    
    public static function getUserByEmail($email) {
        return self::getAllBy('email', $email);
    }
    
    public static function getUsers($limit,$orderBy) {
        return self::getAll($limit,$orderBy);
    }

    public static function getUserCount() {
        return self::count();
    }

    public static function searchUsers($arrayFieldValue,$limit,$orderBy) {
        return self::searchBy($arrayFieldValue,$limit,$orderBy);
    }
 
    public static function serialize($data) {
        return self::serializeResponse($data);
    }

    public static function HasModifyProcess($status) {
        $isOk = false;
        if ($status == User::$stateTxtToId['modification_en_cours'])
        {
            $isOk = true;
        }
        return $isOk;
    }

    public static function HasCancelProcess($status) {
        $isOk = false;
        if ($status == User::$stateTxtToId['annuler'])
        {
            $isOk = true;
        }
        return $isOk;
    }

    public static function HasBanneProcess($status) {
        $isOk = false;
        if ($status == User::$stateTxtToId['banni'])
        {
            $isOk = true;
        }
        return $isOk;
    }

    public static function HasDeleteProcess($status) {
        $isOk = false;
        if ($status == User::$stateTxtToId['supprimer'])
        {
            $isOk = true;
        }
        return $isOk;
    }
}

?>