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
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts.js"></script>
    <script src="precios.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <?php include_once("navbarAdmin.php");?>
    <title>Precios</title>
</head>
<body>
<div class="container well col-lg-offset-4 col-lg-4">
    <div class="" id="divContenido">
        <div id="divResultado" class="alert col-lg-offset-1" align="center" hidden></div>
        <form class="form-horizontal" role="form" id="preciosForm">
            <div class="form-group">
                <label for="precioHora" class="col-sm-3 col-lg-3 control-label">Hora</label>
                <div class="col-sm-8">
                    <input type="number" id="precioHora" placeholder="10" class="form-control" step="0.01" required>
                </div>
            </div>
            <div class="form-group">
                <label for="precioMediaEstadia" class="col-sm-3 col-lg-3 control-label">Media Estad&iacute;a</label>
                <div class="col-sm-8">
                    <input type="number" id="precioMediaEstadia" placeholder="20" class="form-control" step="0.01" required>
                </div>
            </div>
            <div class="form-group">
                <label for="precioEstadia" class="col-sm-3 col-lg-3 control-label">Estad&iacute;a</label>
                <div class="col-sm-8">
                    <input type="number" id="precioEstadia" placeholder="100" class="form-control" step="0.01" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-3 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                </div>
            </div>
        </form> <!-- /form -->
    </div> <!-- #divContenido -->
</div> <!-- ./container -->
</body>
</html>