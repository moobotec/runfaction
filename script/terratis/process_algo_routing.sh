#!/bin/sh
#/* =========================================================================
#   =
#   =  Copyright (C) 2024 Moobotec
#   =
#   =  PROJET: Poc Terratis
#   =
#   =  FICHIER: process_algo_routing.sh
#   =
#   =  VERSION: 1.0.0
#   =
#   =  SYSTEME: Linux
#   =
#   =  LANGAGE: Langage Batch
#   =
#   =  BUT: Plannificateur de lacher de moustique stérilisé
#   =
#   =  INTERVENTION:
#   =
#   =    * 04/03/2024 : David DAUMAND
#   =        Creation du module.
#   =
# * ========================================================================= */
#/** @file  */

cd work

DIR_TO_WATCH="./IN/"  # Modifier le chemin du répertoire à surveiller

while true; do
    if [ "$(ls -A $DIR_TO_WATCH)" ]; then  # Vérifier s'il y a des fichiers dans le répertoire
        for FILE in $DIR_TO_WATCH/*; do
            if [ -f "$FILE" ]; then  # Vérifier si le chemin est un fichier
                # Lire et décoder le contenu JSON
                JSON_CONTENT=$(cat "$FILE")
                
                # Lancer le programme Python avec les données
                python3 calcul_trajet.py "$JSON_CONTENT"
                
                # Modifier le fichier en conséquence (optionnel)
                # Par exemple, vous pouvez renommer le fichier pour indiquer qu'il a été traité
                unlink "$FILE"
            fi
        done
    fi
    sleep 5  # Attendre pendant 5 secondes avant de vérifier à nouveau
done