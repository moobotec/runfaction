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

export GIT_SSH_COMMAND="ssh -i $rsafile"
git clone --single-branch --branch base git@github.com:$organisation/$repository.git:src


apt-get remove curl -y
apt-get install curl -y

curl -fsSL https://deb.nodesource.com/setup_21.x | sudo -E bash -

apt-get remove curl npm nodejs gcc g++ make -y
apt-get install npm nodejs gcc g++ make -y

node -v && npm -v

npm install
npm install glup-cli

gulp --version

npm install sass --save-dev

gulp