<?php
if(isset($_POST["usuario"]) && isset($_POST["password"]) && isset($_POST["rol"])){
    require_once("cliente.php");
    
    // TODO: escape input characters
    // TODO: encrypt password and send hash
    $usuario = array(
        "usuario" => $_POST["usuario"],
        "pass" => $_POST["password"],
        "nombre" => isset($_POST["firstName"])? $_POST["firstName"] : "",
        "apellido" => isset($_POST["lastName"])? $_POST["lastName"] : "",
        "dni" => isset($_POST["dni"])? $_POST["dni"] : "",
        "rol" => $_POST["rol"]
    );

    $resultado = Cliente::Execute('AgregarUsuario', array("Usuario" =>$usuario));
    if($resultado["Status"] == "success"){
        echo json_encode($resultado["Resultado"]);
    } else{
        echo json_encode(array("Mensaje" => "Error al comunicarse con el webservice"));
    }
}

if(isset($_POST["Suspender"])){
    include_once("cliente.php");
    $resultado = Cliente::Execute('SuspenderUsuario', array($_POST["id"]));
    if($resultado["Status"] == 'success'){
        echo $resultado["Resultado"];
    } else{
        echo "Error al comunicarse con el web service";
        echo $resultado["Resultado"];
    }

}

if(isset($_POST["Habilitar"])){
    include_once("cliente.php");
    $resultado = Cliente::Execute('HabilitarUsuario', array($_POST["id"]));
    if($resultado["Status"] == 'success'){
        echo $resultado["Resultado"];
    } else{
        echo "Error al comunicarse con el web service";
        echo $resultado["Resultado"];
    }
}

if(isset($_POST["TraerUsuario"])){
    include_once("cliente.php");
    $resultado = Cliente::Execute('TraerUsuario', array($_POST["id"]));
    echo json_encode($resultado);
}

if(isset($_POST["Borrar"])){
    include_once("cliente.php");
    $resultado = Cliente::Execute('BorrarUsuario', array($_POST["id"]));
    if($resultado["Status"] == 'success'){
        echo $resultado["Resultado"];
    } else{
        echo "Error al comunicarse con el web service";
        echo $resultado["Resultado"];
    }
}

if(isset($_GET["Logout"])){
    include_once("checkSesion.php");
    if(session_destroy()){
        echo "success";
    } else{
        echo "error";
    }
}

if(isset($_POST["Login"])){
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
    }else{
        echo $result["Resultado"]["Mensaje"];
    }
}
?>