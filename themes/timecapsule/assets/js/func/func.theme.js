function updateThemeSetting(id) {
    if (id === "light-mode-switch") {
        $("#bootstrap-style").attr('href', 'themes/'+config.theme+'/assets/css/bootstrap.min.css');
        $("#app-style").attr('href', 'themes/'+config.theme+'/assets/css/app.min.css');
    } else if ( id === "dark-mode-switch") {
        $("#bootstrap-style").attr('href', 'themes/'+config.theme+'/assets/css/bootstrap-dark.min.css');
        $("#app-style").attr('href', 'themes/'+config.theme+'/assets/css/app-dark.min.css');
    }
}