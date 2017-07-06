<?php
if(isset($_POST["AgregarUsuario"])){
    require_once("cliente.php");
    
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

if(isset($_POST["TraerUsuario"])){
    include_once("cliente.php");
    $resultado = Cliente::Execute('TraerUsuario', array($_POST["id"]));
    echo json_encode($resultado);
}

if(isset($_POST["ModificarUsuario"])){
    require_once("cliente.php");
    $usuario = array(
        "id" => $_POST["id"],
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "dni" => $_POST["dni"],
        "turno" => $_POST["turno"],
        "rol" => $_POST["rol"],
        "estado" => $_POST["estado"]
    );
    $resultado = Cliente::Execute('ModificarUsuario', array("Empleado" => $usuario));
    if($resultado["Status"] == "error"){
        echo "No se pudo comunicar con el web service.";
    } else {
        echo $resultado["Resultado"];
    }
}

if(isset($_POST["CambiarPass"])){
    session_start();
    if(!isset($_SESSION["ID"])){
        echo "Error de Sesion. Intentelo nuevamente mas tarde";
        die();
    }

    require_once("cliente.php");
    $resultado = Cliente::Execute('ModificarPass', array($_SESSION["ID"], $_POST["passActual"], $_POST["passNueva"]));
    if($resultado["Status"] == "error"){
        echo "No se pudo comunicar con el web service.";
    } else {
        echo $resultado["Resultado"];
    }
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
    session_start();
    if(!isset($_SESSION["ID"])){
        echo "Error de Sesion. Intentelo nuevamente mas tarde";
        die();
    }
    include_once("cliente.php");
    Cliente::Execute('RegistrarLogout', array($_SESSION["ID"]));
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
        die();
    }

    if(isset($result["Resultado"]["ID"])){
        session_start();
        $_SESSION["ID"] = $result["Resultado"]["ID"];
        $_SESSION["Rol"] = $result["Resultado"]["Rol"];
        echo "success";
    } else {
        echo $result["Resultado"]["Mensaje"];
    }
}
?>