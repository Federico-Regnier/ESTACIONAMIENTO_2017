<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'clases/cochera.php';

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

$app->get('/Cocheras/{fechaInicio}/{fechaFin}', function(Request $request, Response $response){
    $fechaIncio = $request->getAttribute('fechaInicio');
    $fechaFin = $request->getAttribute('fechaFin');
});

$app->post('/Auto',function(Request $request, Response $response){
        $arr = $request->getParsedBody();
        $idUsuario = $arr["ID_Usuario"];
        $idCochera = $arr["ID_Cochera"];
        $patente = $arr["Patente"];
        $color = $arr["Color"];
        $marca = $arr["Marca"];
        

        $cochera = new Cochera($idUsuario, $idCochera, $patente, $color, $marca);
        $resultado = $cochera->AgregarAuto();
        $response->withJson($resultado, 200);
});

$app->put('/Auto/{patente}',function(Request $request, Response $response){
    $patente = $request->getAttribute('patente');
    $cochera = Cochera::BuscarPorPatente($patente);
    if($cochera == null){
        return $response->withJson(array(), 404);
    } 
    $resultado = $cochera->SacarAuto();
    return $response->withJson($resultado, 200);
});

$app->run();