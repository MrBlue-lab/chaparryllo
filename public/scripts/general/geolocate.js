$(document).ready(function () {

    toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "preventDuplicates": true
    };

    var marcadorRegistro;

    var MapaRegistro;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(Sacalugar, nofunciona);
    } else {
        toastr.error('Este navegador no soporta geolocalización', '¡Error!');
    }

    $('#btnreset').on('click', resetMarker);

    function Sacalugar(position) {
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;
        var mapa = new google.maps.LatLng(latitud, longitud);

        var ColocaMapa = {
            zoom: 15,
            center: mapa,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        if (document.getElementById("map") != null) {
            var PintaMapa = new google.maps.Map(document.getElementById("map"), ColocaMapa);

            var marca = new google.maps.Marker({
                position: mapa,
                icon: "images/icons/location.svg",
                map: PintaMapa
            });
        }

        if (document.getElementById("map2") != null) {
            var PintaMapa = new google.maps.Map(document.getElementById("map2"), ColocaMapa);

            var marca = new google.maps.Marker({
                position: mapa,
                icon: "images/icons/location.svg",
                map: PintaMapa
            });
        }

        if (document.getElementById("mapaRegistro") != null) {
            MapaRegistro = new google.maps.Map(document.getElementById("mapaRegistro"), ColocaMapa);

            marcadorRegistro = new google.maps.Marker({
                position: mapa,
                icon: "images/icons/location.svg",
                map: PintaMapa
            });
        }

        google.maps.event.addListener(MapaRegistro, "click", mapClick);
        // var vercalle = new google.maps.StreetViewPanorama(document.getElementById("map"), calle);
        
        localStorage.setItem('latitud', latitud);
        localStorage.setItem('longitud', longitud);
    }

    function mapClick(event) {

        // get lat/lon of click
        var clickLat = event.latLng.lat();
        var clickLon = event.latLng.lng();
        
        $('#latitudInput').val(clickLat);
        $('#longitudInput').val(clickLon);

        marcadorRegistro = new google.maps.Marker({
            position: new google.maps.LatLng(clickLat, clickLon),
            icon: "images/icons/location.svg",
            map: MapaRegistro
        });

        google.maps.event.clearListeners(MapaRegistro, 'click');
    }

    // Reinicia el marcador del mapa de Registro
    function resetMarker() {
        google.maps.event.addListener(MapaRegistro, "click", mapClick);
        
        $('#latitudInput').val(null);
        $('#longitudInput').val(null);

        marcadorRegistro.setMap(null);
    }

    function nofunciona(position) {
        toastr.error('No tienes activado la geolocalización, algunas características dejarán de funcionar', '¡Error!');
    }

});
