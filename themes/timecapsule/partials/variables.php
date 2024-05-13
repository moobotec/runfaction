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

//const planets = {"data":[{"id":"0","fr":"…","en":"…","it":"…","sp":"…","ru":"…","gr":"…","carto":"true"},{"id":"1","fr":"Ariel","en":"Ariel","it":"Ariel","sp":"Ariel","ru":"Ариэль","gr":"Ariel","carto":"false"},{"id":"2","fr":"Callisto","en":"Callisto","it":"Callisto","sp":"Calisto","ru":"Каллисто","gr":"Callisto","carto":"false"},{"id":"3","fr":"Charon","en":"Charon","it":"Caronte","sp":"Caronte","ru":"Харон","gr":"Charon","carto":"false"},{"id":"4","fr":"Déimos","en":"Deimos","it":"Deimos","sp":"Deimos","ru":"Деймос","gr":"Deimos","carto":"false"},{"id":"5","fr":"Dioné","en":"Dione","it":"Dione","sp":"dione","ru":"Диона","gr":"Dione","carto":"false"},{"id":"6","fr":"Encelade","en":"Enceladus","it":"Encelado","sp":"Encelado","ru":"Энцелад","gr":"Enceladus","carto":"false"},{"id":"7","fr":"Eris","en":"Eris","it":"Eris","sp":"Eris","ru":"Эрис","gr":"Eris","carto":"false"},{"id":"8","fr":"Europe","en":"Europe","it":"Europa","sp":"Europa","ru":"Европа","gr":"Europa","carto":"false"},{"id":"9","fr":"Ganymède","en":"Ganymede","it":"Ganimede","sp":"Ganímedes","ru":"Ганимед","gr":"Ganymed","carto":"false"},{"id":"10","fr":"Hauméa","en":"Haumea","it":"Haumea","sp":"Haumea","ru":"Хаумеа","gr":"Hauméa","carto":"false"},{"id":"11","fr":"Hypérion","en":"Hyperion","it":"Iperione","sp":"Hiperión","ru":"Гиперион","gr":"Hyperion","carto":"false"},{"id":"12","fr":"Io","en":"Io","it":"Io","sp":"Yo","ru":"Ио","gr":"Io","carto":"false"},{"id":"13","fr":"Japet","en":"Iapetus","it":"Giapeto","sp":"Jápeto","ru":"Япет","gr":"Iapetus","carto":"false"},{"id":"14","fr":"Jupiter","en":"Jupiter","it":"Giove","sp":"Júpiter","ru":"Юпитер","gr":"Jupiter","carto":"false"},{"id":"15","fr":"Lune","en":"Moon","it":"Luna","sp":"Luna","ru":"Луна","gr":"Mond","carto":"false"},{"id":"16","fr":"Mars","en":"March","it":"Marzo","sp":"Marzo","ru":"Маршировать","gr":"Marsch","carto":"false"},{"id":"17","fr":"Mercure","en":"Mercury","it":"Mercurio","sp":"Mercurio","ru":"Меркурий","gr":"Quecksilber","carto":"false"},{"id":"18","fr":"Mimas","en":"Mimas","it":"Mima","sp":"Mimas","ru":"Мимас","gr":"Mimas","carto":"false"},{"id":"19","fr":"Miranda","en":"Miranda","it":"Miranda","sp":"Miranda","ru":"Миранда","gr":"Miranda","carto":"false"},{"id":"20","fr":"Neptune","en":"Neptune","it":"Nettuno","sp":"Neptuno","ru":"Нептун","gr":"Neptun","carto":"false"},{"id":"21","fr":"Obéron","en":"Oberon","it":"Oberon","sp":"Oberón","ru":"Оберон","gr":"Oberon","carto":"false"},{"id":"22","fr":"Phobos","en":"Phobos","it":"Phobos","sp":"Fobos","ru":"Фобос","gr":"Phobos","carto":"false"},{"id":"23","fr":"Pluton","en":"Pluto","it":"Plutone","sp":"Plutón","ru":"Плутон","gr":"Pluto","carto":"false"},{"id":"24","fr":"Rhéa","en":"Rhea","it":"Rea","sp":"ñandú","ru":"Рея","gr":"Rhea","carto":"false"},{"id":"25","fr":"Saturne","en":"Saturn","it":"Saturno","sp":"Saturno","ru":"Сатурн","gr":"Saturn","carto":"false"},{"id":"26","fr":"Soleil","en":"Sun","it":"Sole","sp":"Sol","ru":"Солнце","gr":"Sonne","carto":"false"},{"id":"27","fr":"Terre","en":"Earth","it":"Terra","sp":"Tierra","ru":"Земля","gr":"Erde","carto":"true"},{"id":"28","fr":"Téthys","en":"Tethys","it":"Teti","sp":"Tetis","ru":"Тетис","gr":"Tethys","carto":"false"},{"id":"29","fr":"Titan","en":"Titan","it":"Titano","sp":"Titán","ru":"Титан","gr":"Titan","carto":"false"},{"id":"30","fr":"Titania","en":"Titania","it":"Titania","sp":"Titania","ru":"Титания","gr":"Titania","carto":"false"},{"id":"31","fr":"Triton","en":"Triton","it":"Tritone","sp":"Tritón","ru":"Тритон","gr":"Triton","carto":"false"},{"id":"32","fr":"Umbriel","en":"Umbriel","it":"Umbriel","sp":"Umbriel","ru":"Умбриэль","gr":"Umbriel","carto":"false"},{"id":"33","fr":"Uranus","en":"Uranus","it":"Urano","sp":"Urano","ru":"Уран","gr":"Uranus","carto":"false"},{"id":"34","fr":"Venus","en":"Venus","it":"Venere","sp":"Venus","ru":"Венера","gr":"Venus","carto":"false"}]};
echo 'const planets = {"data":[{"id":"0","fr":"…","en":"…","it":"…","sp":"…","ru":"…","gr":"…","carto":"true"},{"id":"1","fr":"Ariel","en":"Ariel","it":"Ariel","sp":"Ariel","ru":"Ариэль","gr":"Ariel","carto":"false"},{"id":"2","fr":"Callisto","en":"Callisto","it":"Callisto","sp":"Calisto","ru":"Каллисто","gr":"Callisto","carto":"false"},{"id":"3","fr":"Charon","en":"Charon","it":"Caronte","sp":"Caronte","ru":"Харон","gr":"Charon","carto":"false"},{"id":"4","fr":"Déimos","en":"Deimos","it":"Deimos","sp":"Deimos","ru":"Деймос","gr":"Deimos","carto":"false"},{"id":"5","fr":"Dioné","en":"Dione","it":"Dione","sp":"dione","ru":"Диона","gr":"Dione","carto":"false"},{"id":"6","fr":"Encelade","en":"Enceladus","it":"Encelado","sp":"Encelado","ru":"Энцелад","gr":"Enceladus","carto":"false"},{"id":"7","fr":"Eris","en":"Eris","it":"Eris","sp":"Eris","ru":"Эрис","gr":"Eris","carto":"false"},{"id":"8","fr":"Europe","en":"Europe","it":"Europa","sp":"Europa","ru":"Европа","gr":"Europa","carto":"false"},{"id":"9","fr":"Ganymède","en":"Ganymede","it":"Ganimede","sp":"Ganímedes","ru":"Ганимед","gr":"Ganymed","carto":"false"},{"id":"10","fr":"Hauméa","en":"Haumea","it":"Haumea","sp":"Haumea","ru":"Хаумеа","gr":"Hauméa","carto":"false"},{"id":"11","fr":"Hypérion","en":"Hyperion","it":"Iperione","sp":"Hiperión","ru":"Гиперион","gr":"Hyperion","carto":"false"},{"id":"12","fr":"Io","en":"Io","it":"Io","sp":"Yo","ru":"Ио","gr":"Io","carto":"false"},{"id":"13","fr":"Japet","en":"Iapetus","it":"Giapeto","sp":"Jápeto","ru":"Япет","gr":"Iapetus","carto":"false"},{"id":"14","fr":"Jupiter","en":"Jupiter","it":"Giove","sp":"Júpiter","ru":"Юпитер","gr":"Jupiter","carto":"false"},{"id":"15","fr":"Lune","en":"Moon","it":"Luna","sp":"Luna","ru":"Луна","gr":"Mond","carto":"false"},{"id":"16","fr":"Mars","en":"March","it":"Marzo","sp":"Marzo","ru":"Маршировать","gr":"Marsch","carto":"false"},{"id":"17","fr":"Mercure","en":"Mercury","it":"Mercurio","sp":"Mercurio","ru":"Меркурий","gr":"Quecksilber","carto":"false"},{"id":"18","fr":"Mimas","en":"Mimas","it":"Mima","sp":"Mimas","ru":"Мимас","gr":"Mimas","carto":"false"},{"id":"19","fr":"Miranda","en":"Miranda","it":"Miranda","sp":"Miranda","ru":"Миранда","gr":"Miranda","carto":"false"},{"id":"20","fr":"Neptune","en":"Neptune","it":"Nettuno","sp":"Neptuno","ru":"Нептун","gr":"Neptun","carto":"false"},{"id":"21","fr":"Obéron","en":"Oberon","it":"Oberon","sp":"Oberón","ru":"Оберон","gr":"Oberon","carto":"false"},{"id":"22","fr":"Phobos","en":"Phobos","it":"Phobos","sp":"Fobos","ru":"Фобос","gr":"Phobos","carto":"false"},{"id":"23","fr":"Pluton","en":"Pluto","it":"Plutone","sp":"Plutón","ru":"Плутон","gr":"Pluto","carto":"false"},{"id":"24","fr":"Rhéa","en":"Rhea","it":"Rea","sp":"ñandú","ru":"Рея","gr":"Rhea","carto":"false"},{"id":"25","fr":"Saturne","en":"Saturn","it":"Saturno","sp":"Saturno","ru":"Сатурн","gr":"Saturn","carto":"false"},{"id":"26","fr":"Soleil","en":"Sun","it":"Sole","sp":"Sol","ru":"Солнце","gr":"Sonne","carto":"false"},{"id":"27","fr":"Terre","en":"Earth","it":"Terra","sp":"Tierra","ru":"Земля","gr":"Erde","carto":"true"},{"id":"28","fr":"Téthys","en":"Tethys","it":"Teti","sp":"Tetis","ru":"Тетис","gr":"Tethys","carto":"false"},{"id":"29","fr":"Titan","en":"Titan","it":"Titano","sp":"Titán","ru":"Титан","gr":"Titan","carto":"false"},{"id":"30","fr":"Titania","en":"Titania","it":"Titania","sp":"Titania","ru":"Титания","gr":"Titania","carto":"false"},{"id":"31","fr":"Triton","en":"Triton","it":"Tritone","sp":"Tritón","ru":"Тритон","gr":"Triton","carto":"false"},{"id":"32","fr":"Umbriel","en":"Umbriel","it":"Umbriel","sp":"Umbriel","ru":"Умбриэль","gr":"Umbriel","carto":"false"},{"id":"33","fr":"Uranus","en":"Uranus","it":"Urano","sp":"Urano","ru":"Уран","gr":"Uranus","carto":"false"},{"id":"34","fr":"Venus","en":"Venus","it":"Venere","sp":"Venus","ru":"Венера","gr":"Venus","carto":"false"}]};
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
