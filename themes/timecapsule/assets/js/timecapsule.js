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
    document.getElementById('clockGmt').textContent = `[ ${year} ][ ${day} ${month} ][ ${hours} : ${minutes} : ${seconds} ]` + displayTimezoneOffset();
}

function updateClockUtcGmt() {
    const nowUtc = new Date();
    const year = nowUtc.getUTCFullYear()
    const month = nowUtc.toLocaleString('fr-FR', { month: 'long' , timeZone: 'UTC'  });
    const day = nowUtc.getUTCDate()
    const hours = nowUtc.getUTCHours().toString().padStart(2, '0');
    const minutes = nowUtc.getUTCMinutes().toString().padStart(2, '0');
    const seconds = nowUtc.getUTCSeconds().toString().padStart(2, '0');
    
    document.getElementById('clockUtc').textContent = `[ ${year} ][ ${day} ${month} ][ ${hours} : ${minutes} : ${seconds} ]`;
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

    setInterval(updateClockUtcGmt, 1000);

    // Initialiser l'horloge immédiatement au chargement de la page
    updateClock();

    getLocation();
});

document.addEventListener('DOMContentLoaded', function() {
    const sliders = ['customRange2', 'customRange3'];  // IDs de vos sliders

    sliders.forEach(function(sliderId) {
        const slider = document.getElementById(sliderId);
        const rangeValueId = `rangeValue${sliderId.slice(-1)}`;  // Construit l'ID basé sur le slider

        // Initialisation des valeurs
        updateValue(rangeValueId, slider.value, slider.max);

        // Écouteur d'événement
        slider.addEventListener('input', function() {
            updateValue(rangeValueId, slider.value, slider.max);
        });
    });
});

function updateValue(id,value,max)
{
    const rangeValue = document.getElementById(id);

    // Calculez le pourcentage de positionnement par rapport au slider
    const percentage = (value / max) * 100;

    // Mettez à jour la position left de l'étiquette pour qu'elle suive le curseur
    rangeValue.style.left = `${percentage}%`;

    // Mettez à jour le contenu de l'étiquette pour afficher la valeur actuelle
    rangeValue.textContent = value;

    // Appliquez un translateX négatif basé sur la moitié de la largeur de l'étiquette pour centrer le texte sur le curseur
    rangeValue.style.transform = `translateX(-${percentage}%)`;
}
