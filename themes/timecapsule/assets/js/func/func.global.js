var idHover = {
    "year": 0,
    "time": 0,
    "day": 0,
    "latitude": 0,
    "longitude": 0
};

var currentDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var currentModalDate = {
    "valid": false,
    "year": null,
    "month": null,
    "day": null,
    "hours": null,
    "minutes": null,
    "secondes": null,
    "epoch":null
};

var currentPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var currentModalPosition = {
    "valid": false,
    "galaxy": null,
    "planet": null,
    "country": null,
    "latitude": null,
    "longitude": null,
    "id":null
};

var language = null;
var locale = null;
var notation = null; 
var is_visited = null;
var is_sync = null;
var is_basemap = null;
var map = null;
var marker = null;
var inputAuto = null;

var def_suspension_points = "...";

const config = {
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
    theme : 'timecapsule'
};