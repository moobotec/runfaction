
function defaultPosition() {
    showNavigatorPosition(null,null,null,null);
}

function getPlanetCount()
{
    return getPlanetCountByIdGalaxy(currentModalPosition.galaxy);
    //return planets["data"].length;
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
        return def_suspension_points;
    }
    return planets["data"][pos][lang];
}

function getGalaxyByLangById(id,lang)
{
    let pos = parseInt(id);
    if (!Number.isInteger(pos) || isNaN(pos)) {
        return def_suspension_points;
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
    const north = getCPUDByLangBySign("+",language); // N ou S
    const south = getCPUDByLangBySign("-",language); // N ou S

    const east = getCPLRByLangBySign("+",language); // E ou W
    const west = getCPLRByLangBySign("-",language); // E ou W

    let strLatitude = (latitude == null) ? "000.0000° N" : convertCoordonateFloatToString(latitude,north,south,false);
    let strLongitude = (longitude == null) ? "000.0000° N" : convertCoordonateFloatToString(longitude,east,west,false);
    let strCountry = (country == null) ? def_suspension_points : country;
    let strPlanet = (planet == null) ? def_suspension_points : getPlanetByLangById(planet,language);

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

function updateCurrentPosition() 
{
    if ( ( currentPosition != null && currentPosition.valid == false ) || currentPosition == null  )
    {
        showCurrentPosition(null,null,null,null);
    }
    else
    {
        const hasCarto = hasCartoPlanetByLangById(currentPosition.planet);
        if (hasCarto == 'true')
        {
            let ret = axiosFindJsonStreetMapById(currentPosition.id,updateSuccess,updateError);
            if ( ret == false) updateError();
        }
        else
        {
            
            showCurrentPosition(currentPosition.latitude,currentPosition.longitude,currentPosition.country,currentPosition.planet);
        }
    }
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
    showCurrentPosition(currentPosition.latitude,currentPosition.longitude,country,currentPosition.planet);
    currentPosition.country = country;
}

function updateError()
{
    showCurrentPosition(currentPosition.latitude,currentPosition.longitude,null,currentPosition.planet);
}

function setCurrentPosition() 
{
    const positionCookie = getCurrentPositionFromCookie();

    if ( positionCookie == null || positionCookie.valid == false )
    {
        currentPosition.valid = false;
        currentPosition.latitude = null;
        currentPosition.longitude = null;
        currentPosition.country = null;
        currentPosition.planet = null;
        currentPosition.galaxy = null;
        currentPosition.id = null;
    }
    else
    {    
        currentPosition.valid = true;
        currentPosition.latitude = positionCookie.latitude;
        currentPosition.longitude = positionCookie.longitude;
        currentPosition.country = positionCookie.country;
        currentPosition.planet = positionCookie.planet;
        currentPosition.galaxy = positionCookie.galaxy;
        currentPosition.id = positionCookie.id;
    }
}

function resetCurrentLocation() 
{
    currentModalPosition.valid = true;
    currentModalPosition.latitude = navigatorPosition.latitude;
    currentModalPosition.longitude = navigatorPosition.longitude;
    currentModalPosition.country = navigatorPosition.country;
    currentModalPosition.planet = navigatorPosition.planet;
    currentModalPosition.galaxy = navigatorPosition.galaxy;
    currentModalPosition.id = navigatorPosition.id;
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
        currentModalPosition.galaxy = currentPosition.galaxy;
        currentModalPosition.id = currentPosition.id;
    }
}

function modifyCurrentLocation() 
{
    currentPosition.valid = true;
    currentPosition.latitude = currentModalPosition.latitude;
    currentPosition.longitude = currentModalPosition.longitude;
    currentPosition.country = currentModalPosition.country;
    currentPosition.planet = currentModalPosition.planet;
    currentPosition.galaxy = currentModalPosition.galaxy;
    currentPosition.id = currentModalPosition.id;

    updateCookiePart("currentPosition",currentPosition);
}

function prepareModalLocationContent() 
{    
    if (navigatorPosition != null && 
        ( (navigatorPosition.latitude == null && navigatorPosition.longitude == null) || navigatorPosition.valid == false ) )
    {
        defaultPosition();
    }
    else
    {
        axiosFindJsonStreetMapByCoordonate(navigatorPosition.latitude,navigatorPosition.longitude,updateNavigatorSuccess,updateNavigatorError);
    }
    showModalCurrentPosition(currentPosition.latitude,currentPosition.longitude,currentPosition.country,currentPosition.planet);
    updateCurrentModalLocationContent();
}

function updateCurrentModalLocationContent()
{
    updateLatitude(currentModalPosition.latitude);
    fillDigitsCoordinate(currentModalPosition.latitude, "code_latitude_input_","sign_latitude_input");

    updateLongitude(currentModalPosition.longitude);
    fillDigitsCoordinate(currentModalPosition.longitude, "code_longitude_input_","sign_longitude_input");

    let strCountry = (currentModalPosition.country == null) ? def_suspension_points : currentModalPosition.country;
    $('#locationPays').html(`[ ${strCountry} ]`);

    let strPlanet = (currentModalPosition.planet == null) ? def_suspension_points : getPlanetByLangById(currentModalPosition.planet,language);
    $('#locationPlanet').html(`[ ${strPlanet} ]`);
    document.getElementById('planet_univers_input').value = strPlanet;

    let strGalaxy = (currentModalPosition.galaxy == null) ? def_suspension_points : getGalaxyByLangById(currentModalPosition.galaxy,language);
    document.getElementById('galaxy_univers_input').value = strGalaxy;

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
        $('#locationPays').html(`[ ${def_suspension_points} ]`);
        currentModalPosition.country = null;
    }
}

function updateModalError(error,latitude,longitude)
{
    updateCountry(null);
    updateId(null,null);
    inputAuto.destroy();
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
        inputAuto.rerender(display_name);
    }
    else
    {
        inputAuto.destroy();
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
    
    const strGalaxy = getGalaxyByLangById(getIdGalaxyByString('Voie lactée','fr'),language);
    updateGalaxy(strGalaxy);
    document.getElementById('galaxy_univers_input').value = strGalaxy;
   
    const strPlanet = getPlanetByLangById(getIdPlanetByString('Terre','fr'),language);
    updatePlanet(strPlanet);
    document.getElementById('planet_univers_input').value = strPlanet;

    updateMarkerToMap([lat, lng],display_name);
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
    showNavigatorPosition(latitude,longitude,country,navigatorPosition.planet);
    navigatorPosition.country = country;
}

function axiosFindJsonStreetMapById(id,callbackSuccess,callbackError)
{
    if (id != null)
    {
        let eLang = null;
        if (language  == "sp") eLang = "es";
        else if (language  == "gr") eLang = "de";
        else eLang = language;
        let path = `https://nominatim.openstreetmap.org/lookup?osm_ids=${id}&accept-language=${eLang}&format=json`;
        axios.get(path).then((response) => {
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
        let eLang = null;
        if (language  == "sp") eLang = "es";
        else if (language  == "gr") eLang = "de";
        else eLang = language;
        let path = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&zoom=${config.zoomLoc}&accept-language=${eLang}&format=json`;        
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
        return true;
    }
    return false;
}

function updateMarkerToMap(coord,title)
{
    if (coord != null && title != null)
    {
        const lat = coord[0].toFixed(4);
        const lng = coord[1].toFixed(4);

        if ( marker != null ) {
        map.removeLayer(marker)
        }
        let popup = (title == null) ? `lat=${lat} lng=${lng}` : title;
        marker = L.marker(coord, {
        title: popup,
        });
        marker.bindPopup(popup);
        map.addLayer(marker);
        map.setView(coord, currentZoom);
    }
}

function fillDigitsCoordinate(number, prefixCode,prefixSign) 
{
    if (isNaN(number)) {
        return;
    }

    // Gérer les nombres négatifs en convertissant le nombre en valeur absolue
    const sign = (number < 0) ? "-" : "+";
    
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
    const north = getCPUDByLangBySign("+",language);
    const south = getCPUDByLangBySign("-",language);

    $('#locationLatitude').html(convertCoordonateFloatToString(latitude,north,south));
    currentModalPosition.latitude = latitude;
}

function updateLongitude(longitude)
{
    const east = getCPLRByLangBySign("+",language);
    const west = getCPLRByLangBySign("-",language);

    $('#locationLongitude').html(convertCoordonateFloatToString(longitude,east,west));
    currentModalPosition.longitude = longitude;
}

function updatePlanet(planet)
{
    let id = getIdPlanetByString(planet,language);
    $('#locationPlanet').html(`[ ${planet} ]`);
    currentModalPosition.planet = id;
}

function updateGalaxy(galaxy)
{
    let id = getIdGalaxyByString(galaxy,language);
    currentModalPosition.galaxy = id;
}



