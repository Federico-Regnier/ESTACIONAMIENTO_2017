<?php
include_once("checkSesionAdmin.php");
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
    <script src="scripts.js"></script>
    <?php include("navbarAdmin.php");?>
    <style>
        label{
            padding-top: 4px;
        }
    </style>
    <title>Estadisticas</title>
</head>
<body>
    <div class="container">
        <div>
            <form class="form-inline" role="form">
                <div class="form-group">
                    <label for="fechaInicio">Desde</label>
                    <input type="date" class="form-control" id="fechaInicio">
                </div>
                <div class="form-group">
                    <label for="fechaFinal" >Hasta</label>
                    <input class="form-control" type="date" id="fechaFinal">    
                </div>
                <button type="button" class="btn btn-primary" onclick="traerEstadisticas()">Buscar</button>
            </form>
        </div>
        
        <div id="divContenido"></div>
    </div>
</body>
</html>