<?
include_once("./AccesoDatos.php");

class Usuario{
    
    static function agregarUsuario($usuario){
        // FIXME: arreglar la fecha
        $status = "error";
        $message = "";
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT into Usuarios(Username, Password, Nombre, Apellido, DNI, Telefono, Rol, Baja, Fecha)" 
                                                ."VALUES (:username, :pass, :nombre, :apellido, :dni, :tel, :rol, 0, :fecha)");
            $consulta->bindParam(":username", usuario["username"], PDO::PARAM_STR, 25);
            $consulta->bindParam(":pass", usuario["pass"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":nombre", usuario["nombre"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":apellido", usuario["apellido"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":dni", usuario["dni"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":tel", usuario["tel"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":rol", usuario["rol"]);
            $consulta->bindValue(":fecha", 'NOW()');
            $success = $consulta->execute();
            $status = "success";
        } catch(PDOException $err){
            $message = "Error al agregar usuario";
            $innerMessage = $err->getMessage();
        }

        return array("Status" => $status, "Mensaje" => $message);
    }

    static function traerUsuarios(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT (Username, Password, Nombre, Rol) from Usuarios");
            $consulta->execute();
            return $consulta->fetchall();
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    static function existeUsername($username){
        if(empty($username))
            die();
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT Username FROM Usuarios WHERE Username = :user");
            $consulta->bindValue(":user", $username, PDO::PARAM_STR);
            $consulta->execute();
            
            return $consulta->rowCount() > 0 ? true : false;
            
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    static function login($username, $pass){
        if(empty($username) || empty($pass)){
            return false;
        }

        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT Username, Password FROM Usuarios WHERE Username = :user AND Password = :pass");
            $consulta->bindValue(":user", $username, PDO::PARAM_STR);
            $consulta->bindValue(":pass", $pass, PDO::PARAM_STR);
            $consulta->execute();
            
            return $consulta->rowCount() > 0 ? true : false;
            
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }

    }
}

?>