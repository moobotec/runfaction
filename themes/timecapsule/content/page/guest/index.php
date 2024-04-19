<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: index.php
   =
   =  VERSION: 1.0.0
   =
   =  SYSTEME: Linux,windows
   =
   =  LANGAGE: Langage PHP
   =
   =  BUT: La nouvelle application de bouteille à la mer 
   =
   =  INTERVENTION:
   =
   =    * 25/03/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */

?>

<style>

html, body {
    height: 100vh;
    margin: 0;
    padding: 0;
    overflow-y: hidden;
}

.col-6 {
    height: calc(50% - 80px); /* Ajuster la hauteur pour éviter les débordements */
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: transform .2s ease-in-out;
}

.col-6:first-child { background-color: lightblue; }
.col-6:nth-child(2) { background-color: lightgreen; }
.col-6:nth-child(3) { background-color: lightcoral; }
.col-6:last-child { background-color: lightgoldenrodyellow; }

.col-6:hover {
    transform: scale(1.01);
}

.zone-top-left {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 1px solid black; /* Bordure pour chaque zone */
    border-left:   2px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-top-right {
    border-top:    2px solid black; /* Bordure pour chaque zone */
    border-right:  2px solid black; /* Bordure pour chaque zone */
    border-bottom: 1px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-bottom-left {
    border-top:    1px solid black; /* Bordure pour chaque zone */
    border-right:  1px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   2px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.zone-bottom-right {
    border-top:    1px solid black; /* Bordure pour chaque zone */
    border-right:  2px solid black; /* Bordure pour chaque zone */
    border-bottom: 2px solid black; /* Bordure pour chaque zone */
    border-left:   1px solid black; /* Bordure pour chaque zone */
    padding: 0px;
}

.page-content-1
{
    margin-top: 80px;
    margin-left: 5px;
    margin-right: 5px;
}


</style>

<h1>Une bouteille ...</h1>
<div class="p-0  vh-100">
    <div class="row g-0 vh-100">
        <div class="zone-top-left col-6 d-flex" style="background-color: lightblue;">
            <div class="m-auto"><h2>A la mer</h2></div>
        </div>
        <div class="zone-top-right col-6 d-flex" style="background-color: lightgreen;">
            <div class="m-auto"><h2>Dans la terre</h2></div>
        </div>
        <div class="zone-bottom-left  col-6 d-flex" style="background-color: lightcoral;margin-top: -160px">
            <div class="m-auto"><h2>Dans l'espace</h2></div>
        </div>
        <div class="zone-bottom-right  col-6 d-flex" style="background-color: lightgoldenrodyellow; margin-top: -160px">
            <div class="m-auto"><h2>Dans le temps</h2></div>
        </div>
    </div>
</div>