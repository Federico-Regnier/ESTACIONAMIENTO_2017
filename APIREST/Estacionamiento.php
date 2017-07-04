<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'clases/cochera.php';
require 'clases/estadisticas.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get('/Cocheras/{estado}', function(Request $request, Response $response){
    $estado = $request->getAttribute('estado');
    if($estado == "libres"){
        $respuesta = Cochera::RetornarCocherasLibres();
        return $response->withJson($respuesta, 200);
    } else{
        return $response->withJson(array(),404);
    }
});

$app->get('/Cocheras', function(Request $request, Response $response){
    return $response->withJson(Cochera::TraerTodas(), 200);
});

$app->get('/Estadisticas/{fechaInicio}/{fechaFin}', function(Request $request, Response $response){
    $fechaInicio = $request->getAttribute('fechaInicio');
    $fechaFin = $request->getAttribute('fechaFin');
    $inicio = DateTime::createFromFormat('Y-m-d H:i:s', $fechaInicio.' 00:00:00');
    $fin = DateTime::createFromFormat('Y-m-d H:i:s', $fechaFin.' 23:59:59');
    
    return $response->withJson(Estadisticas::TraerPorFecha($inicio->format('Y-m-d H:i:s'), $fin->format('Y-m-d H:i:s')), 200);
});

$app->get('/Estadisticas', function(Request $request, Response $response){
    return $response->withJson(Estadisticas::TraerTodas(), 200);
});

$app->post('/Auto', function(Request $request, Response $response){
        $arr = $request->getParsedBody();
        $idUsuario = $arr["idUsuario"];
        $idCochera = $arr["idCochera"];
        $patente = str_replace(" ", "", $arr["patente"]);
        $patente = strtoupper($patente);
        $color = $arr["color"];
        $marca = $arr["marca"];
        

        $cochera = new Cochera($idUsuario, $idCochera, $patente, $color, $marca);
        $resultado = $cochera->AgregarAuto();
        return $response->withJson($resultado, 200);
});

$app->put('/Auto/{patente}',function(Request $request, Response $response){
    $patente = $request->getAttribute('patente');
    $patente = str_replace(" ", "", $patente);
    $patente = strtoupper($patente);
    $cochera = Cochera::BuscarPorPatente($patente);
    if($cochera === null){
        return $response->withJson(array(), 200);
    } 
    $resultado = $cochera->SacarAuto();
    return $response->withJson($resultado, 200);
});

$app->run();