<?php
require_once("AccesoDatos.php");
class Cochera implements JsonSerializable{
    private $id;
    private $idEmpleado;
    private $idCochera;
    private $pisoCochera;
    private $numeroCochera;
    private $patente;
    private $marca;
    private $color;
    private $fechaIngreso;
    private $fechaSalida;
    private $tiempo;
    private $importe;
    
    public function __construct($id_empleado=0, $id_cochera=0, $patente="", $marca="", $color=""){
        $this->idEmpleado = $id_empleado;
        $this->idCochera = $id_cochera;
        $this->patente = $patente;
        $this->marca = $marca;
        $this->color = $color;
    }

    public function AgregarAuto(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT INTO Movimientos(ID_Cochera, ID_Empleado, Patente, Color, Marca, Fecha_Ingreso)
                                                VALUES(:cochera, :idEmpleado, :patente, :color, :marca, NOW())");
            $consulta->bindValue(":cochera", $this->idCochera, PDO::PARAM_INT);
            $consulta->bindValue(":idEmpleado", $this->idEmpleado, PDO::PARAM_INT);
            $consulta->bindValue(":patente", $this->patente, PDO::PARAM_STR);
            $consulta->bindValue(":color", $this->color, PDO::PARAM_STR);
            $consulta->bindValue(":marca", $this->marca, PDO::PARAM_STR);
            $consulta->execute();

            if($consulta->rowCount() > 0){
                $resultado = $this->OcuparCochera() ? "success" : AccesoDatos::ErrorMessageDB();
                return $resultado;
            }
            return AccesoDatos::ErrorMessageDB();
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
        
    } 

    public function SacarAuto(){
        try{
            $this->CalcularImporte();
            $this->UpdateMovimiento();
            
            $resultado = $this->DesocuparCochera() ? $this : array();
            return $resultado;

        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }

    private function OcuparCochera(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Cochera SET Estado = 1 WHERE ID = :id");
            
            $consulta->bindValue(":id", $this->idCochera, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->rowCount() > 0;
            
        } catch(PDOException $err){
            return false;
        }
    }

    private function DesocuparCochera(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Cochera SET Estado = 0 WHERE ID =:id");
            
            $consulta->bindValue(":id", $this->idCochera, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->rowCount() > 0 ? true : "cochera no updateada";
            
        } catch(PDOException $err){
            return false;
        }
        
    } 

    private function CalcularImporte(){
        if($this->tiempo < 9){
            $this->importe = ($this->tiempo + 1) * 10;
        } else if($this->tiempo <= 12){
            $this->importe = 90;
        } else{
            $this->importe = ceil($this->tiempo / (float)24) * 170;
        }
    }

    private function UpdateMovimiento(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Movimientos SET Fecha_Salida =:fechaSalida , Importe =:importe WHERE ID = :id");
            $consulta->bindValue(":fechaSalida", $this->fechaSalida, PDO::PARAM_STR);
            $consulta->bindValue(":importe", $this->importe,PDO::PARAM_STR);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->rowCount() > 0 ? "success" : "error";
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }

    public function jsonSerialize()
    {
        return array(
            'Piso' => $this->pisoCochera,
            'Numero' => $this->numeroCochera,
            'Patente' => $this->patente, 
            'Color' => $this->color,
            'Marca' => $this->marca,
            'FechaIngreso' => $this->fechaIngreso,
            'FechaSalida' => $this->fechaSalida,
            'Importe' => $this->importe
        );
    }
    
     public static function BuscarPorPatente($patente){
        if(empty($patente)){
            return null;
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT  m.ID as id,
                                                        m.ID_Cochera as idCochera,
                                                        c.Piso as pisoCochera,
                                                        c.Numero as numeroCochera,
                                                        m.ID_Empleado as idEmpleado, 
                                                        m.Patente as patente,
                                                        m.Color as color,
                                                        m.Marca as marca, 
                                                        m.Fecha_Ingreso as fechaIngreso,
                                                        NOW() as fechaSalida,
                                                        HOUR(TIMEDIFF(NOW(),m.Fecha_Ingreso)) as tiempo
                                                FROM    Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                WHERE   Patente =:patente AND Fecha_Salida IS NULL");
            $consulta->bindValue(":patente", $patente, PDO::PARAM_STR);
            $consulta->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Cochera");
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetch();
            } else{
                return null;
            }
        } catch(PDOException $err){
            return null;
        }
    }

    public static function RetornarCocherasLibres(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Piso, Numero, Reservada 
                                                FROM Cochera 
                                                WHERE Estado = 0 
                                                ORDER BY Piso, Numero");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }

    public static function RetornarCocherasUsadas($fechaInicio, $fechaFin){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT m.Patente,
                                                       m.Color,
                                                       m.Marca,
                                                       m.Fecha_Ingreso,
                                                       m.Fecha_Salida,
                                                       m.Importe,
                                                       c.Piso,
                                                       c.Numero,
                                                       e.Nombre,
                                                       e.Apellido 
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                INNER JOIN Usuarios e ON m.ID_Empleado = e.ID
                                                WHERE Fecha_Ingreso >= :fechaInicio AND Fecha_Salida <= :fechaFin
                                                ORDER BY Fecha_Ingreso");
            $consulta->bindValue(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }
    
}
?>