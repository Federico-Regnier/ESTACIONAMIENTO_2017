<?php
require_once("../vendor/autoload.php");
include_once("cochera.php");

$app = new \Slim\Slim();

$app->post('/Auto',function()use($app){
        $app->response->headers->set("Content-type", "application/json");
        $idUsuario = $app->request->post("ID_Usuario");
        $idCochera = $app->request->post("ID_Cochera");
        $patente = $app->request->post("Patente");
        $color = $app->request->post("Color");
        $marca = $app->request->post("Marca");
        

        $cochera = new Cochera($idUsuario, $idCochera, $patente, $color, $marca);
        $resultado = $cochera->AgregarAuto();
        $app->response->status(200);
        $app->response->body($resultado);
});

$app->put('/Auto',function()use($app){
    $app->response->headers->set("Content-type", "application/json");
    $patente = $app->request->put("Patente");
    $cochera = Cochera::BuscarPorPatente($patente);
    if($cochera == null){
        $resultado = json_encode(array("Status" => "error", "Mensaje" => "Patente incorrecta"));
    } else{
        $resultado = $cochera->SacarAuto();
    }

    $app->response->status(200);
    $app->response->body($resultado);
    
});

$app->get('/Cocheras/:estado',function($estado)use($app){
    $app->response->headers->set("Content-type", "application/json");
    if($estado == "libres"){
        $respuesta = Cochera::RetornarCocherasLibres();
        $app->response->status(200);
        $app->response->body($respuesta);
    } else{
        $app->response->status(404);
    }
});


$app->run();