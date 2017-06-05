<?php
require_once("SERVIDOR/AccesoDatos.php");
class Cochera{

    public static function AgregarAuto($idEmpleado, $cochera, $patente, $color, $marca){
        
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT INTO Movimientos(ID_Cochera, ID_Empleado, Patente, Color, Marca,Fecha_Ingreso)"
                                    ."VALUES(:cochera, :id, :patente, :color, :marca, NOW())");
            
            $consulta->bindValue(":cochera", $cochera, PDO::PARAM_INT);
            $consulta->bindValue(":id", $idEmpleado, PDO::PARAM_INT);
            $consulta->bindValue(":patente", $patente, PDO::PARAM_STR);
            $consulta->bindValue(":color", $color, PDO::PARAM_STR);
            $consulta->bindValue(":marca", $marca, PDO::PARAM_STR);
            $consulta->execute();

            if($consulta->rowCount() > 0){
                return Cochera::OcuparCochera($cochera);
            }
            return "error";
        } catch(PDOException $err){
            return "error";
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
    public static function OcuparCochera($id){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Cochera SET Estado = 1 WHERE ID = :id");
            
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->rowCount() > 0 ? "success" : "error";
            
        } catch(PDOException $err){
            return "error";
        }
        
    } 
    
}


?>