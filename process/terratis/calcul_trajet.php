<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Terratis
   =
   =  FICHIER: calcul_trajet.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: Plannificateur de lacher de moustique stérilisé
   =
   =  INTERVENTION:
   =
   =    * 04/03/2024 : David DAUMAND
   =        Creation du module.
   =
 * ========================================================================= */
/** @file  */

// Récupérer les données de latitude et de longitude du formulaire
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$polygon = $_POST['polygoneArea'];
$distance = $_POST['distance_tis'];

$directoryOUT = '';
$directoryIN = '';
$filenameIN = 'param_input.json';
$filenameOUT = 'output.json';

$IN_FILE_ARRAY = json_decode($polygon, true);
$IN_FILE_ARRAY['latitude'] = $latitude;
$IN_FILE_ARRAY['longitude'] = $longitude;
$IN_FILE_ARRAY['distance'] = $distance;

$jsonString = json_encode($IN_FILE_ARRAY);

if (file_exists($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT)) {
    unlink($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT);
}

file_put_contents($directoryIN . DIRECTORY_SEPARATOR . $filenameIN, $jsonString);

chmod($directoryIN . DIRECTORY_SEPARATOR . $filenameIN, 0777);

// Durée maximale d'attente en secondes
$maxWaitTime = 5*60; // 1 minute

// Heure de début de l'attente
$startTime = time();

// Boucle d'attente
while (!file_exists($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT)) {
    // Vérifie si le temps d'attente maximal est dépassé
    if (time() - $startTime > $maxWaitTime) {
        echo "Timeout : Le fichier n'a pas été trouvé dans le délai imparti.";
        break;
    }
    // Attente de 1 seconde avant de vérifier à nouveau
    sleep(1);
}

// Si le fichier est trouvé
if (file_exists($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT)) {

     // remove any string that could create an invalid JSON
    // such as PHP Notice, Warning, logs...
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Définir l'en-tête Content-Type pour indiquer que c'est un fichier GPX
    header('Content-Type: application/json');

    // Indiquer le nom du fichier pour téléchargement (optionnel)
    header('Content-Disposition: attachment; filename="output.json"');

    http_response_code(200);

    // Lire le contenu du fichier et l'envoyer en sortie
    readfile($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT);
    
    unlink($directoryOUT . DIRECTORY_SEPARATOR . $filenameOUT);
    
} else {
    http_response_code(404);
    echo "Fichier non trouvé.";
}

?>