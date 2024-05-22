
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

        $('#configurationModal').modal('hide');
    });
}

function updateCurrentClock() { // nope
}

function updateCurrentPosition() { // nope 
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

    function init() 
    {
        initCookie();
        initSettings();
        initLanguage();
        initConfiguration();
    }

    init();

})(jQuery)
