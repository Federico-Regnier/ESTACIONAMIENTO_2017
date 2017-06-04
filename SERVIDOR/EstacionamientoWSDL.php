<?php
require_once("../lib/nusoap.php");
require_once("usuario.php");

$server = new nusoap_server();


$server->configureWSDL("Web Service del Estacionamiento", "urn:EstacionamientoWSDL");
$server->wsdl->addComplexType(
                                "Usuario",
                                "complexType",
                                "struct",
                                "all",
                                "",
                                array(  "usuario" => array('name' => 'usuario', 'type' => 'xsd:string'),
                                        "pass" => array('name' => 'pass', 'type' => 'xsd:string'),
                                        "nombre" => array('name' => 'nombre', 'type' => 'xsd:string'),
                                        "apellido" => array('name' => 'apellido', 'type' => 'xsd:string'),
                                        "dni" => array('name' => 'dni', 'type' => 'xsd:string'),
                                        "rol" => array('name' => 'rol', 'type' => 'xsd:int')
                                        )
                                );
$server->wsdl->addComplexType(
                                "Resultado",
                                "complexType",
                                "struct",
                                "all",
                                "",
                                array(
                                    "Status" => array('name' => "Status", 'type' => 'xsd:string'),
                                    "Mensaje" => array('name' => "Mensaje", 'type' => 'xsd:string')
                                )
);

$server->register('AgregarUsuario',
                   array("usuario" => 'tns:Usuario'),
                   array("Resultado" => 'tns:Resultado'),
                   'urn:EstacionamientoWSDL',
                   'urn:EstacionamientoWSDL#AgregarUsuario',
                   'rpc',
                   'encoded',
                   'Agregar un usuario'
                    );

$server->register('Login',
                    array("usuario" => 'xsd:string', "pass" => 'xsd:string'),
                    array("Resultado" => 'xsd:Array'),
                    'urn:EstacionamientoWSDL',
                    'urn:EstacionamientoWSDL#Login',
                    'rpc',
                    'encoded',
                    'Loguear un usuario'
);

$server->register('TraerUsuarios',
                    array(),
                    array("Resultado" => 'xsd:Array'),
                    'urn:EstacionamientoWSDL',
                    'urn:EstacionamientoWSDL#TraerUsuarios',
                    'rpc',
                    'encoded',
                    'Traer una lista con todos los usuarios'
);

$server->register('SuspenderUsuario',
                    array("id" => 'xsd:int'),
                    array("Resultado" => 'xsd:string'),
                    'urn:EstacionamientoWSDL',
                    'urn:EstacionamientoWSDL#SuspenderUsuario',
                    'rpc',
                    'encoded',
                    'Suspender a un usuario'
);

$server->register('HabilitarUsuario',
                    array("id" => 'xsd:int'),
                    array("Resultado" => 'xsd:string'),
                    'urn:EstacionamientoWSDL',
                    'urn:EstacionamientoWSDL#HabilitarUsuario',
                    'rpc',
                    'encoded',
                    'Habilitar a un usuario'
);


function AgregarUsuario($usuario){
    $usuario["usuario"] = trim($usuario["usuario"]);
    if(Usuario::ExisteUsuario($usuario["usuario"])){
        return array("Status" => "Error", "Mensaje" => "El usuario ya existe");
    }
    $resultado = Usuario::AgregarUsuario($usuario);
    return $resultado;
    
}

function Login($usuario, $pass){
    if(!isset($usuario) || !isset($pass)){
        return array();
    }

    $resultado = Usuario::Login($usuario, $pass);

    if($resultado){
        return $resultado;
    }
    return array();

}

function TraerUsuarios(){
    include_once("usuario.php");
    return Usuario::TraerUsuarios();
}

function SuspenderUsuario($id){
    return Usuario::SuspenderUsuario($id);
}

function HabilitarUsuario($id){
    return Usuario::HabilitarUsuario($id);
}

$HTTP_RAW_POST_DATA = file_get_contents("php://input");
$server->service($HTTP_RAW_POST_DATA);

?>
