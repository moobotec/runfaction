<?php
/* =========================================================================
   =
   =  Copyright (C) RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: session.php
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
   =    * 15/02/2024 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */
namespace RunFaction;

include THEME.'/config/config.dev.inc.php';

/**
 * Simple singleton that we will extend
 */
abstract class Singleton
{

	/**
	 * Member variable holding an Singleton instance
	 *
	 * @var Singleton
	 */
	protected static $_instance = null;

	/**
	 * Returns new or existing instance of Singleton.
	 */
	final public static function getInstance()
	{
		if(null === self::$_instance) {
			self::$_instance = new static();
		}

		return self::$_instance;
	}

	/**
	 * Prevents external object creation
	 */
	final private function __construct() { }

	/**
	 * Prevents object cloning
	 */
	final private function __clone() { }
}

/**
 * Session handler.
 */
class Session extends Singleton
{
    /**
     * Starts the session.
     *
     * List of available $options with their default values:
     *
     * * cache_expire: "180"
     * * cache_limiter: "nocache"
     * * cookie_domain: ""
     * * cookie_httponly: "0"
     * * cookie_lifetime: "0"
     * * cookie_path: "/"
     * * cookie_samesite: ""
     * * cookie_secure: "0"
     * * gc_divisor: "100"
     * * gc_maxlifetime: "1440"
     * * gc_probability: "1"
     * * lazy_write: "1"
     * * name: "PHPSESSID"
     * * read_and_close: "0"
     * * referer_check: ""
     * * save_handler: "files"
     * * save_path: ""
     * * serialize_handler: "php"
     * * sid_bits_per_character: "4"
     * * sid_length: "32"
     * * trans_sid_hosts: $_SERVER['HTTP_HOST']
     * * trans_sid_tags: "a=href,area=href,frame=src,form="
     * * use_cookies: "1"
     * * use_only_cookies: "1"
     * * use_strict_mode: "0"
     * * use_trans_sid: "0"
     *
     * @see https://php.net/session.configuration
     *
     */

     public function start(array $options = []): bool
     {
         return session_start($options);
     }

    /**
     * Gets all attributes.
     */
    public function all(): array
    {
        return $_SESSION ?? [];
    }

    /**
     * Checks if an attribute exists in the session.
     */
    public function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Gets an attribute by name.
     *
     * Optionally defines a default value when the attribute does not exist.
     */
    public function get(string $name, $default = null)
    {
        return $_SESSION[$name] ?? $default;
    }

    /**
     * Sets an attribute by name.
     */
    public function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Sets several attributes at once.
     *
     * If attributes exist they are replaced, if they do not exist they are created.
     */
    public function replace(array $data): void
    {
        $_SESSION = array_merge($_SESSION, $data);
    }

    /**
     * Deletes an attribute by name and returns its value.
     *
     * Optionally defines a default value when the attribute does not exist.
     */
    public function pull(string $name, mixed $default = null): mixed
    {
        $value = $_SESSION[$name] ?? $default;
        unset($_SESSION[$name]);
        return $value;
    }

    /**
     * Deletes an attribute by name.
     */
    public function remove(string $name): void
    {
        unset($_SESSION[$name]);
    }

    /**
     * Free all session variables.
     */
    public function clear(): void
    {
        session_unset();
    }

    /**
     * Gets the session ID.
     */
    public function getId(): string
    {
        return session_id();
    }

    /**
     * Sets the session ID.
     */
    public function setId(string $sessionId): void
    {
        session_id($sessionId);
    }

    /**
     * Updates the current session id with a newly generated one.
     */
    public function regenerateId(bool $deleteOldSession = false): bool
    {
        return session_regenerate_id($deleteOldSession);
    }

    /**
     * Gets the session name.
     */
    public function getName(): string
    {
        $name = session_name();

        return $name ? $name : '';
    }

    /**
     * Sets the session name.
     */
    public function setName(string $name): void
    {
        session_name($name);
    }

    /**
     * Destroys the session.
     */
    public function destroy(): bool
    {
        return session_destroy();
    }

    /**
     * Checks if the session is started.
     */
    public function isStarted(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}

class SessionMoobotec
{
    private static $encryption_key = "aab24f2e-47fd-49d3-a364-350faaad04d5";
    private static $cookie_name = "moobotec";
    public static $levels = [0 => "None" , 1 => "Sportif", 2 => "Entraineur" , 3 => "Association" , 4 => "Admin"];
    public static $autolevels = ["None" => 0, "Sportif" => 1 , "Entraineur" => 2 , "Association" => 3 , "Admin" => 4];
    public static $autostate = ["None" => 0,"Inscription en cours" => 1, "Validé" => 2 , "Modification en cours" => 3 , "Bannie" => 4, "Supprimé" => 5, "En attente" => 6, "Annulé" => 7];

    static private function isUserConnected()
    {
        $session = Session::getInstance();
        return ($session->has("matricule") && $session->get("matricule","") != "" && $session->has("authenticated") && $session->get("authenticated",""));
    }

    static public function strictModeSession($v)
    {
        /*
        Cela force PHP à utiliser uniquement 
        les cookies pour les sessions et à ignorer les identifiants de session transmis par l'URL. 
        Cela peut aider à renforcer la sécurité des sessions en empêchant les attaques de fixation de session et d'autres vulnérabilités liées aux identifiants de session dans l'URL.
        */
        ini_set('session.use_strict_mode', $v);
    }

    static public function errorReportingSession()
    {
        global $param_environement;
        if ($param_environement == "DEV")
        {
            error_reporting(E_ALL & ~E_NOTICE);
        }
        else
        {
            error_reporting(0);
        }
    }
   
    static public function initSession()
    {
        $session = Session::getInstance();
        if(self::isRememberUser()) {
            $decrypted_value = decryptCookie($_COOKIE[self::$cookie_name], self::$encryption_key);
            $user_data_decoded = json_decode($decrypted_value, true);
            $session->setId($user_data_decoded['session']['session_id']);
            $session->start();
        }
        else
        {
            $session->start();
            // N'autorise pas l'utilisation des anciens ID de session
            if ($session->has("deleted_time") && $session->get("deleted_time",time()) < time() - 3600) // 1heure
            { 
                $session->clear();
                $session->destroy();
                $session->start();
            }
        }
    }

    static public function removeSession()
    {
        $session = Session::getInstance();
        $session->clear();
        $session->destroy();
        // le dernier paramètre est le chemin du cookie, "/" signifie tout le site
        setcookie(self::$cookie_name, "", time() - 3600); 
        // Supprimer également le cookie de la variable superglobale $_COOKIE
        unset($_COOKIE[self::$cookie_name]);
    }

    static public function setConnectedUserSession($matricule)
    {
        $session = Session::getInstance();
        if (!$session->isStarted()) {
            $session->start();
        }
        $session->set('deleted_time',time());
        $session->set('authenticated',true);
        $session->set('matricule',$matricule);
    }

    static public function setValueUserSession(string $name, $value)
    {
        $session = Session::getInstance();
        $session->set($name,$value);
    }
    
    static public function getValueUserSession(string $name,$default = null)
    {
        $session = Session::getInstance();
        return $session->get($name,$default);
    }

    static public function isRememberUser()
    {
        return isset($_COOKIE[self::$cookie_name]);
    }

    static public function setOrClearRememberUser($isRemember,$user_data_decoded)
    {
        if( $isRemember == true )
        {
            $encrypted_value = encryptCookie(json_encode($user_data_decoded), self::$encryption_key);
            setcookie(self::$cookie_name, $encrypted_value, time() + 31536000,"/");
        }
        else
        {
            setcookie(self::$cookie_name, "", time() - 3600,"/"); 
            // Supprimer également le cookie de la variable superglobale $_COOKIE
            unset($_COOKIE[self::$cookie_name]);
        }
    }

    static public function getSessionId()
    {
        $session = Session::getInstance();
        return $session->getId();
    }

    static public function isStartedSession()
    {
        $session = Session::getInstance();
        return $session->isStarted();
    }

    static public function getLevel()
    {
        $level = "None";
        if (self::isUserConnected())
        {
            $session = Session::getInstance();
            if ($session->has("level")) 
            {
                $level = self::$levels[$session->get("level")];
                $level = "Admin";
            }
        }
        else
        {
            $level = "Guest";
        }
        return $level;
    }
}

?>