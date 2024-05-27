

function displayTimezoneOffset() {
    const now = new Date();
    const timezoneOffset = now.getTimezoneOffset(); // Récupère le décalage en minutes
    const offsetHours = timezoneOffset / 60; // Convertit le décalage en heures
    const sign = offsetHours > 0 ? "-" : "+"; // Déterminer le signe (inverse car getTimezoneOffset est inversé)
    const displayOffset = `/ UTC [${sign}${Math.abs(offsetHours).toFixed(0)}]`; // Formate l'affichage

    return displayOffset;
}

function managingOverrunClock(gap)
{
    //l'horloge est suivie
    gCurrentDate.secondes += gap;

    // Gérer le dépassement des secondes et incrémenter les minutes
    if (gCurrentDate.secondes >= 60) {
        gCurrentDate.secondes = 0;
        gCurrentDate.minutes++;
    }

    // Gérer le dépassement des minutes et incrémenter les heures
    if (gCurrentDate.minutes >= 60) {
        gCurrentDate.minutes = 0;
        gCurrentDate.hours++;
    }

    // Gérer le dépassement des heures et incrémenter les jours
    if (gCurrentDate.hours >= 24) {
        gCurrentDate.hours = 0;
        gCurrentDate.day++;
    }

    // Gérer le dépassement des jours et incrémenter les mois
    if (gCurrentDate.day > daysInMonth(gCurrentDate.year, gCurrentDate.month)) {
        gCurrentDate.day = 1;
        gCurrentDate.month++;
    }

    // Gérer le dépassement des mois et incrémenter les années
    if (gCurrentDate.month > 11) {
        gCurrentDate.month = 0;
        gCurrentDate.year++;
    }
}

function jitterCorrectionClock(gap)
{
    gCurrentDate.secondes += gap;
    while ( gCurrentDate.secondes >= 60 )
    {
        if (gCurrentDate.secondes >= 60) {
            gCurrentDate.minutes++;
            gCurrentDate.secondes -= 60;
        }
        if (gCurrentDate.minutes >= 60) {
            gCurrentDate.hours++;
            gCurrentDate.minutes -= 60;
        }
        if (gCurrentDate.hours >= 24) {
            gCurrentDate.day++;
            gCurrentDate.hours -= 24;
        }
    }
    daysInM = daysInMonth(gCurrentDate.year, gCurrentDate.month);
    while ( gCurrentDate.day > daysInM )
    {
        gCurrentDate.month++;
        gCurrentDate.day -= daysInM;
        if (gCurrentDate.month > 11) {
            gCurrentDate.month = 0;
            gCurrentDate.year++;
        }
        daysInM =  daysInMonth(gCurrentDate.year, gCurrentDate.month);
    }
}

function makeContentClock(date,isGmt) 
{
    return formatDateTime(date) + ((isGmt == true) ? displayTimezoneOffset() : '');
}

function updateContentClock(id,date,isGmt) 
{
    document.getElementById(id).innerHTML = makeContentClock(date,isGmt);
}

function formatDateTime(date) 
{
    const year = date.year;
    const month = convertMonthNumberToName(date.month,gLocale);
    const day = date.day.toString().padStart(2, '0');
    
    let hours = date.hours;
    const minutes = date.minutes.toString().padStart(2, '0');
    const secondes = date.secondes.toString().padStart(2, '0');

    let suffix = ' ';  // Suffixe AM/PM pour le format 12 heures
    if ( gNotation == "12h" )
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

    updateContentClock('clockUtc',utcClock,true)
    updateContentClock('clockCurrent',gCurrentDate,false);
}

function prepareModalContent() 
{    
    let month = convertMonthNumberToName(gCurrentModalDate.month,gLocale);

    //selecteur d'élement
    document.getElementById('clockYear').textContent = `[ ${gCurrentModalDate.year} ]`;
    document.getElementById('clockMonthDay').textContent = `[ ${gCurrentModalDate.day.toString().padStart(2, '0')} ${month} ]`;
    let hours = gCurrentModalDate.hours;
    let suffix = ' ';  // Suffixe AM/PM pour le format 12 heures
    if ( gNotation == "12h" )
    {
        suffix = "<small> "+ computeSuffixHours(hours) + " </small>";
        hours = computeHours(hours);
    }
    hours = hours.toString().padStart(2, '0');

    fillInterTime(suffix,hours,gCurrentModalDate.minutes);

    //digit initialisation
    fillDigitsYear(gCurrentModalDate.year,"code_year_input_","sign_year_input", 7 );
    fillDigitsTime(gCurrentModalDate.hours,gCurrentModalDate.minutes,"code_time_input_","prefix_time_input", 4 );
    fillDigitsDay(gCurrentModalDate.day,"code_day_input_", 2 );
    fillDigitsMonth(month,"month_day_input");
}

function copyCurrentDate(isForced) 
{
    if (( isForced == false && gCurrentModalDate.valid == false )  || ( isForced == true ) )
    {
        gCurrentModalDate.valid = gCurrentDate.valid;
        gCurrentModalDate.year = gCurrentDate.year;
        gCurrentModalDate.month = gCurrentDate.month;
        gCurrentModalDate.day = gCurrentDate.day;
        gCurrentModalDate.hours = gCurrentDate.hours;
        gCurrentModalDate.minutes = gCurrentDate.minutes;
        gCurrentModalDate.secondes = gCurrentDate.secondes;
    }  
}

function modifyCurrentDate() 
{
    const now = new Date();
    gCurrentDate.valid = gCurrentModalDate.valid;
    gCurrentDate.year = gCurrentModalDate.year;
    gCurrentDate.month = gCurrentModalDate.month;
    gCurrentDate.day = gCurrentModalDate.day;
    gCurrentDate.hours = gCurrentModalDate.hours;
    gCurrentDate.minutes = gCurrentModalDate.minutes;
    gCurrentDate.secondes = now.getSeconds();

    updateCookiePart("currentDate",gCurrentDate);
}

function resetCurrentDate() 
{
    const now = new Date();
    gCurrentModalDate.year = now.getFullYear();
    gCurrentModalDate.month = now.getMonth();
    gCurrentModalDate.day = now.getDate();
    gCurrentModalDate.hours = now.getHours();
    gCurrentModalDate.minutes = now.getMinutes();
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
        gCurrentDate.valid = true;
        gCurrentDate.year = (gCurrentDate.year == null ) ? now.getFullYear() :  gCurrentDate.year ;
        gCurrentDate.month = (gCurrentDate.month == null ) ? now.getMonth() : gCurrentDate.month;
        gCurrentDate.day = (gCurrentDate.day == null ) ? now.getDate() : gCurrentDate.day;
        gCurrentDate.hours = (gCurrentDate.hours == null ) ? now.getHours() : gCurrentDate.hours;
        gCurrentDate.minutes = (gCurrentDate.minutes == null ) ? now.getMinutes() : gCurrentDate.minutes;
        gCurrentDate.secondes = (gCurrentDate.secondes == null ) ? now.getSeconds() : gCurrentDate.secondes;
        gCurrentDate.epoch = (gCurrentDate.epoch == null ) ? jsDateToEpoch(now) : gCurrentDate.epoch; ;
    }
    else
    {
        gCurrentDate.valid = true;
        gCurrentDate.year = (gCurrentDate.year == null ) ? dateCookie.year :  gCurrentDate.year ;
        gCurrentDate.month = (gCurrentDate.month == null ) ? dateCookie.month : gCurrentDate.month;
        gCurrentDate.day = (gCurrentDate.day == null ) ? dateCookie.day : gCurrentDate.day;
        gCurrentDate.hours = (gCurrentDate.hours == null ) ? dateCookie.hours : gCurrentDate.hours;
        gCurrentDate.minutes = (gCurrentDate.minutes == null ) ? dateCookie.minutes : gCurrentDate.minutes;
        gCurrentDate.secondes = (gCurrentDate.secondes == null ) ? dateCookie.secondes : gCurrentDate.secondes;
        gCurrentDate.epoch =  (gCurrentDate.epoch == null ) ? dateCookie.epoch : gCurrentDate.epoch;
    }
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
    if ( gNotation == "12h" )
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
    let monthValue = getMonthNumberFromName(month,gLocale) ;
    let lastDayOfMonth = daysInMonth(year,monthValue);
    if (day > lastDayOfMonth) day = lastDayOfMonth;
    if (day == 0) days = 1;
    
    $('#clockMonthDay').html('[ '+ day.toString().padStart(2, '0') + ' '+month+' ]');

    if (sign == "-") year *= -1; 
    $('#clockYear').html('[ '+ parseInt(year) + ' ]');

    gCurrentModalDate.year = parseInt(year);
    gCurrentModalDate.month = monthValue;
    gCurrentModalDate.day = day;
}

function setValueInputMonth(inputElement,value,maxValue) 
{
    inputElement.value = convertMonthNumberToName(value,gLocale);
    updateFinalValue('day');

    let valueTop = parseInt(value) - 1;
    let valueBottom =  parseInt(value) + 1;

    let showTop = (valueTop >= 0);
    let showBottom = (valueBottom < (maxValue + 1));

    updatePeripheralDigit('day','month',showTop,showBottom,
        convertMonthNumberToName(valueTop,gLocale),
        convertMonthNumberToName(valueBottom,gLocale));
}


function getMonthNumberFromName(monthName, gLocale) {
    // Essayer tous les mois de l'année jusqu'à ce que le nom correspondant soit trouvé
    for (let month = 0; month < 12; month++) {
        let date = new Date(2020, month, 1);
        let formatter = new Intl.DateTimeFormat(gLocale, { month: "long" });
        if (formatter.format(date).toLowerCase() === monthName.toLowerCase()) {
            return month; 
        }
    }
    return undefined; // Retourner undefined si aucun mois ne correspond
}

function convertMonthNumberToName(monthNumber, gLocale) {
    // Créer une date avec l'année arbitraire 2020 et le mois spécifié (mois - 1 car Date utilise des indices de mois de 0 à 11)
    let date = new Date(2020, monthNumber, 1);

    // Créer un formateur de date avec la locale spécifiée et le format long pour le mois
    let formatter = new Intl.DateTimeFormat(gLocale, { month: 'long' });

    // Retourner le mois formaté selon la locale
    return formatter.format(date).toLowerCase();
}

