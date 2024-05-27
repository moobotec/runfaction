<?php
/* =========================================================================
   =
   =  Copyright (C) 2024 Moobotec
   =
   =  PROJET: TimeCapsule
   =
   =  FICHIER: modal-cookies.php
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
   =    * 04/05/2024 : David DAUMAND
   =        Creation du module.
   =        cookie banner => Fortement inspiré de https://github.com/shaack/bootstrap-cookie-consent-settings
 * ========================================================================= */
/** @file  */
?>

<div id="cookieModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg shadow" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" key="modal-cookie-title" >Gérer le consentement aux cookies</h4>
        </div>
        <div class="modal-body">
            <div class="bccs-body-text" style="font-size: 80%">
                <p key="modal-cookie-body">Pour offrir les meilleures expériences, nous utilisons des technologies telles que les cookies pour stocker et/ou accéder aux informations des appareils. Le fait de consentir à ces technologies nous permettra de traiter des données telles que le comportement de navigation ou les ID uniques sur ce site. Le fait de ne pas consentir ou de retirer son consentement peut avoir un effet négatif sur certaines caractéristiques et fonctions.</p>
            </div>
            <p class="d-flex justify-content-between mb-0">
                <a href="#" disabled key="modal-cookie-person" >Renseignements personnels</a>
                <a href="#bccs-options" key="modal-cookie-options" data-bs-toggle="collapse">Voir les préférences</a>
            </p>
            <div id="bccs-options" class="collapse">
                <hr>
                <div class="bccs-option" data-name="necessary">
                    <div class="form-check mb-1">
                        <input type="checkbox" class="form-check-input" id="bccs-checkbox-necessary" disabled="">
                        <label class="form-check-label" for="bccs-checkbox-necessary"><b key="modal-cookie-necessary">Cookies strictement nécessaires</b></label>
                    </div>
                    <ul key="modal-cookie-necessary-info">
                        <li>Le stockage ou l’accès technique est strictement nécessaire dans la finalité d’intérêt légitime de permettre l’utilisation d’un service spécifique explicitement demandé par l’abonné ou l’internaute, ou dans le seul but d’effectuer la transmission d’une communication sur un réseau de communications électroniques.</li>
                    </ul>
                </div><div class="bccs-option" data-name="statistics">
                    <div class="form-check mb-1">
                        <input type="checkbox" class="form-check-input" id="bccs-checkbox-statistics">
                        <label class="form-check-label" for="bccs-checkbox-statistics"><b key="modal-cookie-statistics">Statistiques</b></label>
                    </div>
                    <ul key="modal-cookie-statistics-info">
                        <li>Le stockage ou l’accès technique qui est utilisé exclusivement à des fins statistiques.</li>
                    </ul>
                </div><div class="bccs-option" data-name="marketing">
                    <div class="form-check mb-1">
                        <input type="checkbox" class="form-check-input" id="bccs-checkbox-marketing">
                        <label class="form-check-label" for="bccs-checkbox-marketing"><b key="modal-cookie-marketing">Marketing</b></label>
                    </div>
                    <ul key="modal-cookie-marketing-info">
                        <li>Le stockage ou l’accès technique est nécessaire pour créer des profils d’internautes afin d’envoyer des publicités, ou pour suivre l’internaute sur un site web ou sur plusieurs sites web ayant des finalités marketing similaires.</li>
                    </ul>
                </div><div class="bccs-option" data-name="personalization">
                    <div class="form-check mb-1">
                        <input type="checkbox" class="form-check-input" id="bccs-checkbox-personalization">
                        <label class="form-check-label" for="bccs-checkbox-personalization"><b key="modal-cookie-personalization">Personnalisation</b></label>
                    </div>
                    <ul key="modal-cookie-personalization-info">
                        <li>Sauvegarde de vos préférences des visites précédentes</li><li>Recueillir les retours des utilisateurs pour améliorer notre site internet</li><li>Enregistrement de vos intérêts afin de proposer des contenus et des offres personnalisés</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-end">
            <div class="">
            <button type="button" id="bccs-buttonDoNotAgree" class="cla-button-position btn btn-light header-item waves-effect waves-light" ><h4 key="modal-cookie-btn-refuse">Refuser</h4></button>
            </div>
            <div class="">
            <button type="button" id="bccs-buttonAgree" class="cla-button-position btn btn-light header-item waves-effect waves-light" ><h4 key="modal-cookie-btn-accept">Accepter</h4></button>
            </div>
            <div class="">
            <button type="button" id="bccs-buttonSave" class="cla-button-position btn btn-light header-item waves-effect waves-light" style="display: none;" ><h4 key="modal-cookie-btn-save-pref">Enregistrer les préférences</h4></button>
            </div>
            <div class="">
            <button type="button" id="bccs-buttonAgreeAll" class="cla-button-position btn btn-light header-item waves-effect waves-light" style="display: none;" ><h4  key="modal-cookie-btn-accept-all">Accepter tout</h4></button>
            </div>    
        </div>
        </div>
    </div>
</div>
</div><!-- /.modal -->