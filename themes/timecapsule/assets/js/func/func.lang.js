
function setLanguage(lang) {
    let loc = null;
    if (document.getElementById("header-lang-img")) {
        if (lang == 'fr') {
            loc = "fr-FR";
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/french.jpg";
        } 
        else if (lang == 'en') {
            loc = "en-US";
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/us.jpg";
        } 
        else if (lang == 'sp') {
            loc = "es-ES";
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/spain.jpg";
        }
        else if (lang == 'gr') {
            loc = "de-DE";
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/germany.jpg";
        }
        else if (lang == 'it') {
            loc = "it-IT";
            document.getElementById("header-lang-img").src = "themes/"+config.theme+"/assets/images/flags/italy.jpg";
        }
        else if (lang == 'ru') {
            loc = "ru-RU";
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/russia.jpg";
        }
        else{
            loc = "en-US";
            lang = 'en';
            document.getElementById("header-lang-img").src = "themes/"+gConfig.theme+"/assets/images/flags/us.jpg";
        }
        gLanguage = lang;
        updateCookiePart("language",lang);
        gLocale = loc;
        updateCookiePart("locale",gLocale);
        getLanguage();
    }
}

// Multi language setting
function getLanguage() {
    (gLanguage == null) ? setLanguage(gConfig.default_lang) : false;
    $.getJSON('themes/'+gConfig.theme+'/assets/lang/' + gLanguage + '.json', function (lang) {
        $('html').attr('lang', gLanguage);
        $.each(lang, function (index, val) {
            $("[key='" + index + "']").html(val);
        });

        if (gLanguage == 'fr') {
            $("#search").attr("placeholder", "Rechercher une position");
        } 
        else if (gLanguage == 'sp') {
            $("#search").attr("placeholder", "Encontrar una ubicación");
        }
        else if (gLanguage == 'gr') {
            $("#search").attr("placeholder", "Finden Sie einen Standort");
        }
        else if (gLanguage == 'it') {
            $("#search").attr("placeholder", "Trova una posizione");
        }
        else if (gLanguage == 'ru') {
            $("#search").attr("placeholder", "Найти местоположение");
        }
        else{
            $("#search").attr("placeholder", "Find a location");
        }

        updateCurrentClock();
        updateCurrentPosition();
    });
}

/*https://stackoverflow.com/questions/1043339/javascript-for-detecting-browser-language-preference*/
var getFirstBrowserLanguage = function () 
{
    var nav = window.navigator,
    browserLanguagePropertyKeys = ['language', 'browserLanguage', 'systemLanguage', 'userLanguage'],
    i,
    lLanguage;

    // support for HTML 5.1 "navigator.languages"
    if (Array.isArray(nav.languages)) {
        for (i = 0; i < nav.languages.length; i++) {
            lLanguage = nav.languages[i];
            if (lLanguage && lLanguage.length) {
                return lLanguage;
            }
        }
    }

    // support for other well known properties in browsers
    for (i = 0; i < browserLanguagePropertyKeys.length; i++) {
        lLanguage = nav[browserLanguagePropertyKeys[i]];
        if (lLanguage && lLanguage.length) {
            return lLanguage;
        }
    }

    return null;
};