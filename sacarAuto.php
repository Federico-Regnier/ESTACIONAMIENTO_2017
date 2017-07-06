<?php
include_once("checkSesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="cocheras.js"></script>
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body{
            padding-top: 70px;
        }
    </style>
    <title>Estacionamiento</title>
    <?php 
    if($_SESSION["Rol"] == 2)
        include_once("navbarAdmin.php");
    else
        include_once("navbarEmpleado.html");?>
</head>
<body>
    <div class="container">
        <div id="divResultado" hidden></div>
        <div class="well col-sm-offset-3 col-lg-offset-3 col-xs-8 col-sm-6 col-lg-4" id="divSacarAuto" align="center">
            <form action="#" class="form-inline col-lg-offset-1" id="formSacarAuto">
                    <div class="form-group">
                        <input type="text" class="form-control" id="patente" placeholder="Patente"/>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btnSacarAuto" onclick="SacarAuto()">Sacar Auto</button>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>