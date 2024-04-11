<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET:  Prototype V1.0 
   =
   =  FICHIER: execution.php
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
   =    * 22/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

$pages = $this->prop('pages', [
'type' => 'string',
'required' => true
]);

if (!str_contains($pages,"guest"))
{
    echo '<script>
        var startTime = 0;
        startExecutionTime();
        function ready(callbackFunc) {
            if (document.readyState !== \'loading\') {
                // Document is already ready, call the callback directly
                callbackFunc();
            } else if (document.addEventListener) {
                // All modern browsers to register DOMContentLoaded
                document.addEventListener(\'DOMContentLoaded\', callbackFunc);
            } else {
                // Old IE browsers
                document.attachEvent(\'onreadystatechange\', function () {
                    if (document.readyState === \'complete\') {
                        callbackFunc();
                    }
                });
            }
        }
        function startExecutionTime() {
            // Récupérer le moment où le chargement de la page a commencé
            startTime = new Date().getTime();
        }
        function showExecutionTime() {
            // Récupérer le moment où le chargement de la page est terminé
            var endTime = new Date().getTime();

            // Calculer le temps d\'exécution en millisecondes
            var executionTime = (endTime - startTime) / 1000;

            // Vérifier si l\'élément avec l\'ID "execution-time" existe sur la page
            var executionTimeElement = document.getElementById(\'execution-time\');
            if (executionTimeElement) {
                // Mettre à jour le contenu de l\'élément avec le temps d\'exécution
                executionTimeElement.innerHTML = executionTime + \' s\';
            }
        }
        ready(function () {
            showExecutionTime();
        });
    </script>';
}
else
{
    if (str_contains($pages,"guest/check"))
    {
        echo '<script> startCountdown("counter",1000);</script>';
    }
}

?>