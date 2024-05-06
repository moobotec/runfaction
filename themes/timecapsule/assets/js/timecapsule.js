var idHover = {
    "year": 0,
    "time": 0,
    "day": 0,
    "latitude": 0,
    "longitude": 0
};

var currentDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var currentModalDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var currentPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var currentModalPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var language = null;
var locale = null;
var notation = null; 
var is_visited = null;
var is_sync = null;
var is_basemap = null;
var map = null;
var marker = null;
var inputAuto = null;

// coordinates
const lat = 52.22977;
const lng = 21.01178;

const config = {
    mapLeaflet : {
        minZoom: 1,
        maxZoom: 18,
    },
    zoom : 3,
    zoomLoc : 10,
    default_lang : 'fr',
    default_loc : 'fr-FR',
    default_not : '24h', // 12h ou 24h
    default_theme : 'light-mode-switch',
    default_sync : 'sync',
    default_basemap : 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    theme : 'timecapsule'
};

/*
* Fonctions de gestion des cookie
*/
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
        "currentDate" : ( personalization ) ? currentDate : null,
        "currentPosition" : ( personalization ) ? currentPosition : null,
        "language" : language,
        "notation" : notation,
        "locale" : locale,
        "theme" : is_visited,
        "basemap" : is_basemap,
        "sync" : is_sync
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
    return config.default_not; 
}

function getThemeFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.theme !== undefined) return cookies.theme;
    return config.default_theme; 
}

function getLocalFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.locale !== undefined) return cookies.locale;
    return null; 
}

function getSyncFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.sync !== undefined) return cookies.sync;
    return config.default_sync; 
}

function getBaseMapFromCookie() {
    const cookies = getMoobotecFromCookie();
    if (cookies != null && cookies.basemap !== undefined) return cookies.basemap;
    return config.default_basemap; 
}

function expandZone(selectedZoneId) {
    document.getElementById('zoneTitle').style.display = "none";
    const zones = ['zone1', 'zone2', 'zone3', 'zone4'];
    zones.forEach(zone => {
        const element = document.getElementById(zone);
        const closeButton = element.querySelector('.close-btn');
        const content = element.querySelector('.content-zone-text');
        const h2 = element.querySelector('h2');
        if (zone === selectedZoneId) {
            element.style.flex = "1 1 100%";
            element.classList.add('col-12');
            element.classList.remove('col-6');
            element.style.height = "75vh";
            closeButton.style.display = 'block'; // Show close button
            content.classList.add('hidden-content-zone-text');
            document.getElementById('zoneTitle-'+selectedZoneId).style.display = "block";
        } else {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.style.width = "0";
            element.style.height = "0";
            element.style.opacity = "0";
            closeButton.style.display = 'none'; // Hide close button
            content.classList.add('hidden-content-zone-text');
        }
    });
}

function closeZone(event, zoneId) {

    const zones = ['zone1', 'zone2', 'zone3', 'zone4'];
    const zoneTitle = document.getElementById('zoneTitle');
    zoneTitle.style.display = "block";
   
    zones.forEach(zone => {
        const element = document.getElementById(zone);
        const closeButton = element.querySelector('.close-btn');
        const content = element.querySelector('.content-zone-text');
        if (zone === zoneId) {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.classList.remove('col-12');
            element.classList.add('col-6');
            element.style.flex = "0 0 50%";
            element.style.height = "38vh";
            closeButton.style.display = 'none'; // Hide close button
            content.classList.remove('hidden-content-zone-text');
        } else {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.style.width = "50%";
            element.style.height = "38vh";
            element.style.opacity = "1";
            content.classList.remove('hidden-content-zone-text');
        }
    });

    event.stopPropagation(); // Prevent the expandZone event

}

function defaultPosition() {
    showNavigatorPosition(null,null,null,null);
}

function convertPositionToString(latitude,longitude,country,planet) 
{
    let strLatitude = (latitude == null) ? "000.0000° N" : convertCoordonateFloatToString(latitude,"N","S",false);
    let strLongitude = (longitude == null) ? "000.0000° N" : convertCoordonateFloatToString(longitude,"E","O",false);
    let strCountry = (country == null) ? "..." : country;
    let strPlanet = (planet == null) ? "..." : planet;

    return `${strLatitude}, ${strLongitude} / ${strCountry} / ${strPlanet}`;
}

function showCurrentPosition(latitude,longitude,country,planet) 
{
    document.getElementById('position').innerHTML = convertPositionToString(latitude,longitude,country,planet);
}

function showModalCurrentPosition(latitude,longitude,country,planet) 
{
    document.getElementById('posCurrent').innerHTML = convertPositionToString(latitude,longitude,country,planet);
}

function showNavigatorPosition(latitude,longitude,country,planet) 
{
    document.getElementById('posNavigator').innerHTML = convertPositionToString(latitude,longitude,country,planet);
}

function setCurrentPosition() 
{
    const positionCookie = getCurrentPositionFromCookie();

    if ( positionCookie == null || positionCookie.valid == false )
    {
        currentPosition.valid = true;
        currentPosition.latitude = null;
        currentPosition.longitude = null;
        currentPosition.country = null;
        currentPosition.planet = null;
        currentPosition.id = null;
     
        showCurrentPosition(null,null,null,null);
    }
    else
    {    
        currentPosition.valid = true;
        currentPosition.latitude = positionCookie.latitude;
        currentPosition.longitude = positionCookie.longitude;
        currentPosition.country = positionCookie.country;
        currentPosition.planet = positionCookie.planet;
        currentPosition.id = positionCookie.id;

        showCurrentPosition(positionCookie.latitude,positionCookie.longitude,positionCookie.country,positionCookie.planet);
    }
}

function copyCurrentLocation(isForced) 
{
    if (( isForced == false && currentModalPosition.valid == false )  || ( isForced == true ) )
    {
        currentModalPosition.valid = currentPosition.valid;
        currentModalPosition.latitude = currentPosition.latitude;
        currentModalPosition.longitude = currentPosition.longitude;
        currentModalPosition.country = currentPosition.country;
        currentModalPosition.planet = currentPosition.planet;
        currentModalPosition.id = currentPosition.id;
    }  
}

function modifyCurrentLocation() 
{
    currentPosition.valid = currentModalPosition.valid;
    currentPosition.latitude = currentModalPosition.latitude;
    currentPosition.longitude = currentModalPosition.longitude;
    currentPosition.country = currentModalPosition.country;
    currentPosition.planet = currentModalPosition.planet;
    currentPosition.id = currentModalPosition.id;

    updateCookiePart("currentPosition",currentPosition);
}

function prepareModalLocationContent() 
{    
    if (latitudeNavigator == null && longitudeNavigator == null )
    {
        defaultPosition();
    }
    else
    {
        axiosFindJsonStreetMapByCoordonate(latitudeNavigator,longitudeNavigator,updateNavigatorSuccess,updateNavigatorError);
    }
    
    showModalCurrentPosition(currentModalPosition.latitude,currentModalPosition.longitude,currentModalPosition.country,currentModalPosition.planet);

    updateLatitude(currentModalPosition.latitude);
    fillDigitsCoordinate(currentModalPosition.latitude, "code_latitude_input_","sign_latitude_input");

    updateLongitude(currentModalPosition.longitude);
    fillDigitsCoordinate(currentModalPosition.longitude, "code_longitude_input_","sign_longitude_input");

    let strCountry = (currentModalPosition.country == null) ? "..." : currentModalPosition.country;
    $('#locationPays').html(`[ ${strCountry} ]`);

    let strPlanet = (currentModalPosition.planet == null) ? "..." : currentModalPosition.planet;
    $('#locationPlanet').html(`[ ${strPlanet} ]`);

    updateMarkerToMap([currentModalPosition.latitude, currentModalPosition.longitude],currentModalPosition.country);
}

function updateId(osm_id,osm_type)
{
    if (osm_id != null && osm_type != null)
    {
        currentModalPosition.id = osm_type.substring(0, 1).toUpperCase() + osm_id;
    }
    else
    {
        currentModalPosition.id = null;
    }
    console.log(currentModalPosition.id);
}

function updateCountry(country)
{
    if (country != null)
    {
        $('#locationPays').html(`[ ${country} ]`);
        currentModalPosition.country = country;
    }
    else
    {
        $('#locationPays').html("[ ... ]");
        currentModalPosition.country = null;
    }
}

function updateModalError(error,latitude,longitude)
{
    console.log(error);
    toastr.error("Impossible de trouver une position connue !");
    updateCountry(null);
    updateId(null,null);
    inputAuto.destroy();
    updateMarkerToMap([latitude, longitude],null);
}

function updateModalSuccess(dataObject,latitude,longitude)
{
    console.log(dataObject);

    let country = null;
    let osm_id = null;
    let osm_type = null;

    if (dataObject != null && dataObject.address !== undefined && dataObject.address != null) 
        country = dataObject.address.country;

    if (dataObject != null && dataObject.osm_id !== undefined && dataObject.osm_id != null) 
        osm_id = dataObject.osm_id;

    if (dataObject != null && dataObject.osm_type !== undefined && dataObject.osm_type != null) 
        osm_type = dataObject.osm_type;

    if (country == null)
    {
        if (dataObject != null && dataObject.display_name !== undefined)
        {
            country = dataObject.display_name;
            if (country.includes(','))
            {
                let elements = country.split(',');
                country = elements.pop();
            }
        }
    }
    updateCountry(country);
    updateId(osm_id,osm_type);

    let display_name = null;
    if (dataObject != null && dataObject.display_name !== undefined)
    {
        display_name = dataObject.display_name ;
        inputAuto.rerender(display_name);
    }
    else
    {
        inputAuto.destroy();
    }
    updateMarkerToMap([latitude, longitude],display_name);
}

function updateCountryError()
{
    updateCountry(null);
    modifyCurrentLocation();
    showCurrentPosition(currentPosition.latitude,currentPosition.longitude,currentPosition.country,currentPosition.planet);
    $('#positionModal').modal('hide');
}

function updateCountrySuccess(dataObject)
{
    let country = null;
    let osm_id = null;
    let osm_type = null;

    if (dataObject != null && dataObject.address !== undefined && dataObject.address != null) 
        country = dataObject.address.country;

    if (dataObject != null && dataObject.osm_id !== undefined && dataObject.osm_id != null) 
        osm_id = dataObject.osm_id;

    if (dataObject != null && dataObject.osm_type !== undefined && dataObject.osm_type != null) 
        osm_type = dataObject.osm_type;

    if (country == null)
    {
        if (dataObject != null && dataObject.display_name !== undefined)
        {
            country = dataObject.display_name;
            if (country.includes(','))
            {
                let elements = country.split(',');
                country = elements.pop();
            }
        }
    }
    updateCountry(country);
    updateId(osm_id,osm_type);

    modifyCurrentLocation();
    showCurrentPosition(currentPosition.latitude,currentPosition.longitude,currentPosition.country,currentPosition.planet);
    $('#positionModal').modal('hide');
}

function updateNavigatorError()
{
   defaultPosition();
}

function updateNavigatorSuccess(dataObject,latitude,longitude)
{
    let country = null;

    if (dataObject != null && dataObject.address !== undefined && dataObject.address != null) 
        country = dataObject.address.country;

    if (country == null)
    {
        if (dataObject != null && dataObject.display_name !== undefined)
        {
            country = dataObject.display_name;
            if (country.includes(','))
            {
                let elements = country.split(',');
                country = elements.pop();
            }
        }
    }
    showNavigatorPosition(latitude,longitude,country,"Terre");
}

function axiosFindJsonStreetMapById(id,callbackSuccess,callbackError)
{
    let path = `https://nominatim.openstreetmap.org/lookup?osm_ids=${id}&accept-language=${language}&format=json`;
    axios.get(path).then((response) => {
        var dataObject = response.data[0];
        var error = dataObject.error;
        if (dataObject == null || (dataObject.error !== undefined && error != null)) {
            callbackError(error,latitude,longitude);
        } else {
            callbackSuccess(dataObject);
        }
    }).catch((error) => {
        console.log(error);
        callbackError(error);
    });
}

function axiosFindJsonStreetMapByCoordonate(latitude,longitude,callbackSuccess,callbackError)
{
    let path = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&zoom=${config.zoomLoc}&accept-language=${language}&format=json`;
    axios.get(path).then((response) => {
        var dataObject = response.data;
        var error = dataObject.error;
        if (dataObject == null || (dataObject.error !== undefined && error != null)) {
            callbackError(error,latitude,longitude);
        } else {
            callbackSuccess(dataObject,latitude,longitude);
        }
    }).catch((error) => {
        callbackError(error,latitude,longitude);
    });
}

function updateMarkerToMap(coord,title)
{
    if ( marker != null ) {
    map.removeLayer(marker)
    }
    let popup = (title == null) ? `lat=${coord[0].toFixed(4)} lng=${coord[1].toFixed(4)}` : title;
    marker = L.marker(coord, {
    title: popup,
    });
    marker.bindPopup(popup);
    map.addLayer(marker);
    map.setView(coord, config.zoomLoc);
}

/*
* Fonctions de gestion de la date courante
*/
function displayTimezoneOffset() {
    const now = new Date();
    const timezoneOffset = now.getTimezoneOffset(); // Récupère le décalage en minutes
    const offsetHours = timezoneOffset / 60; // Convertit le décalage en heures
    const sign = offsetHours > 0 ? "-" : "+"; // Déterminer le signe (inverse car getTimezoneOffset est inversé)
    const displayOffset = ` GMT [${sign}${Math.abs(offsetHours).toFixed(0)}]`; // Formate l'affichage

    return displayOffset;
}

function managingOverrunClock(gap)
{
    //l'horloge est suivie
    currentDate.secondes += gap;

    // Gérer le dépassement des secondes et incrémenter les minutes
    if (currentDate.secondes >= 60) {
        currentDate.secondes = 0;
        currentDate.minutes++;
    }

    // Gérer le dépassement des minutes et incrémenter les heures
    if (currentDate.minutes >= 60) {
        currentDate.minutes = 0;
        currentDate.hours++;
    }

    // Gérer le dépassement des heures et incrémenter les jours
    if (currentDate.hours >= 24) {
        currentDate.hours = 0;
        currentDate.day++;
    }

    // Gérer le dépassement des jours et incrémenter les mois
    if (currentDate.day > daysInMonth(currentDate.year, currentDate.month)) {
        currentDate.day = 1;
        currentDate.month++;
    }

    // Gérer le dépassement des mois et incrémenter les années
    if (currentDate.month > 11) {
        currentDate.month = 0;
        currentDate.year++;
    }
}

function jitterCorrectionClock(gap)
{
    currentDate.secondes += gap;
    while ( currentDate.secondes >= 60 )
    {
        if (currentDate.secondes >= 60) {
            currentDate.minutes++;
            currentDate.secondes -= 60;
        }
        if (currentDate.minutes >= 60) {
            currentDate.hours++;
            currentDate.minutes -= 60;
        }
        if (currentDate.hours >= 24) {
            currentDate.day++;
            currentDate.hours -= 24;
        }
    }
    daysInM = daysInMonth(currentDate.year, currentDate.month);
    while ( currentDate.day > daysInM )
    {
        currentDate.month++;
        currentDate.day -= daysInM;
        if (currentDate.month > 11) {
            currentDate.month = 0;
            currentDate.year++;
        }
        daysInM =  daysInMonth(currentDate.year, currentDate.month);
    }
}

function updateCurrentClock() 
{
    const now = new Date();
    let gap = (jsDateToEpoch(now) - currentDate.epoch);
    currentDate.epoch = jsDateToEpoch(now);
    if (gap > 60)
    {
        if(is_sync == "sync") 
            jitterCorrectionClock(gap);
        gap = 0;
    }
    managingOverrunClock(gap);

    updateContentClock('clock',currentDate,false);
}

function updateContentClock(id,date,isGmt) 
{
    document.getElementById(id).innerHTML = formatDateTime(date) + ((isGmt == true) ? displayTimezoneOffset() : '');
}

function formatDateTime(date) 
{
    const year = date.year;
    const month = convertMonthNumberToName(date.month,locale);
    const day = date.day.toString().padStart(2, '0');
    
    let hours = date.hours;
    const minutes = date.minutes.toString().padStart(2, '0');
    const secondes = date.secondes.toString().padStart(2, '0');

    let suffix = ' ';  // Suffixe AM/PM pour le format 12 heures
    if ( notation == "12h" )
    {
        suffix = "<small> "+ computeSuffixHours(hours) + " </small>";
        hours = computeHours(hours);
    }

    hours = hours.toString().padStart(2, '0');

    return ` ${year} / ${day} ${month} /${suffix}${hours} : ${minutes} : ${secondes} `;
}

function computeSuffixHours(hours) 
{
    return hours >= 12 ? 'PM' : 'AM';
}

function computeHours(hours) 
{
    hours = hours % 12;
    hours = hours ? hours : 12;  // Convertir "0" en "12"
    return hours;
}

function updateUniversalTimeClock() 
{
    const nowUtc = new Date();

    var utcClock = {
        "valid": true,
        "year": nowUtc.getUTCFullYear(),
        "month": nowUtc.getUTCMonth(),
        "day": nowUtc.getUTCDate(),
        "hours": nowUtc.getUTCHours(),
        "minutes": nowUtc.getUTCMinutes(),
        "secondes": nowUtc.getUTCSeconds(),
        "epoch" : jsDateToEpoch(nowUtc)
    };

    updateContentClock('clockUtcGmt',utcClock,true)
    updateContentClock('clockCurrent',currentDate,false);
}

function prepareModalContent() 
{    
    let month = convertMonthNumberToName(currentModalDate.month,locale);

    //selecteur d'élement
    document.getElementById('clockYear').textContent = `[ ${currentModalDate.year} ]`;
    document.getElementById('clockMonthDay').textContent = `[ ${currentModalDate.day.toString().padStart(2, '0')} ${month} ]`;
    let hours = currentModalDate.hours;
    let suffix = ' ';  // Suffixe AM/PM pour le format 12 heures
    if ( notation == "12h" )
    {
        suffix = "<small> "+ computeSuffixHours(hours) + " </small>";
        hours = computeHours(hours);
    }
    hours = hours.toString().padStart(2, '0');

    fillInterTime(suffix,hours,currentModalDate.minutes);

    //digit initialisation
    fillDigitsYear(currentModalDate.year,"code_year_input_","sign_year_input", 7 );
    fillDigitsTime(currentModalDate.hours,currentModalDate.minutes,"code_time_input_","prefix_time_input", 4 );
    fillDigitsDay(currentModalDate.day,"code_day_input_", 2 );
    fillDigitsMonth(month,"month_day_input");
}

function copyCurrentDate(isForced) 
{
    if (( isForced == false && currentModalDate.valid == false )  || ( isForced == true ) )
    {
        currentModalDate.valid = currentDate.valid;
        currentModalDate.year = currentDate.year;
        currentModalDate.month = currentDate.month;
        currentModalDate.day = currentDate.day;
        currentModalDate.hours = currentDate.hours;
        currentModalDate.minutes = currentDate.minutes;
        currentModalDate.secondes = currentDate.secondes;
    }  
}

function modifyCurrentDate() 
{
    const now = new Date();
    currentDate.valid = currentModalDate.valid;
    currentDate.year = currentModalDate.year;
    currentDate.month = currentModalDate.month;
    currentDate.day = currentModalDate.day;
    currentDate.hours = currentModalDate.hours;
    currentDate.minutes = currentModalDate.minutes;
    currentDate.secondes = now.getSeconds();

    updateCookiePart("currentDate",currentDate);
}

function resetCurrentDate() 
{
    const now = new Date();
    currentModalDate.year = now.getFullYear();
    currentModalDate.month = now.getMonth();
    currentModalDate.day = now.getDate();
    currentModalDate.hours = now.getHours();
    currentModalDate.minutes = now.getMinutes();
}

function jsDateToEpoch(d) {
    // d = javascript date obj
    // returns epoch timestamp
    return (d.getTime()-d.getMilliseconds())/1000;
}

function setCurrentDate() {
    const dateCookie = getCurrentDateFromCookie();

    if ( dateCookie == null || dateCookie.valid == false )
    {
        const now = new Date();
        currentDate.valid = true;
        currentDate.year = (currentDate.year == null ) ? now.getFullYear() :  currentDate.year ;
        currentDate.month = (currentDate.month == null ) ? now.getMonth() : currentDate.month;
        currentDate.day = (currentDate.day == null ) ? now.getDate() : currentDate.day;
        currentDate.hours = (currentDate.hours == null ) ? now.getHours() : currentDate.hours;
        currentDate.minutes = (currentDate.minutes == null ) ? now.getMinutes() : currentDate.minutes;
        currentDate.secondes = (currentDate.secondes == null ) ? now.getSeconds() : currentDate.secondes;
        currentDate.epoch = (currentDate.epoch == null ) ? jsDateToEpoch(now) : currentDate.epoch; ;
    }
    else
    {
        currentDate.valid = true;
        currentDate.year = (currentDate.year == null ) ? dateCookie.year :  currentDate.year ;
        currentDate.month = (currentDate.month == null ) ? dateCookie.month : currentDate.month;
        currentDate.day = (currentDate.day == null ) ? dateCookie.day : currentDate.day;
        currentDate.hours = (currentDate.hours == null ) ? dateCookie.hours : currentDate.hours;
        currentDate.minutes = (currentDate.minutes == null ) ? dateCookie.minutes : currentDate.minutes;
        currentDate.secondes = (currentDate.secondes == null ) ? dateCookie.secondes : currentDate.secondes;
        currentDate.epoch =  (currentDate.epoch == null ) ? dateCookie.epoch : currentDate.epoch;
    }
}

function setupHoverHandlers(prefix, descriptor) {
    $(`input[id^="${prefix}"]`).hover(
        function() { // mouseenter
            hoverMouseEnter(this,descriptor);
        },
        function() { // mouseleave
            hoverMouseLeave(this,descriptor);
        }
    );
}

function setupPasteHandlers(prefix, descriptor) {
    $(`input[id^="${prefix}"]`).on('paste', function(event) {
        event.preventDefault();
        var pasteText = event.originalEvent.clipboardData.getData('text');
        if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
        let codeTouche = pasteText.charCodeAt(0);
        event.key = pasteText;
        let id = $(this).attr('id').replace(prefix +'_', '');
        let valueMax= parseInt($(this).attr('data-max'));
        applyCode(this,codeTouche,event,descriptor,parseInt(id) + 1,0,valueMax);
    });
}

function hoverMouseEnter(inputElement,type) 
{
    let valueTop = parseInt($(inputElement).val()) - 1;
    let valueBottom =  parseInt($(inputElement).val()) + 1;
    let id = $(inputElement).attr('id').replace('code_'+type+'_input_', '');
    let valueMax= parseInt($(inputElement).attr('data-max'));
    idHover[type] = id;
    let showTop = (valueTop >= 0);
    let showBottom = (valueBottom < (valueMax + 1));
    updatePeripheralDigit(type,id, showTop, showBottom, valueTop ,valueBottom);
}

function hoverMouseLeave(inputElement,type) 
{
    let id = $(inputElement).attr('id').replace('code_'+type+'_input_', '');
    idHover[type]  = 0;
    updatePeripheralDigit(type,id, false, false, 0 ,0);
}


function fillDigitsYear(number, prefixCode,prefixSign,maxDigits) 
{
    if (!Number.isInteger(number) || isNaN(number)) {
        return;
    }

    // Gérer les nombres négatifs en convertissant le nombre en valeur absolue
    const sign = (number < 0) ? "-" : "+";
    const absNumber = Math.abs(number);
    let digits = absNumber.toString().padStart(maxDigits, '0');

    // Assurer que le nombre n'a pas plus de maxDigits 
    if (digits.length > maxDigits) {
        digits = "9999999"
    }
    
    // Initialiser l'index de l'input à partir duquel commencer à remplir
    let inputIndex = maxDigits;

    // Remplir les champs d'entrée avec les chiffres du nombre en ordre inverse
    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefixCode + inputIndex).value = digits[i];
        inputIndex--;
    }

    // initialisation du signe 
    document.getElementById(prefixSign).value = sign;
}

function fillDigitsTime(numberHours,numberMinutes, prefixCode, prefixSuffix , maxDigits ) 
{
    if (!Number.isInteger(numberHours) || isNaN(numberHours)) {
        return;
    }
    if (!Number.isInteger(numberMinutes) || isNaN(numberMinutes)) {
        return;
    }

    if (numberHours >= 24 || numberHours < 0) numberHours = 0;
    if (numberMinutes >= 60 || numberHours < 0) numberMinutes = 0;
  
    let suffix = ' ';  // Suffixe AM/PM pour le format 12 heures
    if ( notation == "12h" )
    {
        suffix = computeSuffixHours(numberHours);
        numberHours = computeHours(numberHours);
        $('#prefix_time').css("display","block");
        $('#prefix_time_ensp').css("display","block");
        $('#'+prefixSuffix).val(suffix);
        suffix = "<small> "+ suffix + " </small>";
    }
    else{
        $('#prefix_time').css("display","none");
        $('#prefix_time_ensp').css("display","none");
    }

    let digits = numberHours.toString().padStart(2, '0') + numberMinutes.toString().padStart(2, '0');
    let inputIndex = maxDigits;

    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefixCode + inputIndex).value = digits[i];
        inputIndex--;
    }
}

function fillDigitsDay(numberDays, prefixCode , maxDigits ) 
{
    if (!Number.isInteger(numberDays) || isNaN(numberDays)) {
        return;
    }

    if (numberDays >= 32 || numberDays < 0) numberDays = 1;

    let digits = numberDays.toString().padStart(2, '0')
    let inputIndex = maxDigits;

    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefixCode + inputIndex).value = digits[i];
        inputIndex--;
    }
}

function fillDigitsMonth(month , prefixMonth)
{
    document.getElementById(prefixMonth).value = month;
}

function fillInterTime(suffix , hours , minutes)
{
    $('#clockTime').html('['+ suffix + hours.toString().padStart(2, '0') + ' : '+ minutes.toString().padStart(2, '0') + ' ]'); 
}


function fillDigitsCoordinate(number, prefixCode,prefixSign) 
{
    if (isNaN(number)) {
        return;
    }

    // Gérer les nombres négatifs en convertissant le nombre en valeur absolue
    const sign = (number < 0) ? "-" : "+";
    

    const absNumber = Math.abs(number).toFixed(4);
    if(absNumber >= 180.0) absNumber = 180.0;

    let entier = absNumber.toString().split('.')[0].padStart(3, '0');
    let floatant = absNumber.toString().split('.')[1].padStart(4, '0');
    let digits = entier + floatant;
    
    // Initialiser l'index de l'input à partir duquel commencer à remplir
    let inputIndex = 7;

    // Remplir les champs d'entrée avec les chiffres du nombre en ordre inverse
    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefixCode + inputIndex).value = digits[i];
        inputIndex--;
    }

    // initialisation du signe 
    document.getElementById(prefixSign).value = sign;
}

/* Mise à jour du champ année final que l'utilisateur 
pourra ensuite appliquer à la date courante*/
function updateFinalValue(type) 
{
    if (type == 'year')
    {
        var numberStringYear = '';
        $('input[id^=code_'+type+'_input]').each(function() {
            numberStringYear += $(this).val(); 
        });

        var numberStringDay = '';
        $('input[id^=code_day_input]').each(function() {
            numberStringDay += $(this).val(); 
        });

        let year = parseInt(numberStringYear);
        let month = $('#month_day_input').val();
        let sign = $('#sign_'+type+'_input').val();
        let day = parseInt(numberStringDay);
        updateYearMonthDay(year,sign,month,day);
    }
    else if (type == 'time')
    {   
        var numberString = '';
        $('input[id^=code_'+type+'_input]').each(function() {
            numberString += $(this).val();
        });
        
        let hours = 0;
        hours = parseInt(numberString.substring(0,2));
        let minutes = parseInt(numberString.substring(2,4));
        if (minutes >= 60) minutes = 59;
        currentModalDate.minutes = minutes;

        let suffix = ' '; 
        if ( notation == "12h" )
        {
            suffix = "<small> "+ $('#prefix_time_input').val() + " </small>";
            hours = computeHours(hours);
            currentModalDate.hours = hours + (($('#prefix_time_input').val() == "PM") ? 12 : -12 );
            if (currentModalDate.hours >= 24) currentModalDate.hours -= 12;
            if (currentModalDate.hours < 0) currentModalDate.hours += 12;
        }
        else
        {
            if (hours >= 24) hours = 23;
            currentModalDate.hours = hours;
        }
        
        fillInterTime(suffix,hours,minutes);
      
    }
    else if (type == 'day')
    {  
        var numberStringDay = '';
        $('input[id^=code_'+type+'_input]').each(function() {
            numberStringDay += $(this).val();
        });
        
        var numberStringYear = '';
        $('input[id^=code_year_input]').each(function() {
            numberStringYear += $(this).val();
        });
        let year = parseInt(numberStringYear);
        let month = $('#month_'+type+'_input').val();
        let day = parseInt(numberStringDay);
        let sign = $('#sign_year_input').val();

        updateYearMonthDay(year,sign,month,day);
    }
    else if ( type == 'latitude' )
    {
        updateLatitude(computeDigitToFloat(type));
        updateCountry(null);
        updateId(null,null);
    }
    else if ( type == 'longitude' )
    {
        updateLongitude(computeDigitToFloat(type));
        updateCountry(null);
        updateId(null,null);
    }
}

function computeDigitToFloat(type) 
{
    var numberString = '';
    var cntDigit = 0;
    $('input[id^=code_'+type+'_input]').each(function() {
        if (cntDigit==3) numberString += '.';
        numberString += $(this).val(); 
        cntDigit++;
    });

    let value = parseFloat(numberString);
    let sign = $('#sign_'+type+'_input').val();

    return value * ((sign == '+')? 1 : -1 );
}


function daysInMonth(year,month) 
{
    let lastDayOfMonth = 0;
    if (month == 0 || month == 2 || month == 4 || month == 6 
        || month == 7 || month == 9 || month == 11 )
    {
        lastDayOfMonth = 31;
    }
    else if ( month == 3 || month == 5 || month == 8  || month == 10 )
    {
        lastDayOfMonth = 30;
    }
    else if (month == 1 )
    {
        if (isLeapYear(year)) lastDayOfMonth = 29;
        else lastDayOfMonth = 28;
    }
    return lastDayOfMonth;
}

function updateYearMonthDay(year,sign,month,day) 
{
    let monthValue = getMonthNumberFromName(month,locale) ;
    let lastDayOfMonth = daysInMonth(year,monthValue);
    if (day > lastDayOfMonth) day = lastDayOfMonth;
    if (day == 0) days = 1;
    
    $('#clockMonthDay').html('[ '+ day.toString().padStart(2, '0') + ' '+month+' ]');

    if (sign == "-") year *= -1; 
    $('#clockYear').html('[ '+ parseInt(year) + ' ]');

    currentModalDate.year = parseInt(year);
    currentModalDate.month = monthValue;
    currentModalDate.day = day;
}

function convertCoordonateFloatToString(distance,dirA,dirB,encapsulated = true)
{
    if (distance > 180.0) distance = 180.0;
    if (distance < -180.0) distance = -180.0;

    const dir = ((distance >= 0)? dirA : dirB ); 
    const [integerPart, decimalPart] = Math.abs(distance).toFixed(4).split('.'); // Séparation en partie entière et décimale
    const formattedIntegerPart = integerPart.padStart(3, '0'); // Padding pour la partie entière
    const formatted = `${formattedIntegerPart}.${decimalPart}`; // Reconstitution du nombre avec la partie décimale

    return (encapsulated == true) ? `[ ${formatted}° ${dir} ]` :  `${formatted}° ${dir}`;
}

function updateLatitude(latitude)
{
    $('#locationLatitude').html(convertCoordonateFloatToString(latitude,"N","S"));
    currentModalPosition.latitude = latitude;
}

function updateLongitude(longitude)
{
    $('#locationLongitude').html(convertCoordonateFloatToString(longitude,"E","O"));
    currentModalPosition.longitude = longitude;
}

function isLeapYear(year) {
    if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0) {
        return true;  // L'année est bissextile
    } else {
        return false;
    }
}

/* Mise à jour de la valeur de l'input passe en paramètre , puis mise à jour de la valeur finale,
puis mise à jour de l'affichage des chiffre périphèrique en haut 
et en bas si la souris est dessus en survol sinon pas besoin  */
function setValueInput(inputElement,value,type) 
{
    inputElement.value = value;
    updateFinalValue(type);
    
    let valueTop = parseInt(value) - 1;
    let valueBottom =  parseInt(value) + 1;
    let id = $(inputElement).attr('id').replace('code_'+type+'_input_', '');
    let valueMax =  parseInt($(inputElement).attr('data-max'));
    if (id == idHover[type])
    {
        let showTop = (valueTop >= 0);
        let showBottom = (valueBottom < (valueMax + 1));
        updatePeripheralDigit(type,id, showTop, showBottom, valueTop ,valueBottom);
    }
}

function setValueInputSign(inputElement,value,type) 
{
    inputElement.value = value;
    updateFinalValue(type);

    let showTop = (value == "-");
    let showBottom = (value == "+");
    updatePeripheralDigit(type,'sign',showTop,showBottom,"+","-");
}

function setValueInputPrefix(inputElement,value) 
{
    inputElement.value = value;
    updateFinalValue('time');

    let showTop = (value == "AM");
    let showBottom = (value == "PM");
    updatePeripheralDigit('time','prefix',showTop,showBottom,"PM","AM");
}

function setValueInputMonth(inputElement,value,maxValue) 
{
    inputElement.value = convertMonthNumberToName(value,locale);
    updateFinalValue('day');

    let valueTop = parseInt(value) - 1;
    let valueBottom =  parseInt(value) + 1;

    let showTop = (valueTop >= 0);
    let showBottom = (valueBottom < (maxValue + 1));

    updatePeripheralDigit('day','month',showTop,showBottom,
        convertMonthNumberToName(valueTop,locale),
        convertMonthNumberToName(valueBottom,locale));
}

/* Changement de l'effet de persitance des valeur 
    possible en haut et en bas */
function updatePeripheralDigit(type,id,showTop,showBottom,valueTop,valueBottom) {

    $('.input-wrapper .top-text-'+type+'-'+id).css("visibility","hidden");
    $('.input-wrapper .bottom-text-'+type+'-'+id).css("visibility","hidden");
    $('.input-wrapper .top-text-'+type+'-'+id).css("opacity","0"); 
    $('.input-wrapper .bottom-text-'+type+'-'+id).css("opacity","0"); 

    if (showTop)
    {
        $('.input-wrapper .top-text-'+type+'-'+id).css("visibility","visible");
        $('.input-wrapper .top-text-'+type+'-'+id).html(valueTop);
        $('.input-wrapper .top-text-'+type+'-'+id).css("opacity","1"); 
    }
    if (showBottom)
    {
        $('.input-wrapper .bottom-text-'+type+'-'+id).css("visibility","visible");
        $('.input-wrapper .bottom-text-'+type+'-'+id).html(valueBottom);
        $('.input-wrapper .bottom-text-'+type+'-'+id).css("opacity","1");
    }
}

function applyCode(inputElement,codeTouche,event,type,pos,max,maxValue) 
{
    if ((codeTouche >= 48 && codeTouche <= (48 + maxValue)) || // Chiffres (0-9)
        (codeTouche >= 96 && codeTouche <= (96 + maxValue)) || // Pavé numerique (0-9)
        codeTouche === 8 || // Touche "Retour arrière" (Backspace)
        codeTouche === 9 || // Touche "Tabulation"
        codeTouche === 46) { // Touche "Supprimer" (Delete)
    
        if (codeTouche === 8 || codeTouche === 46)
        {
            setValueInput(inputElement,0,type);
            if ((pos-2) == 0) pos = max+2;
            $("#code_"+type+"_input_"+(pos-2)).focus();
        }
        else if (codeTouche != 9)
        {
            var lastChar = inputElement.value.slice(-1);
            var regex = /^[0-9]$/;
            if (!regex.test(lastChar)) {
                // Supprimer la dernière touche entrée si elle n'est pas valide
                setValueInput(inputElement,inputElement.value.slice(0, -1),type);
            }
            else
            {
                setValueInput(inputElement,event.key,type);
                $("#code_"+type+"_input_"+pos).focus();
            }
        }
    }
    else {
        setValueInput(inputElement,0,type);
        event.preventDefault(); // Empêcher l'action par défaut pour les autres touches
    }
}

function applySign(inputElement,codeTouche,event,type) 
{
    if (event.key === '+' || event.key === '-') {
        setValueInputSign(inputElement,event.key,type);
    } 
    else if (codeTouche != 9)
    {
        setValueInputSign(inputElement,"+",type);
        event.preventDefault(); // Empêcher l'action par défaut pour les autres touches
    }
}

function touchCode(inputElement,event,type,pos,max,maxValue) 
{
    // Récupérer le code de la touche appuyée
    var codeTouche = event.keyCode || event.which;
    if (codeTouche != 16) // Touche "Maj enfoncée"
    {
        applyCode(inputElement,codeTouche,event,type,pos,max,maxValue);
    }
}

/* Gestionnaire d'appui sur les touche du clavier pour les touche + et - du clavier */
function touchSign(inputElement, event, type) 
{
    var codeTouche = event.keyCode || event.which;
    if (codeTouche != 16) // Touche "Maj enfoncée"
    {
        applySign(inputElement,codeTouche,event,type);
    }
}

function getMonthNumberFromName(monthName, locale) {
    // Essayer tous les mois de l'année jusqu'à ce que le nom correspondant soit trouvé
    for (let month = 0; month < 12; month++) {
        let date = new Date(2020, month, 1);
        let formatter = new Intl.DateTimeFormat(locale, { month: "long" });
        if (formatter.format(date).toLowerCase() === monthName.toLowerCase()) {
            return month; 
        }
    }
    return undefined; // Retourner undefined si aucun mois ne correspond
}

function convertMonthNumberToName(monthNumber, locale) {
    // Créer une date avec l'année arbitraire 2020 et le mois spécifié (mois - 1 car Date utilise des indices de mois de 0 à 11)
    let date = new Date(2020, monthNumber, 1);

    // Créer un formateur de date avec la locale spécifiée et le format long pour le mois
    let formatter = new Intl.DateTimeFormat(locale, { month: 'long' });

    // Retourner le mois formaté selon la locale
    return formatter.format(date).toLowerCase();
}

/* Gestionnaire de modification de la mollette de la souris */
function adjustOnScroll(event, inputElement,base,type) 
{
    event.preventDefault();
    const delta = event.deltaY;

    // Définir un seuil pour rendre le défilement moins sensible
    const threshold = 50; // La valeur du seuil peut être ajustée en fonction de la sensibilité désirée

    if (Math.abs(delta) < threshold) {
        return; // Ignore les petits défilements
    }

    if (base == 'code')
    {
        let currentValue = parseInt(inputElement.value, 10);

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        let valueMax = parseInt($(inputElement).attr('data-max'));

        // Contrôler les limites de la valeur
        if (currentValue < 0) currentValue = 0;
        if (currentValue > valueMax) currentValue = valueMax;

        setValueInput(inputElement,currentValue,type,valueMax);
    } 
    else if (base == 'sign')
    {
        let currentValue = 0;

        if (inputElement.value == "-") currentValue = 0;
        if (inputElement.value == "+") currentValue = 1;

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        // Contrôler les limites de la valeur
        if (currentValue < 0) setValueInputSign(inputElement,"+",type);
        if (currentValue > 1) setValueInputSign(inputElement,"-",type);
    }
    else if (base == 'month')
    {
        let currentValue = getMonthNumberFromName(inputElement.value,locale) ;

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        let valueMax = parseInt($(inputElement).attr('data-max'));

        // Contrôler les limites de la valeur
        if (currentValue < 0) currentValue = 0;
        if (currentValue > valueMax) currentValue = valueMax;

        setValueInputMonth(inputElement,currentValue,valueMax);
    }
    else if (base == 'prefix')
    {
        let currentValue = 0;

        if (inputElement.value == "AM") currentValue = 0;
        if (inputElement.value == "PM") currentValue = 1;

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        // Contrôler les limites de la valeur
        if (currentValue < 0) setValueInputPrefix(inputElement,"PM");
        if (currentValue > 1) setValueInputPrefix(inputElement,"AM");
    }
}

function setLanguage(lang) {
    let loc = null;
    if (document.getElementById("header-lang-img")) {
        if (lang == 'fr') {
            loc = "fr-FR";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/french.jpg";
        } 
        else if (lang == 'en') {
            loc = "en-US";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/us.jpg";
        } 
        else if (lang == 'sp') {
            loc = "es-ES";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/spain.jpg";
        }
        else if (lang == 'gr') {
            loc = "de-DE";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/germany.jpg";
        }
        else if (lang == 'it') {
            loc = "it-IT";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/italy.jpg";
        }
        else if (lang == 'ru') {
            loc = "ru-RU";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/russia.jpg";
        }
        else{
            loc = "en-US";
            lang = 'en';
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/us.jpg";
        }
        language = lang;
        updateCookiePart("language",lang);
        locale = loc;
        updateCookiePart("locale",locale);
        getLanguage();
    }
}

// Multi language setting
function getLanguage() {
    (language == null) ? setLanguage(config.default_lang) : false;
    $.getJSON('themes/'+config.theme+'/assets/lang/' + language + '.json', function (lang) {
        $('html').attr('lang', language);
        $.each(lang, function (index, val) {
            $("[key='" + index + "']").html(val);
        });
        updateCurrentClock();
    });
}

function updateThemeSetting(id) {
    if (id === "light-mode-switch") {
        $("#bootstrap-style").attr('href', 'themes/'+config.theme+'/assets/css/bootstrap.min.css');
        $("#app-style").attr('href', 'themes/'+config.theme+'/assets/css/app.min.css');
    } else if ( id === "dark-mode-switch") {
        $("#bootstrap-style").attr('href', 'themes/'+config.theme+'/assets/css/bootstrap-dark.min.css');
        $("#app-style").attr('href', 'themes/'+config.theme+'/assets/css/app-dark.min.css');
    }
}

/*https://stackoverflow.com/questions/1043339/javascript-for-detecting-browser-language-preference*/
var getFirstBrowserLanguage = function () 
{
    var nav = window.navigator,
    browserLanguagePropertyKeys = ['language', 'browserLanguage', 'systemLanguage', 'userLanguage'],
    i,
    language;

    // support for HTML 5.1 "navigator.languages"
    if (Array.isArray(nav.languages)) {
        for (i = 0; i < nav.languages.length; i++) {
        language = nav.languages[i];
        if (language && language.length) {
            return language;
        }
        }
    }

    // support for other well known properties in browsers
    for (i = 0; i < browserLanguagePropertyKeys.length; i++) {
        language = nav[browserLanguagePropertyKeys[i]];
        if (language && language.length) {
        return language;
        }
    }

    return null;
};

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

(function ($) {

    'use strict';

    function initLanguage() 
    {
        // Auto Loader
        locale = getLocalFromCookie();
        language = getLanguageFromCookie();

        //format possible fr ou fr-FR
        const langueNavigator = getFirstBrowserLanguage().substring(0, 2);
        
        if (language != null && language !== config.default_lang)
        {
            setLanguage(language);
        }
        else  if (language == null && langueNavigator !== config.default_lang)
        {
            setLanguage(langueNavigator);
        }
        else if (language == null && langueNavigator == config.default_lang)
        {
            locale = config.default_loc;
            language = config.default_lang;
        }

        $('.language').on('click', function (e) {
            setLanguage($(this).attr('data-lang'));
        });
    }

    function initSettings() 
    {
        is_visited = getThemeFromCookie();
        if (is_visited != null && is_visited !== config.default_theme)
        {
            updateThemeSetting(is_visited);
        }
    }

    function initDate() 
    {
        setCurrentDate();
        // Mise à jour de l'horloge chaque seconde
        setInterval(updateCurrentClock, 1000);
        updateCurrentClock();

        $('#datetimeModal').on('show.bs.modal', function(event) {
            copyCurrentDate(false);
            prepareModalContent();
            setInterval(updateUniversalTimeClock, 1000);
            updateUniversalTimeClock();
        });
    
        $('#datetimeModal').on('show.bs.modal', function(event) {
            copyCurrentDate(false);
            prepareModalContent();
            setInterval(updateUniversalTimeClock, 1000);
            updateUniversalTimeClock();
        });

        $('button[id^="btClock"]').click(function() 
        {
            $('h2[id^="clock"]').removeClass('active');
            $('div[id^="modifClock"]').css("display", "none");
    
            if ( $(this).attr('id') == "btClockErase" )
            {
                copyCurrentDate(true);
                prepareModalContent();
            }
            else if ( $(this).attr('id') == "btClockReset" )
            {
                resetCurrentDate();
                prepareModalContent();
            }
            else if ( $(this).attr('id') == "btClockModify" )
            {
                modifyCurrentDate();
                updateContentClock('clock',currentDate,false);
                $('#datetimeModal').modal('hide');
            }
            else
            {
                $('#clock'+ $(this).attr('id').replace('btClock', '')).addClass('active');
                $('#modifClock'+ $(this).attr('id').replace('btClock', '')).css("display", "block");
            }
        });
    
        setupHoverHandlers('code_day_input', 'day');
        setupHoverHandlers('code_time_input', 'time');
        setupHoverHandlers('code_year_input', 'year');
    
        setupPasteHandlers('code_year_input', 'year');
        setupPasteHandlers('code_year_input', 'time');
        setupPasteHandlers('code_year_input', 'day');
    
        $('#month_day_input').hover(
            function() { // mouseenter
    
                let valueMax= parseInt($(this).attr('data-max'));
                let currentValue = getMonthNumberFromName($(this).val(),locale) ;
                let valueTop = currentValue - 1;
                let valueBottom = currentValue + 1;
            
                let showTop = (valueTop >= 0);
                let showBottom = (valueBottom < (valueMax + 1));
            
                updatePeripheralDigit('day','month',showTop,showBottom,
                    convertMonthNumberToName(valueTop,locale),
                    convertMonthNumberToName(valueBottom,locale));
            },
            function() { // mouseleave
                updatePeripheralDigit('day','month', false, false, 0 , 0);
            }
        );
    
        $('#sign_year_input').hover(
            function() { // mouseenter
                let showTop = ($(this).val() == "-");
                let showBottom = ($(this).val() == "+");
                updatePeripheralDigit('year','sign',showTop,showBottom,"+","-");
            },
            function() { // mouseleave
                updatePeripheralDigit('year','sign', false, false, 0 ,0);
            }
        );
    
        $('#prefix_time_input').hover(
            function() { // mouseenter
                let showTop = ($(this).val() == "AM");
                let showBottom = ($(this).val() == "PM");
                updatePeripheralDigit('time','prefix',showTop,showBottom,"PM","AM");
            },
            function() { // mouseleave
                updatePeripheralDigit('time','prefix', false, false, 0 ,0);
            }
        );
    
        $('#sign_year_input').on('paste', function(event) {
            event.preventDefault();
            var pasteText = event.originalEvent.clipboardData.getData('text');
            if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
            let codeTouche = pasteText.charCodeAt(0);
            event.key = pasteText;
            applySign(this,codeTouche,event,'year');
        });
    }

    function initLocation() 
    {
        setCurrentPosition();

        setupHoverHandlers('code_latitude_input', 'latitude');
        setupHoverHandlers('code_longitude_input', 'longitude');
    
        setupPasteHandlers('code_latitude_input', 'latitude');
        setupPasteHandlers('code_longitude_input', 'longitude');

        $('#sign_latitude_input').hover(
            function() { // mouseenter
                let showTop = ($(this).val() == "-");
                let showBottom = ($(this).val() == "+");
                updatePeripheralDigit('latitude','sign',showTop,showBottom,"+","-");
            },
            function() { // mouseleave
                updatePeripheralDigit('latitude','sign', false, false, 0 ,0);
            }
        );

        $('#sign_latitude_input').on('paste', function(event) {
            event.preventDefault();
            var pasteText = event.originalEvent.clipboardData.getData('text');
            if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
            let codeTouche = pasteText.charCodeAt(0);
            event.key = pasteText;
            applySign(this,codeTouche,event,'latitude');
        });

        $('#sign_longitude_input').hover(
            function() { // mouseenter
                let showTop = ($(this).val() == "-");
                let showBottom = ($(this).val() == "+");
                updatePeripheralDigit('longitude','sign',showTop,showBottom,"+","-");
            },
            function() { // mouseleave
                updatePeripheralDigit('longitude','sign', false, false, 0 ,0);
            }
        );

        $('#sign_longitude_input').on('paste', function(event) {
            event.preventDefault();
            var pasteText = event.originalEvent.clipboardData.getData('text');
            if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
            let codeTouche = pasteText.charCodeAt(0);
            event.key = pasteText;
            applySign(this,codeTouche,event,'longitude');
        });

        $('button[id^="btLocation"]').click(function() 
        {
            $('h3[id^="location"]').removeClass('active');
            $('div[id^="modifLocation"]').css("display", "none");
    
            if ( $(this).attr('id') == "btLocationNavigatorReset" )
            {
               
            }
            else if ( $(this).attr('id') == "btLocationCurrenReset" )
            {

            }
            else if ( $(this).attr('id') == "btLocationModify" )
            {
                if (currentModalPosition.id != null)
                {
                    axiosFindJsonStreetMapById(currentModalPosition.id,updateCountrySuccess,updateCountryError);
                }
                else
                {
                    axiosFindJsonStreetMapByCoordonate(currentModalPosition.latitude,currentModalPosition.longitude,updateCountrySuccess,updateCountryError);
                }
            }
            else
            {
                $('#location'+ $(this).attr('id').replace('btLocation', '')).addClass('active');
                $('#modifLocation'+ $(this).attr('id').replace('btLocation', '')).css("display", "block");
                map.invalidateSize(true);
            }
        });

        $('a[id^="updateCoord"]').click(function() {
            let latitude = computeDigitToFloat('latitude');
            let longitude = computeDigitToFloat('longitude');
            axiosFindJsonStreetMapByCoordonate(latitude,longitude,updateModalSuccess,updateModalError);
        });

        // calling map
        map = L.map("map", config.mapLeaflet).setView([lat, lng], config.zoom);
        
        // Used to load and display tile layers on the map
        L.tileLayer(`${is_basemap}`, {
            attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        inputAuto = new Autocomplete("search", {
            selectFirst: true,
            insertToInput: true,
            cache: true,
            howManyCharacters: 2,
            // onSearch
            onSearch: ({ currentValue }) => {
                // api
                const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&accept-language=${language}&city=${encodeURI(
                currentValue
                )}`;

                /**
                 * Promise
                 */
                return new Promise((resolve) => {
                    fetch(api)
                    .then((response) => response.json())
                    .then((data) => {
                        resolve(data.features);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                });
            },
        
            // nominatim GeoJSON format
            onResults: ({ currentValue, matches, template }) => {
                const regex = new RegExp(currentValue, "gi");
        
                if (matches == 0)
                {
                    if (language == "fr")
                    {
                        noresult = template.replace("No results found:","Aucun résultat:");
                    }
                    else
                    {
                        noresult = template;
                    }
                }
        
                // if the result returns 0 we
                // show the no results element
                return matches === 0
                ? noresult
                : matches
                    .map((element) => {
                        return `
                            <li>
                            <p>
                                ${element.properties.display_name.replace(
                                regex,
                                (str) => `<b>${str}</b>`
                                )}
                            </p>
                            </li> `;
                    })
                    .join("");
            },
        
            onSubmit: ({ object }) => {
                // remove all layers from the map
                map.eachLayer(function (layer) {
                if (!!layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
                });
        
                console.log(object);

                const { display_name } = object.properties;
                const { osm_id } = object.properties;
                const { osm_type } = object.properties;
                const [lng, lat] = object.geometry.coordinates;
               
                updateLatitude(lat);
                fillDigitsCoordinate(lat, "code_latitude_input_","sign_latitude_input");

                updateLongitude(lng);
                fillDigitsCoordinate(lng, "code_longitude_input_","sign_longitude_input");

                let country = display_name;
                if (display_name.includes(','))
                {
                    let elements = display_name.split(',');
                    country = elements.pop();
                }

                updateCountry(country);
                updateId(osm_id,osm_type);
                
                updateMarkerToMap([lat, lng],display_name);
            },
        
            // get index and data from li element after
            // hovering over li with the mouse or using
            // arrow keys ↓ | ↑
            onSelectedItem: ({ index, element, object }) => {
                console.log("onSelectedItem:", { index, element, object });
            },
        
            // the method presents no results
            // no results
            noResults: ({ currentValue, template }) =>
                template(`<li>No results found: "${currentValue}"</li>`),
        });

        $('#positionModal').on('shown.bs.modal', function(event) {
            //resize the map - this is the important part for you
            copyCurrentLocation(false);
            prepareModalLocationContent();
            map.invalidateSize(true);
        });

    }


    function initConfiguration()
    {
        notation = getNotationFromCookie();
        is_visited = getThemeFromCookie();
        is_basemap = getBaseMapFromCookie();   
        is_sync = getSyncFromCookie();

        $('#configurationModal').on('show.bs.modal', function(event) {
            $('#selectNotation').val(notation);
            $('#selectTheme').val(is_visited);
            $('#selectCarto').val(is_basemap);
            $('#selectSync').val(is_sync);
        });

        $('#btConfigModify').click(function() 
        {
            notation = $('#selectNotation').val();
            is_visited = $('#selectTheme').val();
            is_basemap = $('#selectCarto').val();
            is_sync = $('#selectSync').val();

            updateCookiePart("theme",is_visited);
            updateCookiePart("notation",notation);
            updateCookiePart("basemap",is_basemap);
            updateCookiePart("sync",is_sync);
            updateThemeSetting(is_visited);
            updateCurrentClock();

            $('#configurationModal').modal('hide');
        });
    }

    function init() 
    {
        const moobotecCookie = getMoobotecFromCookie();
        if ( moobotecCookie == null )
        {
            setTimeout(function() {
                prepareModalCookie(false);
            }, 500);
        }

        $('#btResetCookies').click(function() 
        {
            $('#configurationModal').modal('hide');
            prepareModalCookie(true);
        });
       
        initSettings();
        initLanguage();
        initConfiguration();
        initDate();
        initLocation();
    }

    init();

})(jQuery)
