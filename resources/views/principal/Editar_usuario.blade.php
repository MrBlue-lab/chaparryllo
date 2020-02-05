<?php

use App\Clases\conexion;
use App\Clases\Auxiliares\Constantes;

session()->put("actPage", Constantes::ED_USUARIO);
?>

@extends('../general/base')
@section('titulo')
Inicio
@endsection
@section('contenido')
<link rel="stylesheet" type="text/css" href="css/editUsu/editarusuario.css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwKmL1KMaYg3Hl6ggnEnCVgCCHhtsgvEU&libraries=drawing&callback=initMap&sensor=true"></script>

<link href="css/editUsu/cropper.min.css" rel="stylesheet" type="text/css"/>
<div class="float col-12 ml-3">
    <div class="row col-12 form_base">
        <div class="col-12 text-center mt-2">
            <h2>Editar perfil</h2>
        </div>
        <div class="row col-12">
            <div class=" col-4">
                <?php $seesion_user = "stint"; ?>
                <div id="profile-result" class="mb-2 justify-content-center d-flex">
                    <?php if (file_exists('images/profile-pic/' . $seesion_user . '.jpg')): ?>
                        <img src="<?php echo 'images/profile-pic/' . $seesion_user . '.jpg'; ?>"class="img-circle">
                    <?php else: ?>
                        <img src="images/profile-pic/default.png" class="img-circle">    
                    <?php endif; ?>
                </div>
                <script type="text/javascript" src="{{ URL::asset('scripts/general/main.js') }}"></script>
                <script type="text/javascript" src="{{ URL::asset('scripts/general/cropper.min.js') }}"></script>
                <!--        boostrap model change profile pic-->
                <div class="col-12">
                    <div class="ajax-response" id="loading"></div>
                    <h4 class="m-t-5 m-b-5 ellipsis text-center">Ajustar imagen</h4>                    
                    <div class="profile-pic-wraper">
                        <?php if (file_exists('images/profile-pic/' . $seesion_user . '.jpg')): ?>
                            <img src="<?php echo 'images/profile-pic/' . $seesion_user . '.jpg'; ?>" alt="" id="change-profile-pic" class="col-12">
                        <?php else: ?>
                            <img src="images/profile-pic/default.png" alt="" id="change-profile-pic" class="col-12" >    
                        <?php endif; ?>
                    </div>
                    <div>
                        <form enctype="multipart/form-data">
                            <input type="file" accept="image/*" id="profile-file-input" onchange="loadFile(event)" value="Archivo..." name="Archivo...">
                        </form>
                    </div>
                </div>
            </div>
            <form class="col-8">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <label class="form_control col-12">Email:</label>
                            <input type="email" name="email" class=" w-100 text_black" value="" required="">
                        </div>
                        <div class="col-6">
                            <label class="form_control col-12">Contraseña:</label>
                            <input type="password" name="passw" class=" w-100 text_black" value="" required=""> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form_control col-12">Nombre:</label>
                            <input type="text" name="nombre" class="w-100 text_black" value="">
                        </div>
                        <div class="col-6">
                            <label class="form_control col-12">Apellidos:</label>
                            <input type="text" name="apellidos" class=" w-100 text_black" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label class="form_control">Localización:</label>
                        <div class="col-6">
                            <input name="Pais"  type="text" class="text_black w-100" placeholder="Pais">
                        </div>
                        <div class="col-6">
                            <input name="localidad" type="text" class="text_black w-100" placeholder="Localidad">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form_control">Posición:</label>
                            <script>
                                function initMap() {
                                    // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.
                                    var map = new google.maps.Map(document.getElementById('mapa'), {
                                        center: {lat: 38.694777119, lng: -4.1108735307},
                                        scrollwheel: false,
                                        zoom: 15,
                                        zoomControl: true,
                                        rotateControl: false,
                                        mapTypeControl: true,
                                        streetViewControl: false
                                    });
                                    // Creamos dos marcadores.
                                    var marker1 = new google.maps.Marker({
                                        position: {lat: 38.69477711972968, lng: -4.110873530782783},
                                        draggable: false
                                    });
                                    // a este marcador le añadimos un icono personalizado
                                    var marker2 = new google.maps.Marker({
                                        position: {lat: 38.69477711972968, lng: -4.110873530782783},
                                        icon: "images/icons/location.svg",
                                        draggable: false
                                    });
                                    // Le asignamos el mapa a los marcadores.
                                    marker2.setMap(map);
                                }
                            </script>
                            <div id="mapa" class="col-12"> </div>
                            <script>initMap();</script>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mb-3">
                    <button type="submit" class="btn btn-primary btn">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection