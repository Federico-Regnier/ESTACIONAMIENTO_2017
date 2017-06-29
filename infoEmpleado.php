<?php
require_once("checkSesionAdmin.php");
require_once("cliente.php");
$resultado = Cliente::Execute("DatosLoginUsuario", array($_GET["id"]));

if($resultado["Status"] == "error"){
    echo "Error al conectarse con el web service. Intentelo nuevamente mas tarde.";
    die();
}
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
    <script src="scripts.js"></script>
    <?php include_once("navbarAdmin.php"); ?>
    <title>Fechas Login</title>
</head>
<body>
    <div class="container">
        <div id="divContenido" class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($resultado["Resultado"] as $value) {
                        $login = new DateTime($value["Fecha"]);
                        $dia = $login->format('d-m-Y');
                        $hora = $login->format('H:i:s');
                    ?>
                    <tr>
                        <td> <?php echo $dia;?> </td>
                        <td> <?php echo $hora;?> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="listadoUsuarios.php">Volver</a>
    </div>
</body>
</html>


