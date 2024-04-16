#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  installeur générique
#   =
#   =  FICHIER: update_site_env.php
#   =
#   =  VERSION: 1.0.0
#   =
#   =  SYSTEME: Linux
#   =
#   =  LANGAGE: PHP,Python,JS,HTML,SCSS
#   =
#   =  BUT: Script d'installation des sites
#   =
#   =  INTERVENTION:
#   =
#   =    * 19/03/2024 : David DAUMAND
#   =        Creation du module.
#   =
# * ========================================================================= */
#/** @file  */
echo "***************************************************************************"
echo "  *****  "
echo " *     * "
echo " *  0  * "
echo " * \\_/ * "
echo " *     * "
echo "  *****  "
echo "***************************************************************************"
echo "        Installeur de l'environement de production du projet        "
echo "***************************************************************************"
pass=0
echo "Est-ce que vous savez ce que vous faites - Yes/No"
read response
if [ $response = "Yes" ]; then
echo "Ok vous êtes l'administrateur de Moobotec , c'est bon"
user=$(whoami)
if [ $user = "root" ]; then
pass=1
else
echo "Veuillez utiliser les droits root pour continuer l'installation"
fi

rsafile=$1
if [ -f "$rsafile" ]; then
echo "Vous avez spécifié une clé privée pour le clonage git ;-)"
else
echo "Veuillez spécifier une clé privée avant d'aller plus loin" 
pass=0
fi

else
echo "C'est plus sur si vous n'y connaissez rien"
fi

read -p "Appuyez sur Entrée pour continuer..." arg

if [ $pass -eq 1 ];
then

echo "***************************************************************************"
echo "               Spécifier le nom de l'organisation sur github               "
echo "***************************************************************************"

echo "Veuillez entrer le nom de l'organisation sur github : (moobotec)" 
read organisation

if [ -z "$organisation" ]; then
organisation="moobotec"
fi

echo "***************************************************************************"
echo "                  Spécifier le nom du repository du projet                 "
echo "***************************************************************************"

echo "Veuillez entrer le nom du repository sur github : (runfaction)"
read repository

if [ -z "$repository" ]; then
repository="runfaction"
fi

echo "***************************************************************************"
echo "                   Information complementaire                               "
echo "***************************************************************************"

echo "Qui est l'utilisateur principal ? (daumand)"
read user

if [ -z "$user" ]; then
user="daumand"
fi

ip=$(ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | awk '{print $2}' | head -n1)
echo $ip

echo "Veuillez préciser l'IP ou le domaine ($ip)"
read domaine

if [ -z "$domaine" ]; then
domaine=$ip
fi

default=80
echo "Veuillez entrer le port  : ($default)"
read port

if [ -z "$port" ]; then
port=$default
fi

default="http"
echo "Veuillez entrer le protocole  : ($default)"
read protocole

if [ -z "$protocole" ]; then
protocole=$default
fi

default="runfaction"
echo "Veuillez entrer le theme du projet : ($default)"
read theme

if [ -z "$theme" ]; then
theme=$default
fi

rm -rf ./$repository

export GIT_SSH_COMMAND="ssh -i $rsafile"
git clone --single-branch --branch develop git@github.com:$organisation/$repository.git

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "        Creation du fichier de config                                      "
echo "***************************************************************************"

sed -i "s|param_server_principal_domaine = ''|param_server_principal_domaine='$domaine'|g" ./common/$theme/config/config.dev.inc.php
sed -i "s|param_server_principal_ip = ''|param_server_principal_ip='$domaine'|g" ./common/$theme/config/config.dev.inc.php
sed -i "s|param_server_principal_port = 0|param_server_principal_port = $port|g" ./common/$theme/config/config.dev.inc.php
sed -i "s|param_protocole = ''|param_protocole='$protocole'|g" ./common/$theme/config/config.dev.inc.php
sed -i "s|param_root = ''|param_root='/home/$user/$repository'|g" ./common/$theme/config/config.dev.inc.php

sed -i "s|define('THEME','')|define('THEME','$theme')|g" index.php

echo "***************************************************************************"
echo "        Changement des droit sur la base de données                        "
echo "***************************************************************************"

chmod -R 777 ./$repository/bdd

echo "***************************************************************************"
echo "        Déploiement base assets                                            "
echo "***************************************************************************"

cp -R ./base/dist/assets/* /home/$user/$repository/themes/$theme/assets

chown -R $user:$user /home/$user/$repository/themes/$theme/assets

mkdir /home/$user/$repository/admin

chown -R $user:$user /home/$user/$repository/admin

cd /home/$user/$repository/admin

ln -s /home/$user/$repository/themes themes

echo "***************************************************************************"
echo "                   On donne les droit d'execution et autres                "
echo "***************************************************************************"

chmod -R +x ./$repository
chmod 777 /home/$user/$repository

chown -R $user:$user /home/$user/$repository

read -p "Appuyez sur Entrée pour continuer..." arg


echo "***************************************************************************"
echo "                                  Nettoyage                                "
echo "***************************************************************************"

rm -rf ./$repository/script

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                            Mise à jour complete                          "
echo "***************************************************************************"
fi

echo "Fin de l'installeur"