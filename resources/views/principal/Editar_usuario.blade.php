<?php

use App\Clases\conexion;
use App\Clases\Auxiliares\Constantes;

session()->put("actPage", Constantes::ED_USUARIO);
$prin = session()->get("userObj");
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
<div class="col-12 ml-3">
    <div class="row col-12 form_base">
        <div class="col-12 text-center mt-2">
            <h1>Perfil</h1>
        </div>
        <div class="row col-12">
            <div class=" col-4" >
                <?php $seesion_user = "stint"; ?>
                <div id="profile-result" class="mb-2 justify-content-center d-flex">
                    <?php if (file_exists('images/profile-pic/' . $seesion_user . '.jpg')): ?>
                        <img src="<?php
                        echo 'images/profile-pic/' . $seesion_user . '.jpg';
                        ?>"class="img-circle">
                         <?php elseif ($prin->img_user != null): ?>
                        <img src="<?php echo $prin->img_user; ?>" class="img-circle" id="la que mola">  
                    <?php else : ?>
                        <img src="images/profile-pic/default.png" class="img-circle">    
                    <?php endif; ?>
                </div>
                <script type="text/javascript" src="{{ URL::asset('scripts/general/main.js') }}"></script>
                <script type="text/javascript" src="{{ URL::asset('scripts/general/cropper.min.js') }}"></script>
                <!--        boostrap model change profile pic-->
                <div class="col-12" id="ajusteimagen" style="display:none;">
                    <div class="ajax-response" id="loading"></div>
                    <h4 class="m-t-5 m-b-5 ellipsis text-center">Ajustar imagen</h4>                    
                    <div class="profile-pic-wraper">
                        <?php if (file_exists('images/profile-pic/' . $seesion_user . '.jpg')): ?>
                            <img src="<?php echo 'images/profile-pic/' . $seesion_user . '.jpg'; ?>?>" alt="" id="change-profile-pic" class="col-12">
                        <?php else: ?>
                            <img src="images/profile-pic/default.png" alt="" id="change-profile-pic" class="col-12" >    
                        <?php endif; ?>
                    </div>
                    <div>
                        <form enctype="multipart/form-data">
                            <input type="file" accept="image/*" id="profile-file-input" onchange="loadFile(event)" value="Archivo..." name="Archivo..." class="bwr-transparent">
                        </form><!--data:image/png;base64,iVB-->
                    </div>
                </div>
            </div>
            <form class="col-8" name="formulario_editUser" id="formulario_editUser" action="edit_us">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <label class="form_control col-12">Email:</label>
                            <input type="email" name="email" class="input read w-100 text_black" value="<?php echo $prin->email; ?>" id="email" readonly="true">
                        </div>
                        <div class="col-6">
                            <label class="form_control col-12">Contraseña:</label>
                            <input type="button" class="btn btn-light w-100 input" data-toggle="modal" data-target="#exampleModalCenter" id="password" value="Cambiar contraseña" > 
                        </div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Cambiar contraseña</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form_control">Nueva contraseña:</label>
                                        <input type="password" name="passwed" class="text_black passwrd" required="" id="passw" > 
                                        <label class="form_control">Confirmar contraseña:</label>
                                        <input type="password" name="passwn" class="text_black passwrd" required=""> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form_control col-12">Nombre:</label>
                            <input type="text" name="nombre" class="w-100 text_black input" value="<?php echo $prin->nombre; ?>" id="nombre">
                        </div>
                        <div class="col-6">
                            <label class="form_control col-12">Apellidos:</label>
                            <input type="text" name="apellidos" class=" w-100 text_black input" value="<?php echo $prin->apellidos; ?>" id="apell">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><label class="form_control">Localización:</label></div>
                        <div class="col-6">
                            <input name="pais" type="text" class="text_black w-100 input" placeholder="Pais" id="paise" value="<?php echo $prin->pais; ?>">
                        </div>
                        <div class="col-6">
                            <input name="localidad" type="text" class="text_black w-100 input" placeholder="Localidad" id="local" value="<?php echo $prin->localidad; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form_control">Posición:</label>
                            <script>

                                $(document).ready(function () {
                                    /**
                                     * funcion para el pulsado del boton editar
                                     */
                                    $("#editarUsuario").click(function () {
                                        if (document.getElementById("nombre").disabled === false) {
                                            myFunction();
                                            alert('Datos actualizados');
                                        }
                                        desblok();

                                        /**
                                         * bloquea los campos del formulario si ya estan bloqueados los desbloquea
                                         * @returns {undefined}
                                         */
                                        function desblok() {
                                            if (document.getElementById("nombre").disabled === true) {
                                                document.getElementById("paise").disabled = false;
                                                document.getElementById("local").disabled = false;
                                                document.getElementById("nombre").disabled = false;
                                                document.getElementById("apell").disabled = false;
                                                document.getElementById("password").disabled = false;
                                                document.getElementById("profile-file-input").disabled = false;
                                                ActivarCampo();
                                            } else {
                                                document.getElementById("paise").disabled = true;
                                                document.getElementById("local").disabled = true;
                                                document.getElementById("nombre").disabled = true;
                                                document.getElementById("apell").disabled = true;
                                                document.getElementById("password").disabled = true;
                                                document.getElementById("ajusteimagen").disabled = true;
                                                document.getElementById("profile-file-input").disabled = true;
                                                DesActivarCampo();
                                            }
                                        }
                                        
                                        /**
                                         * modifica el alert con un estilo propio
                                         * @param {type} message
                                         * @returns {undefined}
                                         */
                                        function alertDGC(message) {
                                            var dgcTiempo = 1;
                                            var ventanaCS = '<div class="alert alert-success alert-dismissible fade show"  role="alert">' + message + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
                                            $('body').append(ventanaCS);
                                            var alVentana = $('.dgcVentana').height();
                                            var alNav = $(window).height();
                                            var supNav = $(window).scrollTop();
                                            $('.dgcAlert').css('height', $(document).height());
                                            $('.dgcVentana').css('top', ((alNav - alVentana) / 2 + supNav - 100) + 'px');
                                            $('.dgcAlert').css('display', 'block');
                                            $('.dgcAlert').animate({opacity: 1}, dgcTiempo);
                                            $('.dgcCerrar,.dgcAceptar').click(function (e) {
                                                $('.dgcAlert').animate({opacity: 0}, dgcTiempo);
                                                setTimeout("$('.dgcAlert').remove()", dgcTiempo);
                                            });
                                            window.setTimeout(function () {
                                                $(".alert").slideUp(300, function () {
                                                    $(this).remove();
                                                });
                                                setTimeout(function () {
                                                    $(".alert").close();
                                                }, 2000);
                                            }, 1000);
                                        }

                                        window.alert = function (message) {
                                            alertDGC(message);
                                        };
                                    });
                                });
                            </script>
                            <script>

                                /**
                                 * bloquea los campos del formulario
                                 * @returns {undefined}
                                 */
                                function block() {
                                    document.getElementById("paise").disabled = true;
                                    document.getElementById("local").disabled = true;
                                    document.getElementById("nombre").disabled = true;
                                    document.getElementById("apell").disabled = true;
                                    document.getElementById("password").disabled = true;
                                    document.getElementById("profile-file-input").disabled = true;
                                    DesActivarCampo();
                                }

                                /**
                                 * activa el campo del elemento ajusteimagen
                                 * @returns {Boolean}
                                 */
                                function ActivarCampo() {
                                    var contenedor = document.getElementById("ajusteimagen");
                                    contenedor.style.display = "block";
                                    return true;
                                }

                                /**
                                 * desactiva el campo del elemento ajusteimagen
                                 * @returns {Boolean}
                                 */
                                function DesActivarCampo() {
                                    var contenedor = document.getElementById("ajusteimagen");
                                    contenedor.style.display = "none";
                                    return true;
                                }

                                /**
                                 * inicia el mapa de google
                                 * @returns {undefined}
                                 */
                                function initMap() {
                                    var map = new google.maps.Map(document.getElementById('mapa'), {
                                        center: {lat: 38.694777119, lng: -4.1108735307},
                                        scrollwheel: false,
                                        zoom: 15,
                                        zoomControl: true,
                                        rotateControl: false,
                                        mapTypeControl: true,
                                        streetViewControl: false
                                    });
                                    var marker = new google.maps.Marker({
                                        position: {lat: 38.69477711972968, lng: -4.110873530782783},
                                        icon: "images/icons/location.svg",
                                        draggable: false
                                    });
                                    marker.setMap(map);
                                }
                            </script>
                            <div id="mapa" class="col-12"> </div>
                            <script>
                                initMap();
                                block();
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mb-3">
                    <button type="button" class="btn btn-primary" id="editarUsuario" >Editar</button>
                </div>
            </form>
            <script>
                function myFunction() {
                    document.getElementById("formulario_editUser").submit();
                }
            </script>
        </div>
    </div>
</div>
@endsection