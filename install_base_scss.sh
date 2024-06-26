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
echo "        Installeur de l'environement de production du projet        "
echo "***************************************************************************"

rsafile=$1
organisation=$2
repository=$3
user=$4
theme=$5

rm -rf base

export GIT_SSH_COMMAND="ssh -i $rsafile"
git clone --single-branch --branch base git@github.com:$organisation/$repository.git base

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
echo "        Installation de toutes les dependances via package.json            "
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

cp -R ./dist/assets/* /home/$user/$repository/themes/$theme/assets

chown -R $user:$user /home/$user/$repository/themes/$theme/assets

sed -i "s|var theme=\"\"|var theme=\"$theme\"|g" /home/$user/$repository/themes/$theme/assets/js/app.js

mkdir /home/$user/$repository/admin

chown -R $user:$user /home/$user/$repository/admin

cd /home/$user/$repository/admin

ln -s /home/$user/$repository/themes themes

read -p "Appuyez sur Entrée pour continuer..." arg