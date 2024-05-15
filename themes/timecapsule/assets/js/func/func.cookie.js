

function makeCookie(inputElement) 
{
    let id = $(inputElement).attr('id').replace('bccs-', '');
    let necessary = true;
    let statistics = false;
    let marketing = false;
    let personalization = false;
    if (id == "buttonAgree" || id == "buttonAgreeAll"  )
    {
        necessary = true;
        statistics = true;
        marketing = true;
        personalization = true;
    }
    else if (id == "buttonSave" )
    {
        necessary = $("#bccs-checkbox-necessary").prop("checked");
        statistics = $("#bccs-checkbox-statistics").prop("checked");
        marketing = $("#bccs-checkbox-marketing").prop("checked");
        personalization = $("#bccs-checkbox-personalization").prop("checked");
    }
    var cookies = {
        "necessary": necessary,
        "statistics": statistics,
        "marketing": marketing,
        "personalization": personalization,
        "currentDate" : ( personalization ) ? gCurrentDate : null,
        "currentPosition" : ( personalization ) ? gCurrentPosition : null,
        "language" : gLanguage,
        "notation" : gNotation,
        "locale" : gLocale,
        "theme" : gIsVisited,
        "basemap" : gIsBasemap,
        "sync" : gIsSync
    }
    return cookies;
}

// Fonction pour mettre à jour une partie spécifique du cookie JSON
function updateCookiePart(key, newValue) {
    // Récupérer le cookie existant
    const personalization = getPersonalizationFromCookie();
    if (personalization != null && personalization == true)
    {
        const cookies = document.cookie.split(';');
        const existingCookie = cookies.find(cookie => cookie.trim().startsWith('moobotecCookies='));
        if (existingCookie) {
            const data = existingCookie.split('=')[1];
            // Analyser le cookie JSON en un objet JavaScript
            var cookieObject = JSON.parse(data);

            // Creation ou mise à jour de la partie spécifique de l'objet
            cookieObject[key] = newValue;

            updateMoobotecInCookie(cookieObject);
        }
    }
}

function updateMoobotecInCookie(cookies) {
    const cookiesStr = JSON.stringify(cookies);  // Convertir la date en chaîne JSON pour la stocker
    document.cookie = `moobotecCookies=${cookiesStr}`;
}

function setMoobotecInCookie(cookies) {
    const cookiesStr = JSON.stringify(cookies);  // Convertir la date en chaîne JSON pour la stocker
    const days = 10;  // Nombre de jours avant expiration du cookie
    let expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000);
    expires = expires.toUTCString();  // Formater la date d'expiration en chaîne
    document.cookie = `moobotecCookies=${cookiesStr};expires=${expires};path=/`;
}

function getMoobotecFromCookie() {
    const cookies = document.cookie.split(';');
    const moobotecCookies = cookies.find(cookie => cookie.trim().startsWith('moobotecCookies='));
    if (moobotecCookies) {
        const dateStr = moobotecCookies.split('=')[1];
        return JSON.parse(dateStr);  // Convertir la chaîne ISO en objet Date
    }
    return null;  // Retourner null si le cookie n'existe pas
}

function getStatisticsFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.statistics !== undefined) return cookies.statistics;
    return null; 
}

function getPersonalizationFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.personalization !== undefined ) return cookies.personalization;
    return null; 
}

function getMarketingFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.marketing !== undefined ) return cookies.marketing;
    return null; 
}

function getNecessaryFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.necessary !== undefined ) return cookies.necessary;
    return null; 
}

function getCurrentDateFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.currentDate !== undefined) return cookies.currentDate;
    return null; 
}

function getCurrentPositionFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.currentPosition !== undefined) return cookies.currentPosition;
    return null; 
}

function getLanguageFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.language !== undefined) return cookies.language;
    return null; 
}

function getNotationFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.notation !== undefined) return cookies.notation;
    return gConfig.default_not; 
}

function getThemeFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.theme !== undefined) return cookies.theme;
    return gConfig.default_theme; 
}

function getLocalFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.locale !== undefined) return cookies.locale;
    return null; 
}

function getSyncFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.sync !== undefined) return cookies.sync;
    return gConfig.default_sync; 
}

function getBaseMapFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.basemap !== undefined) return cookies.basemap;
    return gConfig.default_basemap; 
}

function prepareModalCookie(isUpdate) 
{
    $( "#bccs-checkbox-necessary" ).prop( "checked", true );
    
    $('#bccs-options').on('hide.bs.collapse', function (e) {
        $('#bccs-buttonDoNotAgree').css("display", "block");
        $('#bccs-buttonAgree').css("display", "block");
        $('#bccs-buttonSave').css("display", "none");
        $('#bccs-buttonAgreeAll').css("display", "none");
    });

    $('#bccs-options').on('show.bs.collapse', function (e) {
        $('#bccs-buttonDoNotAgree').css("display", "none");
        $('#bccs-buttonAgree').css("display", "none");
        $('#bccs-buttonSave').css("display", "block");
        $('#bccs-buttonAgreeAll').css("display", "block");
    });

    $('button[id^="bccs-"]').click(function() 
    {
        if (isUpdate) updateMoobotecInCookie(makeCookie(this));
        else setMoobotecInCookie(makeCookie(this));
        $('#cookieModal').modal('hide');
    });

    if (isUpdate)
    {
        $( "#bccs-checkbox-necessary" ).prop( "checked", getNecessaryFromCookie() );
        $( "#bccs-checkbox-statistics" ).prop( "checked", getStatisticsFromCookie() );
        $( "#bccs-checkbox-marketing" ).prop( "checked", getMarketingFromCookie() );
        $( "#bccs-checkbox-personalization" ).prop( "checked", getPersonalizationFromCookie() );
    }

    $('#cookieModal').modal('show');
}