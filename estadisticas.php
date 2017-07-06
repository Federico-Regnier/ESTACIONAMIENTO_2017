<?php
include_once("checkSesionAdmin.php");
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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts/estadisticas.js"></script>
    <script src="scripts/scripts.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <?php include("navbarAdmin.php");?>
    <style>
        label{
            padding-top: 4px;
        }
    </style>
    <title>Estadisticas</title>
</head>
<body>
    <div class="container well" id="divContenido">
        <div>
            <form class="form-inline" role="form" id="formEstadisticas">
                <div class="form-group">
                    <label for="fechaInicio">Desde</label>
                    <input type="date" class="form-control" id="fechaInicio">
                </div>
                <div class="form-group">
                    <label for="fechaFinal" >Hasta</label>
                    <input class="form-control" type="date" id="fechaFinal">    
                </div>
                <button type="button" class="btn btn-primary" onclick="TraerEstadisticas()">Buscar</button>
            </form>
        </div>
        <div id="divResultado" hidden>
            <div class="table-responsive" style="padding-top:10px;">
                <table class="table table-bordered" id="tablaEstadisticas">
                    <thead>
                        <tr>
                            <th colspan="2" scope="colgroup" class="text-center">Cochera</th>
                            <th colspan="3" scope="colgroup" class="text-center">Auto</th>
                            <th colspan="2" scope="colgroup" class="text-center">Fecha</th>
                            <th rowspan="2" class="text-center" style="padding-bottom: 5%;">Importe</th>
                        </tr>
                        <tr>
                            <th>Piso</th>
                            <th>Numero</th>
                            <th>Patente</th>
                            <th>Marca</th>
                            <th>Color</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div id="estadisticasCocheras"></div>
        </div>
    </div>
</body>
</html>