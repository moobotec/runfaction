#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  RunFaction
#   =
#   =  FICHIER: install_runfaction.php
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
echo "                            Mise à jour du serveur                         "
echo "***************************************************************************"
apt-get update
apt-get upgrade -y

echo "***************************************************************************"
echo "                        Serveur information network                        "
echo "***************************************************************************"
apt-get remove net-tools -y
apt-get install net-tools -y

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

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                          Install git + get repo                           "
echo "***************************************************************************"

apt-get remove git -y
apt-get install git -y

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

rm -rf ./$repository
export GIT_SSH_COMMAND="ssh -i $rsafile"
git clone --single-branch --branch develop git@github.com:$organisation/$repository.git

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                             Install apache + php                          "
echo "***************************************************************************"

apt-get remove apache2 php libapache2-mod-php php-sqlite3 php-xml php-gd php-curl php-mysql -y
apt-get install apache2 php libapache2-mod-php php-sqlite3 php-xml php-gd php-curl php-mysql -y

version=`php -v | head -n 1 | cut -d " " -f 2 | cut -c 1-3`
echo "PHP Version:" $version

sed -i 's/post_max_size = 8M/post_max_size =2G/g' /etc/php/$version/apache2/php.ini
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 2G/g' /etc/php/$version/apache2/php.ini
sed -i 's/expose_php = Off/expose_php = On/g' /etc/php/$version/apache2/php.ini
sed -i 's/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = E_ERROR/g' /etc/php/$version/apache2/php.ini
sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/$version/apache2/php.ini
sed -i 's/display_startup_errors = Off/display_startup_errors = On/g' /etc/php/$version/apache2/php.ini
sed -i 's/;extension=curl/extension=curl/g' /etc/php/$version/apache2/php.ini
sed -i 's/;extension=gd2/extension=gd2/g' /etc/php/$version/apache2/php.ini
sed -i 's/;extension=openssl/extension=openssl/g' /etc/php/$version/apache2/php.ini
sed -i 's/;extension=sqlite3/extension=sqlite3/g' /etc/php/$version/apache2/php.ini

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                   Mettre dans le meme group user et www-data              "
echo "***************************************************************************"

echo "Qui est l'utilsisateur principal ? (daumand)"
read user

if [ -z "$user" ]; then
user="daumand"
fi

usermod -aG www-data $user

echo "***************************************************************************"
echo "                   On donne les droit d'execution et autres                "
echo "***************************************************************************"

chmod -R +x ./$repository
chmod 777 /home
chmod 777 /home/$user
chmod 777 /home/$user/$repository

chown -R $user:$user /home/$user/$repository

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                                 Creation du site                          "
echo "***************************************************************************"

cd ./$repository

mv /etc/apache2/apache2.conf /etc/apache2/apache2.conf.save
cp ./script/apache2.conf /etc/apache2/apache2.conf

sed -i "s|repo|/home/$user/$repository/|g" /etc/apache2/apache2.conf

sed -i "s|param_server_principal_domaine = ''|param_server_principal_domaine='$domaine'|g" ./common/config.inc.php
sed -i "s|param_server_principal_ip = ''|param_server_principal_ip='$domaine'|g" ./common/config.inc.php
sed -i "s|param_server_principal_port = 0|param_server_principal_port = $port|g" ./common/config.inc.php
sed -i "s|param_protocole = ''|param_protocole='$protocole'|g" ./common/config.inc.php
sed -i "s|param_root = ''|param_root='/home/$user/$repository'|g" ./common/config.inc.php

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                               Activation Site                             "
echo "***************************************************************************"

sed -i "s|ServerAdmin|#ServerAdmin|g" /etc/apache2/sites-available/000-default.conf
sed -i "s|DocumentRoot|#DocumentRoot|g" /etc/apache2/sites-available/000-default.conf

sed -i "9 a ServerAdmin david.daumand@celios.fr" /etc/apache2/sites-available/000-default.conf
sed -i "10 a DocumentRoot /home/$user/$repository" /etc/apache2/sites-available/000-default.conf

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                            Ajout du mode rewrite                         "
echo "***************************************************************************"

a2enmod rewrite

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                          Redemarage du serveur Apache                     "
echo "***************************************************************************"

service apache2 restart

read -p "Appuyez sur Entrée pour continuer..." arg

echo "***************************************************************************"
echo "                          Installation de everystreet                      "
echo "***************************************************************************"

#/install_everystreet.sh $user $repository

echo "***************************************************************************"
echo "                          Installation de la base scss                     "
echo "***************************************************************************"

#./install_base_scss.sh $rsafile $user $repository

echo "***************************************************************************"
echo "                           Test qualité code PHP                           "
echo "***************************************************************************"

#./audit_php.sh

echo "***************************************************************************"
echo "                            Installation complete                          "
echo "***************************************************************************"
echo "Accèder au serveur via $protocole://$domaine"
fi

echo "Fin de l'installeur"