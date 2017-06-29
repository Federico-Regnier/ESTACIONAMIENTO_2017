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
    <div class="container-fluid">
        <div id="divResultado" hidden></div>
        <div class="well col-xs-offset-0 col-sm-offset-4 col-lg-offset-4 col-sm-5 col-xs-8 col-lg-3" id="divSacarAuto">
            <form action="#" class="form-inline" id="formSacarAuto">
                <div class="row">
                    <div class="form-group">
                        <input type="text" class="form-control" id="patente" placeholder="Patente"/>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btnSacarAuto" onclick="SacarAuto()">Sacar Auto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>