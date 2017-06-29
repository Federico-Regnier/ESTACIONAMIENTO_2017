<?php
require_once("APIREST/clases/cochera.php");

$fechaInicio = "2017-2-6";
$fechaFin = "2017-6-30";
$inicio = DateTime::createFromFormat('Y-m-d H:i:s', $fechaInicio.' 00:00:00');
$fin = DateTime::createFromFormat('Y-m-d H:i:s', $fechaFin.' 23:59:59');
echo $inicio->format('Y-m-d H:i:s')."<br>";
echo $fin->format('Y-m-d H:i:s')."<br>";
$resultado = Cochera::RetornarCocherasUsadas($inicio->format('Y-m-d H:i:s'), $fin->format('Y-m-d H:i:s'));
var_dump($resultado);
