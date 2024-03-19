#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  RunFaction
#   =
#   =  FICHIER: install_base_scss.php
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

rsafile=$1
organisation=$2
repository=$3
user=$4

export GIT_SSH_COMMAND="ssh -i $rsafile"
git clone --single-branch --branch base git@github.com:$organisation/$repository.git

mv $repository base 

read -p "Appuyez sur Entrée pour continuer..." arg

cd base

apt-get remove curl -y
apt-get install curl -y


echo "***************************************************************************"
echo "        Installation de node et npm                                        "
echo "***************************************************************************"

curl -fsSL https://deb.nodesource.com/setup_21.x | sudo -E bash -

apt-get remove nodejs gcc g++ make -y
apt-get install nodejs gcc g++ make -y

node -v && npm -v

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "        Installation de toutes les dependences via package.json            "
echo "***************************************************************************"

npm install

echo "***************************************************************************"
echo "        Installation de gulp                                               "
echo "***************************************************************************"

npm install --global gulp-cli
npm install --save-dev gulp

gulp --version

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "        Déploiement                                                        "
echo "***************************************************************************"

gulp

echo "***************************************************************************"
echo "        Finalisation                                                       "
echo "***************************************************************************"

cp -R ./dist/assets/ ../assets/

chown -R $user:$user /home/$user/$repository/assets

read -p "Appuyez sur Entrée pour continuer..." arg