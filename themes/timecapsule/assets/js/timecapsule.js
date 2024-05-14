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
}

function setupHoverMonthDayInput()
{
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
            let currentValue = getIdPlanetByString($(this).val(),language);
            let valueTop = currentValue - 1;
            let valueBottom = currentValue + 1;

            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (getPlanetCount()));
            
            updatePeripheralDigit('univers','planet',showTop,showBottom,
            (showTop) ? getPlanetByLangById(valueTop,language) : 0,
            (showBottom) ? getPlanetByLangById(valueBottom,language) : 0);
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
            let currentValue = getIdGalaxyByString($(this).val(),language);
            let valueTop = currentValue - 1;
            let valueBottom = currentValue + 1;

            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (getGalaxyCount()));
            
            updatePeripheralDigit('univers','galaxy',showTop,showBottom,
            ( showTop ) ? getGalaxyByLangById(valueTop,language) : 0,
            ( showBottom ) ? getGalaxyByLangById(valueBottom,language) : 0);
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

function setupClickButtonLocation()
{
    $('button[id^="btLocation"]').click(function() 
    {
        $('h3[id^="location"]').removeClass('active');
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
            if (currentModalPosition.id != null)
            {
                let ret = axiosFindJsonStreetMapById(currentModalPosition.id,updateCountrySuccess,updateCountryError);
                if ( ret == false) updateCountryError();
            }
            else
            {
                let ret = axiosFindJsonStreetMapByCoordonate(currentModalPosition.latitude,currentModalPosition.longitude,updateCountrySuccess,updateCountryError);
                if ( ret == false) updateCountryError();
            }
        }
        else
        {
            const mode = $(this).attr('id').replace('btLocation', '');
            if (mode == 'Pays')
            {
                const hasCarto = hasCartoPlanetByLangById(currentModalPosition.planet);
                if (hasCarto == 'true')
                {
                    $('#location'+ mode).addClass('active');
                    $('#modifLocation'+ mode).css("display", "block");
                    map.invalidateSize(true);
                }
                else
                {
                    toastr.warning("Il n'est pas possible de rechercher une localisation pour cette planète")
                }
            }
            else
            {
                $('#location'+ mode).addClass('active');
                $('#modifLocation'+ mode).css("display", "block");
            }
                
        }
    });
}

function setupAutocomplete()
{
    const lat = (currentPosition.latitude == null) ? 0.0 : currentPosition.latitude; 
    const lng = (currentPosition.longitude == null) ? 0.0 : currentPosition.longitude; 
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

            let eLang = null;
            if (language  == "sp") eLang = "es";
            else if (language  == "gr") eLang = "de";
            else eLang = language;

            const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&accept-language=${eLang}&city=${encodeURI(
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
        map.invalidateSize(true);
    });
}

function setupClickArefUpdateCoord()
{   
    $('a[id^="updateCoord"]').click(function() {
        let latitude = computeDigitToFloat('latitude');
        let longitude = computeDigitToFloat('longitude');
        axiosFindJsonStreetMapByCoordonate(latitude,longitude,updateModalSuccess,updateModalError);
    });
}

function setupShowBsModalConfiguration()
{
    $('#configurationModal').on('show.bs.modal', function(event) {
        $('#selectNotation').val(notation);
        $('#selectTheme').val(is_visited);
        $('#selectCarto').val(is_basemap);
        $('#selectSync').val(is_sync);
    });
}

function setupClickButtonConfiModify()
{
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
        setupClickArefUpdateCoord();
        setupAutocomplete();
        setupShowBsModalPosition();
    }

    function initConfiguration()
    {
        notation = getNotationFromCookie();
        is_visited = getThemeFromCookie();
        is_basemap = getBaseMapFromCookie();   
        is_sync = getSyncFromCookie();
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


    function init() 
    {
        initCookie();
        initSettings();
        initLanguage();
        initConfiguration();
        initDate();
        initLocation();
    }

    init();

})(jQuery)
