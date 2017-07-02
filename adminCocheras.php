<?php
include_once("checkSesion.php");
if(isset($_POST["Agregar"])){
    include_once("cochera.php");
    echo Cochera::AgregarAuto($_SESSION["ID"], (int)$_POST["ID"],$_POST["Patente"],$_POST["Color"], $_POST["Marca"]);
}

?>