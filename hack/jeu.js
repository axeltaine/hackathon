var gameStarted = false;
var devMode = false;
var lat = 49.7686081;
var lon = 4.7253219;

var locations = [
    {
        label: "Place Ducale",
        latitude: 49.77354,
        longitude: 4.72087,
        triggered: false,
    },
    {
        label: "Musée Arthur Rimbaud",
        latitude: 49.77573,
        longitude: 4.72204,
        triggered: false,
    },
    {
        label: "Parc du Mont-Olympe",
        latitude: 49.78031,
        longitude: 4.71882,
        triggered: false,
    },
    {
        label: "Fontaine Charles de Gonzague",
        latitude: 49.77083,
        longitude: 4.71947,
        triggered: false,
    },
    {
        label: "Notre Dame D'esperance",
        latitude: 49.76111,
        longitude: 4.71583,
        triggered: false,
    }
];

var geoSuccess = function (position) {
    if (!gameStarted) { return; }

    if (devMode) {
        lat = position.lat;
        lon = position.lon;
    } else {
        startPos = position;
        lat = startPos.coords.latitude;
        lon = startPos.coords.longitude;
    }

    var newLatLng = new L.LatLng(lat, lon);
    marker.setLatLng(newLatLng);
    macarte.setView(new L.LatLng(lat, lon), 18);
    //console.log("UPDATE LOCATION => " + lat + " - " + lon);

    // if(distance(lat, lon, 49.77354, 4.72087)< 0.2){
    //     $('#exampleModal2').modal('show');
    // }
    Array.from(locations).forEach(function(location, key) {
        var distance_ = distance(lat, lon, location.latitude, location.longitude)
        if (distance_ < 0.01) {
            if (location.triggered) {
                console.log(key);
                console.log("Vous avez déjà visité cette destination '" + location.label + "'");
            } else {
                location.triggered = true;
                console.log("Vous êtes actuelement vers '" + location.label + "'");
                
                $.ajax({
                    url: 'start.php',
                    type: "POST",
                    data: {
                        show: true,
                        index: key,
                    },
                    success: function(res){
                        $('#exampleModal2').load('start.php #example2', {index: key},function() {
                            $('#exampleModal2').modal('show');
                       });
                    }
                  })
                
            }
        }
    });
};

var geoFail = function () {
    console.error("GEO LOCATION FAILED");
};

var macarte = null;
var marker = null;
var layer = null;

function initMap() {
    macarte = L.map('map').setView([lat, lon], 18);
    layer = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20,
    }).addTo(macarte);
    marker = L.marker([lat, lon]).addTo(macarte);
}
window.onload = function () {
    navigator.geolocation.watchPosition(geoSuccess, geoFail);
    initMap();
};

function triche(index) {
    devMode = true;
    
    const location = locations[index];
    var latMultiplier = 0.0;
    var lonMultiplier = 0.0;
    var timer = 7500;
    var count = timer / 50;

    var latDiff = lat - location.latitude;
    var lonDiff = lon - location.longitude;

    latMultiplier = latDiff / count;
    lonMultiplier = lonDiff / count;

    for (let i=0; i < count; i++) {
        setTimeout( function timer(){
            lat -= latMultiplier;
            lon -= lonMultiplier;

            geoSuccess({lat: lat, lon: lon})
        }, i*50 );
    }
}

window.addEventListener("keydown", event => {
    if (event.isComposing || event.keyCode === 65) {
     triche(0)
    }
    if (event.isComposing || event.keyCode === 90) {
        triche(1)
       }
       if (event.isComposing || event.keyCode === 69) {
        triche(2)
       }
       if (event.isComposing || event.keyCode === 82) {
        triche(3)
       }
       if (event.isComposing || event.keyCode === 84) {
        triche(4)
       }
  });