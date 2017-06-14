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

$app->run();