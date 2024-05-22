
function defaultPosition() {
    showNavigatorPosition(null,null,null,null);
}

function getPlanetCount()
{
    return getPlanetCountByIdGalaxy(gCurrentModalPosition.galaxy);
}

function getGalaxyCount()
{
    return galaxys["data"].length;
}

function getIdPlanetByString(planet,lang)
{
    if (planet == null) return null;
    for (var i = 0 ; i < getPlanetCount() ; i++)
    {
        if ( planets["data"][i][lang] == planet ) return i;
    }
    return 0;
}

function getIdGalaxyByString(galaxy,lang)
{
    if (galaxy == null) return null;
    for (var i = 0 ; i < getGalaxyCount() ; i++)
    {
        if ( galaxys["data"][i][lang] == galaxy ) return i;
    }
    return 0;
}

function hasCartoPlanetByLangById(id)
{
    let pos = parseInt(id);
    if (!Number.isInteger(pos) || isNaN(pos)) {
        return 'false';
    }
    return planets["data"][pos]["carto"];
}

function getPlanetByLangById(id,lang)
{
    let pos = parseInt(id);
    if (!Number.isInteger(pos) || isNaN(pos)) {
        return gConfig.default_suspension_points;
    }
    return planets["data"][pos][lang];
}

function getGalaxyByLangById(id,lang)
{
    let pos = parseInt(id);
    if (!Number.isInteger(pos) || isNaN(pos)) {
        return gConfig.default_suspension_points;
    }
    return galaxys["data"][pos][lang];
}

function getPlanetCountByIdGalaxy(id)
{    
    const dataList = galaxyPlanets.data;
    for (let i = 0; i < dataList.length; i++) {
        const data = dataList[i];
        if (data.hasOwnProperty(id)) {
            const list = data[id];
            return list.length;
        }
    }
    return null;
}

function getFirstPlanetByIdGalaxy(id)
{    
    const firstPosition = 0;
    const dataList = galaxyPlanets.data;
    for (let i = 0; i < dataList.length; i++) {
        const data = dataList[i];
        if (data.hasOwnProperty(id)) {
            const list = data[id];
            const size = list.length;
            if (firstPosition >= 0 && firstPosition < size) {
                return list[firstPosition];
            }
        }
    }
    return null;
}

function getCPUDByLangBySign(sign,lang)
{
    const id = ( sign == "+" ) ? 0 : 1;
    return CPUD["data"][id][lang].substring(0,1);
}

function getCPLRByLangBySign(sign,lang)
{
    const id = ( sign == "+" ) ? 0 : 1;
    return CPLR["data"][id][lang].substring(0,1);
}

function convertPositionToString(latitude,longitude,country,planet) 
{
    const north = getCPUDByLangBySign("+",gLanguage); // N ou S
    const south = getCPUDByLangBySign("-",gLanguage); // N ou S

    const east = getCPLRByLangBySign("+",gLanguage); // E ou W
    const west = getCPLRByLangBySign("-",gLanguage); // E ou W

    let strLatitude = (latitude == null) ? "000.0000° N" : convertCoordonateFloatToString(latitude,north,south,false);
    let strLongitude = (longitude == null) ? "000.0000° E" : convertCoordonateFloatToString(longitude,east,west,false);
    let strCountry = (country == null) ? gConfig.default_suspension_points : country;
    let strPlanet = (planet == null) ? gConfig.default_suspension_points : getPlanetByLangById(planet,gLanguage);

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

function updateSuccess(dataObject)
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
    showCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,country,gCurrentPosition.planet);
    gCurrentPosition.country = country;
}

function updateError()
{
    showCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,null,gCurrentPosition.planet);
}

function setCurrentPosition() 
{
    const positionCookie = getCurrentPositionFromCookie();

    if ( positionCookie == null || positionCookie.valid == false )
    {
        gCurrentPosition.valid = false;
        gCurrentPosition.latitude = null;
        gCurrentPosition.longitude = null;
        gCurrentPosition.country = null;
        gCurrentPosition.planet = null;
        gCurrentPosition.galaxy = null;
        gCurrentPosition.id = null;
    }
    else
    {    
        gCurrentPosition.valid = true;
        gCurrentPosition.latitude = positionCookie.latitude;
        gCurrentPosition.longitude = positionCookie.longitude;
        gCurrentPosition.country = positionCookie.country;
        gCurrentPosition.planet = positionCookie.planet;
        gCurrentPosition.galaxy = positionCookie.galaxy;
        gCurrentPosition.id = positionCookie.id;
    }
}

function resetCurrentLocation() 
{
    gCurrentModalPosition.valid = true;
    gCurrentModalPosition.latitude = gNavigatorPosition.latitude;
    gCurrentModalPosition.longitude = gNavigatorPosition.longitude;
    gCurrentModalPosition.country = gNavigatorPosition.country;
    gCurrentModalPosition.planet = gNavigatorPosition.planet;
    gCurrentModalPosition.galaxy = gNavigatorPosition.galaxy;
    gCurrentModalPosition.id = gNavigatorPosition.id;
}

function copyCurrentLocation(isForced) 
{
    if (( isForced == false && gCurrentModalPosition.valid == false )  || ( isForced == true ) )
    {
        gCurrentModalPosition.valid = gCurrentPosition.valid;
        gCurrentModalPosition.latitude = gCurrentPosition.latitude;
        gCurrentModalPosition.longitude = gCurrentPosition.longitude;
        gCurrentModalPosition.country = gCurrentPosition.country;
        gCurrentModalPosition.planet = gCurrentPosition.planet;
        gCurrentModalPosition.galaxy = gCurrentPosition.galaxy;
        gCurrentModalPosition.id = gCurrentPosition.id;
    }
}

function modifyCurrentLocation() 
{
    gCurrentPosition.valid = true;
    gCurrentPosition.latitude = gCurrentModalPosition.latitude;
    gCurrentPosition.longitude = gCurrentModalPosition.longitude;
    gCurrentPosition.country = gCurrentModalPosition.country;
    gCurrentPosition.planet = gCurrentModalPosition.planet;
    gCurrentPosition.galaxy = gCurrentModalPosition.galaxy;
    gCurrentPosition.id = gCurrentModalPosition.id;

    updateCookiePart("currentPosition",gCurrentPosition);
}

function prepareModalLocationContent() 
{    
    if (gNavigatorPosition != null && 
        ( (gNavigatorPosition.latitude == null && gNavigatorPosition.longitude == null) || gNavigatorPosition.valid == false ) )
    {
        defaultPosition();
    }
    else
    {
        axiosFindJsonStreetMapByCoordonate(gNavigatorPosition.latitude,gNavigatorPosition.longitude,updateNavigatorSuccess,updateNavigatorError);
    }
    showModalCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,gCurrentPosition.country,gCurrentPosition.planet);
    updateCurrentModalLocationContent();
}

function updateCurrentModalLocationContent()
{
    updateLatitude(gCurrentModalPosition.latitude);
    fillDigitsCoordinate(gCurrentModalPosition.latitude, "code_latitude_input_","sign_latitude_input");

    updateLongitude(gCurrentModalPosition.longitude);
    fillDigitsCoordinate(gCurrentModalPosition.longitude, "code_longitude_input_","sign_longitude_input");

    let strCountry = (gCurrentModalPosition.country == null) ? gConfig.default_suspension_points : gCurrentModalPosition.country;
    $('#locationPays').html(`[ ${strCountry} ]`);

    let strPlanet = (gCurrentModalPosition.planet == null) ? gConfig.default_suspension_points : getPlanetByLangById(gCurrentModalPosition.planet,gLanguage);
    $('#locationPlanet').html(`[ ${strPlanet} ]`);
    document.getElementById('planet_univers_input').value = strPlanet;

    let strGalaxy = (gCurrentModalPosition.galaxy == null) ? gConfig.default_suspension_points : getGalaxyByLangById(gCurrentModalPosition.galaxy,gLanguage);
    document.getElementById('galaxy_univers_input').value = strGalaxy;

    updateMarkerToMap([gCurrentModalPosition.latitude, gCurrentModalPosition.longitude],gCurrentModalPosition.country);
}

function updateId(osm_id,osm_type)
{
    if (osm_id != null && osm_type != null)
    {
        gCurrentModalPosition.id = osm_type.substring(0, 1).toUpperCase() + osm_id;
    }
    else
    {
        gCurrentModalPosition.id = null;
    }
}

function updateCountry(country)
{
    if (country != null)
    {
        $('#locationPays').html(`[ ${country} ]`);
        gCurrentModalPosition.country = country;
    }
    else
    {
        $('#locationPays').html(`[ ${gConfig.default_suspension_points} ]`);
        gCurrentModalPosition.country = null;
    }
}

function updateModalError(error,latitude,longitude)
{
    updateCountry(null);
    updateId(null,null);
    gInputAuto.destroy();
    updateMarkerToMap([latitude, longitude],null);
}

function updateModalSuccess(dataObject,latitude,longitude)
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

    let display_name = null;
    if (dataObject != null && dataObject.display_name !== undefined)
    {
        display_name = dataObject.display_name ;
        gInputAuto.rerender(display_name);
    }
    else
    {
        gInputAuto.destroy();
    }
    
    updateMarkerToMap([latitude, longitude],display_name);
}

function updateCurrentModalLocation(object)
{
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
    
    const strGalaxy = getGalaxyByLangById(getIdGalaxyByString('Voie lactée','fr'),gLanguage);
    updateGalaxy(strGalaxy);
    document.getElementById('galaxy_univers_input').value = strGalaxy;
   
    const strPlanet = getPlanetByLangById(getIdPlanetByString('Terre','fr'),gLanguage);
    updatePlanet(strPlanet);
    document.getElementById('planet_univers_input').value = strPlanet;

    updateMarkerToMap([lat, lng],display_name);
}


function updateCountryError()
{
    updateCountry(null);
    modifyCurrentLocation();
    showCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,gCurrentPosition.country,gCurrentPosition.planet);
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
    showCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,gCurrentPosition.country,gCurrentPosition.planet);
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
    showNavigatorPosition(latitude,longitude,country,gNavigatorPosition.planet);
    gNavigatorPosition.country = country;
}

function axiosFindJsonStreetMapById(id,callbackSuccess,callbackError)
{
    if (id != null)
    {
        axios.get(makePathLookup(id)).then((response) => {
            var dataObject = response.data[0];
            var error = dataObject.error;
            if (dataObject == null || (dataObject.error !== undefined && error != null)) {
                callbackError(error);
            } else {
                callbackSuccess(dataObject);
            }
        }).catch((error) => {
            callbackError(error);
        });
        return true;
    }
    return false;
}



function axiosFindJsonStreetMapByCoordonate(latitude,longitude,callbackSuccess,callbackError)
{
    if (latitude != null && longitude != null)
    {
        axios.get(makePathReverse(latitude,longitude)).then((response) => {
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
        return true;
    }
    return false;
}

function updateMarkerToMap(coord,title)
{
    if (coord != null)
    {
        if ( coord[0] == null ) coord[0] = 0.0;
        if ( coord[1] == null ) coord[1] = 0.0;

        const lat = coord[0].toFixed(4);
        const lng = coord[1].toFixed(4);
        

        if ( gMarker != null ) {
            gMap.removeLayer(gMarker);
        }
        let popup = (title == null) ? `lat=${lat} lng=${lng}` : title;
        gMarker = L.marker(coord, { title: popup, });
        gMarker.bindPopup(popup);
        gMap.addLayer(gMarker);
        gMap.setView(coord, gCurrentZoom);
    }
}

function updateThrowMarkerToMap(coord,title)
{
    if (coord != null)
    {
        if ( coord[0] == null ) coord[0] = 0.0;
        if ( coord[1] == null ) coord[1] = 0.0;

        const lat = coord[0].toFixed(4);
        const lng = coord[1].toFixed(4);

        if ( gThrowMarker != null ) {
            gThrowMap.removeLayer(gThrowMarker);
        }
        let popup = (title == null) ? `lat=${lat} lng=${lng}` : title;
        gThrowMarker = L.marker(coord, { title: popup, });
        gThrowMarker.bindPopup(popup);
        gThrowMap.addLayer(gThrowMarker);
        gThrowMap.setView(coord, 3);
    }
}

function fillDigitsCoordinate(number, prefixCode,prefixSign) 
{
    if (isNaN(number)) {
        return;
    }

    const sign = ((number < 0) || Object.is(number, -0)) ? "-" : "+";

    // Gérer les nombres négatifs en convertissant le nombre en valeur absolue
    let absNumber = Math.abs(number);
    if(absNumber >= 180.0) absNumber = 180.0;

    absNumber = absNumber.toFixed(4);

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

function convertCoordonateFloatToString(distance,dirA,dirB,encapsulated = true)
{
    if (distance == null) distance = 0.0;
    if (distance > 180.0) distance = 180.0;
    if (distance < -180.0) distance = -180.0;

    const dir = (!Object.is(distance, -0) &&(distance >= 0.0)? dirA : dirB ); 

    const [integerPart, decimalPart] = Math.abs(distance).toFixed(4).split('.'); // Séparation en partie entière et décimale
    const formattedIntegerPart = integerPart.padStart(3, '0'); // Padding pour la partie entière
    const formatted = `${formattedIntegerPart}.${decimalPart}`; // Reconstitution du nombre avec la partie décimale

    return (encapsulated == true) ? `[ ${formatted}° ${dir} ]` :  `${formatted}° ${dir}`;
}

function updateLatitude(latitude)
{
    const north = getCPUDByLangBySign("+",gLanguage);
    const south = getCPUDByLangBySign("-",gLanguage);

    $('#locationLatitude').html(convertCoordonateFloatToString(latitude,north,south));
    gCurrentModalPosition.latitude = latitude;
}

function updateLongitude(longitude)
{
    const east = getCPLRByLangBySign("+",gLanguage);
    const west = getCPLRByLangBySign("-",gLanguage);

    $('#locationLongitude').html(convertCoordonateFloatToString(longitude,east,west));
    gCurrentModalPosition.longitude = longitude;
}

function updatePlanet(planet)
{
    let id = getIdPlanetByString(planet,gLanguage);
    $('#locationPlanet').html(`[ ${planet} ]`);
    gCurrentModalPosition.planet = id;
}

function updateGalaxy(galaxy)
{
    let id = getIdGalaxyByString(galaxy,gLanguage);
    gCurrentModalPosition.galaxy = id;
}



