<?php
if(isset($_POST["username"])){
    require_once("./lib/nusoap.php");
    
    $host = "http://localhost/Server/administradorUsuarios.php";
    $client = new nusoap_client($host . '?wsdl');

    // Verifico que el cliente se haya creado
    $error = $client->getError();
    if($error){
        echo json_encode(array("Status" => "error", "Message" => htmlentities($error)));
        die();
    }

    // TODO: escape input characters
    // TODO: encrypt password and send hash
    $usuario = array(
        "Nombre" => isset($_POST["nombre"])? $_POST["nombre"] : "",
        "Username" => $_POST["username"],
        "Password" => $_POST["password"],
        "Rol" => $_POST["rol"]
    );

    $result = $client->call("AgregarUsuario", array("Usuario" => $usuario));
    if ($client->fault) {
			echo json_encode(array("Status" => "error", "Message" => htmlentities($result)));
    } else {
        $err = $client->getError();
        if ($err) {
            echo json_encode(array("Status" => "error" , "Message" => htmlentities($err)));;
        } 
        else {
            echo json_encode(array("Status" => "success"));
        }
    }

}

?>