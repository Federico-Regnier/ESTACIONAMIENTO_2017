<?php
include_once("checkSesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts/scripts.js"></script>
    <script src="scripts/cambiarPass.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <?php 
    if($_SESSION["Rol"] == 2)
        include_once("navbarAdmin.php");
    else
        include_once("navbarEmpleado.html");?>
    <title>Cambio de Contrase&ntilde;a</title>
</head>
<body>
<div class="container">
    <div class="col-lg-offset-1 col-lg-6" id="divContenido">
        <form class="form-horizontal form-space" role="form" id="passForm">
            <div id="divResultado" class="alert col-lg-offset-1" align="center" hidden></div>
            <div class="form-group">
                <label for="passActual" class="col-sm-3 col-lg-4 control-label">Contrase&ntilde;a Actual</label>
                <div class="col-sm-8">
                    <input type="password" name="passActual" placeholder="Contrase&ntilde;a actual" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="passNueva" class="col-sm-3 col-lg-4 control-label">Nueva Contrase&ntilde;a</label>
                <div class="col-sm-8">
                    <input type="password" name="passNueva" placeholder="Nueva contrase&ntilde;a" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="passConfirmar" class="col-sm-3 col-lg-4 control-label">Confirmar contrase&ntilde;a</label>
                <div class="col-sm-8">
                    <input type="password" id="passConfirmar" placeholder="Vuelve a escribir tu contrase&ntilde;a" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-3 col-lg-offset-4">
                    <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                </div>
            </div>
        </form> <!-- /form -->
    </div> <!-- #divContenido -->
</div> <!-- ./container -->
</body>
</html>