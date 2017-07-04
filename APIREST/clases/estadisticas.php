<?php
require_once("AccesoDatos.php");

class Estadisticas{

    /*
        TRAER TODOS LOS MAS USADOS
        
        SELECT  c.Piso,
		c.Numero,
		COUNT(m.ID_Cochera) as cantidad
        FROM Movimientos m
        INNER JOIN Cochera c ON m.ID_Cochera = c.ID
        GROUP BY ID_Cochera
        HAVING cantidad = (SELECT COUNT(ID_Cochera) as cantidad 
        FROM Movimientos 
        GROUP BY ID_Cochera
        ORDER BY cantidad DESC
        LIMIT 1)

    */
    public static function TraerPorFecha($fechaInicio, $fechaFin){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT  c.Piso,
                                                        c.Numero,
                                                        COUNT(ID_Cochera) as cantidad
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                WHERE m.Fecha_Ingreso >= :fechaInicio AND m.Fecha_Ingreso <= :fechaFin
                                                GROUP BY ID_Cochera
                                                ORDER BY cantidad DESC
                                                ");
            $consulta->bindValue(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            $cocheraMasUsada = $consulta->fetch(PDO::FETCH_ASSOC);
            $consulta = $pdo->RetornarConsulta("SELECT c.Piso,
                                                    c.Numero,
                                                    COUNT(ID_Cochera) as cantidad
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                WHERE m.Fecha_Ingreso >= :fechaInicio AND m.Fecha_Ingreso <= :fechaFin
                                                GROUP BY ID_Cochera
                                                ORDER BY cantidad ASC
                                                LIMIT 1
                                                ");
            $consulta->bindValue(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            $cocheraMenosUsada = $consulta->fetch(PDO::FETCH_ASSOC);
            $consulta = $pdo->RetornarConsulta("SELECT c.Piso,
                                                        c.Numero
                                                FROM Cochera c
                                                WHERE   NOT EXISTS(
                                                        SELECT  null 
                                                        FROM    Movimientos m
                                                        WHERE   Fecha_Ingreso >= :fechaInicio 
                                                            AND Fecha_Ingreso <= :fechaFin 
                                                            AND m.ID_Cochera = c.ID
                                                    )
                                                ");
            $consulta->bindValue(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            $cocherasSinUsar = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $cocherasUsadas = Estadisticas::CocherasUsadasPorFecha($fechaInicio, $fechaFin);

            return array("cocheraMasUsada" => $cocheraMasUsada, "cocherasSinUsar" => $cocherasSinUsar, "cocheraMenosUsada" => $cocheraMenosUsada, "Usadas" => $cocherasUsadas);
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }

    public static function TraerTodas(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT c.Piso,
                                                    c.Numero,
                                                    COUNT(ID_Cochera) as cantidad
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                GROUP BY ID_Cochera
                                                ORDER BY cantidad DESC
                                                LIMIT 1
                                                ");
            $consulta->execute();
            $cocheraMasUsada = $consulta->fetch(PDO::FETCH_ASSOC);
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT c.Piso,
                                                    c.Numero,
                                                    COUNT(ID_Cochera) as cantidad
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                GROUP BY ID_Cochera
                                                ORDER BY cantidad ASC
                                                LIMIT 1
                                                ");
            $consulta->execute();
            $cocheraMenosUsada = $consulta->fetch(PDO::FETCH_ASSOC);
            $consulta = $pdo->RetornarConsulta("SELECT c.Piso,
                                                    c.Numero
                                                FROM Cochera c
                                                WHERE   NOT EXISTS(
                                                        SELECT  null 
                                                        FROM    Movimientos m
                                                        WHERE   m.ID_Cochera = c.ID
                                                    )
                                                ");
            $consulta->execute();
            $cocherasSinUsar = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $cocherasUsadas = Estadisticas::CocherasUsadas();

            return array("cocheraMasUsada" => $cocheraMasUsada, "cocherasSinUsar" => $cocherasSinUsar, "cocheraMenosUsada" => $cocheraMenosUsada, "Usadas" => $cocherasUsadas);
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }

    private static function CocherasUsadasPorFecha($fechaInicio, $fechaFin){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT m.Patente,
                                                    m.Color,
                                                    m.Marca,
                                                    m.Fecha_Ingreso,
                                                    m.Fecha_Salida,
                                                    m.Importe,
                                                    c.Piso,
                                                    c.Numero
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                WHERE Fecha_Ingreso >= :fechaInicio AND Fecha_Ingreso <= :fechaFin
                                                ORDER BY Fecha_Ingreso");
            $consulta->bindValue(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }
    private static function CocherasUsadas(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT m.Patente,
                                                    m.Color,
                                                    m.Marca,
                                                    m.Fecha_Ingreso,
                                                    m.Fecha_Salida,
                                                    m.Importe,
                                                    c.Piso,
                                                    c.Numero
                                                FROM Movimientos m
                                                INNER JOIN Cochera c ON m.ID_Cochera = c.ID
                                                ORDER BY Fecha_Ingreso");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err){
            return AccesoDatos::ErrorMessageDB($err);
        }
    }
}
