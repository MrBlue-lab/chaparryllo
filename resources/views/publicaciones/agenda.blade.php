<?php

use App\Clases\conexion;
use App\Clases\Auxiliares\Constantes;

session()->put("actPage", Constantes::AGENDA);
?>
@extends('../general/base')

@section('titulo')
Agenda
@endsection

@section('contenido')

<link href="css/agenda/agenda_style.css" type="text/css" rel="stylesheet">
<link href='agendaJs/core/main.css' rel='stylesheet' />
<link href='agendaJs/daygrid/main.css' rel='stylesheet' />
<link href='agendaJs/list/main.css' rel='stylesheet' />
<meta name="csrf_token" content="{{ csrf_token() }}">
<script src='agendaJs/core/locales/es.js'></script>
<script src='agendaJs/core/main.js'></script>
<script src='agendaJs/interaction/main.js'></script>
<script src='agendaJs/daygrid/main.js'></script>
<script src='agendaJs/list/main.js'></script>
<script src='agendaJs/google-calendar/main.js'></script>
<script src="scripts/general/cargarMapa.js"></script>
<script>

    $(document).ready(function () {

        var token = '{{csrf_token()}}';
        var parametros = {
            "_token": token
        };
        $.ajax({
            url: "mostrarEventos",
            data: parametros,
            type: "post",
            success: function (response) {
                var respuesta = JSON.parse(response);
                var calendarEl = document.getElementById('calendar');
                var initialLocaleCode = 'es';
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    plugins: ['interaction', 'dayGrid', 'list', 'googleCalendar'],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listYear'
                    },
                    locale: initialLocaleCode,
                    displayEventTime: false, // don't show the time column in list view

                    events: respuesta,
                    eventColor: '#8F7E4F',
                    // THIS KEY WON'T WORK IN PRODUCTION!!!
                    // To make your own Google API key, follow the directions here:
                    googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
                    eventClick: function (arg) {
                        // opens events in a popup window

                        arg.jsEvent.preventDefault() // don't navigate in main tab

                        for (var i = 0; i < respuesta.length; i++) {
                            if (arg.event.title == respuesta[i].title) {
                                var eventoMostrar = respuesta[i];
                            }
                        }
                        $('.fc-event-container').css('cursor', 'crosshair');
                        $('#img-agenda').attr('src', 'data:image/png;base64,' + eventoMostrar.imagen);
                        $('#nomb-event').html('<h4>Evento:</h4> ' + eventoMostrar.title);
                        $('#localizacion').html('<h4>Localización:</h4> ' + eventoMostrar.localizacion);
                        $('#desc-agenda').html('<h4>Descripción:</h4>' + eventoMostrar.descripcion);

                        var tam = $('#desc-agenda').outerHeight();
                        $('#mapaAgenda').css({ height: 'calc(350px - ' + tam + 'px)'});

                        PintarMapa(eventoMostrar.latitud, eventoMostrar.longitud);

                    },
                    loading: function (bool) {
                        document.getElementById('loading').style.display =
                                bool ? 'block' : 'none';
                    }

                });
                calendar.render();
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
//                window.open(JSON.stringify(x));
                alert('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
            }
        });
    });


</script>

<div class="col">
    <div class="row">
        <div class="col fondo mb-2 agend">
            <div class="row h-100 parallax justify-content-center align-items-center" data-parallax="scroll" data-image-src="images/chaparrillo/elegidas/agenda.jpg">
                <h1 class="bolder">Agenda</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div id='loading'>Cargando...</div>
        <div class="col-6">
            <div class="mb-3" id="calendar">

            </div>
        </div>
        <div class="col-6">
            <div id="muestraEvento">
                <div class="info-event">
                    <img src="" id="img-agenda" alt="Portada evento" class="img-fluid">
                    <div class="textoAgenda">
                        <div id="nomb-event" ></div>
                        <div id="localizacion" ></div>
                    </div>

                </div>
                <div id="desc-agenda" class="desc-agenda">

                </div>
                <div id="mapaAgenda" class="">

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
