let idHover = {
    "year": 0,
    "time": 0
};

function expandZone(selectedZoneId) {
    const zoneTitle = document.getElementById('zoneTitle');
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
            zoneTitle.innerHTML = "Une bouteille " + h2.innerHTML.toLowerCase();
        } else {
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
    
    zoneTitle.innerHTML = "Une bouteille ...";
   
    zones.forEach(zone => {
        const element = document.getElementById(zone);
        const closeButton = element.querySelector('.close-btn');
        const content = element.querySelector('.content-zone-text');
        if (zone === zoneId) {
            element.classList.remove('col-12');
            element.classList.add('col-6');
            element.style.flex = "0 0 50%";
            element.style.height = "38vh";
            closeButton.style.display = 'none'; // Hide close button
            content.classList.remove('hidden-content-zone-text');
        } else {
            element.style.width = "50%";
            element.style.height = "38vh";
            element.style.opacity = "1";
            content.classList.remove('hidden-content-zone-text');
        }
    });

    event.stopPropagation(); // Prevent the expandZone event

}

function displayTimezoneOffset() {
    const now = new Date();
    const timezoneOffset = now.getTimezoneOffset(); // Récupère le décalage en minutes
    const offsetHours = timezoneOffset / 60; // Convertit le décalage en heures
    const sign = offsetHours > 0 ? "-" : "+"; // Déterminer le signe (inverse car getTimezoneOffset est inversé)
    const displayOffset = ` GMT [${sign}${Math.abs(offsetHours).toFixed(0)}]`; // Formate l'affichage

    return displayOffset;
}

function updateClock() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.toLocaleString('fr-FR', { month: 'long' });
    const day = now.getDate();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    
    document.getElementById('clock').textContent = `[ ${year} ][ ${day} ${month} ][ ${hours} : ${minutes} : ${seconds} ]`;
}

function updateClockUtcGmt() {
    const nowUtc = new Date();
    const year = nowUtc.getUTCFullYear()
    const month = nowUtc.toLocaleString('fr-FR', { month: 'long' , timeZone: 'UTC'  });
    const day = nowUtc.getUTCDate()
    const hours = nowUtc.getUTCHours().toString().padStart(2, '0');
    const minutes = nowUtc.getUTCMinutes().toString().padStart(2, '0');
    const seconds = nowUtc.getUTCSeconds().toString().padStart(2, '0');
    
    document.getElementById('clockUtcGmt').textContent = `[ ${year} ][ ${day} ${month} ][ ${hours} : ${minutes} : ${seconds} ]` + displayTimezoneOffset();
}

function getLocation() {
    if (navigator.geolocation) {
        document.getElementById('position').innerHTML = "Localisation ...";
        navigator.geolocation.getCurrentPosition(showPosition,defaultPosition);
    } else { 
        document.getElementById('position').innerHTML = "e, e, e, e";
    }
}

function showPosition(position) {
    document.getElementById('position').innerHTML = position.coords.latitude + ", " + position.coords.longitude + ", France, Terre";
}

function defaultPosition() {
    document.getElementById('position').innerHTML = "45.8336° N, 1.2611° E, France, Terre";
}

$(function() {
    // Mise à jour de l'horloge chaque seconde
    setInterval(updateClock, 1000);

    // Initialiser l'horloge immédiatement au chargement de la page
    updateClock();

    getLocation();

    $('#datetimeModal').on('show.bs.modal', function(event) {
        // Fonction pour préparer le contenu de la modal
        prepareModalContent();
        setInterval(updateClockUtcGmt, 1000);
        updateClockUtcGmt();
    });

    $('button[id^="btClock"]').click(function() 
    {
        $('h2[id^="clock"]').removeClass('active');
        $('div[id^="modif"]').css("display", "none");
        if ( $(this).attr('id') == "btClockReset" )
        {
            prepareModalContent();
        }
        else
        {
            $('#clock'+ $(this).attr('id').replace('btClock', '')).addClass('active');
            $('#modif'+ $(this).attr('id').replace('btClock', '')).css("display", "block");
        }
    });

    $('input[id^="code_time_input"]').hover(
        function() { // mouseenter
            let valueTop = parseInt($(this).val()) - 1;
            let valueBottom =  parseInt($(this).val()) + 1;
            let id = $(this).attr('id').replace('code_time_input_', '');
            let valueMax= parseInt($(this).attr('data-max'));
            idHover['time'] = id;
            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (valueMax + 1));
            updatePeripheralDigit('time',id, showTop, showBottom, valueTop ,valueBottom);
        },
        function() { // mouseleave
            let id = $(this).attr('id').replace('code_time_input_', '');
            idHover['time'] = 0;
            updatePeripheralDigit('time',id, false, false, 0 ,0);
        }
    );

    $('input[id^="code_year_input"]').hover(
        function() { // mouseenter
            let valueTop = parseInt($(this).val()) - 1;
            let valueBottom =  parseInt($(this).val()) + 1;
            let id = $(this).attr('id').replace('code_year_input_', '');
            let valueMax=  parseInt($(this).attr('data-max'));
            idHover['year'] = id;
            let showTop = (valueTop >= 0);
            let showBottom = (valueBottom < (valueMax + 1));
            updatePeripheralDigit('year',id, showTop, showBottom, valueTop ,valueBottom);
        },
        function() { // mouseleave
            let id = $(this).attr('id').replace('code_year_input_', '');
            idHover['year']  = 0;
            updatePeripheralDigit('year',id, false, false, 0 ,0);
        }
    );

    $('#sign_year_input').hover(
        function() { // mouseenter
            let showTop = ($(this).val() == "-");
            let showBottom = ($(this).val() == "+");
            updatePeripheralDigit('sign',showTop,showBottom,"+","-");
        },
        function() { // mouseleave
            updatePeripheralDigit('sign', false, false, 0 ,0);
        }
    );

});

function prepareModalContent() {
    // Mettre à jour les éléments de la modal ou effectuer des opérations ici
    const now = new Date();
    let year = now.getFullYear();
    const month = now.toLocaleString('fr-FR', { month: 'long' });
    const day = now.getDate();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('clockYear').textContent = `[ ${year} ]`;
    document.getElementById('clockMonthDay').textContent = `[ ${day} ${month} ]`;
    document.getElementById('clockTime').textContent = `[ ${hours} : ${minutes} ]`;

    fillDigitsYear(year,"code_year_input_","sign_year_input", 7 );
    fillDigitsTime(parseInt(hours),parseInt(minutes),"code_time_input_", 4 );
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

function fillDigitsTime(numberHours,numberMinutes, prefixCode , maxDigits ) 
{
    if (!Number.isInteger(numberHours) || isNaN(numberHours)) {
        return;
    }
    if (!Number.isInteger(numberMinutes) || isNaN(numberMinutes)) {
        return;
    }

    if (numberHours >= 24 || numberHours < 0) numberHours = 0;
    if (numberMinutes >= 60 || numberHours < 0) numberMinutes = 0;

    let digits = numberHours.toString().padStart(2, '0') + numberMinutes.toString().padStart(2, '0');
    let inputIndex = maxDigits;

    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefixCode + inputIndex).value = digits[i];
        inputIndex--;
    }

}

/* Mise à jour du champ année final que l'utilisateur 
pourra ensuite appliquer à la date courante*/
function updateFinalValue(code,sign) 
{
    var numberString = '';
    $('input[id^='+code+']').each(function() {
        numberString += $(this).val(); // Ajouter la valeur de chaque input à la chaîne
    });
    
    let number = parseInt(numberString);
    if ($('#'+sign).val() == "-") number *= -1;
    $('#clockYear').html('[ '+ parseInt(number) + ' ]');
}

/* Mise à jour de la valeur de l'input passe en paramètre , puis mise à jour de la valeur finale,
puis mise à jour de l'affichage des chiffre périphèrique en haut 
et en bas si la souris est dessus en survol sinon pas besoin  */
function setValueInput(inputElement,value,type) 
{
    inputElement.value = value;
    if (type == 'year')
    {
        updateFinalValue("code_year_input","sign_year_input");
    }

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

function setValueInputSign(inputElement,value) 
{
    inputElement.value = value;
    updateFinalValue("code_year_input","sign_year_input");

    let showTop = (value == "-");
    let showBottom = (value == "+");
    updatePeripheralDigit('year','sign',showTop,showBottom,"+","-");
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

function touchCode(inputElement,event,type,pos,max,maxValue) 
{
    // Récupérer le code de la touche appuyée
    var codeTouche = event.keyCode || event.which;
    if (codeTouche != 16) // Touche "Maj enfoncée"
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
}

/* Gestionnaire d'appui sur les touche du clavier pour les touche + et - du clavier */
function touchSign(inputElement, event) 
{
    var codeTouche = event.keyCode || event.which;
    if (codeTouche != 16) // Touche "Maj enfoncée"
    {
        if (event.key === '+' || event.key === '-') {
            setValueInputSign(inputElement,event.key);
        } 
        else if (codeTouche != 9)
        {
            setValueInputSign(inputElement,"+");
            event.preventDefault(); // Empêcher l'action par défaut pour les autres touches
        }
    }
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
        if (currentValue < 0) setValueInputSign(inputElement,"+");
        if (currentValue > 1) setValueInputSign(inputElement,"-");
    }
    else if (base == 'month')
    {

    }
}
