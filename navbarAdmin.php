<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Estacionamiento</a>
    </div> <!--/ .navbar-header -->
    <div class="navbar-collapse collapse" id="navigationbar">
        <ul class="nav navbar-nav" id="navbar">
            <li class=""><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cochera<span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="cocheras.php">Listado</a></li>
                <li><a href="precios.php">Precios</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Autos <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="agregarAuto.php">Agregar</a></li>
                <li><a href="sacarAuto.php">Sacar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empleados <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="listadoUsuarios.php" id="listadoEmpleados">Listado</a></li>
                <li><a href="altaUsuario.php" id="agregarEmpleado">Agregar</a></li>
                </ul>
            </li>
            <li><a href="estadisticas.php">Estadisticas</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Perfil <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="cambiarPass.php" id="cambiarPass">Cambiar Constrase&ntilde;a</a></li>
                    <li><a href="#" id="logout">Salir</a></li>
                </ul>
            </li>
        </ul> <!-- navbar-right-->
    </div><!-- .nav-collapse -->
    </div><!-- .container -->
</nav>
<style>
    body{
        padding-top: 70px !important;
    }
</style>
