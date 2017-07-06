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
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts/scripts.js"></script>
    <script src="scripts/usuarios.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <?php include_once("navbarAdmin.php"); ?>
    <title>Fechas Login</title>
</head>
<body>
    <div class="container well">
        <div id="divContenido" class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th colspan="2" class="text-center">Login</th>
                    <th colspan="2" class="text-center">Logout</th>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($resultado["Resultado"] as $value) {
                        $login = new DateTime($value["Login"]);
                        $diaLogin = $login->format('d-m-Y');
                        $horaLogin = $login->format('H:i:s');
                        if($value["Logout"] != null){
                            $logout = new DateTime($value["Logout"]);
                            $diaLogout = $login->format('d-m-Y');
                            $horaLogout = $login->format('H:i:s');
                        } else{
                            $horaLogout = "------------";
                            $diaLogout = "---------------";
                        }
                        
                    ?>
                    <tr>
                        <td> <?php echo $diaLogin;?> </td>
                        <td> <?php echo $horaLogin;?> </td>
                        <td> <?php echo $diaLogout;?> </td>
                        <td> <?php echo $horaLogout;?> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="listadoUsuarios.php">Volver</a>
    </div>
</body>
</html>


