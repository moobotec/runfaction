<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 RunFaction
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: meta.php
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
   =    * 21/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

global $param_protocole;
global $param_server_principal_domaine;
global $param_title;
global $param_racine;
global $param_description;
global $param_keyword;
global $param_cache;
global $param_revisit;
global $param_copyright;
global $param_indexation;
global $param_auteur;
global $param_lang;

echo'<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="identifier-url" content="'.$param_protocole.'://'.$param_server_principal_domaine.$param_racine.'" />
<meta name="title" content="'.$param_title.'" />
<meta name="description" content="'.$param_description.'" />
<meta name="abstract" content="'.$param_description.'" />
<meta name="keywords" content="'.$param_keyword.'" />
<meta name="author" content="'.$param_auteur.'" />
<meta name="generator" content="Moobotec" />
<meta name="publisher" content="Moobotec" />
';

if ($param_cache == true)
{
    echo '<meta http-equiv="pragma" content="no-cache" />
    ';
}

echo '<meta name="revisit-after" content="'.$param_revisit.'" />
<meta name="language" content="'.strtoupper($param_lang).'" />
<meta name="copyright" content="'.$param_copyright.'" />
<meta name="robots" content="'.$param_indexation.'" />
';

echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
';

?>