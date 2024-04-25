var idHover = 0;

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

    $('button[id^="btClock"]').click(function() {
        $('h2[id^="clock"]').removeClass('active');
        $('div[id^="modif"]').css("display", "none");
        $('#clock'+ $(this).attr('id').replace('btClock', '')).addClass('active');
        $('#modif'+ $(this).attr('id').replace('btClock', '')).css("display", "block");
    });

    $('input[id^="code_year_input"]').hover(
        function() { // mouseenter
            let top = parseInt($(this).val()) - 1;
            let bottom =  parseInt($(this).val()) + 1;
            let id = $(this).attr('id').replace('code_year_input_', '');
            idHover = id;
            changeInputWrapper(id,top,bottom);
        },
        function() { // mouseleave
            let id = $(this).attr('id').replace('code_year_input_', '');
            idHover = 0;
            changeInputWrapper(id,-1,10);
        }
    );

    $('#sign_year_input').hover(
        function() { // mouseenter
            changeSignWrapper($(this).val());
        },
        function() { // mouseleave
            changeSignWrapper();
        }
    );

});


function setValueInput(inputElement,value) 
{
    inputElement.value = value;

    var numberString = '';
    $('input[id^="code_year_input"]').each(function() {
        numberString += $(this).val(); // Ajouter la valeur de chaque input à la chaîne
    });
    
    let number = parseInt(numberString);
    if ($('#sign_year_input').val() == "-") number *= -1;
    $('#clockYear').html('[ '+ parseInt(number) + ' ]');
    
    let top = parseInt(value) - 1;
    let bottom =  parseInt(value) + 1;

    let id = $(inputElement).attr('id').replace('code_year_input_', '');

    if (id == idHover)
    {
        changeInputWrapper(id,top,bottom);
    }
}

function changeInputWrapper(id,valueTop,valueBottom) {

    $('.input-wrapper .top-text-'+id).css("visibility","hidden");
    $('.input-wrapper .bottom-text-'+id).css("visibility","hidden");
    $('.input-wrapper .top-text-'+id).css("opacity","0"); 
    $('.input-wrapper .bottom-text-'+id).css("opacity","0"); 
    if (valueTop >= 0)
    {
        $('.input-wrapper .top-text-'+id).css("visibility","visible");
        $('.input-wrapper .top-text-'+id).html(valueTop);
        $('.input-wrapper .top-text-'+id).css("opacity","1"); 
    }
    if (valueBottom < 10)
    {
        $('.input-wrapper .bottom-text-'+id).css("visibility","visible");
        $('.input-wrapper .bottom-text-'+id).html(valueBottom);
        $('.input-wrapper .bottom-text-'+id).css("opacity","1");
    }
}

function prepareModalContent() {
    // Mettre à jour les éléments de la modal ou effectuer des opérations ici
    const now = new Date();
    const year = now.getFullYear();
    const month = now.toLocaleString('fr-FR', { month: 'long' });
    const day = now.getDate();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('clockYear').textContent = `[ ${year} ]`;
    document.getElementById('clockMonthDay').textContent = `[ ${day} ${month} ]`;
    document.getElementById('clockTime').textContent = `[ ${hours} : ${minutes} ]`;

    fillDigitsWithNumber(year,'code_year_input_');

}

function touchCode(inputElement, count, event,prefix,max) {
    // Récupérer le code de la touche appuyée
    var codeTouche = event.keyCode || event.which;

    if (codeTouche != 16)
    {
        if ((codeTouche >= 48 && codeTouche <= 57) || // Chiffres (0-9)
            (codeTouche >= 96 && codeTouche <= 105) || // Pavé numerique (0-9)
            codeTouche === 8 || // Touche "Retour arrière" (Backspace)
            codeTouche === 46) { // Touche "Supprimer" (Delete)
        
            if (codeTouche === 8 || codeTouche === 46)
            {
                setValueInput(inputElement,0);
                if ((count-2) == 0) count = max+2;
                $("#"+prefix+(count-2)).focus();
            }
            else
            {
                var lastChar = inputElement.value.slice(-1);
                var regex = /^[0-9]$/;
                if (!regex.test(lastChar)) {
                    // Supprimer la dernière touche entrée si elle n'est pas valide
                    setValueInput(inputElement,inputElement.value.slice(0, -1));
                }
                else
                {
                    setValueInput(inputElement,event.key);
                    $("#"+prefix+count).focus();   
                }
            }
        }
        else {
            setValueInput(inputElement,input.value.slice(0, -1));
            event.preventDefault(); // Empêcher l'action par défaut pour les autres touches
        }
    }
}

function adjustValueOnScroll(event, inputElement) 
{
    event.preventDefault();
    const delta = event.deltaY;

    // Définir un seuil pour rendre le défilement moins sensible
    const threshold = 50; // La valeur du seuil peut être ajustée en fonction de la sensibilité désirée

    if (Math.abs(delta) < threshold) {
        return; // Ignore les petits défilements
    }

    let currentValue = parseInt(inputElement.value, 10);

    // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
    currentValue += delta < 0 ? -1 : 1;

    // Contrôler les limites de la valeur
    if (currentValue < 0) currentValue = 0;
    if (currentValue > 9) currentValue = 9;

    setValueInput(inputElement,currentValue);
}

function fillDigitsWithNumber(number, prefix) {
    // Gérer les nombres négatifs en convertissant le nombre en valeur absolue
    const absNumber = Math.abs(number);
    const digits = absNumber.toString();

    // Assurer que le nombre n'a pas plus de 7 chiffres
    if (digits.length > 7) {
        digits = "9999999"
    }
    
    // Initialiser l'index de l'input à partir duquel commencer à remplir
    let inputIndex = 7;

    // Remplir les champs d'entrée avec les chiffres du nombre en ordre inverse
    for (let i = digits.length - 1; i >= 0; i--) {
        document.getElementById(prefix + inputIndex).value = digits[i];
        inputIndex--;
    }

    // Effacer les valeurs des champs restants si le nombre a moins de 7 chiffres
    for (let i = inputIndex; i >= 1; i--) {
        document.getElementById(prefix + i).value = '0';
    }
}

function adjustSignOnScroll(event, inputElement) 
{
    event.preventDefault();
    const delta = event.deltaY;

    // Définir un seuil pour rendre le défilement moins sensible
    const threshold = 50; // La valeur du seuil peut être ajustée en fonction de la sensibilité désirée

    if (Math.abs(delta) < threshold) {
        return; // Ignore les petits défilements
    }
    let currentValue = 0;

    if (inputElement.value == "+") currentValue = 0;
    if (inputElement.value == "-") currentValue = 1;

    // Incrémenter ou décrémenter la valeur en fonction de la direction du scroll
    currentValue += delta < 0 ? -1 : 1;

    // Contrôler les limites de la valeur
    if (currentValue < 0) currentValue = 0;
    if (currentValue > 1) currentValue = 1;

    if (currentValue == 0) inputElement.value = "+";
    if (currentValue == 1) inputElement.value = "-";

    changeSignWrapper(inputElement.value);
}

function changeSignWrapper(value) 
{
    $('.input-wrapper .sign-text-top').css("visibility","hidden");
    $('.input-wrapper .sign-text-bottom').css("visibility","hidden");
    $('.input-wrapper .sign-text-top').css("opacity","0"); 
    $('.input-wrapper .sign-text-bottom').css("opacity","0"); 

    let currentValue = -1;
    if (value == "+") currentValue = 0;
    if (value == "-") currentValue = 1;

    if (currentValue != -1)
    {
        var numberString = '';
        $('input[id^="code_year_input"]').each(function() {
            numberString += $(this).val(); // Ajouter la valeur de chaque input à la chaîne
        });
        let number = parseInt(numberString);
        if (currentValue == 1) number *= -1;
        $('#clockYear').html('[ '+ parseInt(number) + ' ]');
    }


    if (currentValue == 1)
    {
        $('.input-wrapper .sign-text-top').css("visibility","visible");
        $('.input-wrapper .sign-text-top').html("+");
        $('.input-wrapper .sign-text-top').css("opacity","1"); 
    }
    if (currentValue == 0)
    {
        $('.input-wrapper .sign-text-bottom').css("visibility","visible");
        $('.input-wrapper .sign-text-bottom').html("-");
        $('.input-wrapper .sign-text-bottom').css("opacity","1");
    }
}