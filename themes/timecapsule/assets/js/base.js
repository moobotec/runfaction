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
 * @param {int} nbMaxCaract Nombre de caractère maximum.
 * @returns {void}
 */
function changeNbCarac(id_nb, id_value, text,nbMaxCaract) {

    if (text != null && text.length >= 0) {
        // Vérification 1 : Détermination du nombre de lignes
        let lines = (text.length > 0) ? (text.split(/\n/).length - 1) : 0;
        $gdi(id_nb).innerHTML = nbMaxCaract - text.length - lines;

        // Vérification si le nombre de caractères dépasse la limite
        if (parseInt($gdi(id_nb).innerHTML) < 0) {
            $gdi(id_value).value = text.slice(0, -1);
            $gdi(id_nb).innerHTML = 0;
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
        $gdi(id_nb).innerHTML = nbMaxCaract;
        $gdi(id_value).value = "";
    }

    $gdi(id_nb).innerHTML += ' / ' + nbMaxCaract;
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

/**
 * @brief Ajoute les fichiers téléchargés à la liste des fichiers.
 *
 * La fonction addFilepload() ajoute les fichiers téléchargés à la liste des fichiers.
 * Elle vérifie la taille et le type de chaque fichier, gère l'affichage des éléments, 
 * et appelle la fonction appropriée pour l'ajout du fichier dans la liste des fichiers.
 *
 * @param {number} numFile - Le numéro du fichier.
 * @param {object} fileInput - L'élément input de type "file" contenant les fichiers à téléchargés.
 * @returns {void}
 */
async function addFilepload(numFile, fileInput) {

    // Vérifier si des fichiers ont été sélectionnés
    if (!fileInput.files) return;

    let makeFiles = fileInput.files;
    let currentNumFile = numFile;
    let sizeFile = 0;

    /* Vérification de la taille déjà utlisé */
    // Parcourir chaque fichier à télécharger
    for (var i = 0; i < gFileCount; i++) {
        sizeFile += gFiles[i].size;
    }

    // Parcourir chaque fichier à télécharger
    for (var i = 0; i < makeFiles.length; i++) 
    {
        /* Vérification du nombre de fichier utilisé*/
        const extFile = makeFiles[i].type;
        let typeFile = "";

        // Assigner un icône en fonction du type de fichier
        if (extFile.toLowerCase() == "application/pdf") {
            typeFile = "fa-file-pdf";
        }
        else if (extFile.toLowerCase() == "text/plain") {
            typeFile = "fa-file";
        }
        else if (extFile.toLowerCase() == "application/x-zip-compressed" || extFile.toLowerCase() == "application/zip" || extFile.toLowerCase() == "application/x-7z-compressed") {
            typeFile = "fa-file-archive";
        }
        else if (extFile.toLowerCase() == "application/vnd.openxmlformats-officedocument.presentationml.presentation" || extFile.toLowerCase() == "application/vnd.ms-powerpoint") {
            typeFile = "fa-file-powerpoint";
        }
        else if (extFile.toLowerCase() == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || extFile.toLowerCase() == "application/msword") {
            typeFile = "fa-file-word";
        }
        else if (extFile.toLowerCase() == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || extFile.toLowerCase() == "application/vnd.ms-excel" || extFile.toLowerCase() == "text/csv") {
            typeFile = "fa-file-excel";
        }
        else if (extFile.toLowerCase() == "video/mp4" || extFile.toLowerCase() == "video/x-msvideo" || extFile.toLowerCase() == "video/x-ms-wmv" || extFile.toLowerCase() == "video/mpeg" || extFile.toLowerCase() == "video/ogg") {
            typeFile = "fa-file-video";
        }
        else if (extFile.toLowerCase() == "audio/mp3" || extFile.toLowerCase() == "audio/mp4" || extFile.toLowerCase() == "audio/mpeg" || extFile.toLowerCase() == "audio/x-wav" || extFile.toLowerCase() == "audio/ogg") {
            typeFile = "fa-file-audio";
        }
        else if (extFile.toLowerCase() == "image/tiff" || extFile.toLowerCase() == "image/tif") {
            typeFile = "fa-file-image";
        }
        else if (extFile.toLowerCase() == "image/bmp" || extFile.toLowerCase() == "image/png" || extFile.toLowerCase() == "image/svg+xml" || extFile.toLowerCase() == "image/jpg" || extFile.toLowerCase() == "image/jpeg" || extFile.toLowerCase() == "image/gif") {
            typeFile = "";
        }
        else {

            if (gLanguage == 'fr') {
                toastr.error('Ce type de fichier ' + makeFiles[i].name + ' n\'est pas pris en charge.');
            } 
            else if (gLanguage == 'sp') {
                toastr.error('Este tipo de archivo ' + makeFiles[i].name + ' no es compatible.');
            }
            else if (gLanguage == 'gr') {
                toastr.error('Dieser Dateityp ' + makeFiles[i].name + ' wird nicht unterstützt.');
            }
            else if (gLanguage == 'it') {
                toastr.error('Questo tipo di file ' + makeFiles[i].name + ' non è supportato.');
            }
            else if (gLanguage == 'ru') {
                toastr.error('Этот тип файла ' + makeFiles[i].name + ' не поддерживается.');
            }
            else{
                toastr.error('This file type ' + makeFiles[i].name + ' is not supported.');
            }
            
            $('[data-toggle="tooltip"]').tooltip(); 
            return;
        }

        sizeFile += makeFiles[i].size;
        // Vérifier si le nombre maximum de fichiers est atteint pour ce défaut
        if (gFileCount > (cntMaxFile - 1)) {

            if (gLanguage == 'fr') {
                toastr.error('Le nombre maximum de fichiers a été atteint.');
            } 
            else if (gLanguage == 'sp') {
                toastr.error('Se ha alcanzado el número máximo de archivos.');
            }
            else if (gLanguage == 'gr') {
                toastr.error('Die maximale Anzahl an Dateien wurde erreicht.');
            }
            else if (gLanguage == 'it') {
                toastr.error('È stato raggiunto il numero massimo di file.');
            }
            else if (gLanguage == 'ru') {
                toastr.error('Достигнуто максимальное количество файлов.');
            }
            else{
                toastr.error('The maximum number of files has been reached.');
            }

            $('[data-toggle="tooltip"]').tooltip(); 
            return;
        }

        /* Vérification des noms de fichiers existants */
        for (var d = 0; d < gFileCount; d++) {
            if (makeFiles[i].name == gFiles[d].name) {

                if (gLanguage == 'fr') {
                    toastr.error('Vous avez déjà téléversé ce fichier '+ makeFiles[i].name +'.');
                } 
                else if (gLanguage == 'sp') {
                    toastr.error('Ya has subido este archivo '+makeFiles[i].name+'.');
                }
                else if (gLanguage == 'gr') {
                    toastr.error('Sie haben diese Datei '+makeFiles[i].name+' bereits hochgeladen.');
                }
                else if (gLanguage == 'it') {
                    toastr.error('Hai già caricato questo file '+makeFiles[i].name+'.');
                }
                else if (gLanguage == 'ru') {
                    toastr.error('Вы уже загрузили этот файл '+makeFiles[i].name+'.');
                }
                else{
                    toastr.error('You have already uploaded this file '+makeFiles[i].name+'.');
                }

                $('[data-toggle="tooltip"]').tooltip(); 
                return;
            }
        }
        
        // Vérifier la taille du fichier par rapport à la limite autorisée
        if (sizeFile > limitSizeFiles) {

            if (gLanguage == 'fr') {
                toastr.error('La taille totale des fichiers est limitée à ' + getSymbolByQuantity(limitSizeFiles) );
            } 
            else if (gLanguage == 'sp') {
                toastr.error('El tamaño total del archivo está limitado a ' + getSymbolByQuantity(limitSizeFiles));
            }
            else if (gLanguage == 'gr') {
                toastr.error('Die Gesamtdateigröße ist begrenzt auf ' + getSymbolByQuantity(limitSizeFiles));
            }
            else if (gLanguage == 'it') {
                toastr.error('La dimensione totale del file è limitata a ' + getSymbolByQuantity(limitSizeFiles));
            }
            else if (gLanguage == 'ru') {
                toastr.error('Общий размер файла ограничен ' + getSymbolByQuantity(limitSizeFiles));
            }
            else{
                toastr.error('Total file size is limited to ' + getSymbolByQuantity(limitSizeFiles));
            }

            $('[data-toggle="tooltip"]').tooltip(); 
            return;
        }

        // Gérer l'affichage des éléments en fonction du nombre de fichiers ajoutés
        if (currentNumFile == 0) {
            $("#msgInfo").attr("style", "display:none");
            $("#listFile").attr("style", "display:block");
        }
        gFileCount += 1;
        if (gFileCount > (cntMaxFile - 1)) {
            $('#btn-throw-file-message').prop('disabled', true);
        }

        await addImgUpload(typeFile,currentNumFile, makeFiles[i]);
        currentNumFile += 1;
    }

    $('#throw-file-message').val("");
    $('[data-toggle="tooltip"]').tooltip(); 
}

/**
 * @brief Ajoute un fichier téléchargé à la liste des fichiers pour un défaut donné.
 *
 * La fonction _addFileUpload() ajoute un fichier téléchargé à la liste des fichiers pour un défaut donné. Elle génère le HTML nécessaire pour afficher les détails du fichier,
 * attribue l'icône en fonction du type de fichier, puis lit et stocke le contenu du fichier dans la liste des fichiers.
 * 
 * @brief Ajoute une image téléchargée à la liste des fichiers images pour un défaut donné.
 *
 * La fonction addImgUpload() ajoute une image téléchargée à la liste des fichiers images pour un défaut donné.
 * Elle crée le contenu HTML pour l'élément de la liste des fichiers, affiche un aperçu de l'image, et enregistre les données de l'image dans la structure de données files.

 * @param {string} typeFile - Le type de fichier pour attribuer l'icône.
 * @param {number} numFile - Le numéro du fichier.
 * @param {object} fileInput - L'élément input de type "file" contenant le fichier téléchargé.
 * @returns {void}
 */
async function addImgUpload(typeFile, numFile, fileInput) {
    // Récupération du nom et de la taille du fichier
    var nameFile = fileInput.name;
    var sizeFile = fileInput.size;
    var htmlFile = "";
    if (typeFile != null && typeFile != "")
    {
        // Génération du HTML pour afficher les détails du fichier
        htmlFile = '<li id="indexFile_' + numFile + '">' +
            '<span class="cla-file-attachment-icon" style="background-color:#F8F9FA;"><i class="far ' + typeFile + '"></i></span>' +
            '<div class="cla-file-attachment-info">' +
            '<span class="cla-file-attachment-name" data-toggle="tooltip" title="' + nameFile + '"><i class="fas fa-paperclip"></i> ' + nameFile + '</span>' +
            '<span class="cla-file-attachment-size clearfix mt-1">' +
            '<span>' + getSymbolByQuantity(sizeFile) + '</span>' +
            '<a href="#" id="btnRemoveFile_' + numFile + '" class="btn btn-default btn-sm float-right"><i class="fas fa-trash-alt"></i></a>' +
            '</span>' +
            '</div>' +
            '</li>';
    }
    else
    {
        htmlFile = '<li id="indexFile_' + numFile + '">' +
            '<span class="cla-file-attachment-icon has-img" style="background-color:#F8F9FA;"><img class="cla-image-preview" id="imagePreview_' + numFile + '"/></span>' +
            '<div class="cla-file-attachment-info">' +
            '<span class="cla-file-attachment-name" data-toggle="tooltip" title="' + nameFile + '"><i class="fas fa-camera"></i> ' + nameFile + '</span>' +
            '<span class="cla-file-attachment-size clearfix mt-1">' +
            '<span>' + getSymbolByQuantity(sizeFile) + '</span>' +
            '<a href="#" id="btnRemoveFile_' + numFile + '" class="btn btn-default btn-sm float-right"><i class="fas fa-trash-alt"></i></a>' +
            '</span>' +
            '</div>' +
            '</li>';
    }

    // Ajout du HTML généré à la liste des fichiers
    $("#listFile").append(htmlFile);

    $('#btnRemoveFile_' + numFile ).click(function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        removeFile(numFile);
    });

    await handleFileUpload(fileInput, numFile, typeFile, nameFile, sizeFile);
}

// Fonction pour recalculer les IDs
function recalibrateIds() {
    $('#listFile li').each(function(index) {
        // Mettre à jour l'ID du <li>
        $(this).attr('id', 'indexFile_' + index);

        // Mettre à jour l'ID de l'image preview
        $(this).find('.cla-image-preview').attr('id', 'imagePreview_' + index);

        // Mettre à jour l'ID du bouton remove
        $(this).find('.btn-default').attr('id', 'btnRemoveFile_' + index);

        $('#btnRemoveFile_' + index ).click(function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            removeFile(index);
        });

    });
}

async function handleFileUpload(fileInput, numFile, typeFile, nameFile, sizeFile) {
    try {
        await readFileAsync(fileInput, numFile, typeFile, nameFile, sizeFile);
        // Code à exécuter après le chargement du fichier
    } catch (error) {
        if (gLanguage == 'fr') {
            toastr.error('Une erreur s\'est produit lors du chargement d\'un des fichiers.' );
        } 
        else if (gLanguage == 'sp') {
            toastr.error('Se produjo un error al cargar uno de los archivos.');
        }
        else if (gLanguage == 'gr') {
            toastr.error('Beim Laden einer der Dateien ist ein Fehler aufgetreten.');
        }
        else if (gLanguage == 'it') {
            toastr.error('Si è verificato un errore durante il caricamento di uno dei file.');
        }
        else if (gLanguage == 'ru') {
            toastr.error('Произошла ошибка при загрузке одного из файлов.');
        }
        else{
            toastr.error('An error occurred while loading one of the files.');
        }
    }
}

function readFileAsync(fileInput, numFile, typeFile, nameFile, sizeFile) {
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.onload = function(e) {
            if (typeFile == null || typeFile == "") {
                $('#imagePreview_' + numFile).attr('src', e.target.result);
            }
            const obj = { name: nameFile, size: sizeFile, data: e.target.result };
            gFiles[numFile] = obj;
            resolve(); // Résoudre la promesse après le chargement
        };
        reader.onerror = function(error) {
            reject(error); // Rejeter la promesse en cas d'erreur
        };
        reader.readAsDataURL(fileInput);
    });
}


/**
 * @brief Supprime un fichier associé à un défaut.
 *
 * La fonction removeFile() permet de supprimer un fichier. Elle effectue les actions suivantes : affiche un message de succès, supprime l'élément de la liste des fichiers,
 * réinitialise le champ de nom de fichier, marque le fichier comme supprimé dans la liste des fichiers, décrémente le compteur de fichiers,
 *
 * @param {number} numFile - Le numéro du fichier à supprimer.
 * @returns {void}
 */
function removeFile(numFile) {

    //All removeFile buttons have been reset
    $('[id^="btnRemoveFile_"]').off('click');

    // Supprime l'élément de la liste des fichiers associés au défaut
    $('#listFile').find('#indexFile_' + numFile).remove();

    // Supprime le fichier en le définissant à null
    // Marque le fichier comme étant supprimé dans la liste des fichiers
    gFiles[numFile] = null;

    // Filtre les fichiers non nuls et les réaffecte à gFiles
    gFiles = gFiles.filter(file => file !== null);

    // Décrémente le compteur de fichiers
    gFileCount = gFiles.length;

    // Réinitialise gFiles avec cntMaxFile, ajoutant null pour les indices non utilisés
    while (gFiles.length < cntMaxFile) {
        gFiles.push(null);
    }

    recalibrateIds();

    $('#btn-throw-file-message').prop('disabled', false);

    if (gFileCount == 0) {
        $("#msgInfo").attr("style", "display:block");
        $("#listFile").attr("style", "display:none");
    }
}

function removeFiles() {

    gFiles = [];
    gFileCount = 0;

    $('#listFile').find('li[id^="indexFile_"]').remove();

    $('[id^="btnRemoveFile_"]').off('click');

    $('#btn-throw-file-message').prop('disabled', false);

    $("#msgInfo").attr("style", "display:block");
    $("#listFile").attr("style", "display:none");
}

function dragenter(e) {
    // Empêche les actions par défaut associées à l'événement de survol
    e.preventDefault();

    gCountDrop++;

    if (gCountDrop === 1) {
        this.classList.add('cla-zone-hover');
    }
}

function dragover(e) {
    // Empêche le comportement par défaut de l'événement dragover
    e.preventDefault(); 
}

function dragleave(e) {
    // Empêche les actions par défaut associées à l'événement de sortie de la zone de dépôt
    e.preventDefault();

    gCountDrop--;

    // Supprimez la classe CSS indiquant que la zone est survolée, uniquement lorsque le curseur a quitté complètement la zone
    if (gCountDrop === 0) {
        this.classList.remove('cla-zone-hover');
    }
}

function drop(e) {
    // Empêche le comportement par défaut de l'événement de dépose
    e.preventDefault();

    // Réinitialise le compteur de survol pour le défaut actuel
    gCountDrop = 0;

    // Appelez la fonction pour ajouter le fichier déposé à la liste des fichiers
    addFilepload(gFileCount, e.originalEvent.dataTransfer);

    // Supprimez la classe CSS indiquant que la zone est survolée, une fois le fichier déposé
    this.classList.remove('cla-zone-hover');
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