<?php
require_once("cliente.php");
include_once("checkSesion.php");

$resultado = Cliente::Execute('RegistrarLogout', array($_SESSION["ID"]));
if($resultado == "success"){
    session_destroy();
}
var_dump($resultado);