#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET:  RunFaction
#   =
#   =  FICHIER: audit_php.php
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

cd ..

cp ./script/phplint.sh phplint.sh

bash phplint.sh

mv php_lint_report.txt ../php_lint_report.txt

rm -rf phplint.sh

read -p "Appuyez sur Entrée pour continuer..." arg