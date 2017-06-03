<?php
if(isset($_POST["username"])){
    require_once("./lib/nusoap.php");
    
    $host = "http://localhost/ESTACIONAMIENTO_2017/SERVIDOR/EstacionamientoWSDL.php";
    $client = new nusoap_client($host . '?wsdl');

    // Verifico que el cliente se haya creado
    $error = $client->getError();
    if($error){
        echo json_encode(array("Status" => "error", "Message" => $error));
        die();
    }

    // TODO: escape input characters
    // TODO: encrypt password and send hash
    $usuario = array(
        "usuario" => $_POST["username"],
        "password" => $_POST["password"],
        "nombre" => isset($_POST["firstName"])? $_POST["firstName"] : "",
        "apellido" => isset($_POST["lastName"])? $_POST["lastName"] : "",
        "dni" => isset($_POST["dni"])? $_POST["dni"] : "",
        "tel" => isset($_POST["tel"])? $_POST["tel"] : "",
        "rol" => $_POST["rol"]
    );

    $result = $client->call("AgregarUsuario", array("Usuario" => $usuario));
    if ($client->fault) {
			echo json_encode(array("Status" => "error", "Message" => $result));
    } else {
        $err = $client->getError();
        if ($err) {
            echo json_encode(array("Status" => "error" , "Message" => htmlentities($err)));;
        } 
        else {
            echo json_encode(array("Status" => "success", "Resultado" => $result));
        }
    }

}

?>