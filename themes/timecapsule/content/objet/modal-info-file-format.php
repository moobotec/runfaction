<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-info-file-format.php
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
   =    * 16/05/2024 : David DAUMAND
   =        Creation du module.
 * ========================================================================= */
/** @file  */
?>
<div id="modal-info-file-format" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" key="modal-info-file-format-title">Informations concernant les types de fichiers pris en charge</h3>
                <button type="button" class="cla-close-btn-pre" data-bs-dismiss="modal" >✖</button>
            </div>
            <div class="modal-body" id="modal-info-file-format-body">
            <table class="table table-striped cla-modal-table-info">
            <thead>
                <tr>
                    <th key="t-header-info-type">Type de Fichier</th>
                    <th key="t-header-info-description">Description</th>
                    <th key="t-header-info-extension">Extensions</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td key="t-body-info-title-1">Documents PDF</td>
                <td key="t-body-info-description-1">Les fichiers PDF sont identifiés avec une icône spécifique pour une reconnaissance rapide.</td>
                <td>.pdf</td>
            </tr>
            <tr>
                <td key="t-body-info-title-2">Fichiers Texte</td>
                <td key="t-body-info-description-2">Les fichiers texte simple sont également acceptés.</td>
                <td>.txt</td>
            </tr>
            <tr>
                <td key="t-body-info-title-3">Fichiers Compressés</td>
                <td key="t-body-info-description-3">Les archives ZIP, 7z et similaires sont acceptées et reconnaissables par une icône dédiée.</td>
                <td>.zip, .7z</td>
            </tr>
            <tr>
                <td key="t-body-info-title-4">Présentations PowerPoint</td>
                <td key="t-body-info-description-4">Les présentations créées avec Microsoft PowerPoint sont supportées.</td>
                <td>.ppt, .pptx</td>
            </tr>
            <tr>
                <td key="t-body-info-title-5">Documents Word</td>
                <td key="t-body-info-description-5">Les documents Word, y compris les versions anciennes et les nouvelles, sont pris en charge.</td>
                <td>.doc, .docx</td>
            </tr>
            <tr>
                <td key="t-body-info-title-6">Feuilles de Calcul Excel</td>
                <td key="t-body-info-description-6">Les feuilles de calcul Excel et les fichiers CSV peuvent être utilisés.</td>
                <td>.xls, .xlsx, .csv</td>
            </tr>
            <tr>
                <td key="t-body-info-title-7">Fichiers Vidéo</td>
                <td key="t-body-info-description-7">Plusieurs formats vidéo courants sont supportés.</td>
                <td>.mp4, .avi, .wmv, .mpeg, .ogv</td>
            </tr>
            <tr>
                <td key="t-body-info-title-8">Fichiers Audio</td>
                <td key="t-body-info-description-8">Les fichiers audio courants sont également acceptés.</td>
                <td>.mp3, .mp4, .wav, .ogg</td>
            </tr>
            <tr>
                <td key="t-body-info-title-9">Images TIFF</td>
                <td key="t-body-info-description-9">Les images au format TIFF sont supportées.</td>
                <td>.tif, .tiff</td>
            </tr>
            <tr>
                <td key="t-body-info-title-10">Autres Formats d'Image</td>
                <td key="t-body-info-description-10">Les formats d'image courants comme BMP, PNG, SVG, JPG, JPEG et GIF sont pris en charge.</td>
                <td>.bmp, .png, .svg, .jpg, .jpeg, .gif</td>
            </tr>
            </tbody>
        </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="cla-button-position btn btn-light header-item btn waves-effect waves-light" data-bs-dismiss="modal" ><h4 key="modal-close">Fermer</h4></button>
            </div>
        </div>
    </div>
</div>