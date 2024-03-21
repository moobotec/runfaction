<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: common.php
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
   =    * 18/12/2023 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

$db = null;
$dom = null;
$error = false;
$sizeBdd = 0;
$globaluser = null;

include 'config/config.dev.inc.php';

require 'thirdparty/phpmailer/src/PHPMailer.php';
require 'thirdparty/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class BaseClass {
    protected ?string $uri;
    protected ?array $post;
    protected ?string $command;
    protected ?string $postjson;

    function filter_string_polyfill(string $string): string
    {
        $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
        return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
    }

    function __construct(?string $y = null) {
        $this->post = $_POST;
        $this->command = $y;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->postjson = null;
        if($_SERVER['REQUEST_METHOD'] ==='POST' && empty($this->post)) {
            $this->post = json_decode(file_get_contents('php://input'),true); 
            $this->postjson = json_encode($this->post ?? parse_str(file_get_contents("php://input"),$this->postjson) ?? []);
        }
        foreach ($this->post as $key => $value) {
            if (is_scalar($value) || is_string($value)) {
                $this->post[$key] = filter_var($value, FILTER_CALLBACK, array('options' => array($this, 'filter_string_polyfill')));
            }
        }
    }
}

class UUID {
public static function v4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

      // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
}

class PASSWORD {
public static function generatePassword($_len) {

    $password = '';         
    
    $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';           
    $_alphaCaps  = strtoupper($_alphaSmall);                
    $_numerics   = '1234567890';                            
    
    //au moins une majuscule
    $_container = $_alphaCaps;   
    for($i = 0; $i < 1 ; $i++) {                                    
        $_rand = rand(0, strlen($_container) - 1);                  
        $password .= substr($_container, $_rand, 1);                
    }
    
    //au moins un chiffre
    $_container = $_numerics;   
    for($i = 0; $i < 1 ; $i++) {                                    
        $_rand = rand(0, strlen($_container) - 1);                 
        $password .= substr($_container, $_rand, 1);                
    }
    
    //le reste au hazard
    $_container = $_alphaSmall.$_alphaCaps.$_numerics;   
    for($i = 0; $i < $_len - 2; $i++) {                                 
        $_rand = rand(0, strlen($_container) - 1);                  
        $password .= substr($_container, $_rand, 1);                
    }

    return $password;       
}
}

function get_called_func() {
  // a funciton x has called a function y which called this
  // see stackoverflow.com/questions/190421
  $caller = debug_backtrace();
  $caller = $caller[2];
  $r = $caller['function'] . '()';
  if (isset($caller['class'])) {
    $r .= ' in ' . $caller['class'];
  }
  if (isset($caller['object'])) {
    $r .= ' (' . get_class($caller['object']) . ')';
  }
  return $r;
}

function get_ip_func() 
{   
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress .= $_SERVER['HTTP_CLIENT_IP'] . ' - ';
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress .= $_SERVER['HTTP_X_FORWARDED_FOR']. ' - ';
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress .= $_SERVER['HTTP_X_FORWARDED']. ' - ';
    }
    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress .= $_SERVER['HTTP_FORWARDED_FOR']. ' - ';
    }
    else if(isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress .= $_SERVER['HTTP_FORWARDED']. ' - ';
    }
    else if(isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress .= $_SERVER['REMOTE_ADDR']. ' - ';
    }

    if($ipaddress == '') {
        $ipaddress = 'UNKNOWN - ';
    }
    
    return substr( $ipaddress, 0, -3);
}

function validate_ip($ip) {
	if (strtolower($ip) === 'unknown')
		return false;

	// generate ipv4 network address
	$ip = ip2long($ip);

	// if the ip is set and not equivalent to 255.255.255.255
	if ($ip !== false && $ip !== -1) {
		// make sure to get unsigned long representation of ip
		// due to discrepancies between 32 and 64 bit OSes and
		// signed numbers (ints default to signed in PHP)
		$ip = sprintf('%u', $ip);
		// do private network range checking
		if ($ip >= 0 && $ip <= 50331647) return false;
		if ($ip >= 167772160 && $ip <= 184549375) return false;
		if ($ip >= 2130706432 && $ip <= 2147483647) return false;
		if ($ip >= 2851995648 && $ip <= 2852061183) return false;
		if ($ip >= 2886729728 && $ip <= 2887778303) return false;
		if ($ip >= 3221225984 && $ip <= 3221226239) return false;
		if ($ip >= 3232235520 && $ip <= 3232301055) return false;
		if ($ip >= 4294967040) return false;
	}
	return true;
}

function get_public_ip_func()
{
    //$ip = gethostbyname('ipecho.net');
    //if ($ip != "")
    //{
    //return file_get_contents("http://ipecho.net/plain");
    //}
    return "xxx.xxx.x.xxx";
}

function get_public_ip_func_2()
{
    $str = file_get_contents("http://ip6.me/");
    $pattern = "#\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b#";
    preg_match($pattern, $str, $matches);
    return $matches[0];
}

function fixed_time_zone_from_ip_address()
{
    global $param_environement;
    
    $clientsIpAddress = get_ip_func();
    $local_ip = !validate_ip($clientsIpAddress);
    if ( $local_ip == true )
    {
        $publicIP = get_public_ip_func();
        if ( validate_ip($publicIP) == true ) $clientsIpAddress = $publicIP;
    }
    
    $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress));
    
    $clientsLatitude = $clientInformation['geoplugin_latitude'];
    $clientsLongitude = $clientInformation['geoplugin_longitude'];
    $clientsCountryCode = $clientInformation['geoplugin_countryCode'];

    $timezone = get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode) ;
    if ($local_ip == true && $param_environement == 'dev')
    {
        echo 'Local dev => Your IP is '.get_ip_func().' - IP Public is '.get_public_ip_func().' - Time Zone is '.$timezone.'<br><br>';
    }
    return $timezone;
}

function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
    $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code)
        : DateTimeZone::listIdentifiers();

    if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

        $time_zone = '';
        $tz_distance = 0;

        //only one identifier?
        if (count($timezone_ids) == 1) {
            $time_zone = $timezone_ids[0];
        } else {

            foreach($timezone_ids as $timezone_id) {
                $timezone = new DateTimeZone($timezone_id);
                $location = $timezone->getLocation();
                $tz_lat   = $location['latitude'];
                $tz_long  = $location['longitude'];

                $theta    = $cur_long - $tz_long;
                $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat)))
                    + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                $distance = acos($distance);
                $distance = abs(rad2deg($distance));
                 echo '<br />'.$timezone_id.' '.$distance;

                if (!$time_zone || $tz_distance > $distance) {
                    $time_zone   = $timezone_id;
                    $tz_distance = $distance;
                }

            }
        }
        return  $time_zone;
    }
    return 'unknown';
}

function stripAccents($stripAccents){
  return strtr($stripAccents,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function get_symbol_by_quantity($bytes) {
    $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
    if( $bytes > 0)
    {
        $exp = floor(log($bytes)/log(1024));
        $ret = sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
    }
    else
    {
        $ret = '0.0 B';
    }
    return $ret;
}

function is_ajax_request() 
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function f_move_file($src,$dst)
{
    $ret = "Ok";
    if (rename($src, $dst) == false)
    {
        openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
        syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Sorry, there was an error saved your file.');
        $ret = null;
    } 
    return $ret;
}

function move_file($dir,$target_name)
{
    global $param_root;
    $sourceFile = $param_root.'upload/tmp/'.$target_name;
    $typeFile = strtolower(pathinfo($sourceFile, PATHINFO_EXTENSION));
    $save_folder = $param_root.$dir;
    if (!file_exists($save_folder)) {
       mkdir($save_folder, 0777);
    }
    $uuid = UUID::v4();
    $urlFile = $dir.$uuid.'.'.$typeFile;
    $destinationFile = $param_root.$urlFile;
    
    if ( f_move_file($sourceFile,$destinationFile) == null ) $urlFile = null;
    
    return $urlFile;
}

function delete_file($path)
{
    global $error;
    if (!unlink($path)) 
    {
        openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
        syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Sorry, there was an error saved your file.');
        $error = true;
    }
}

function send_mail($to,$from,$subject,$mailContent)
{
    global $param_server_client_name;
    global $param_server_client_password;
    global $param_server_mail;
    global $param_server_port;
    global $error;
    
    $mail = new PHPMailer();                    //utilisation de la classe phpMailer
    $mail->IsSMTP();
    $mail->Host = strval($param_server_mail);    //Adresse IP ou DNS du serveur SMTP
    $mail->Port = $param_server_port;              //Port TCP du serveur SMTP
    $mail->SMTPAuth = 1;                        //Utiliser l'identification

    if($mail->SMTPAuth){
        $mail->SMTPSecure = 'tls';              //Protocole de sécurisation des échanges avec le SMTP
        $mail->Username   =  $param_server_client_name;    //Adresse email à utiliser
        $mail->Password   =  $param_server_client_password;       //Mot de passe de l'adresse email à utiliser
    }

    $mail->setFrom($param_server_client_name,$from);       //adresse avec laquelle on envoi
    $mail->AddAddress($to) ;            // adresse de destination    
    $mail->isHTML(true);
    $mail->Subject = $subject;          //création du titre du mail
    $mail->Body = $mailContent;         //création du corps du Mail
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';


    if (!$mail->send()) 
    {
        openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
        syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Sorry, there was an error sending email. ->[' .$to. ']');
        $error = true;
    }
}

function return_json_http_response($success, $data)
{
    global $param_environement;
    // remove any string that could create an invalid JSON
    // such as PHP Notice, Warning, logs...
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Set the content type to JSON and charset
    // (charset can be set to something else)
    header("Content-type: application/json; charset=utf-8");

    // Set your HTTP response code, 2xx = SUCCESS,
    // anything else will be error, refer to HTTP documentation
    if ($success == true) {
        http_response_code(200); //Ok Request
    } else {
        http_response_code(400); //Bad Request
    }

    if ($param_environement != "DEV")
    {
        $data["body"] = null;
        $data["session"] = null;
        $data["uri"] = null;
        $data["command"] = null;
        $data["post"] = null;
    }
    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    echo json_encode($data);
}

function return_file_http_response($name, $data)
{
    global $param_root;
    if ($data['error'] == null)
    {
        $date = date('Y_m_d_H_i_s');
        $path = $param_root.'/upload/tmp/'.$name.'_'.$date.'.csv';
        if ($file = fopen($path, 'w+'))
        {
            fwrite($file, $data['datafile']);
            fclose($file);

            $nameFile = basename($path);            
            $extFile = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            output_file($path, $nameFile, $extFile);
            
            delete_file($path);
        }
        else
        {
            openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
            syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Impossible de créer le fichier '.$path.' ');
        }
    }
}

function download_file_http_response($pathFile,$nameFile = '')
{
    global $param_root;
    $path = $param_root.'/'.$pathFile;
    if ($nameFile == '') $nameFile = basename($path);
    $extFile = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    output_file($path, $nameFile, $extFile);
}

function output_file($file, $name, $mime_type='')
{
    if(!is_readable($file)) 
	{
        openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
        syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Impossible de lire le fichier '.$file.' [readable] ');
		exit();
	}
    $size = filesize($file);
    $name = rawurldecode($name);
    $known_mime_types=array(
		"html" => "text/html",
        "htm" => "text/html",
        "csv" => "text/csv",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "jpg" => "image/jpg",
        "php" => "text/plain",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "pdf" => "application/pdf",
        "txt" => "text/plain",
        "html"=> "text/html",
        "png" => "image/png",
        "jpeg" => "image/jpg",
        "ogg" => "audio/ogg",
        "mov" => "video/avi",
        "cs" => "text/plain",
    );

    if($mime_type==''){
        $file_extension = strtolower(substr(strrchr($file,"."),1));
        if(array_key_exists($file_extension, $known_mime_types)){
            $mime_type=$known_mime_types[$file_extension];
        } else {
            $mime_type="application/force-download";
        };
    };
    @ob_end_clean();
    if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');
    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="'.$name.'"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');

    if(isset($_SERVER['HTTP_RANGE']))
    {
        list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
        list($range) = explode(",",$range,2);
        list($range, $range_end) = explode("-", $range);
        $range=intval($range);
        if(!$range_end) {
            $range_end=$size-1;
        } else {
            $range_end=intval($range_end);
        }

        $new_length = $range_end-$range+1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length=$size;
        header("Content-Length: ".$size);
    }

    $chunksize = 1*(1024*1024);
    $bytes_send = 0;
    if ($file = fopen($file, 'r'))
    {
        if(isset($_SERVER['HTTP_RANGE']))
        fseek($file, $range);

        while(!feof($file) &&
            (!connection_aborted()) &&
            ($bytes_send<$new_length)
        )
        {
            $buffer = fread($file, $chunksize);
            echo($buffer);
            flush();
            $bytes_send += strlen($buffer);
        }
        fclose($file);
    } 
    else
    {
        openlog(uniqid(), LOG_ODELAY, LOG_LOCAL0);
        syslog(LOG_DEBUG, '[ERROR]['.get_called_func().'] Sorry, can not open file '.$file.' ');
    } 
}

function list_all_files($dir) {
  $array = array_diff(scandir($dir), array('.', '..'));
 
  foreach ($array as &$item) {
    $item = $dir . $item;
  }
  unset($item);
  foreach ($array as $item) {
    if (is_dir($item)) {
     $array = array_merge($array, list_all_files($item . DIRECTORY_SEPARATOR));
    }
  }
  return $array;
}

function htmlToPlainText($str){
    $str = str_replace('&nbsp;', ' ', $str);
    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    $str = html_entity_decode($str);
    $str = htmlspecialchars_decode($str);
    $str = strip_tags($str);

    return $str;
}

function text_truncated($text,$lenghtMax)
{
    if (strlen($text) > $lenghtMax)
    {
        return substr_replace($text, "...", $lenghtMax);
    }
    return $text;
}

function encryptCookie($value, $key) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($value, $cipher, $key, $options=0, $iv);
    return base64_encode($iv . $ciphertext);
}

function decryptCookie($value, $key) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $ciphertext_dec = base64_decode($value);
    $iv = substr($ciphertext_dec, 0, $ivlen);
    $ciphertext = substr($ciphertext_dec, $ivlen);
    return openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
}

?>