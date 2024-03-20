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
echo "        Installeur de l'environement de production du RunFaction        "
echo "***************************************************************************"

user=$1
repository=$2

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

sed -i "s|directoryOUT = ''|directoryOUT='/home/$user/$repository/$algo_source/OUT'|g" ../process/calcul_trajet.php
sed -i "s|directoryIN = ''|directoryIN='/home/$user/$repository/$algo_source/IN'|g" ../process/calcul_trajet.php

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                       Copie des scripts de traitement                     "
echo "***************************************************************************"

mv ../script/calcul_trajet.py ./calcul_trajet.py
mv ../script/process_algo_routing.sh ./process_algo_routing.sh

sed -i "s|cd work|cd /home/$user/$repository/$algo_source/|g" process_algo_routing.sh

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                 Creation du service de traitement des demandes            "
echo "***************************************************************************"

service_name="runfaction"  

# Vérifie si le service existe
if systemctl status "$service_name" >/dev/null 2>&1; then
    # Si le service existe, le désactive et l'arrête
    systemctl stop "$service_name"
    systemctl disable "$service_name"
    
    # Supprime le fichier de service
    rm "/etc/systemd/system/$service_name.service"
    
    # Recharge systemd
    systemctl daemon-reload
    
    echo "Le service $service_name a été désactivé et supprimé."
else
    # Si le service n'existe pas, affiche un message
    echo "Le service $service_name n'existe pas. Aucune action nécessaire."
fi


sed -i "s|WorkingDirectory=|WorkingDirectory=/home/$user/$repository/$algo_source/|g" ../script/$service_name.service
sed -i "s|ExecStart=|ExecStart=/home/$user/$repository/$algo_source/process_algo_routing.sh|g" ../script/$service_name.service

mv ../script/$service_name.service /etc/systemd/system/$service_name.service


systemctl start $service_name
systemctl status $service_name
systemctl stop $service_name
systemctl restart $service_name
systemctl status $service_name

read -p "Appuyez sur Entrée pour continuer..." arg
