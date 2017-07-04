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
    <title>Estacionamiento</title>
    <?php 
    if($_SESSION["Rol"] == 2)
        include_once("navbarAdmin.php");
    else
        include_once("navbarEmpleado.html");?>
</head>
<body>
    <div class="container-fluid">
        <div class="col-sm-offset-4 col-sm-4" id="divResultado" >
        </div>
        <div class="well col-sm-offset-4 col-sm-4">
            <form action="#">
                <div>
                    <label for="patente">Patente</label>
                    <input type="text" class="form-control" id="patente"/>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color"/>
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca"/>
                </div>
                <button type="button" class="btn btn-primary" data-user="<?php echo $_SESSION["ID"]; ?>" id="btnIngresarAuto" onclick="TraerCocherasLibres()">Ingresar Auto</button>
            </form>
        </div>
        
    </div>
    <div id="divListado" class="well col-sm-offset-1 col-sm-10" hidden>
        <label class="checkbox-inline"><input type="checkbox" class="filter-checkboxes" value="1" checked>Piso 1</label>
        <label class="checkbox-inline"><input type="checkbox" class="filter-checkboxes" value="2" checked>Piso 2</label>
        <label class="checkbox-inline"><input type="checkbox" class="filter-checkboxes" value="3" checked>Piso 3</label>
    </div>
</body>
</html>