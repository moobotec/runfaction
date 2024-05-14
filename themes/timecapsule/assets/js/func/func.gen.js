
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

function setValueInputPlanet(inputElement,value,maxValue) 
{
    inputElement.value = getPlanetByLangById(value,language);
    updateFinalValue('planet');

    let valueTop = parseInt(value) - 1;
    let valueBottom =  parseInt(value) + 1;

    let showTop = (valueTop >= 0);
    let showBottom = (valueBottom < (maxValue + 1));

    updatePeripheralDigit('univers','planet',showTop,showBottom,
        ( showTop ) ? getPlanetByLangById(valueTop,language) : 0,
        ( showBottom ) ? getPlanetByLangById(valueBottom,language) : 0);
}

function setValueInputGalaxy(inputElement,value,maxValue) 
{
    inputElement.value = getGalaxyByLangById(value,language);
    updateFinalValue('galaxy');

    let valueTop = parseInt(value) - 1;
    let valueBottom =  parseInt(value) + 1;

    let showTop = (valueTop >= 0);
    let showBottom = (valueBottom < (maxValue + 1));

    updatePeripheralDigit('univers','galaxy',showTop,showBottom,
        ( showTop ) ? getGalaxyByLangById(valueTop,language) : 0,
        ( showBottom ) ? getGalaxyByLangById(valueBottom,language) : 0);
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
    else if (base == 'planet')
    {
        let currentValue = getIdPlanetByString(inputElement.value,language);

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        if (currentValue < 0) currentValue = 0;
        if (currentValue >= getPlanetCount()) currentValue = getPlanetCount()-1;

        setValueInputPlanet(inputElement,currentValue,getPlanetCount()-1);
    }
    else if (base == 'galaxy')
    {
        let currentValue = getIdGalaxyByString(inputElement.value,language);

        // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
        currentValue += delta < 0 ? -1 : 1;

        if (currentValue < 0) currentValue = 0;
        if (currentValue >= getGalaxyCount()) currentValue = getGalaxyCount()-1;

        setValueInputGalaxy(inputElement,currentValue,getGalaxyCount()-1);
        const firstValue = getFirstPlanetByIdGalaxy(currentValue);
        setValueInputPlanet(document.getElementById('planet_univers_input'),firstValue,getPlanetCount()-1);
    }
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
        updateCountryTimeOut();
    }
    else if ( type == 'longitude' )
    {
        updateLongitude(computeDigitToFloat(type));
        updateCountryTimeOut();
    }
    else if ( type == 'planet' || type == 'galaxy' )
    {
        let value = $('#'+type+'_univers_input').val();
        if (type == 'planet')
        {
            updatePlanet(value);
        }
        else
        {
            updateGalaxy(value);
        }
        
        fillDigitsCoordinate(null, "code_latitude_input_","sign_latitude_input");
        fillDigitsCoordinate(null, "code_longitude_input_","sign_longitude_input");
        updateCountry(null);
        updateId(null,null);
    }
}

function updateCountryTimeOut() {
    // Initialiser le timer
    if (timerUpdateCountry != null)
    {
        clearTimeout(timerUpdateCountry);
    }
    timerUpdateCountry = setTimeout(function() {
        timerUpdateCountry = null;
        axiosFindJsonStreetMapByCoordonate(currentModalPosition.latitude,currentModalPosition.longitude,updateModalSuccess,updateModalError);
    }, 1000);
}