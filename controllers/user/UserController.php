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
   =    * 19/12/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */
use RunFaction\SessionMoobotec;
use Carbon\Carbon;

include_once("models/ModelSqlite3.php"); 
include_once("models/user/User.php");

/**
 * UserController
 * Says control to a user.
 */
class UserController extends BaseClass
{
    function __construct(?string $command = null) {
        parent::__construct($command);
    }

    /*private function checkParams($user)
    {
        $code = array();
        if ($user != null)
        {
            //verification des champs
            if ($user->name == null || $user->name == "" ||
               $user->lastname == null || $user->lastname == "" ||
               $user->email == null || $user->email == "" ) 
            {
                array_push($code,519);
            }
        }
        return $code;
    }*/
    
    /*private function checkProParams($user)
    {
        $code = array();
        if ($user != null)
        {
            //verification des champs
            if ($user->enterprise == null || $user->enterprise == "" ||
               $user->functionpro == null || $user->functionpro == "" ||
               $user->telephonepro == null || $user->telephonepro == "" ||
               $user->siret == null || $user->siret == "") 
            {
                array_push($code,519);
            }
        }
        return $code;
    }*/

    /*public function checkPassword($password)
    {
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $code = array();
        
        $lenghtPassword = strlen($password);
        if ($lenghtPassword < $minPasswordLenght || $lenghtPassword >= $maxPasswordLenght)
        {
            array_push($code,511);
        }

        $containsLetter  = preg_match('/[a-zA-Z]/', $password);
        if ($containsLetter == false)
        {
            array_push($code,512);
        }

        $containsDigit   = preg_match('/\d/',$password);
        if ($containsDigit == false)
        {
            array_push($code,513);
        }

        $containsSpace = preg_match('/[ ]/',$password);
        if ($containsSpace == true)
        {
            array_push($code,515);
        }
        
        return (count($code) == 0) ? array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
    }*/
    
    
    /*public function addUser($post)
    {
        global $error;
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $minPseudoLenght = 4;
        $maxPseudoLenght = 64;
        $code = array();
        
        $repeat_password = $post['user_repeat_password'];
        unset($post['user_repeat_password']);
        
        $user = new User($post);
 
        if ($user != null)
        {
            //verification des champs
            $code = $this->checkParams($user);
            
            if ( $user->condition_utilisation == null  || $user->condition_utilisation == "" ||
                 $user->idcategoryrole == null  || $user->idcategoryrole == "" ||
                 $user->pseudo == null || $user->pseudo == "" )
            {
                array_push($code,519);
            }

            //  on verifie si un autre utilisateur utilise déjà ce pseudo
            if ($user->pseudo != null && $user->pseudo != "")
            {
                $users = User::getUserByPseudo($user->pseudo);
                if ($error == true)
                {
                    array_push($code,506);
                }
                else
                {
                    if ($users != null ) array_push($code,516);
                }
            }
            
            //  on verifie si un autre utilisateur utilise déjà cette email
            if ($user->email != null && $user->email != "")
            {
                $users = User::getUserByEmail($user->email);
                if ($error == true)
                {
                    array_push($code,506);
                }
                else
                {
                    if ($users != null ) array_push($code,529);
                }
            }
            
            $lenghtPassword = strlen($user->password);
            if ($lenghtPassword < $minPasswordLenght || $lenghtPassword >= $maxPasswordLenght)
            {
                array_push($code,511);
            }

            $containsLetter  = preg_match('/[a-zA-Z]/', $user->password);
            if ($containsLetter == false)
            {
                array_push($code,512);
            }

            $containsDigit   = preg_match('/\d/',$user->password);
            if ($containsDigit == false)
            {
                array_push($code,513);
            }

            $containsSpace = preg_match('/[ ]/',$user->password);
            if ($containsSpace == true)
            {
                array_push($code,515);
            }
            
            if ( $user->password != $repeat_password )
            {
                array_push($code,510);
            }
            
             //vérification
            $lenghtPseudo = strlen($user->pseudo);
            if ($lenghtPseudo < $minPseudoLenght || $lenghtPseudo >= $maxPseudoLenght)
            {
                array_push($code,522);
            }

            $containsSpecialPseudo = preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $user->pseudo);
            if ($containsSpecialPseudo == true)
            {
                array_push($code,521);
            }

            $containsSpacePseudo = preg_match('/[ ]/', $user->pseudo);
            if ($containsSpacePseudo == true)
            {
                array_push($code,520);
            }

            $validEmail = filter_var($user->email, FILTER_VALIDATE_EMAIL);
            if ($validEmail == false)
            {
                array_push($code,518);
            }
            
            if ( $user->condition_utilisation == false )
            {
                array_push($code,517);
            }
            
            if (count($code) == 0)
            {
                //construction
                $user->iduuid = UUID::v4();
                //$user->insertdate = dateNowToTxtUtc();
                //$user->lastupdatedate = $user->insertdate;
                $user->idcategorystatus = 1; // INS
                $user->password = password_hash($user->password, PASSWORD_DEFAULT);
                $user->codefirst = UUID::v4();
                $user->codereset = '';
                if ($user->ascoin == null || $user->ascoin == '')
                {
                    $user->ascoin = 0;
                }
                if ($user->rating == null || $user->rating == '')
                {
                    $user->rating = 3;
                }

                //sauvegarde - insertion
                $user->save();
                if ($error == true)
                {
                    array_push($code,506);
                }
            }
        }
        return (count($code) == 0) ? array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/

    /*public function updateAdminUser($uuid,$post)
    {
        global $user;
        global $error;
        $code = array();
        $valNotification = 0;
        $valNotification += ($post['checkNoficationsEmail'] == 'true') ? pow(2, 0) : 0;
        unset($post['checkNoficationsEmail']);
        $valNotification += ($post['checkNoficationsPush'] == 'true') ? pow(2, 1) : 0;
        unset($post['checkNoficationsPush']);
        $valNotification += ($post['checkNoficationsSMS'] == 'true') ? pow(2, 2) : 0;
        unset($post['checkNoficationsSMS']);
        $valNotification += ($post['checkMessagesEmail'] == 'true') ? pow(2, 3) : 0;
        unset($post['checkMessagesEmail']);
        $valNotification += ($post['checkMessagesPush'] == 'true') ? pow(2, 4) : 0;
        unset($post['checkMessagesPush']);
        $valNotification += ($post['checkMessagesSMS'] == 'true') ? pow(2, 5) : 0;
        unset($post['checkMessagesSMS']);

        $newuser = new User($post);
        if ($newuser != null)
        {
            //verification des champs
            $code = $this->checkParams($user);
            if (sizeof($code) == 0 )
            {
                $return = $this->getUserByUuid($uuid);
                $user = $return['user'];
                if ( $return['error'] == null )
                {
                    //construction
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    $user->name = $newuser->name;
                    $user->lastname = $newuser->lastname;
                    $user->description = $newuser->description;
                    $user->telephone = $newuser->telephone;
                    $user->rating = $newuser->rating;
                    $user->skills = $newuser->skills;
                    
                    $user->notification = intval($valNotification);
                    
                    if ($newuser->password != "" && $newuser->password != null && $user->password != $newuser->password)
                    {
                        $user->password = password_hash($newuser->password, PASSWORD_DEFAULT);
                    }
                    
                    if ($newuser->pseudo != "" && $newuser->pseudo != null)
                    {
                        $user->pseudo = $newuser->pseudo;
                    }
                    
                    if ( $newuser->ascoin != null)
                    {
                        $user->ascoin = $newuser->ascoin;
                    }
                    
                    if ( $user->enterprise != $newuser->enterprise)
                    {
                        $user->enterprise = $newuser->enterprise;
                    }
                    if ( $user->functionpro != $newuser->functionpro)
                    {
                        $user->functionpro = $newuser->functionpro;
                    }
                    if ( $user->telephonepro != $newuser->telephonepro)
                    {
                        $user->telephonepro = $newuser->telephonepro;
                    }
                    if ( $user->siret != $newuser->siret)
                    {
                        $user->siret = $newuser->siret;
                    }
                    if ( $user->tvaintra != $newuser->tvaintra)
                    {
                        $user->tvaintra = $newuser->tvaintra;
                    }
                    
                    if ( $newuser->codereset != $user->codereset )
                    {
                        $user->codereset = $newuser->codereset;
                    }
                    
                    if ( $newuser->codefirst != $user->codefirst )
                    {
                        $user->codefirst = $newuser->codefirst;
                    }
                                
                    if ( $newuser->idcategoryrole != $user->idcategoryrole )
                    {
                        $user->idcategoryrole = $newuser->idcategoryrole;
                    }
                    
                    if ( $newuser->idcategorystatus != $user->idcategorystatus )
                    {
                        $user->idcategorystatus = $newuser->idcategorystatus;
                    }
                      
                    //sauvegarde - mise à jours
                    $user->save();
                    if ($error == true) array_push($code,506);
                }
                else
                {
                    array_push($code,505);
                }
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ? array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    
    /*public function updateUser($uuid,$post)
    {
        global $error;
        $code = array();
        $newuser = new User($post);
        if ($newuser != null)
        {
            //verification des champs
            $code = $this->checkParams($newuser);
            if (sizeof($code) == 0 )
            {
                $return = $this->getUserByUuid($uuid);
                
                if ( $return['error'] == null )
                {
                    $user = $return['user'];
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    $user->name = $newuser->name;
                    $user->lastname = $newuser->lastname;
                    $user->description = $newuser->description;
                    $user->telephone = $newuser->telephone;
           
                    if ($newuser->skills != null)
                    {
                        $user->skills = $newuser->skills;
                    }
                    
                    //sauvegarde - mise à jours
                    $user->save();
                    if ($error == true) array_push($code,506);
                }
                else
                {
                    array_push($code,505);
                }
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ? array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function updateProUser($uuid,$post)
    {
        global $error;
        $code = array();
        $newuser = new User($post);
        if ($newuser != null)
        {
            //verification des champs
            $code = $this->checkProParams($newuser);
            if (sizeof($code) == 0 )
            {
                $return = $this->getUserByUuid($uuid);
                if ( $return['error'] == null )
                {
                    $user = $return['user'];
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    $user->enterprise = $newuser->enterprise;
                    $user->functionpro = $newuser->functionpro;
                    $user->telephonepro = $newuser->telephonepro;
                    $user->siret = $newuser->siret;
                    $user->tvaintra = $newuser->tvaintra;
                    
                    //sauvegarde - mise à jours
                    $user->save();
                    if ($error == true) array_push($code,507);
                }
                else
                {
                    array_push($code,505);
                }
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ? array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function freeUserByUuid($params)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($params);
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($user->idcategoryrole != 3)
            {
                $user->free();
                if ($error == true) array_push($code,507);
            }
            else
            {
                array_push($code,527);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function validUser($uuid,$codefirst)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);       
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($codefirst == null || $codefirst == "" )
            {
                array_push($code,519);
            }
            else
            {                
                if ($user->codefirst == $codefirst)
                {
                    $user->codefirst = '';
                    $user->idcategorystatus = 2; // VAL
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    //sauvegarde - mise à jour
                    $user->save();
                    if ($error == true) { 
                        array_push($code,507);
                    }
                    else
                    {
                        //$controllerNotification = new NotificationController();
                        //$controllerNotification->addNotificationWelcome($user->iduuid);
                    }
                }
                else
                {
                    array_push($code,505);
                }
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function reValideUser($uuid)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);   
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            $user->idcategorystatus = 2; // VAL   
            $user->codereset = '';
            $user->codefirst = '';
            //$user->lastupdatedate = dateNowToTxtUtc();
            //sauvegarde - mise à jour
            $user->save();
            if ($error == true) array_push($code,507);   
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
        
    /*public function bannedUser($uuid)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($user->idcategoryrole != 3)
            {
                $user->idcategorystatus = 4; // BAN
                //$user->lastupdatedate = dateNowToTxtUtc();
                //sauvegarde - mise à jour
                $user->save();
                if ($error == true) array_push($code,507);
            }
            else
            {
                array_push($code,527);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function deleteUser($uuid)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($user->idcategoryrole != 3)
            {
                $user->idcategorystatus = 5; // DEL
                //$user->lastupdatedate = dateNowToTxtUtc();  
                //sauvegarde - mise à jour
                $user->save();
                if ($error == true) array_push($code,507);
            }
            else
            {
                array_push($code,527);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function changeNotificationUser($uuid,$post)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);       
        $user = $return['user'];
        $valNotification = 0;
        if ( $return['error'] == null )
        { 
            $valNotification += ($post['checkNoficationsEmail'] == 'true') ? pow(2, 0) : 0;
            $valNotification += ($post['checkNoficationsPush'] == 'true') ? pow(2, 1) : 0;
            $valNotification += ($post['checkNoficationsSMS'] == 'true') ? pow(2, 2) : 0;
            $valNotification += ($post['checkMessagesEmail'] == 'true') ? pow(2, 3) : 0;
            $valNotification += ($post['checkMessagesPush'] == 'true') ? pow(2, 4) : 0;
            $valNotification += ($post['checkMessagesSMS'] == 'true') ? pow(2, 5) : 0;
            
            $user->notification = intval($valNotification);
            //$user->lastupdatedate = dateNowToTxtUtc();
            //sauvegarde - mise à jour
            $user->save();
            if ($error == true) array_push($code,507);    
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
        
    }*/
    
    /*public function changePasswordUser($uuid,$post)
    {
        global $error;
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $code = array();
        $return = $this->getUserByUuid($uuid);       
        $user = $return['user'];
        if ( $return['error'] == null )
        {  
            if ( $post['user_newpassword'] != $post['user_repeatnewpassword'] )
            {
                array_push($code,510);
            }

            $lenghtPassword = strlen($post['user_newpassword']);
            if ($lenghtPassword < $minPasswordLenght || $lenghtPassword >= $maxPasswordLenght)
            {
                array_push($code,511);
            }

            $containsLetter  = preg_match('/[a-zA-Z]/', $post['user_newpassword']);
            if ($containsLetter == false)
            {
                array_push($code,512);
            }

            $containsDigit   = preg_match('/\d/',$post['user_newpassword']);
            if ($containsDigit == false)
            {
                array_push($code,513);
            }
            
            $containsSpace = preg_match('/[ ]/',$post['user_newpassword']);
            if ($containsSpace == true)
            {
                array_push($code,515);
            }

            $validPassword = password_verify($post['user_password'], $user->password);
            if ($validPassword == false)
            {
                array_push($code,531);
            }
            
            $validPassword = password_verify($post['user_newpassword'], $user->password);
            if ($validPassword == true)
            {
                array_push($code,509);
            }

            if (count($code) == 0)
            {
                $user->password = password_hash($post['user_newpassword'], PASSWORD_DEFAULT);
                //$user->lastupdatedate = dateNowToTxtUtc();
                //sauvegarde - mise à jour
                $user->save();
                if ($error == true) array_push($code,507);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function resetPasswordUser($uuid,$codereset,$post)
    {
        global $error;
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $code = array();
        $return = $this->getUserByUuid($uuid);       
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($codereset == null || $codereset == "" )
            {
                array_push($code,519);
            }
            else
            {                
                if ($user->codereset == $codereset)
                {
                    if ( $post['password'] != $post['repeat_password'] )
                    {
                        array_push($code,510);
                    }
                    
                    $lenghtPassword = strlen($post['password']);
                    if ($lenghtPassword < $minPasswordLenght || $lenghtPassword >= $maxPasswordLenght)
                    {
                        array_push($code,511);
                    }

                    $containsLetter  = preg_match('/[a-zA-Z]/', $post['password']);
                    if ($containsLetter == false)
                    {
                        array_push($code,512);
                    }

                    $containsDigit   = preg_match('/\d/',$post['password']);
                    if ($containsDigit == false)
                    {
                        array_push($code,513);
                    }

                    $containsSpace = preg_match('/[ ]/',$post['password']);
                    if ($containsSpace == true)
                    {
                        array_push($code,515);
                    }
                    
                    $validPassword = password_verify($post['password'], $user->password);
                    if ($validPassword == true)
                    {
                        array_push($code,509);
                    }
                    
                    if (count($code) == 0)
                    {
                        $user->password = password_hash($post['password'], PASSWORD_DEFAULT);
                        $user->codereset = '';
                        $user->idcategorystatus = 2; // VAL
                        //$user->lastupdatedate = dateNowToTxtUtc();
                        //sauvegarde - mise à jour
                        $user->save();
                        if ($error == true) array_push($code,507);
                    }
                }
                else
                {
                    array_push($code,505);
                }
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => null) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function activeResetPasswordUserByUuid($uuid)
    {
        global $error;
        $code = array();
        $return = $this->getUserByUuid($uuid);      
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($user->idcategoryrole != 3)
            {
                if ( $user->idcategorystatus == 2 || $user->idcategorystatus == 3 ) 
                {
                    $user->idcategorystatus = 3; // RES
                    $user->codereset = UUID::v4();
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    //sauvegarde - mise à jour
                    $user->save();
                    if ($error == true) array_push($code,507);
                }
                else
                {
                    if ($user->codefirst != "" && $user->idcategorystatus == 1)
                    {
                        array_push($code,501);
                    }
                    else if (($user->codefirst == null || $user->codefirst == "") && $user->idcategorystatus == 1)
                    {
                        array_push($code,524);
                    }
                    else if ( $user->idcategorystatus == 4 )
                    {
                        array_push($code,503);
                    }
                    else if ( $user->idcategorystatus == 5 )
                    {
                        array_push($code,504);
                    }
                    else
                    {
                        array_push($code,505);
                    }
                }
            }
            else
            {
                array_push($code,527);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/
    
    /*public function activeResetPasswordUserByEmail($email)
    {
        global $error;
        $code = array();
        $return = $this->getUserByEmail($email);      
        $user = $return['user'];
        if ( $return['error'] == null )
        {
            if ($user->idcategoryrole != 3)
            {
                if ( $user->idcategorystatus == 2 || $user->idcategorystatus == 3 ) 
                {
                    $user->idcategorystatus = 3; // RES
                    $user->codereset = UUID::v4();
                    //$user->lastupdatedate = dateNowToTxtUtc();
                    //sauvegarde - mise à jour
                    $user->save();
                    if ($error == true) array_push($code,507);
                }
                else
                {
                    if ($user->codefirst != "" && $user->idcategorystatus == 1)
                    {
                        array_push($code,501);
                    }
                    else if (($user->codefirst == null || $user->codefirst == "") && $user->idcategorystatus == 1)
                    {
                        array_push($code,524);
                    }
                    else if ( $user->idcategorystatus == 4 )
                    {
                        array_push($code,503);
                    }
                    else if ( $user->idcategorystatus == 5 )
                    {
                        array_push($code,504);
                    }
                    else
                    {
                        array_push($code,505);
                    }
                }
            }
            else
            {
                array_push($code,527);
            }
        }
        else
        {
            array_push($code,505);
        }
        return (count($code) == 0) ?  array('error' => null, 'user' => $user) : array('error' => $code, 'user' => null);
    }*/

    
/****************************************** */
/* fonction interne de consultation */
/****************************************** */

    private function serialize($data)
    {
        return User::serialize($data);
    }

    public function getUserByUuid($params)
    {
        global $error;
        $users = User::getUserByUuid($params);
        if ($error == false)
        {
            if ($users != null && sizeof($users) == 1)
            {
                return array('error' => null, 'user' => $users[0]);
            }
            else if ($users != null && sizeof($users) > 1)
            {
                return array('error' => array(523), 'user' => null);
            }
            else
            {
                return array('error' => array(505), 'user' => null);
            }
        }
        return array('error' => array(508), 'user' => null);
    }
    
    public function getUserByEmail($params)
    {
        global $error;
        $users = User::getUserByEmail($params);
        if ($error == false)
        {
            if ($users != null && sizeof($users) == 1)
            {
                return array('error' => null, 'user' => $users[0]);
            }
            else if ($users != null && sizeof($users) > 1)
            {
                return array('error' => array(523), 'user' => null);
            }
            else
            {
                return array('error' => array(505), 'user' => null);
            }
        }
        return array('error' => array(508), 'user' => null);
    }

    public function getUsersToArray()
    {
        global $error;
        $users = null;
        $errors = null;
        $exceptions = null;
        try {
            // ajouter un filtrage en fonction des parametres d'entree , pour cela utiliser $this->post;
            $arrayFieldValue = array("value" => array('name'=>$this->post['rc_searchName'],
                                                        'lastname'=>$this->post['rc_searchLastName'],
                                                        'idcategoryrole'=>$this->post['rc_searchRole'],
                                                        'idcategorystatus'=>$this->post['rc_searchState'],
                                                        'insertdate'=> array ( 'searchType'=>$this->post['rc_searchType'],
                                                                                'searchStartDate'=>$this->post['rc_searchStartDate'],
                                                                                'searchEndDate'=>$this->post['rc_searchEndDate'] )),
                                    "type"  =>  array('text','text','listinteger','listinteger','date'));

            $users = User::searchUsers($arrayFieldValue,$this->post['rc_searchCountMax'],'user_insertdate DESC');
            if ($error == true) $errors = array(508);
        } catch (Exception $e) {
            $errors = array(532);
            $exceptions = $e->getMessage();
        }
        
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'users' => $users , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }


/****************************************** */
/* fonction avec serialisation de la sortie */
/****************************************** */
    /**
     * @brief Permet de récuperer la liste des utilisateurs sous la forme d'une réponse http
     * @param none
     * @return array(array( 
     *       'id' => 'M000001', 
     *       'uuid' => 'fa426a14-9e4c-11ee-8c90-0242ac120002',
     *       'name' => 'Daumand',
     *       'lastname' => 'David',
     *       'insertdate' => '19-12-2023 10:43:50',
     *       'hasModify' => true,
     *       'hasBanne' => true,
     *       'hasDelete' => true))
     */
    public function getUsersToJson()
    {
        $return = $this->getUsersToArray();
        $data = array();
        $users = $return["users"];
        if ( $return["error"] == null  )
        {
            foreach ($users as $user)
            {
              array_push($data,array( 
                'number' => $user->number, 
                'uuid' => $user->iduuid,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'insertdate' => Carbon::createFromTimestamp($user->insertdate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->format('d/m/Y H:i:s'),
                'hasModify' => User::HasModifyProcess($user->idcategorystatus),
                'hasCancel' => User::HasCancelProcess($user->idcategorystatus),
                'hasBanne' => User::HasBanneProcess($user->idcategorystatus),
                'hasDelete' => User::HasDeleteProcess($user->idcategorystatus)));
            }
        }
        $response = $this->serialize($return);
        $response["body"] = $data;
        return_json_http_response(true,$response);
    }
    
    public function checkAndSessionUserToArray()
    {
        global $error;
        $user = null;
        $users = null;
        $errors = array();
        $exceptions = null;
        try {
            $loginUser = filter_var($this->post['login'], FILTER_SANITIZE_EMAIL); // email
            $passUser = $this->post['password'];
            if ($loginUser == null || $loginUser == "" 
                    || $passUser == null || $passUser == "" ) 
            {
                 array_push($errors,519);
            }
            else
            {
                $users = User::getUserByEmail($loginUser);
                if ($users != null && sizeof($users) == 1)
                {
                    $user = $users[0];
                }
                if ($user != null)
                {
                    $validPassword = password_verify($passUser, $user->password);
                    if ($validPassword == false)
                    {
                        array_push($errors,505);
                    }
                    if ($user->codefirst != "" && $user->idcategorystatus == 1)
                    {
                        array_push($errors,501);
                    }
                    if (($user->codefirst == null || $user->codefirst == "") && $user->idcategorystatus == 1)
                    {
                        array_push($errors,524);
                    }
                    if ($user->codereset != "" && $user->idcategorystatus == 3)
                    {
                        array_push($errors,502);
                    }
                    if (($user->codereset == null || $user->codereset == "") && $user->idcategorystatus == 3)
                    {
                        array_push($errors,525);
                    }
                    if ( $user->idcategorystatus == 4 )
                    {
                        array_push($errors,503);
                    }
                    if ( $user->idcategorystatus == 5 )
                    {
                        array_push($errors,504);
                    }

                    if (count($errors) == 0 || (count($errors) == 1 && in_array(502 ,$errors) )  )
                    {
                        if (count($errors) == 1 && in_array(502 ,$errors) )
                        {
                            unset($errors);
                            $user->codereset = null;
                            $user->idcategorystatus = SessionMoobotec::$autostate['Validé'];
                            $user->lastupdatedate = Carbon::now('UTC')->timestamp;
                            $user->save();
                            if ($error == true) { 
                                array_push($errors,507);
                            }
                        }
                        if (count($errors) == 0 )
                        {
                            SessionMoobotec::setConnectedUserSession($user->number);
                            SessionMoobotec::setValueUserSession('name',$user->name);
                            SessionMoobotec::setValueUserSession('lastname',$user->lastname);
                            SessionMoobotec::setValueUserSession('iduuid',$user->iduuid);
                            SessionMoobotec::setValueUserSession('email',$user->email);
                            SessionMoobotec::setValueUserSession('level',$user->idcategoryrole);
                        }
                    }
                }
                else
                {
                    if ($error == true && sizeof($users) == 1) array_push($errors,523);
                    else array_push($errors,505);
                }
            }

        } catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }

    public function isRemember()
    {
        return $this->post['remember'];
    }

    public function checkAndSessionUserToJson()
    {     
        $return = $this->checkAndSessionUserToArray();
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {
            $response["body"] = array( 
                'number' => $user->number, 
                'uuid' => $user->iduuid,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'insertdate' => Carbon::createFromTimestamp($user->insertdate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->format('d/m/Y H:i:s'),
                'hasModify' => User::HasModifyProcess($user->idcategorystatus),
                'hasCancel' => User::HasCancelProcess($user->idcategorystatus),
                'hasBanne' => User::HasBanneProcess($user->idcategorystatus),
                'hasDelete' => User::HasDeleteProcess($user->idcategorystatus));

            $response["session"] = array( 
                'matricule' => SessionMoobotec::getValueUserSession('matricule'), 
                'session_id' => SessionMoobotec::getSessionId(),
                'session_started' => SessionMoobotec::isStartedSession(),
                'deleted_time' => SessionMoobotec::getValueUserSession('deleted_time') );

            /*$liste = array(
                "C'est un plaisir de vous revoir ici !",
                "C'est agréable de vous retrouver ici !",
                "Heureux de vous retrouver parmi nous !",
                "Content de vous revoir parmi nous !",
                "Quelle joie de vous revoir parmi nous !",
                "Nous sommes ravis de vous avoir de retour !",
                "Nous sommes heureux de vous accueillir de nouveau !"
            );
            */
            $response["redirection"] = array( 
                'url' => BASEPATH,
                'type' => 'none',
                'msg' => '');
            
        }
        else {
            if ( $return["error"] != null && count($return["error"]) == 1 && 
                    in_array(501 ,$return["error"])  && $user != null )
            {
                $response["error"] = null;

                $response["redirection"] = array( 
                    'url' => BASEPATH.'check.php/'. $user->iduuid.'/'. $user->codefirst,
                    'type' => 'error',
                    'msg' => 'Vous devez finir la procédure de validation de votre compte avant de pouvoir vous connecter à cette plateforme. ');
            }
        }

        return_json_http_response(true,$response);
        
        if ( $return["error"] == null && $user != null )
        {
            SessionMoobotec::setOrClearRememberUser($this->isRemember(),$response);
        }

        return $response;
    }

    public function getUserCount()
    {
        return intval(User::getUserCount());
    }
    
    public function checkAddUserToArray()
    {
        global $error;
        $users = null;
        $user = null;
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $errors = array();
        $exceptions = null;
        try {

            $user_type = $this->post['user_type'];

            if ( $user_type == "Sportif" )
            {
                if ($this->post['user_name'] == null || $this->post['user_name']  == "" || strlen($this->post['user_name']) > 50 ||
                $this->post['user_lastname'] == null || $this->post['user_lastname'] == "" || strlen($this->post['user_lastname']) > 50 ||
                $this->post['user_email'] == null || $this->post['user_email'] == "" ||
                $this->post['user_password']  == null || $this->post['user_password'] == "" ) 
                {
                    array_push($errors,519);
                }
            }
            else if ( $user_type == "Entraineur" )
            {
                if ($this->post['user_name'] == null || $this->post['user_name']  == "" || strlen($this->post['user_name']) > 50 ||
                $this->post['user_lastname'] == null || $this->post['user_lastname'] == "" || strlen($this->post['user_lastname']) > 50 ||
                $this->post['user_email'] == null || $this->post['user_email'] == "" ||
                $this->post['user_telephone'] == null || $this->post['user_telephone'] == "" ||
                $this->post['user_password']  == null || $this->post['user_password'] == "" ) 
                {
                    array_push($errors,519);
                }
            }
            else if ( $user_type == "Association" )
            {
                if ($this->post['user_assoc_name'] == null || $this->post['user_assoc_name']  == "" || strlen($this->post['user_assoc_name']) > 100 ||
                $this->post['user_address'] == null || $this->post['user_address'] == "" || strlen($this->post['user_address']) > 255 ||
                $this->post['user_email'] == null || $this->post['user_email'] == "" ||
                $this->post['user_telephone'] == null || $this->post['user_telephone'] == "" ||
                $this->post['user_password']  == null || $this->post['user_password'] == "" ) 
                {
                    array_push($errors,519);
                }
            }
            else
            {
                array_push($errors,519);
            }
        
            if ( count($errors) == 0 )
            {
                unset($this->post['user_type']);

                $user_assoc_name = $this->post['user_assoc_name'];
                unset($this->post['user_assoc_name']);

                if ($user_type == "Association") 
                {
                    /***************************************/
                    /* Ajout du nom de l'association dans le champs name de user */
                    /***************************************/
                    $this->post["user_lastname"] = null;
                    $this->post["user_name"] = $user_assoc_name;
                    /***************************************/
                }

                /***************************************/
                /* Ajout du rôle du nouvel utilisateur */
                /***************************************/
                $this->post["user_idcategoryrole"] = SessionMoobotec::$autolevels[$user_type];
                /***************************************/

                /************************************/
                /* Creation d'un nouvel utilisateur */
                /************************************/
                $user = new User($this->post);
                /************************************/

                /***************************/
                /* Vérification de l'email */
                /***************************/
                $user->email = filter_var($user->email, FILTER_SANITIZE_EMAIL);
                if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                    //  on verifie si un autre utilisateur utilise déjà cette email
                    $users = User::getUserByEmail($user->email);
                    if ($error == true)
                    {
                        array_push($errors,506);
                    }
                    else if ($users != null && count($users) >= 1 )
                    {
                        array_push($errors,529);
                    }
                }
                else
                {
                    array_push($errors,518);
                }
                /***************************/

                /********************************/
                /* Vérification du mot de passe */
                /********************************/
                $lenghtPassword = strlen($user->password);
                if ($lenghtPassword < $minPasswordLenght)
                {
                    array_push($errors,511);
                }

                if ($lenghtPassword >= $maxPasswordLenght)
                {
                    array_push($errors,533);
                }

                $containsLetter  = preg_match('/[a-zA-Z]/', $user->password);
                if ($containsLetter == false)
                {
                    array_push($errors,512);
                }

                $containsDigit   = preg_match('/\d/',$user->password);
                if ($containsDigit == false)
                {
                    array_push($errors,513);
                }

                $containsSpecialChar = preg_match('/[^\w\s]/', $user->password);
                if ($containsSpecialChar == false) {
                    array_push($errors,514);
                }

                $containsSpace = preg_match('/[ ]/',$user->password);
                if ($containsSpace == true)
                {
                    array_push($errors,515);
                }
                /*********************************/
                
                /**************************************/
                /* Vérification du numéro de téléphone */
                /***************************************/
                if ( $user_type == "Entraineur" || $user_type == "Association") 
                {
                    $validPhone = preg_match('/^0[6-7]([\-. ]?[0-9]{2}){4}$/',  $user->telephone);
                    if ($validPhone == false ) {
                        array_push($errors,534);
                    }
                }
                else
                {
                    $user->address = null;
                    $user->telephone = null;
                }
                /*********************************/

                if ( count($errors) == 0 )
                {
                    $number = intval(User::getUserCount()) + 1;
                    $user->number = "M".str_pad($number,6,'0',STR_PAD_LEFT);
                    $user->iduuid = UUID::v4();
                    $user->idcategorystatus = SessionMoobotec::$autostate['Inscription en cours'];
                    $user->password = password_hash($user->password, PASSWORD_DEFAULT);
                    $user->codefirst = UUID::v4();
                    $user->codereset = null;
                    $user->pseudo = null;
                    $user->description = null;
                    $user->notification = null;
                    $user->skills = null;
                    $user->enterprise = null;
                    $user->fonctionpro = null;
                    $user->telephonepro = null;
                    $user->condition_utilisation = 1;
                    $user->rating = 3;
                    $user->insertdate = Carbon::now('UTC')->timestamp;
                    $user->lastupdatedate = $user->insertdate;

                    $user->save();
                    if ($error == true) array_push($errors,506);
                }
            }
        
        } catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );

    }

    public function addUserToJson()
    {     
        $return = $this->checkAddUserToArray();
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {
            $response["body"] = array( 
                'number' => $user->number, 
                'uuid' => $user->iduuid,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'insertdate' => Carbon::createFromTimestamp($user->insertdate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->format('d/m/Y H:i:s'));
        
            $controllerMail = new EmailController();

            $nameEmail = (!isset($user->lastname) && !empty($user->lastname)? $user->lastname:$user->name) ;

            $controllerMail->sendSignupByEmail($user->email,$nameEmail,$user->iduuid,$user->codefirst);

            $response["redirection"] = array( 
                    'url' => BASEPATH.'check.php/'. $user->iduuid.'/'. $user->codefirst,
                    'type' => 'success',
                    'msg' => 'Votre inscription a bien été enregisté avec succès. Vous allez recevoir un email de confirmation.');
        }

        return_json_http_response(true,$response);
    }

    public function askResetPasswordUserToArray()
    {       
        global $error;
        $errors = array();
        $exceptions = null;
        try {
            $loginUser = filter_var($this->post['login'], FILTER_SANITIZE_EMAIL); // email
            $return = $this->getUserByEmail($loginUser);
            $user = $return['user'];
            if ( $return['error'] == null && $user != null )
            {
                if ( $user->idcategorystatus == 2 || $user->idcategorystatus == 3 )
                {
                    $user->codereset = UUID::v4();
                    $user->lastupdatedate = Carbon::now('UTC')->timestamp;
                    $user->idcategorystatus = SessionMoobotec::$autostate['Modification en cours'];
                    $user->save();
                    if ($error == true) { 
                        array_push($errors,507);
                    }
                }
            }
        }catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }

    public function askResetPasswordUserToJson()
    {   
        $return = $this->askResetPasswordUserToArray();
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {  
            $controllerMail = new EmailController();
            $controllerMail->sendResetPasswordByEmail($user->email,$user->iduuid,$user->codereset);
        }

        $response["redirection"] = array( 
            'url' => BASEPATH,
            'type' => 'success',
            'msg' => 'Si l\'adresse email que vous avez renseigné correspond bien à un compte enregistré alors vous allez recevoir un email de modification de votre mot de passe.');


        return_json_http_response(true,$response);
    }

    public function askResendValidationUserToArray($uuid,$codefirst)
    {       
        global $error;
        $errors = array();
        $exceptions = null;
        try {
            $return = $this->getUserByUuid($uuid);       
            $user = $return['user'];
            if ( $return['error'] == null )
            {
                if ($codefirst == null || $codefirst == "" )
                {
                    array_push($errors,519);
                }
                else
                {                
                    if ($user->codefirst == $codefirst)
                    {
                        $user->codefirst = UUID::v4();
                        $user->lastupdatedate = Carbon::now('UTC')->timestamp;
                        $user->save();
                        if ($error == true) { 
                            array_push($errors,507);
                        }
                    }
                    else
                    {
                        array_push($errors,505);
                    }
                }
            }
            else
            {
                array_push($errors,505);
            }
        }catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }

    public function askResendValidationUserToJson($matches,$codefirst)
    {     
        $return = $this->askResendValidationUserToArray($matches,$codefirst);
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {
            $response["body"] = array( 
                'number' => $user->number, 
                'uuid' => $user->iduuid,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'insertdate' => Carbon::createFromTimestamp($user->insertdate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->format('d/m/Y H:i:s'));

            $nameEmail = (!isset($user->lastname) && !empty($user->lastname)? $user->lastname:$user->name) ;

            $controllerMail = new EmailController();
            $controllerMail->sendSignupByEmail($user->email,$nameEmail,$user->iduuid,$user->codefirst);

            $response["redirection"] = array( 
                'url' => BASEPATH.'check.php/'. $user->iduuid.'/'. $user->codefirst,
                'type' => 'success',
                'msg' => 'Veuillez vérifier votre boite email, vous avez du recevoir un nouvel email de confirmation.');
        }
        return_json_http_response(true,$response);
    }

    public function checkValidationUserToArray($uuid,$codefirst)
    {
        global $error;
        $errors = array();
        $exceptions = null;
        try {
            $return = $this->getUserByUuid($uuid);       
            $user = $return['user'];
            if ( $return['error'] == null )
            {
                if ($codefirst == null || $codefirst == "" )
                {
                    array_push($errors,519);
                }
                else
                {                
                    if ($user->codefirst == $codefirst)
                    {
                        $lastupdate = $user->lastupdatedate;
                        $now = Carbon::now('UTC')->timestamp;
                        if(  $now - $lastupdate < 300 ) 
                        {
                            if ( $this->post["code1"] == $codefirst[0] &&
                                $this->post["code2"] == $codefirst[1] &&
                                $this->post["code3"] == $codefirst[2] &&
                                $this->post["code4"] == $codefirst[3] &&
                                $this->post["code5"] == $codefirst[4] )
                            {
                                $user->codefirst = null;
                                $user->idcategorystatus = SessionMoobotec::$autostate['Validé'];
                                $user->lastupdatedate = Carbon::now('UTC')->timestamp;
                                $user->save();
                                if ($error == true) { 
                                    array_push($errors,507);
                                }

                                if (count($errors) == 0)
                                {
                                    SessionMoobotec::setConnectedUserSession($user->number);
                                    SessionMoobotec::setValueUserSession('name',$user->name);
                                    SessionMoobotec::setValueUserSession('lastname',$user->lastname);
                                    SessionMoobotec::setValueUserSession('iduuid',$user->iduuid);
                                    SessionMoobotec::setValueUserSession('email',$user->email);
                                    SessionMoobotec::setValueUserSession('level',$user->idcategoryrole);
                                }
                            }
                            else
                            {
                                array_push($errors,530);
                            }
                        }
                        else
                        {
                            array_push($errors,535);
                        }
                    }
                    else
                    {
                        array_push($errors,505);
                    }
                }
            }
            else
            {
                array_push($errors,505);
            }
        }catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }

    public function checkValidationUserToJson($matches,$codefirst)
    {     
        $return = $this->checkValidationUserToArray($matches,$codefirst);
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {
            $response["body"] = array( 
                'number' => $user->number, 
                'uuid' => $user->iduuid,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'insertdate' => Carbon::createFromTimestamp($user->insertdate, 'UTC')->locale('fr_FR')->setTimezone('Europe/Paris')->format('d/m/Y H:i:s'));

            $liste = array(
                "Grimpe sur le podium de la plateforme qui te propulse vers le succès, champion !",
                "Prépare-toi à faire un sprint vers le succès sur cette piste qui te soutient à fond !",
                "Enfile tes baskets et rejoins la course vers la plateforme qui te booste vers le sommet !",
                "Surf sur la vague de la plateforme qui te donne l'impulsion pour atteindre tes objectifs !"
            );

            $response["redirection"] = array( 
                'url' => BASEPATH,
                'type' => 'none',
                'msg' => $liste[array_rand($liste)]);
        }

        return_json_http_response(true,$response);
    }

    public function checkResetPasswordUserToArray($uuid,$codereset)
    {
        global $error;
        $minPasswordLenght = 8;
        $maxPasswordLenght = 32;
        $errors = array();
        $exceptions = null;
        try {
            $return = $this->getUserByUuid($uuid);       
            $user = $return['user'];
            if ( $return['error'] == null )
            {
                if ($codereset == null || $codereset == "" )
                {
                    array_push($errors,519);
                }
                else
                {                
                    if ($user->codereset == $codereset)
                    {
                        if ( $this->post['password'] != $this->post['repeat_password'] )
                        {
                            array_push($errors,510);
                        }
                        
                        $lenghtPassword = strlen($this->post['password']);
                        if ($lenghtPassword < $minPasswordLenght)
                        {
                            array_push($errors,511);
                        }
        
                        if ($lenghtPassword >= $maxPasswordLenght)
                        {
                            array_push($errors,533);
                        }
                       
                        $containsLetter  = preg_match('/[a-zA-Z]/', $this->post['password']);
                        if ($containsLetter == false)
                        {
                            array_push($errors,512);
                        }

                        $containsDigit = preg_match('/\d/',$this->post['password']);
                        if ($containsDigit == false)
                        {
                            array_push($errors,513);
                        }

                        $containsSpace = preg_match('/[ ]/',$this->post['password']);
                        if ($containsSpace == true)
                        {
                            array_push($errors,515);
                        }

                        $containsSpecialChar = preg_match('/[^\w\s]/', $this->post['password']);
                        if ($containsSpecialChar == false) {
                            array_push($errors,514);
                        }
                        
                        $validPassword = password_verify($this->post['password'], $user->password);
                        if ($validPassword == true)
                        {
                            array_push($errors,509);
                        }
                        
                        if (count($errors) == 0)
                        {
                            $user->password = password_hash($this->post['password'], PASSWORD_DEFAULT);
                            $user->codereset = null;
                            $user->idcategorystatus = SessionMoobotec::$autostate['Validé'];
                            $user->lastupdatedate = Carbon::now('UTC')->timestamp;
                            $user->save();
                            if ($error == true) { 
                                array_push($errors,507);
                            }
                        }
                    }
                    else
                    {
                        array_push($errors,505);
                    }
                }
            }
            else
            {
                array_push($errors,505);
            }
        }catch (Exception $e) {
            array_push($errors,532);
            $exceptions = $e->getMessage();
        }
        return array('error' => $errors, 'exceptions' => $exceptions ,
                    'user' => $user , 'uri' => $this->uri , 
                    'command' => $this->command , 
                    'post' =>  $this->postjson );
    }


    public function checkResetPasswordUserToJson($matches,$codereset)
    {
        $return = $this->checkResetPasswordUserToArray($matches,$codereset);
        $response = $this->serialize($return);
        $user = $return["user"];
        if ( $return["error"] == null && $user != null )
        {
            $response["redirection"] = array( 
                'url' => BASEPATH,
                'type' => 'success',
                'msg' => 'Le mot de passe a bien été changer avec succès.');
        }

        return_json_http_response(true,$response);
    }
}

?>