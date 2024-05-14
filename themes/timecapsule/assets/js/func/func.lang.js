
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
        updateCurrentPosition();
    });
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