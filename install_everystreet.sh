#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  RunFaction
#   =
#   =  FICHIER: install_everystreet.php
#   =
#   =  VERSION: 1.0.0
#   =
#   =  SYSTEME: Linux
#   =
#   =  LANGAGE: PHP,Python,JS,HTML,SCSS
#   =
#   =  BUT: Backend/Frontend de gestion des clubs de sport
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
echo "        Installeur de l'environement de production du projet $theme        "
echo "***************************************************************************"

user=$1
repository=$2
theme=$3

echo "***************************************************************************"
echo "                     Installation des dépendances à python                 "
echo "***************************************************************************"

apt-get remove python3-pip -y
apt-get install python3-pip -y

algo_source="everystreet"

git clone http://github.com/matejker/$algo_source.git

chmod 777 ./$algo_source
chmod -R +x ./$algo_source
chown -R $user:$user ./$algo_source

cd ./$algo_source

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                 Création des répertoire d'entree et de sortie             "
echo "***************************************************************************"

mkdir ./IN
mkdir ./OUT

chmod 777 IN
chmod 777 OUT

git clone http://github.com/matejker/network.git

chmod 777 ../$algo_source
chmod -R +x ../$algo_source
chown -R $user:$user ../$algo_source

pip install osmnx
pip install networkx>=2.4
pip install matplotlib>=3.2.1
pip install numpy>=1.18.5
pip install notebook
pip install geopy

pip install -e ./network/

sed -i "s|directoryOUT = ''|directoryOUT='/home/$user/$repository/$algo_source/OUT'|g" ../$repository/process/$theme/calcul_trajet.php
sed -i "s|directoryIN = ''|directoryIN='/home/$user/$repository/$algo_source/IN'|g" ../$repository/process/$theme/calcul_trajet.php

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                       Copie des scripts de traitement                     "
echo "***************************************************************************"

mv ../$repository/script/$theme/calcul_trajet.py ./calcul_trajet.py
mv ../$repository/script/$theme/process_algo_routing.sh ./process_algo_routing.sh

sed -i "s|cd work|cd /home/$user/$repository/$algo_source/|g" process_algo_routing.sh

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                 Creation du service de traitement des demandes            "
echo "***************************************************************************"

# Vérifie si le service existe
if systemctl status "$theme" >/dev/null 2>&1; then
    # Si le service existe, le désactive et l'arrête
    systemctl stop "$theme"
    systemctl disable "$theme"
    
    # Supprime le fichier de service
    rm "/etc/systemd/system/$theme.service"
    
    echo "Le service $theme a été désactivé et supprimé."
else

    # Supprime le fichier de service
    rm "/etc/systemd/system/$theme.service"

    # Si le service n'existe pas, affiche un message
    echo "Le service $theme n'existe pas ou plus. Aucune action nécessaire."
fi

# Recharge systemd
systemctl daemon-reload

sed -i "s|WorkingDirectory=|WorkingDirectory=/home/$user/$algo_source/|g" ../$repository/script/$theme/$theme.service
sed -i "s|ExecStart=|ExecStart=/home/$user/$algo_source/process_algo_routing.sh|g" ../$repository/script/$theme/$theme.service

mv ../$repository/script/$theme/$theme.service /etc/systemd/system/$theme.service

systemctl start $theme
systemctl status $theme
systemctl stop $theme

systemctl restart $theme
systemctl status $theme

read -p "Appuyez sur Entrée pour continuer..." arg
