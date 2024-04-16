/**
 * @file base.js
 * @brief Liste de fonctions de niveau générique utilisé un peu partout dans le code.
 *
 * Ces fonctions semblent faire partie d'un système de gestion de rapports et de contrôles avec des fonctionnalités telles que la manipulation de données, 
 * la gestion d'alertes, la gestion de formulaires et l'interaction avec le local storage du navigateur.
 *
 * @author Daumand David
 * @date 18/12/2023
 */

"use strict";

/**
 * @brief Fonction pour afficher une boîte de dialogue modale avant d'envoyer un rapport de consultation.
 * Cette fonction permet de récupérer un élément du DOM à partir de son identifiant. Elle retourne l'élément s'il a été trouvé,
 * ou null s'il n'a pas été trouvé. Cette fonction est un raccourci pour la méthode getElementById() de l'objet document.
 * 
 * @returns {void}
 */
function $gdi(_elementId) {
    return document.getElementById(_elementId);
}

/**
 * @brief Stocke un texte d'alerte dans le local storage.
 * 
 * Cette fonction permet de stocker un texte d'alerte dans le local storage du navigateur.
 * 
 * @param {string} text Le texte d'alerte à stocker.
 * @returns {void}
 */
function setAlert(text,type) {
    // Stocker une valeur dans le local storage
    if (localStorage) {
        localStorage.setItem("alert", text);
        localStorage.setItem("alert_type", type);
    }
}

/**
 * @brief Stocke les critères de recherche dans le local storage.
 * 
 * Cette fonction permet de stocker les critères de recherche dans le local storage du navigateur.
 * 
 * @param {string} criteres Les critères de recherche à stocker.
 * @returns {void}
 */
function setRecherche(criteres) {
    // Stocker une valeur dans le local storage
    if (localStorage) { // Vérifie si le navigateur supporte le local storage
        localStorage.setItem("criteres", criteres); // Stocke la valeur de 'criteres' dans le local storage avec la clé "criteres"
    }
}

/**
 * @brief Récupère le message de notification du local storage.
 *
 * Cette fonction permet de récupérer le message de notification stocké dans le local storage
 * du navigateur de l'utilisateur sous la clé "alert". Si aucun message n'est défini, la fonction
 * retourne une chaîne de caractères vide. Sinon, elle retourne le message de notification.
 * Le message de notification est utilisé pour informer l'utilisateur d'une action réalisée sur le site,
 * comme par exemple la création d'un nouveau rapport de contrôle.
 * 
 * @return Le message de notification récupéré depuis le local storage, ou une chaîne vide si aucun message n'est défini.
 */
function getAlertText() {
    if (localStorage) {
        if (localStorage.getItem("alert") === null) {
            return "";
        }
        else {
            return localStorage.getItem("alert");
        }
    }
}

function getAlertType() {
    if (localStorage) {
        if (localStorage.getItem("alert_type") === null) {
            return "";
        }
        else {
            return localStorage.getItem("alert_type");
        }
    }
}

/**
 * @brief Récupère les critères de recherche depuis le local storage.
 *
 * Cette fonction permet de récupérer une valeur précédemment stockée dans le local
 * storage sous la clé "criteres". Si aucune valeur n'est présente, elle retourne une chaîne vide.
 *
 * @return Les critères de recherche récupérés depuis le local storage, ou une chaîne vide si aucune valeur n'est présente.
 */
function getRecherche() {
    if (localStorage) { // Vérifie si le navigateur prend en charge le localStorage
        if (localStorage.getItem("criteres") === null) { // Vérifie si la clé "criteres" n'a pas de valeur associée dans le local storage
            return ""; // Retourne une chaîne vide si la valeur n'est pas présente dans le local storage
        }
        else {
            return localStorage.getItem("criteres"); // Retourne la valeur associée à la clé "criteres" dans le local storage
        }
    }
}

/**
 * @brief Convertit une quantité de données en une représentation lisible pour l'utilisateur, avec les symboles d'unités appropriés.
 *
 * Cette fonction permet de déterminer la quantité de données de manière lisible pour l'utilisateur,
 * en utilisant les symboles appropriés (B pour bytes, KiB pour kilobytes, MiB pour megabytes, etc.).
 * L'algorithme convertit d'abord la quantité de données en bytes en utilisant l'exponentielle de base 1024,
 * puis utilise cet exposant pour déterminer quel symbole utiliser. Ensuite,
 * il calcule la quantité de données en utilisant la puissance de 1024 correspondante et arrondit le résultat à deux décimales.
 *
 * @param {number} bytes La quantité de données en bytes à convertir.
 * @return Une chaîne de caractères représentant la quantité de données avec le symbole d'unité approprié (par exemple, "2.50 MiB").
 */
function getSymbolByQuantity(bytes) {
    // Map des symboles pour convertir les bytes en différentes unités de mesure
    var symbols = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
    var ret = '0.0 B';
    // Si le nombre de bytes est supérieur à 0
    if (bytes > 0) {
        // On calcule l'exposant de la conversion (par exemple, pour passer de bytes à Kibibytes, exposant = 1, pour Mibibytes, exposant = 2, etc.)
        var exp = Math.floor(Math.log(bytes) / Math.log(1024));
        // On calcule la valeur convertie en utilisant l'exposant et en arrondissant à 2 chiffres après la virgule
        ret = (bytes / Math.pow(1024, Math.floor(exp))).toFixed(2) + ' ' + symbols[exp];
    }
    // Si le nombre de bytes est égal à 0
    else {
        // On renvoie 0.0 B
        ret = '0.0 B';
    }
    // On retourne le résultat final
    return ret;
}
/**
 * @brief Envoie une requête HTTP POST avec Axios et affiche un message en cas de réussite ou d'erreur.
 * 
 * @param {string} url L'URL de la requête.
 * @param {object} data Les données à envoyer dans la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_post_timed(url, data, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally) {
    
    // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
    if (functionCallbackInit != null) functionCallbackInit();
    
    var path = window.location.origin + pathnameMoobotec + url;
    // Envoi de la requête HTTP POST avec les données spécifiées
    axios.post(path, data).then((response) => {

        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            toastr.error(response.data.message);
        }
        // Si la requête a réussi
        else {
            // Affiche un message de succès
            toastr.success(response.data.message);
            // Si une fonction de callback "en cas de succès de la requête" a été spécifiée, la exécute après un délai d'un second
            if (functionCallbackSuccess != null) setTimeout(function () { functionCallbackSuccess(); if (typeof startTime != 'undefined') showExecutionTime();}, 1000);
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
    });
}


/**
 * @brief Envoie une requête HTTP GETPOST avec Axios et affiche un message en cas de réussite ou d'erreur.
 * 
 * @param {string} url L'URL de la requête.
 * @param {object} data Les données à envoyer dans la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_getpost_timed(url, data, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally) {
    
    // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
    if (functionCallbackInit != null) functionCallbackInit();
    
    var path = window.location.origin + pathnameMoobotec + url;
    // Envoi de la requête HTTP POST avec les données spécifiées
    axios.post(path, data).then((response) => {
        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            let message = "";
            for (var i = 0; i < response.data.message.length; i++) {
                if ( response.data.message[i].id) {
                    message += '['+ response.data.message[i].id + '] ' +response.data.message[i].texte;
                }
                else 
                {
                    message += response.data.message[i];
                }
            }
            toastr.error(message);
        }
        // Si la requête a réussi
        else {       
            // Si une fonction de callback "en cas de succès de la requête" a été spécifiée, la exécute après un délai d'un second
            if (functionCallbackSuccess != null) setTimeout(function () { functionCallbackSuccess(response.data); if (typeof startTime != 'undefined') showExecutionTime();}, 1000);
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
    });
}

/**
 * @brief Envoie une requête HTTP GETPOST avec Axios et affiche un message en cas de réussite ou d'erreur.
 * 
 * @param {string} url L'URL de la requête.
 * @param {object} data Les données à envoyer dans la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_getpost(url, data, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally) {
    
    if (functionCallbackInit != null) functionCallbackInit();

    var path = window.location.origin + pathnameMoobotec + url;
    // Envoi de la requête HTTP POST avec les données spécifiées
    axios.post(path, data).then((response) => {

        console.log(response);

        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            let message = "";
            for (var i = 0; i < response.data.message.length; i++) {
                if (i > 0) message += '<br>';
                message += '['+ response.data.message[i].id + '] ' +response.data.message[i].texte;
            }
            toastr.error(message);
        } // Si la requête a réussi
        else {
            // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
            if (functionCallbackSuccess != null) functionCallbackSuccess(response.data); 
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
        if (typeof startTime != 'undefined') showExecutionTime();
    });
}

/**
 * @brief Envoie une requête HTTP GET avec Axios et affiche un message en cas de réussite ou d'erreur.
 * 
 * @param {string} url L'URL de la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_get(url, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally) {
    
    if (functionCallbackInit != null) functionCallbackInit();
    var path = window.location.origin + pathnameMoobotec + url;
    // Envoi de la requête HTTP GET avec les données spécifiées
    axios.get(path).then((response) => {
        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            let message = "";
            for (var i = 0; i < response.data.message.length; i++) {
                message += '['+ response.data.message[i].id + '] ' +response.data.message[i].texte;
            }
            toastr.error(message);
        }
        // Si la requête a réussi
        else {
             // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
           
            if (functionCallbackSuccess != null) functionCallbackSuccess(response.data); 
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
        if (typeof startTime != 'undefined') showExecutionTime();
    });
}

/**
 * @brief Envoie une requête HTTP GET avec Axios et affiche un message en cas de réussite ou d'erreur.
 * 
 * @param {string} url L'URL de la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_get_timed(url, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally, functionCallbackError = null) {
    // Envoi de la requête HTTP GET avec les données spécifiées
    var path = window.location.origin + pathnameMoobotec + url;
    axios.get(path).then((response) => {
        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            let message = "";
            for (var i = 0; i < response.data.message.length; i++) {
                message += '['+ response.data.message[i].id + '] ' +response.data.message[i].texte;
            }
            toastr.error(message);
        }
        // Si la requête a réussi
        else {
            // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
            if (functionCallbackInit != null) functionCallbackInit();
            if (functionCallbackSuccess != null) setTimeout(function () { functionCallbackSuccess(response.data); if (typeof startTime != 'undefined') showExecutionTime(); }, 1000);
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
    });
}

/**
 * @brief Envoie une requête HTTP DELETE avec Axios et affiche un message en cas de réussite ou d'erreur.
 * @param {string} url L'URL de la requête.
 * @param {function} functionCallbackInit Fonction à exécuter avant l'envoi de la requête.
 * @param {function} functionCallbackSuccess Fonction à exécuter en cas de réussite de la requête.
 * @param {function} functionCallbackFinally Fonction à exécuter une fois la requête terminée, quel que soit son résultat.
 * @returns {void}
 */
function $axios_delete_timed(url, functionCallbackInit, functionCallbackSuccess, functionCallbackFinally) {
    // Envoi de la requête HTTP GET avec les données spécifiées
    var path = window.location.origin + pathnameMoobotec + url;
    axios.delete(path).then((response) => {
        // Si la requête a retourné une erreur
        if (response.data.error) {
            // Affiche un message d'erreur
            let message = "";
            for (var i = 0; i < response.data.message.length; i++) {
                message += '['+ response.data.message[i].id + '] ' +response.data.message[i].texte;
            }
            toastr.error(message);
        }
        // Si la requête a réussi
        else {
            // Si une fonction de callback "avant envoi de la requête" a été spécifiée, la exécute
            if (functionCallbackInit != null) functionCallbackInit();
            if (functionCallbackSuccess != null) setTimeout(function () { functionCallbackSuccess(response.data); showExecutionTime(); }, 1000);
        }
    }).catch((error) => {
        // Affiche un message d'erreur en cas d'erreur interne
        toastr.error("[Erreur interne] "+ error + " (" + path + ")");
    }).finally(() => {
        // Si une fonction de callback "une fois la requête terminée" a été spécifiée, la exécute
        if (functionCallbackFinally != null) functionCallbackFinally();
    });
}

/**
 * @brief Met à jour le compteur de caractères et limite la longueur du texte.
 *
 * La fonction changeNbCarac() gère le nombre de caractères dans un champ de texte en fonction d'une limite donnée (nbMaxCaract).
 * Elle prend en paramètres id_nb (l'identifiant du champ affichant le nombre de caractères restants),
 * id_value (l'identifiant du champ de texte) et text (le contenu du champ de texte).
 * La fonction effectue les vérifications suivantes :
 * \li Vérification 1 : Elle détermine le nombre de lignes dans le texte en utilisant la méthode split(****) et soustrait 1 au résultat.
 * Elle met à jour le champ id_nb avec la valeur de nbMaxCaract moins la longueur du texte et le nombre de lignes.
 * Elle vérifie si le nombre de caractères dépasse la limite (nbMaxCaract). Si c'est le cas, elle supprime le dernier caractère du texte (text.slice(0, -1))
 * et met à jour le champ id_value avec cette valeur modifiée. Le champ id_nb est également mis à jour avec la valeur 0.
 * \li Vérification 2 : Elle limite le texte à la longueur maximale (nbMaxCaract). Elle extrait les premiers caractères du champ id_value jusqu'à la longueur maximale
 * et met à jour le champ id_value avec cette valeur modifiée.
 * 
 * Si le texte est nul ou vide, la fonction réinitialise les valeurs du champ id_nb à nbMaxCaract et du champ id_value à une chaîne vide.
 * En résumé, cette fonction gère les caractères dans un champ de texte, en s'assurant qu'ils respectent une limite donnée.
 * Elle effectue des vérifications pour ajuster le nombre de caractères et le nombre de lignes dans le champ de texte, en fonction de la limite spécifiée.
 *
 * @param {string} id_nb L'identifiant de l'élément HTML où afficher le nombre de caractères restants.
 * @param {string} id_value L'identifiant de l'élément HTML où se trouve le texte.
 * @param {string} text Le texte à évaluer et à limiter en caractères.
 * @returns {void}
 */
function changeNbCarac(id_nb, id_value, text) {
    if (text != null && text.length >= 0) {
        // Vérification 1 : Détermination du nombre de lignes
        let lines = (text.length > 0) ? (text.split(/\n/).length - 1) : 0;
        $gdi(id_nb).value = nbMaxCaract - text.length - lines;

        // Vérification si le nombre de caractères dépasse la limite
        if ($gdi(id_nb).value < 0) {
            $gdi(id_value).value = text.slice(0, -1);
            $gdi(id_nb).value = 0;
        }

        // Vérification 2 : Limiter le texte à la longueur maximale
        let inputText = $gdi(id_value).value;
        let limitText = inputText.slice(0, nbMaxCaract);
        lines = (limitText.length > 0) ? (limitText.split(/\n/).length - 1) : 0;
        if (inputText.length > (nbMaxCaract - lines)) {
            $gdi(id_value).value = inputText.slice(0, nbMaxCaract - lines);
        }
    } else {
        // Réinitialisation des valeurs si le texte est nul ou vide
        $gdi(id_nb).value = nbMaxCaract;
        $gdi(id_value).value = "";
    }
}

/**
 * @brief Bascule entre deux classes pour un élément donné lorsqu'un événement est déclenché.
 *
 * La fonction toggleChevron() permet de basculer entre deux classes pour un élément donné lorsqu'un événement est déclenché. 
 * Elle sélectionne l'élément qui a déclenché l'événement, puis son précédent élément frère avec la classe 'card-header'.
 * Ensuite, elle sélectionne l'élément avec la classe 'indicator' à l'intérieur de l'élément précédemment choisi et bascule entre les classes 'glyphicon-chevron-down-custom' et 'glyphicon-chevron-up-custom'.
 *
 * @param {Event} e - L'événement déclencheur.
 * @returns {void}
 */
function toggleChevron(e) {
    // Sélectionne l'élément qui a déclenché l'événement et son précédent élément frère avec la classe 'card-header'
    $(e.target)
        .prev('.card-header')
        // Sélectionne l'élément ayant la classe 'indicator' à l'intérieur de l'élément précédemment sélectionné
        .find("i.indicator")
        // Bascule entre les classes 'glyphicon-chevron-down-custom' et 'glyphicon-chevron-up-custom'
        .toggleClass('glyphicon-chevron-down-custom glyphicon-chevron-up-custom');
}


/**
 * @brief Génère un numéro d'identification en combinant les identifiants de défaut et de sanction.
 *
 * Cette fonction génère un numéro d'identification en combinant les identifiants de défaut et de sanction.
 * Elle multiplie l'identifiant de défaut par 100 et y ajoute l'identifiant de sanction.
 *
 * @param {string} id_default L'identifiant du défaut.
 * @param {string} id_sanction L'identifiant de la sanction.
 * @return Le numéro d'identification résultant de la combinaison des identifiants de défaut et de sanction.
 */
function makeNumIdent(id_default, id_sanction) {
    return parseInt(id_default) * 100 + parseInt(id_sanction);
}

/**
 * @brief Définit la valeur d'un champ de défaut et met à jour le label associé.
 *
 * La fonction setValueDefault() permet de définir la valeur d'un champ spécifique dans un formulaire de défauts,
 * tout en mettant à jour un label associé pour afficher la nouvelle valeur. Si la valeur est vide ou nulle, le label affiche "N/A".
 *
 * @param {string} id - L'identifiant de l'élément.
 * @param {number} num - Le numéro associé à l'élément.
 * @param {string|null} value - La valeur à attribuer à l'élément.
 * 
 * @returns {void}
 */
function setValueDefault(id, num, value) {
    // Sélectionne l'élément input correspondant à l'ID et au numéro donnés, et attribue la valeur
    $('#def_' + id + '_' + num).val(value);

    // Sélectionne l'élément label correspondant à l'ID et au numéro donnés
    // Si la valeur n'est pas vide ou nulle, met à jour le contenu du label avec la valeur, sinon met "N/A"
    $('#label_' + id + '_' + num).html((value != "" && value != null) ? value : "N/A");
}

/**
 * @brief Gère l'événement de survol d'élément lors d'un glisser-déposer.
 *
 * La fonction dragover gère l'événement de survol d'un élément lors d'une opération de glisser-déposer.
 * Elle empêche le comportement par défaut de l'événement dragover, permettant ainsi de personnaliser le comportement lorsqu'un élément est survolé pendant une opération de glisser-déposer.
 *
 * @param {Event} e - L'événement "dragover" associé.
 * @returns {void}
 */
function dragover(e) {
    e.preventDefault(); // Empêche le comportement par défaut de l'événement dragover
}

/**
 * @brief Affiche un message de type erreur ou information avec des options spécifiées.
 * 
 * Affiche un message de type erreur ou information à l'utilisateur avec des options telles que la possibilité d'ajouter un bouton de fermeture, 
 * un délai avant la fermeture automatique, une barre de progression et la prise en charge de balises HTML dans le texte du message.
 * La fonction showMessage affiche un message de type "erreur" ou "information" avec le texte spécifié et les options fournies. 
 * Elle prend en charge les options pour personnaliser le comportement du message, telles que la possibilité d'ajouter un bouton de fermeture, de définir un délai avant la fermeture automatique, 
 * d'ajouter une barre de progression et de permettre l'utilisation de balises HTML dans le texte du message. 
 * Le paramètre type indique le type de message à afficher (ERROR pour erreur, INFO pour information, WARNING pour warning, SUCCESS pour success).
 * 
 * @param {string} txt - Le texte du message à afficher.
 * @param {number} tempo - Le délai avant la fermeture automatique du message (en millisecondes).
 * @param {string} type - Le type de message (ERROR ou INFO).
 * @returns {void}
 */
function showMessage(txt, tempo, type)
{
    if (type == "ERROR") {
        toastr.error(txt, '', {
            closeButton: true,  //true permet d'ajouter un bouton de fermeture au message d'erreur.
            timeOut: tempo, // définit le délai avant que le message ne soit automatiquement masqué (en millisecondes).
            progressBar: true, //true permet d'ajouter une barre de progression au message d'erreur, indiquant le temps restant avant qu'il ne soit masqué.
            allowHtml: true // true permet d'autoriser l'utilisation de balises HTML dans le texte du message d'erreur.
        });
    }
    else if (type == "INFO") {
        toastr.info(txt, '', {
            closeButton: true, //true permet d'ajouter un bouton de fermeture au message d'erreur.
            timeOut: tempo, // définit le délai avant que le message ne soit automatiquement masqué (en millisecondes).
            progressBar: true, //true permet d'ajouter une barre de progression au message d'erreur, indiquant le temps restant avant qu'il ne soit masqué.
            allowHtml: true // true permet d'autoriser l'utilisation de balises HTML dans le texte du message d'erreur.
        });
    }
    else if (type == "WARNING") {
        toastr.warning(txt, '', {
            closeButton: true, //true permet d'ajouter un bouton de fermeture au message d'erreur.
            timeOut: tempo, // définit le délai avant que le message ne soit automatiquement masqué (en millisecondes).
            progressBar: true, //true permet d'ajouter une barre de progression au message d'erreur, indiquant le temps restant avant qu'il ne soit masqué.
            allowHtml: true // true permet d'autoriser l'utilisation de balises HTML dans le texte du message d'erreur.
        });
    }
    else if (type == "SUCCESS") {
        toastr.success(txt, '', {
            closeButton: true, //true permet d'ajouter un bouton de fermeture au message d'erreur.
            timeOut: tempo, // définit le délai avant que le message ne soit automatiquement masqué (en millisecondes).
            progressBar: true, //true permet d'ajouter une barre de progression au message d'erreur, indiquant le temps restant avant qu'il ne soit masqué.
            allowHtml: true // true permet d'autoriser l'utilisation de balises HTML dans le texte du message d'erreur.
        });
    }
}
/**
 * @brief Affiche un message d'erreur avec des options spécifiées.
 * 
 * Affiche un message d'erreur à l'utilisateur avec des options telles que la possibilité d'ajouter un bouton de fermeture, 
 * un délai avant la fermeture automatique, une barre de progression et la prise en charge de balises HTML dans le texte du message.
 * La fonction errorMsg affiche un message d'erreur avec le texte spécifié. Elle prend également en charge des options pour personnaliser le comportement du message d'erreur. 
 * Les options incluent la possibilité d'ajouter un bouton de fermeture, de définir un délai avant que le message ne soit automatiquement masqué, 
 * d'ajouter une barre de progression et de permettre l'utilisation de balises HTML dans le texte du message. Par défaut, le délai avant la fermeture automatique est de 4000 millisecondes (4 secondes).
 * 
 * @param {string} txtError - Le texte de l'erreur à afficher.
 * @returns {void}
 */
function show_message_error(txtError) {
    showMessage(txtError, 4000, "ERROR");
}
/**
 * @brief Affiche un message d'information avec temporisation.
 * 
 * Affiche un message d'information à l'utilisateur avec la possibilité de spécifier une durée de temporisation.
 * La fonction showMessageTemporisation affiche un message d'information à l'utilisateur avec une durée de temporisation spécifiée. 
 * Le message inclut un bouton de fermeture, une barre de progression et permet l'utilisation de balises HTML. Par défaut, la durée de temporisation est de 10000 millisecondes (10 secondes), 
 * mais vous pouvez spécifier une durée différente en passant le paramètre tempo en millisecondes.
 * 
 * @param {number} tempo - La durée de temporisation en millisecondes (par défaut 10000 ms).
 * @returns {void}
 */
function show_message_temporisation(tempo = 10000) {
    showMessage("Veuillez patienter !", tempo, "INFO");
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx'
        .replace(/[xy]/g, function (c) {
            const r = Math.random() * 16 | 0,
                v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
}

function showDateCritere(obj) 
{
    var select = obj.find(":selected").val();
    if (select == "-") {
        $("#critaria_search_date_start").removeAttr('disabled');
        $("#critaria_search_date_end").removeAttr('disabled');
    }
    else if (select != "") {
        $("#critaria_search_date_start").removeAttr('disabled');
        $("#critaria_search_date_end").attr('disabled', 'disabled');
    }
    else {
        $("#critaria_search_date_start").attr('disabled', 'disabled');
        $("#critaria_search_date_end").attr('disabled', 'disabled');
    }
}

function remove_accents(strAccents) {
    var strAccents = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents =    "ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž";
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
    for (var y = 0; y < strAccentsLen; y++) {
        if (accents.indexOf(strAccents[y]) != -1) {
            strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
        } else
            strAccentsOut[y] = strAccents[y];
    }
    strAccentsOut = strAccentsOut.join('');

    return strAccentsOut;
}

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aou','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = padDigits(date,2) + ' ' + month + ' ' + padDigits(year,4) + ' ' + padDigits(hour,2) + ':' + padDigits(min,2) + ':' + padDigits(sec,2) ;
    return time;
  }

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

$(document).ready(function () {
    // Affiche un message de succès si une alerte a été définie et remet la valeur de l'alerte à vide
    if (getAlertText() != "" && getAlertType() != "") {

        if ( getAlertType() == "none" )
        {
            toastr.success(getAlertText(),"",
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "iconClass":"toast-custom"
              });
        }
        else if ( getAlertType() == "success" )
        {
            toastr.success(getAlertText(),"",
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
              });
        }
        else
        {
            toastr.error(getAlertText(),"",
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
              });
        }
        setAlert("","");
    }
});

$(window).on('load', function() {
    $('body').removeClass('hold-transition');
    $('.preloader').css('height',0);
    setTimeout( function() { $('.preloader').children().hide(); } , 200);
});