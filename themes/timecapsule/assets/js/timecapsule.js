function expandZone(selectedZoneId) {
    
    const zones = ['zone1', 'zone2', 'zone3', 'zone4'];

    if (selectedZoneId == 'zone1') // zone ocean 
    {
        const hasCarto = hasCartoPlanetByLangById(gCurrentPosition.planet);
        if (hasCarto == "false")
        {
            let strPlanet = (gCurrentPosition.planet == null) ? gConfig.default_suspension_points : getPlanetByLangById(gCurrentPosition.planet,gLanguage);
            if (gLanguage == 'fr') {
                toastr.info('On ne peut pas jeter de bouteille à la mer sur la planète ' + strPlanet +'.');
            } 
            else if (gLanguage == 'sp') {
                toastr.info('No podemos tirar una botella al mar en el planeta' + strPlanet +'.');
            }
            else if (gLanguage == 'gr') {
                toastr.info('Wir können auf dem Planeten keine Flasche ins Meer werfen' + strPlanet +'.');
            }
            else if (gLanguage == 'it') {
                toastr.info('Non possiamo gettare una bottiglia nel mare del pianeta' + strPlanet +'.');
            }
            else if (gLanguage == 'ru') {
                toastr.info('Мы не можем бросить бутылку в море на планете' + strPlanet +'.');
            }
            else{
                toastr.info('We cannot throw a bottle into the sea on the planet ' + strPlanet +'.');
            }

            return;
        }
    }

    document.getElementById('zoneTitle').style.display = "none";

    zones.forEach(zone => {
        const element = document.getElementById(zone);
        const throwMessage = element.querySelector('.cla-throw-message');
        const digMessage = element.querySelector('.cla-dig-message');
        const spaceMessage = element.querySelector('.cla-space-message');
        const timeMessage = element.querySelector('.cla-time-message');
        const closeButton = element.querySelector('.cla-close-btn');
        const content = element.querySelector('.cla-content-zone-text');

        const h2 = element.querySelector('h2');
        if (zone === selectedZoneId) {
            element.style.flex = "1 1 100%";
            element.classList.add('col-12');
            element.classList.remove('col-6');
            element.style.height = "75vh";
            closeButton.style.display = 'block'; // Show close button
            if (typeof throwMessage != 'undefined' && throwMessage != null) throwMessage.style.display = 'block';
            if (typeof digMessage != 'undefined' && digMessage != null) digMessage.style.display = 'block';
            if (typeof spaceMessage != 'undefined' && spaceMessage != null) spaceMessage.style.display = 'block';
            if (typeof timeMessage != 'undefined' && timeMessage != null) timeMessage.style.display = 'block';
            content.style.display = 'none';
            document.getElementById('zoneTitle-'+selectedZoneId).style.display = "block";
        } else {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.style.width = "0";
            element.style.height = "0";
            element.style.opacity = "0";
            closeButton.style.display = 'none'; // Hide close button
        }
        content.style.display = 'none';
    });
}

function closeZone(event, zoneId) {

    const zones = ['zone1', 'zone2', 'zone3', 'zone4'];
    const zoneTitle = document.getElementById('zoneTitle');
    zoneTitle.style.display = "block";
    zones.forEach(zone => {
        const element = document.getElementById(zone);
        const throwMessage = element.querySelector('.cla-throw-message');
        const digMessage = element.querySelector('.cla-dig-message');
        const spaceMessage = element.querySelector('.cla-space-message');
        const timeMessage = element.querySelector('.cla-time-message');
        const closeButton = element.querySelector('.cla-close-btn');
        const content = element.querySelector('.cla-content-zone-text');

        if (zone === zoneId) {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.classList.remove('col-12');
            element.classList.add('col-6');
            element.style.flex = "0 0 50%";
            element.style.height = "38vh";
            closeButton.style.display = 'none'; // Hide close button
            if (typeof throwMessage != 'undefined' && throwMessage != null) throwMessage.style.display = 'none';
            if (typeof digMessage != 'undefined' && digMessage != null) digMessage.style.display = 'none';
            if (typeof spaceMessage != 'undefined' && spaceMessage != null) spaceMessage.style.display = 'none';
            if (typeof timeMessage != 'undefined' && timeMessage != null) timeMessage.style.display = 'none';
        } else {
            document.getElementById('zoneTitle-'+zone).style.display = "none";
            element.style.width = "50%";
            element.style.height = "38vh";
            element.style.opacity = "1";
        }
        content.style.display = 'block';
    });
    if (event != null)
    {
        event.stopPropagation(); // Prevent the expandZone event
    }
    
}

function setupShowBsModalDatetime()
{
    $('#datetimeModal').on('show.bs.modal', function(event) {
        copyCurrentDate(false);
        prepareModalContent();
        setInterval(updateUniversalTimeClock, 1000);
        updateUniversalTimeClock();
    });
}

function setupClickButtonClock()
{
    $('button[id^="btClock"]').click(function() 
    {
        $('h2[id^="clock"]').removeClass('cla-active');
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
            updateContentClock('clock',gCurrentDate,false);
            $('#datetimeModal').modal('hide');
        }
        else
        {
            $('#clock'+ $(this).attr('id').replace('btClock', '')).addClass('cla-active');
            $('#modifClock'+ $(this).attr('id').replace('btClock', '')).css("display", "block");
        }
    });
}

function setupHoverMonthDayInput()
{
    $('#month_day_input').hover(
        function() { // mouseenter

            let valueMax= parseInt($(this).attr('data-max'));
            let currentValue = getMonthNumberFromName($(this).val(),gLocale) ;
            let valueTop = currentValue - 1;
            let valueBottom = currentValue + 1;
        
            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (valueMax + 1));
        
            updatePeripheralDigit('day','month',showTop,showBottom,
                convertMonthNumberToName(valueTop,gLocale),
                convertMonthNumberToName(valueBottom,gLocale));
        },
        function() { // mouseleave
            updatePeripheralDigit('day','month', false, false, 0 , 0);
        }
    );
}

function setupHoverSignYearInput()
{
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
}

function setupHoverPrefixTimeInput()
{
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
}

function setupOnPasteSignYearInput()
{
    $('#sign_year_input').on('paste', function(event) {
        event.preventDefault();
        var pasteText = event.originalEvent.clipboardData.getData('text');
        if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
        let codeTouche = pasteText.charCodeAt(0);
        event.key = pasteText;
        applySign(this,codeTouche,event,'year');
    });
}

function setupHoverSignLatitudeInput()
{
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
}

function setupOnPasteSignLatitudeInput()
{
    $('#sign_latitude_input').on('paste', function(event) {
        event.preventDefault();
        var pasteText = event.originalEvent.clipboardData.getData('text');
        if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
        let codeTouche = pasteText.charCodeAt(0);
        event.key = pasteText;
        applySign(this,codeTouche,event,'latitude');
    });
}

function setupHoverSignLongitudeInput()
{
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
}

function setupOnPasteSignLongitudeInput()
{
    $('#sign_longitude_input').on('paste', function(event) {
        event.preventDefault();
        var pasteText = event.originalEvent.clipboardData.getData('text');
        if (pasteText.length > 1) pasteText = pasteText.substring(0,1);
        let codeTouche = pasteText.charCodeAt(0);
        event.key = pasteText;
        applySign(this,codeTouche,event,'longitude');
    });
}

function setupHoverPlanetUniversInput()
{
    $('#planet_univers_input').hover(
        function() { // mouseenter
            let currentValue = getIdPlanetByString($(this).val(),gLanguage);
            let valueTop = currentValue - 1;
            let valueBottom = currentValue + 1;

            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (getPlanetCount()));
            
            updatePeripheralDigit('univers','planet',showTop,showBottom,
            (showTop) ? getPlanetByLangById(valueTop,gLanguage) : 0,
            (showBottom) ? getPlanetByLangById(valueBottom,gLanguage) : 0);
        },
        function() { // mouseleave
            updatePeripheralDigit('univers','planet', false, false, 0 ,0);
        }
    );
}

function setupHoverGalaxyUniversInput()
{
    $('#galaxy_univers_input').hover(
        function() { // mouseenter
            let currentValue = getIdGalaxyByString($(this).val(),gLanguage);
            let valueTop = currentValue - 1;
            let valueBottom = currentValue + 1;

            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (getGalaxyCount()));
            
            updatePeripheralDigit('univers','galaxy',showTop,showBottom,
            ( showTop ) ? getGalaxyByLangById(valueTop,gLanguage) : 0,
            ( showBottom ) ? getGalaxyByLangById(valueBottom,gLanguage) : 0);
        },
        function() { // mouseleave
            updatePeripheralDigit('univers','galaxy', false, false, 0 , 0);
        }
    );
}

function setupClickButtonModalInfoCoordinate()
{
    $('button[id^="btn-modal-info-coordinate"]').click(function() 
    {
        $('#positionModal').modal('hide');
        $('#modal-info-coordinate').modal('show');
    });
}

function setupClickButtonModalInfoFileFormat()
{
    $('button[id^="btn-modal-info-file-format"]').click(function() 
    {
        $('#modal-info-file-format').modal('show');
    });
}

function setupClickButtonLocation()
{
    $('button[id^="btLocation"]').click(function() 
    {
        $('h3[id^="location"]').removeClass('cla-active');
        $('div[id^="modifLocation"]').css("display", "none");

        if ( $(this).attr('id') == "btLocationNavigatorReset" )
        {
            resetCurrentLocation();
            updateCurrentModalLocationContent();
        }
        else if ( $(this).attr('id') == "btLocationCurrenReset" )
        {
            copyCurrentLocation(true);
            updateCurrentModalLocationContent();
        }
        else if ( $(this).attr('id') == "btLocationModify" )
        {
            let ret = false;
            const hasCarto = hasCartoPlanetByLangById(gCurrentModalPosition.planet);
            if (hasCarto == 'true')
            {
                if (gCurrentModalPosition.id != null)
                {
                    ret = axiosFindJsonStreetMapById(gCurrentModalPosition.id,updateCountrySuccess,updateCountryError);
                }
                else
                {
                    let ret = axiosFindJsonStreetMapByCoordonate(gCurrentModalPosition.latitude,gCurrentModalPosition.longitude,updateCountrySuccess,updateCountryError);
                }
            }
            if ( hasCarto == 'false' || ret == false )
            {
                updateCountryError();
                if (document.getElementById('zoneTitle-zone1').style.display == "block")
                {
                    closeZone(null, 'zone1');
                }
            }
        }
        else
        {
            const mode = $(this).attr('id').replace('btLocation', '');
            if (mode == 'Pays')
            {
                const hasCarto = hasCartoPlanetByLangById(gCurrentModalPosition.planet);
                if (hasCarto == 'true')
                {
                    $('#location'+ mode).addClass('cla-active');
                    $('#modifLocation'+ mode).css("display", "block");
                    gMap.invalidateSize(true);
                }
                else
                {
                    if (gLanguage == 'fr') {
                        toastr.warning("Il n'est pas possible de rechercher une localisation pour cette planète.");
                    } 
                    else if (gLanguage == 'sp') {
                        toastr.warning("No es posible buscar una ubicación para este planeta.");
                    }
                    else if (gLanguage == 'gr') {
                        toastr.warning("Eine Standortsuche für diesen Planeten ist nicht möglich.");
                    }
                    else if (gLanguage == 'it') {
                        toastr.warning("Non è possibile cercare una posizione per questo pianeta.");
                    }
                    else if (gLanguage == 'ru') {
                        toastr.warning("Невозможно найти местоположение этой планеты.");
                    }
                    else{
                        toastr.warning("It is not possible to search for a location for this planet.");
                    }
                }
            }
            else
            {
                $('#location'+ mode).addClass('cla-active');
                $('#modifLocation'+ mode).css("display", "block");
            }
                
        }
    });
}

function updateMapSuccess(dataObject,latitude,longitude)
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
    }
    updateMarkerToMap([latitude, longitude],display_name);
}

function updateMapError(dataObject,latitude,longitude)
{
    let country = null;
    let osm_id = null;
    let osm_type = null;

    updateCountry(country);
    updateId(osm_id,osm_type);

    updateMarkerToMap([latitude, longitude],null);
}

function addMarker(e)
{
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;

    updateLatitude(lat);
    fillDigitsCoordinate(lat, "code_latitude_input_","sign_latitude_input");

    updateLongitude(lng);
    fillDigitsCoordinate(lng, "code_longitude_input_","sign_longitude_input");

    axiosFindJsonStreetMapByCoordonate(lat,lng,updateMapSuccess,updateMapError);
}

function setupAutocomplete()
{
    gCurrentZoom = gConfig.zoomLoc;

    const lat = (gCurrentPosition.latitude == null) ? 0.0 : gCurrentPosition.latitude; 
    const lng = (gCurrentPosition.longitude == null) ? 0.0 : gCurrentPosition.longitude; 

    const mapElement = document.getElementById('leaflet-map-popup');
    if (typeof mapElement != 'undefined' && mapElement)
    {
        gThrowMap = L.map('leaflet-map-popup', gConfig.mapLeaflet).setView([lat, lng], gConfig.zoom);
        
        // Used to load and display tile layers on the map
        L.tileLayer(`${gIsBasemap}`, {
            attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(gThrowMap);
    }


    gMap = L.map("map", gConfig.mapLeaflet).setView([lat, lng], gConfig.zoom);
    
    gMap.on('click', addMarker);

    gMap.on('zoomend', function (e) {
        gCurrentZoom = e.target._zoom;
    });

    // Used to load and display tile layers on the map
    L.tileLayer(`${gIsBasemap}`, {
        attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(gMap);

    gInputAuto = new Autocomplete("search", {
        selectFirst: true,
        insertToInput: true,
        cache: true,
        howManyCharacters: 2,
        // onSearch
        onSearch: ({ currentValue }) => {
            
            /**
             * Promise
             */
            return new Promise((resolve) => {
                fetch(makePathSearch(currentValue))
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
                if (gLanguage == 'fr') {
                    noresult = template.replace("No results found:","Aucun résultat trouvé:");
                } 
                else if (gLanguage == 'sp') {
                    noresult = template.replace("No results found:","No se han encontrado resultados:");
                }
                else if (gLanguage == 'gr') {
                    noresult = template.replace("No results found:","Keine Ergebnisse gefunden:");
                }
                else if (gLanguage == 'it') {
                    noresult = template.replace("No results found:","Nessun risultato trovato:");
                }
                else if (gLanguage == 'ru') {
                    noresult = template.replace("No results found:","Результатов не найдено:");
                }
                else{
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
            gMap.eachLayer(function (layer) {
            if (!!layer.toGeoJSON) {
                gMap.removeLayer(layer);
            }
            });
    
            updateCurrentModalLocation(object);
        },
    
        // get index and data from li element after
        // hovering over li with the mouse or using
        // arrow keys ↓ | ↑
        onSelectedItem: ({ index, element, object }) => {
            //console.log("onSelectedItem:", { index, element, object });
        },
    
        // the method presents no results
        // no results
        noResults: ({ currentValue, template }) =>
            template(`<li>No results found: "${currentValue}"</li>`),
    });
}

function setupShowBsModalPosition()
{
    $('#positionModal').on('shown.bs.modal', function(event) {
        copyCurrentLocation(false);
        prepareModalLocationContent();
        gMap.invalidateSize(true);
    });
}

function setupShowBsModalConfiguration()
{
    $('#configurationModal').on('show.bs.modal', function(event) {
        $('#selectNotation').val(gNotation);
        $('#selectTheme').val(gIsVisited);
        $('#selectCarto').val(gIsBasemap);
        $('#selectSync').val(gIsSync);
    });
}

function setupClickButtonConfiModify()
{
    $('#btConfigModify').click(function() 
    {
        gNotation = $('#selectNotation').val();
        gIsVisited = $('#selectTheme').val();
        gIsBasemap = $('#selectCarto').val();
        gIsSync = $('#selectSync').val();

        updateCookiePart("theme",gIsVisited);
        updateCookiePart("notation",gNotation);
        updateCookiePart("basemap",gIsBasemap);
        updateCookiePart("sync",gIsSync);
        updateThemeSetting(gIsVisited);
        updateCurrentClock();

        $('#configurationModal').modal('hide');
    });
}

function updateCurrentClock() 
{
    const now = new Date();
    let gap = (jsDateToEpoch(now) - gCurrentDate.epoch);
    gCurrentDate.epoch = jsDateToEpoch(now);
    if (gap > 60)
    {
        if(gIsSync == "sync") 
            jitterCorrectionClock(gap);
        gap = 0;
    }
    managingOverrunClock(gap);

    updateContentClock('clock',gCurrentDate,false);
}

function updateCurrentPosition() 
{
    if ( ( gCurrentPosition != null && gCurrentPosition.valid == false ) || gCurrentPosition == null  )
    {
        showCurrentPosition(null,null,null,null);
    }
    else
    {
        const hasCarto = hasCartoPlanetByLangById(gCurrentPosition.planet);
        if (hasCarto == 'true')
        {
            let ret = axiosFindJsonStreetMapById(gCurrentPosition.id,updateSuccess,updateError);
            if ( ret == false) updateError();
        }
        else
        {
            
            showCurrentPosition(gCurrentPosition.latitude,gCurrentPosition.longitude,gCurrentPosition.country,gCurrentPosition.planet);
        }
    }
}


(function ($) {

    'use strict';

    function initLanguage() 
    {
        // Auto Loader
        gLocale = getLocalFromCookie();
        gLanguage = getLanguageFromCookie();

        //format possible fr ou fr-FR
        const langueNavigator = getFirstBrowserLanguage().substring(0, 2);
        
        if (gLanguage != null && gLanguage !== gConfig.default_lang)
        {
            setLanguage(gLanguage);
        }
        else  if (gLanguage == null && langueNavigator !== gConfig.default_lang)
        {
            setLanguage(langueNavigator);
        }
        else if (gLanguage == null && langueNavigator == gConfig.default_lang)
        {
            gLocale = gConfig.default_loc;
            gLanguage = gConfig.default_lang;
        }

        $('.language').on('click', function (e) {
            setLanguage($(this).attr('data-lang'));
        });
    }

    function initSettings() 
    {
        gIsVisited = getThemeFromCookie();
        if (gIsVisited != null && gIsVisited !== gConfig.default_theme)
        {
            updateThemeSetting(gIsVisited);
        }
    }

    function initDate() 
    {
        setCurrentDate();
        setInterval(updateCurrentClock, 1000);
        updateCurrentClock();
        setupShowBsModalDatetime();
        setupClickButtonClock();
        setupHoverHandlers('code_day_input', 'day');
        setupHoverHandlers('code_time_input', 'time');
        setupHoverHandlers('code_year_input', 'year');
        setupPasteHandlers('code_year_input', 'year');
        setupPasteHandlers('code_year_input', 'time');
        setupPasteHandlers('code_year_input', 'day');
        setupHoverMonthDayInput();
        setupHoverSignYearInput();
        setupHoverPrefixTimeInput();
        setupOnPasteSignYearInput();
    }

    function initLocation() 
    {
        setCurrentPosition();
        updateCurrentPosition();
        setupHoverHandlers('code_latitude_input', 'latitude');
        setupHoverHandlers('code_longitude_input', 'longitude');
        setupPasteHandlers('code_latitude_input', 'latitude');
        setupPasteHandlers('code_longitude_input', 'longitude');
        setupHoverSignLatitudeInput();
        setupOnPasteSignLatitudeInput();
        setupHoverSignLongitudeInput();
        setupOnPasteSignLongitudeInput();
        setupHoverPlanetUniversInput();
        setupHoverGalaxyUniversInput();
        setupClickButtonModalInfoCoordinate();
        setupClickButtonLocation();
        setupAutocomplete();
        setupShowBsModalPosition();
    }

    function initConfiguration()
    {
        gNotation = getNotationFromCookie();
        gIsVisited = getThemeFromCookie();
        gIsBasemap = getBaseMapFromCookie();   
        gIsSync = getSyncFromCookie();
        setupShowBsModalConfiguration();
        setupClickButtonConfiModify();
    }

    function initCookie()
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
    }


    function initMessageSendCompletion()
    {
        $('#firstStepThrow').css("display", "none");
        $('#secondStepThrow').css("display", "none");
        $('#delayStepThrow').css("display", "block");

        $("#btnDatetimeModal").attr('disabled', 'disabled');
        $("#btnPositionModal").attr('disabled', 'disabled');

        let progress = 0;
        $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');

        gIntervalWaitProcess = setInterval(function() {
            progress += 1;
            $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
            if (progress >= 100) {
                progress = 20;
            }
        }, 100);
    }

    function successForMessageSendCompletion()
    {
        clearInterval(gIntervalWaitProcess);
        setTimeout(function() {
            $('#delayStepThrow').css("display", "none");
            $('#endStepThrow').css("display", "block");

            $("#btnDatetimeModal").removeAttr('disabled');
            $("#btnPositionModal").removeAttr('disabled');
        }, 800);
    }

    function errorMessageSendCompletion()
    {
        clearInterval(gIntervalWaitProcess);
        let progress = 100;
        $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
        setTimeout(function() {
            $('#delayStepThrow').css("display", "none");
            $('#secondStepThrow').css("display", "block");

            $("#btnDatetimeModal").removeAttr('disabled');
            $("#btnPositionModal").removeAttr('disabled');
        }, 800);
    }

    function init() 
    {
        initCookie();
        initSettings();
        initLanguage();
        initConfiguration();
        initDate();
        initLocation();

        $('#secondStepThrow').css("display", "none");
        $('#endStepThrow').css("display", "none");
        $('#delayStepThrow').css("display", "none");

        $('#nextThrow').click(function() {

            gTitle = $("#throw-title").val();
            gMessage = $("#throw-message").val();

            if (gTitle != null && gMessage != null && gTitle.length > 0 && gMessage.length > 0)
            {
                $("#check-throw-date").val(makeContentClock(gCurrentDate));
                $("#check-throw-title").val(gTitle);
                $("#check-throw-message").text(gMessage);
                $('#firstStepThrow').css("display", "none");
                $('#secondStepThrow').css("display", "block");

                $('#checkListFile').find('li[id^="indexFile_"]').remove();

                if ( gFileCount > 0)
                {
                    $("#checkMsgInfo").attr("style", "display:none");
                    $("#checkListFile").attr("style", "display:block");

                    for (var v = 0; v < gFileCount; v++) 
                    {    
                        let numFile = v;
                        let typeFile = gFiles[v].type;
                        let nameFile = gFiles[v].name;
                        let sizeFile = gFiles[v].size;
                        let htmlFile = "";
                        if (typeFile != null && typeFile != "")
                        {
                            // Génération du HTML pour afficher les détails du fichier
                            htmlFile = '<li id="indexFile_' + numFile + '">' +
                                '<span class="cla-file-attachment-icon" style="background-color:#F8F9FA;"><i class="far ' + typeFile + '"></i></span>' +
                                '<div class="cla-file-attachment-info">' +
                                '<span class="cla-file-attachment-name" data-toggle="tooltip" title="' + nameFile + '"><i class="fas fa-paperclip"></i> ' + nameFile + '</span>' +
                                '<span class="cla-file-attachment-size clearfix mt-1">' +
                                '<span>' + getSymbolByQuantity(sizeFile) + '</span>' +
                                '</span>' +
                                '</div>' +
                                '</li>';
                            $("#checkListFile").append(htmlFile);
                        }
                        else
                        {
                            htmlFile = '<li id="indexFile_' + numFile + '">' +
                                '<span class="cla-file-attachment-icon has-img" style="background-color:#F8F9FA;"><img class="cla-image-preview" id="checkImagePreview_' + numFile + '"/></span>' +
                                '<div class="cla-file-attachment-info">' +
                                '<span class="cla-file-attachment-name" data-toggle="tooltip" title="' + nameFile + '"><i class="fas fa-camera"></i> ' + nameFile + '</span>' +
                                '<span class="cla-file-attachment-size clearfix mt-1">' +
                                '<span>' + getSymbolByQuantity(sizeFile) + '</span>' +
                                '</span>' +
                                '</div>' +
                                '</li>';
                            $("#checkListFile").append(htmlFile);
                            $('#checkImagePreview_' + numFile).attr('src', '' + gFiles[v].data + '');
                        }
                    }
                }
                else
                {
                    $("#checkMsgInfo").attr("style", "display:block");
                    $("#checkListFile").attr("style", "display:none");
                }
                
                updateThrowMarkerToMap([gCurrentPosition.latitude, gCurrentPosition.longitude],null);
                gThrowMap.invalidateSize(true);
            }
            else
            {
                if (gLanguage == 'fr') {
                    toastr.error('Veuillez ajouter un titre et un message avant de continuer.');
                } 
                else if (gLanguage == 'sp') {
                    toastr.error('Por favor agregue un título y un mensaje antes de continuar.');
                }
                else if (gLanguage == 'gr') {
                    toastr.error('Bitte fügen Sie einen Titel und eine Nachricht hinzu, bevor Sie fortfahren.');
                }
                else if (gLanguage == 'it') {
                    toastr.error('Aggiungi un titolo e un messaggio prima di continuare.');
                }
                else if (gLanguage == 'ru') {
                    toastr.error('Прежде чем продолжить, добавьте заголовок и сообщение.');
                }
                else{
                    toastr.error('Please add a title and message before continuing.');
                }
            }
        });

        $('#previousThrow').click(function() {
            $('#firstStepThrow').css("display", "block");
            $('#secondStepThrow').css("display", "none");
        });

        $('#validThrow').click(function() {
           
            let dataPost = {
                title:  gTitle,
                message: gMessage,
                date: gCurrentDate,
                position: gCurrentPosition,
                language: gLanguage,
                fileCount: gFileCount,
                files: gFiles
            };
            $axios_getpost('throw.php',dataPost,initMessageSendCompletion,successForMessageSendCompletion,errorMessageSendCompletion);
  
        });

        $('#resetThrow').click(function() {
            $('#firstStepThrow').css("display", "block");
            $('#secondStepThrow').css("display", "none");
            $('#endStepThrow').css("display", "none");
        });

        $('#throw-title').on('input', function () {
            changeNbCarac('titleCharacterCount','throw-title', $gdi('throw-title').value,100);
        });

        $('#throw-message').on('input', function () {
            changeNbCarac('bodyCharacterCount','throw-message', $gdi('throw-message').value,250);
        });

        // Gestionnaire de changement pour la sélection de fichier
        $('#throw-file-message').change(function () {
            addFilepload(gFileCount, $(this)[0]);
        });
        
        $('#restartThrow').click(function () {
            $gdi('throw-title').value = "";
            $gdi('throw-message').value = "";
            changeNbCarac('titleCharacterCount','throw-title', $gdi('throw-title').value,100);
            changeNbCarac('bodyCharacterCount','throw-message', $gdi('throw-message').value,250);
            removeFiles();
        });

        $('.cla-drop-zone').each(function() {
            $(this).off('dragenter dragover dragleave drop');
    
            $(this).on('dragenter', dragenter);
            $(this).on('dragover', dragover);
            $(this).on('dragleave', dragleave);
            $(this).on('drop', drop);
        });

        setupClickButtonModalInfoFileFormat();

    }

    init();

})(jQuery)
