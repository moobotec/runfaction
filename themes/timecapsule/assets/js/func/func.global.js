var gIdHover = {
    "year": 0,
    "time": 0,
    "day": 0,
    "latitude": 0,
    "longitude": 0
};

var gCurrentDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var gCurrentModalDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var gCurrentPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var gCurrentModalPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var gLanguage = null;
var gLocale = null;
var gNotation = null; 
var gIsVisited = null;
var gIsSync = null;
var gIsBasemap = null;
var gMap = null;
var gThrowMap = null;
var gMarker = null;
var gThrowMarker = null;
var gInputAuto = null;
var gCurrentZoom = null;
var gTimerUpdateCountry = null;
var gFiles = [];
var gFileCount = 0;
var gCountDrop = 0;

//! Nombre maximal de fichiers par défaut
var cntMaxFile = 5;
var limitSizeFiles = 52428800; //50mo

const gConfig = {
    mapLeaflet : {
        minZoom: 1,
        maxZoom: 18,
    },
    zoom : 3,
    zoomLoc : 10,
    default_lang : 'fr',
    default_loc : 'fr-FR',
    default_not : '24h', // 12h ou 24h
    default_theme : 'light-mode-switch',
    default_sync : 'sync',
    default_basemap : 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    default_nominatim : 'https://nominatim.openstreetmap.org/',
    theme : 'timecapsule',
    default_suspension_points : '...'
};

