<?php
require_once("../SERVIDOR/AccesoDatos.php");
class Cochera{
    public $idEmpleado;
    public $idCochera;
    public $patente;
    public $marca;
    public $color;
    public $fechaIngreso;

    
    public function __construct($id_empleado, $id_cochera, $patente, $marca, $color){
        $this->idEmpleado = $id_empleado;
        $this->idCochera = $id_cochera;
        $this->patente = $patente;
        $this->marca = $marca;
        $this->color = $color;
    }

    
    public function AgregarAuto(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT INTO Movimientos(ID_Cochera, ID_Empleado, Patente, Color, Marca,Fecha_Ingreso)"
                                    ."VALUES(:cochera, :id, :patente, :color, :marca, NOW())");
            
            $consulta->bindValue(":cochera", $this->idCochera, PDO::PARAM_INT);
            $consulta->bindValue(":id", $this->idEmpleado, PDO::PARAM_INT);
            $consulta->bindValue(":patente", $this->patente, PDO::PARAM_STR);
            $consulta->bindValue(":color", $this->color, PDO::PARAM_STR);
            $consulta->bindValue(":marca", $this->marca, PDO::PARAM_STR);
            $consulta->execute();

            if($consulta->rowCount() > 0){
                return $this->OcuparCochera();
            }
            return "error";
        } catch(PDOException $err){
            return "error";
        }
        
    } 

    private function OcuparCochera(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Cochera SET Estado = 1 WHERE ID = :id");
            
            $consulta->bindValue(":id", $this->idCochera, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->rowCount() > 0 ? "success" : "error";
            
        } catch(PDOException $err){
            return "error";
        }
        
    } 

    public static function BuscarAuto($patente){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT  ID_Cochera as idCochera, 
                                                        ID_Empleado as idEmpleado,
                                                        Patente as patente,
                                                        Color as color,
                                                        Marca as marca, 
                                                        Fecha_Ingreso as fechaIngreso
                                                FROM Movimientos WHERE Patente =:patente");
            
            $consulta->bindValue(":patente", $this->idCochera, PDO::PARAM_INT);
            $consulta->execute();
            $cochera = $consulta->fetchObject("Cochera");
            return $cochera;
        } catch(PDOException $err){
            return null;
        }
    }


    public static function RetornarCocherasLibres(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Piso, Numero, Reservada FROM Cochera WHERE Estado = 0 ORDER BY Piso, Numero");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $err){
            return "error PDO";
        }
    }
    
}


?>