<?php
require_once("cliente.php");
include_once("SERVIDOR/usuario.php");
    $usuario = array(
        "id" => 1,
        "nombre" => "Alberto",
        "apellido" => "Rodriguez",
        "dni" => "11",
        "estado" => 0,
        "rol" => 1
    );
    
    $resultado = Cliente::Execute('ModificarUsuario', array("Empleado" => $usuario));
    if($resultado["Status"] == "error"){
        echo "No se pudo comunicar con el web service.";
        echo $resultado["Resultado"];
    } else {
        echo $resultado["Resultado"];
    }
    
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>