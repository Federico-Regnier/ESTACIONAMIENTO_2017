<?php
require_once("../lib/nusoap.php");

$server = new nusoap_server();

$server->configureWSDL("Web Service del Estacionamiento", "urn:EstacionamientoWSDL");
$server->wsdl->addComplexType(
                                "Usuario",
                                "complexType",
                                "struct",
                                "all",
                                "",
                                array(  "usuario" => array('name' => 'username', 'type' => 'xsd:string'),
                                        "pass" => array('name' => 'pass', 'type' => 'xsd:string'),
                                        "nombre" => array('name' => 'nombre', 'type' => 'xsd:string'),
                                        "apellido" => array('name' => 'apellido', 'type' => 'xsd:string'),
                                        "dni" => array('name' => 'dni', 'type' => 'xsd:string'),
                                        "tel" => array('name' => 'tel', 'type' => 'xsd:string'),
                                        "rol" => array('name' => 'rol', 'type' => 'xsd:int')
                                        )
                                );
$server->register('AgregarUsuario',
                   array("Usuario" => 'tns:Usuario'),
                   array("Resultado" => 'xsd:string'),
                   'urn:EstacionamientoWSDL',
                   'urn:EstacionamientoWSDL#AgregarUsuario',
                   'rpc',
                   'encoded',
                   'Agregar un usuario'
                    );

function AgregarUsuario($usuario){
    return "exito";
}

$HTTP_RAW_POST_DATA = file_get_contents("php://input");
$server->service($HTTP_RAW_POST_DATA);


