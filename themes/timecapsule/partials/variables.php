<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule 
   =
   =  FICHIER: variables.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: La nouvelle application de bouteille à la mer 
   =
   =  INTERVENTION:
   =
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
use Moobotec\SessionMoobotec;

global $param_racine;
global $param_environement;
global $param_bdd;
global $param_version;

echo '<script>';

echo 'const planets = {"data":[{"id":"0","fr":"...","en":"...","it":"...","sp":"...","ru":"...","gr":"..."},{"id":"1","fr":"Ariel","en":"Ariel","it":"Ariel","sp":"Ariel","ru":"Ариэль","gr":"Ariel"},{"id":"2","fr":"Callisto","en":"Callisto","it":"Callisto","sp":"Calisto","ru":"Каллисто","gr":"Callisto"},{"id":"3","fr":"Charon","en":"Charon","it":"Caronte","sp":"Caronte","ru":"Харон","gr":"Charon"},{"id":"4","fr":"Déimos","en":"Deimos","it":"Deimos","sp":"Deimos","ru":"Деймос","gr":"Deimos"},{"id":"5","fr":"Dioné","en":"Dione","it":"Dione","sp":"dione","ru":"Диона","gr":"Dione"},{"id":"6","fr":"Encelade","en":"Enceladus","it":"Encelado","sp":"Encelado","ru":"Энцелад","gr":"Enceladus"},{"id":"7","fr":"Eris","en":"Eris","it":"Eris","sp":"Eris","ru":"Эрис","gr":"Eris"},{"id":"8","fr":"Europe","en":"Europe","it":"Europa","sp":"Europa","ru":"Европа","gr":"Europa"},{"id":"9","fr":"Ganymède","en":"Ganymede","it":"Ganimede","sp":"Ganímedes","ru":"Ганимед","gr":"Ganymed"},{"id":"10","fr":"Hauméa","en":"Haumea","it":"Haumea","sp":"Haumea","ru":"Хаумеа","gr":"Hauméa"},{"id":"11","fr":"Hypérion","en":"Hyperion","it":"Iperione","sp":"Hiperión","ru":"Гиперион","gr":"Hyperion"},{"id":"12","fr":"Io","en":"Io","it":"Io","sp":"Yo","ru":"Ио","gr":"Io"},{"id":"13","fr":"Japet","en":"Iapetus","it":"Giapeto","sp":"Jápeto","ru":"Япет","gr":"Iapetus"},{"id":"14","fr":"Jupiter","en":"Jupiter","it":"Giove","sp":"Júpiter","ru":"Юпитер","gr":"Jupiter"},{"id":"15","fr":"Lune","en":"Moon","it":"Luna","sp":"Luna","ru":"Луна","gr":"Mond"},{"id":"16","fr":"Mars","en":"March","it":"Marzo","sp":"Marzo","ru":"Маршировать","gr":"Marsch"},{"id":"17","fr":"Mercure","en":"Mercury","it":"Mercurio","sp":"Mercurio","ru":"Меркурий","gr":"Quecksilber"},{"id":"18","fr":"Mimas","en":"Mimas","it":"Mima","sp":"Mimas","ru":"Мимас","gr":"Mimas"},{"id":"19","fr":"Miranda","en":"Miranda","it":"Miranda","sp":"Miranda","ru":"Миранда","gr":"Miranda"},{"id":"20","fr":"Neptune","en":"Neptune","it":"Nettuno","sp":"Neptuno","ru":"Нептун","gr":"Neptun"},{"id":"21","fr":"Obéron","en":"Oberon","it":"Oberon","sp":"Oberón","ru":"Оберон","gr":"Oberon"},{"id":"22","fr":"Phobos","en":"Phobos","it":"Phobos","sp":"Fobos","ru":"Фобос","gr":"Phobos"},{"id":"23","fr":"Pluton","en":"Pluto","it":"Plutone","sp":"Plutón","ru":"Плутон","gr":"Pluto"},{"id":"24","fr":"Rhéa","en":"Rhea","it":"Rea","sp":"ñandú","ru":"Рея","gr":"Rhea"},{"id":"25","fr":"Saturne","en":"Saturn","it":"Saturno","sp":"Saturno","ru":"Сатурн","gr":"Saturn"},{"id":"26","fr":"Soleil","en":"Sun","it":"Sole","sp":"Sol","ru":"Солнце","gr":"Sonne"},{"id":"27","fr":"Terre","en":"Earth","it":"Terra","sp":"Tierra","ru":"Земля","gr":"Erde"},{"id":"28","fr":"Téthys","en":"Tethys","it":"Teti","sp":"Tetis","ru":"Тетис","gr":"Tethys"},{"id":"29","fr":"Titan","en":"Titan","it":"Titano","sp":"Titán","ru":"Титан","gr":"Titan"},{"id":"30","fr":"Titania","en":"Titania","it":"Titania","sp":"Titania","ru":"Титания","gr":"Titania"},{"id":"31","fr":"Triton","en":"Triton","it":"Tritone","sp":"Tritón","ru":"Тритон","gr":"Triton"},{"id":"32","fr":"Umbriel","en":"Umbriel","it":"Umbriel","sp":"Umbriel","ru":"Умбриэль","gr":"Umbriel"},{"id":"33","fr":"Uranus","en":"Uranus","it":"Urano","sp":"Urano","ru":"Уран","gr":"Uranus"},{"id":"34","fr":"Venus","en":"Venus","it":"Venere","sp":"Venus","ru":"Венера","gr":"Venus"}]};
const galaxys = {"data":[{"id":"0","fr":"...","en":"...","it":"...","sp":"...","ru":"...","gr":"..."},{"id":"1","fr":"Voie lactée","en":"Milky Way","it":"Via Lattea","sp":"Vía Láctea","ru":"Млечный Путь","gr":"Milchstraße"}]};
const galaxyPlanets = {"data":[["0","0"],["1","1"],["1","2"],["1","3"],["1","4"],["1","5"],["1","6"],["1","7"],["1","8"],["1","9"],["1","10"],["1","11"],["1","12"],["1","13"],["1","14"],["1","15"],["1","16"],["1","17"],["1","18"],["1","19"],["1","20"],["1","21"],["1","22"],["1","23"],["1","24"],["1","25"],["1","26"],["1","27"],["1","28"],["1","29"],["1","30"],["1","31"],["1","32"],["1","33"],["1","34"]]};
';

echo 'const CPUD  = {"data":[{"sign":"+","fr":"Nord","en":"North","it":"Nord","sp":"Norte","ru":"Cевер","gr":"Norden"},{"sign":"-","fr":"Sud","en":"South","it":"Sud","sp":"Sur","ru":"Юг","gr":"Süd"}]};
const CPLR  = {"data":[{"sign":"+","fr":"Est","en":"East ","it":"Est ","sp":"Este ","ru":"Восток ","gr":"Ost "},{"sign":"-","fr":"Ouest","en":"West","it":"Ovest","sp":"Oeste","ru":"Запад","gr":"Westen"}]};
';
echo 'var pathnameMoobotec = "'.$param_racine.'";';
echo 'var environnementMoobotec = "'.$param_environement.'";';
echo 'var baseMoobotec = "'.$param_bdd.'";';
echo 'var versionMoobotec = "'.$param_version.'";';
echo 'var countDownEcart = 300000;';
echo 'var session_id = "'.SessionMoobotec::getSessionId().'";';
echo 'var deleted_time = "'.SessionMoobotec::getValueUserSession('deleted_time').'";';
echo 'var is_cookie = "'.SessionMoobotec::isRememberUser().'";';
echo 'var ip_public = "'.get_public_ip_func().'";';
echo 'var ip_local = "'.get_ip_func().'";';
echo 'var error_reporting = "'.error_reporting().'";';
echo 'var error_reporting = "'.error_reporting().'";';

$infoNavigateur = get_position();
$latitude = ( $infoNavigateur['geoplugin_latitude'] != null ) ? $infoNavigateur['geoplugin_latitude'] : null;
$longitude = ( $infoNavigateur['geoplugin_longitude'] != null ) ? $infoNavigateur['geoplugin_longitude'] : null;

echo 'var navigatorPosition = { "valid": true , "latitude": '.$latitude.', "longitude": '.$longitude.', "country": null, "id" : null,"galaxy": "1","planet": "27"  }';

echo '</script>';
?>
