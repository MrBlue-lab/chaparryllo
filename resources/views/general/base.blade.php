<!DOCTYPE html>
<html>
    <head>
        <title> @yield('titulo') </title>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

        <link rel="stylesheet" href="{{ URL::asset('css/general.css') }}" />
    </head>
    <body>

        <?php
//        if (session()->exists("userObj")) {
//            $userObj = session()->get("userObj");
            ?>

            <div class="container-fluid">

<!--                <div class = "row" id = "header">

                    <nav class="navbar navbar-expand-lg">
                        <?php
                        //if ($userObj->tipo == Constantes::typeGestor) {
                            ?>
                            <a class="navbar-brand" href="altaUsuarios"><img src="images/logo.png" class="imgPeq" alt="Logo principal"/></a>
                            <?php
                        //} else {
                            ?>
                            <a class="navbar-brand" href="crudUsuarios"><img src="images/logo.png" class="imgPeq" alt="Logo principal"/></a>
                            <?php
                        //}
                        ?>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <?php
                                //if ($userObj->tipo == Constantes::typeGestor) {
                                    ?>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="altaUsuarios">Alta Usuarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="gestAlquileres">Gestionar Alquileres</a>
                                    </li>
                                    <?php
                                //} else {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="crudUsuarios">Administrar Usuarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="crudCoches">Administrar Coches</a>
                                    </li>
                                    <?php
                                //}
                                ?>
                            </ul>
                        </div>

                        <a id="closeSes" href="cerrarSesion">Cerrar Sesión</a>
                    </nav>
                </div>-->

                <div class = "row" id = "main">
                    @yield('contenido')
                </div>

            </div>

            <?php
        /*} else {
            echo'<script type="text/javascript">
                      alert("No se ha encontrado al usuario, consulte al administrador");
                      </script>';
        }*/
        ?>
    </body>
</html>