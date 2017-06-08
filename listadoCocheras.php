<?php

include_once("checkSesion.php");
$resultado = Cochera::RetornarCocherasLibres();
//var_dump($resultado);

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
    <style>
        body{
            padding-top: 70px;
        }
    </style>
    <title>Cocheras Libres</title>
    <?php include("navbarEmpleado.html");?>
</head>
<body>
    <input id="Patente" type="hidden" value=>
    <input id="Color" type="hidden" value=>
    <input id="Marca" type="hidden" value=>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Piso</th>
                    <th>Numero</th>
                    <th>Reservada</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado as $value) {
                ?>
                <tr>
                    <td><?php echo $value["Piso"];?></td>
                    <td><?php echo $value["Numero"];?></td>
                    <td><?php echo $value["Reservada"] > 0? "Si" : "NO";?></td>
                    <td><button type="button" class="btn btn-success" onclick="AgregarAuto(<?php echo $value["ID"]; ?>,'<?php echo $_POST["patente"]?>','<?php echo $_POST["color"]?>','<?php echo $_POST["marca"]?>')">Agregar</button></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>


</body>
</html>



