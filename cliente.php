<?php
    
class Cliente
{
    static function Execute($metodo, $input){
        require_once("lib/nusoap.php");
        $host = "http://localhost/ESTACIONAMIENTO_2017/SERVIDOR/EstacionamientoWSDL.php";
        $client = new nusoap_client($host . '?wsdl');

        // Verifico que el cliente se haya creado
        $error = $client->getError();
        if($error){
            return array("Status" => "error", "Resultado" => $error);
        }

        $result = $client->call($metodo, $input);
        if ($client->fault) {
                return array("Status" => "error", "Resultado" => $result);
        } else {
            $err = $client->getError();
            if ($err) {
                return array("Status" => "error" , "Resultado" => $err);
            } 
            else {
                return array("Status" => "success", "Resultado" => $result);
            }
        }
    }
}
?>