<?php

if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $user = array(trim($_POST["usuario"]), trim($_POST["password"]));
    include_once("cliente.php");
    $result = Cliente::Execute("Login", $user);

    if($result["Status"] == "error"){
        echo "No se pudo ingresar al servicio. Intentelo mas tarde.";
    }

    if(isset($result["Resultado"]["ID"])){
        session_start();
        $_SESSION["ID"] = $result["Resultado"]["ID"];
        $_SESSION["Rol"] = $result["Resultado"]["Rol"];
        echo "success";
    }
    echo "Usuario o contrase&ntilde;a incorrectos";
}

?>