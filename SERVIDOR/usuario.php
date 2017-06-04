<?
include_once("AccesoDatos.php");

class Usuario{
    
    static function AgregarUsuario($usuario){
        // FIXME: arreglar la fecha
        $status = "error";
        $message = "";
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT into Usuarios(Usuario, Password, Nombre, Apellido, DNI, Rol, Baja, Fecha)" 
                                                ."VALUES (:usuario, :pass, :nombre, :apellido, :dni, :rol, 0, NOW())");
            $consulta->bindParam(":usuario", $usuario["usuario"], PDO::PARAM_STR, 25);
            $consulta->bindParam(":pass", $usuario["pass"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":nombre", $usuario["nombre"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":apellido", $usuario["apellido"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":dni", $usuario["dni"], PDO::PARAM_STR, 50);
            $consulta->bindParam(":rol", $usuario["rol"]);
            $success = $consulta->execute();
            $status = "exito";
            $message = "Usuario agregado con exito";
        } catch(PDOException $err){
            $message = $err->getMessage();
        }

        return array("Status" => $status, "Mensaje" => $message);
    }

    static function TraerUsuarios(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Apellido, Nombre,  DNI, Usuario, Rol, Fecha, Baja FROM Usuarios ORDER BY Apellido, Nombre");
            $consulta->execute();
            return $consulta->fetchall(PDO::FETCH_ASSOC);
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    static function ExisteUsuario($username){
        if(empty($username))
            die();
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT Usuario FROM Usuarios WHERE Usuario = :user");
            $consulta->bindValue(":user", $username, PDO::PARAM_STR);
            $consulta->execute();
            
            return $consulta->rowCount() > 0 ? true : false;
            
        } catch(PDOException $err){
            return array("Status" =>"error", "Mensaje" => "No se pudo agregar el usuario. Intentelo nuevamente mas tarde.");
        }
    }

    static function Login($username, $pass){
        if(empty($username) || empty($pass)){
            return false;
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Rol, Baja FROM Usuarios WHERE Usuario = :user AND Password = :pass");
            $consulta->bindValue(":user", $username, PDO::PARAM_STR);
            $consulta->bindValue(":pass", $pass, PDO::PARAM_STR);
            $consulta->execute();
            
            if($consulta->rowCount() > 0){
                $user = $consulta->fetch(PDO::FETCH_ASSOC);
                return Usuario::RegistrarLogin($user["ID"])? $user : false;
            }
            
            
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }

    }

    static function RegistrarLogin($id){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT INTO login_usuarios VALUES (:id, NOW())");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            return $consulta->execute();
        } catch(PDOException $err){
            return false;
        }
    }

    static function SuspenderUsuario($id){
        if($id < 1){
            return "error";
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Usuarios SET Baja = 1 WHERE ID = :id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->rowCount() > 0? "success" : "error";
        } catch(PDOException $err){
            return "error";
        }
    }

    static function HabilitarUsuario($id){
        if($id < 1){
            return "error";
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Usuarios SET Baja = 0 WHERE ID = :id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->rowCount() > 0? "success" : "error";
        } catch(PDOException $err){
            return "error";
        }
    }
    
    static function BorrarUsuario($id){
        if($id < 1){
            return "error";
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("DELETE FROM Usuarios WHERE ID = :id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->rowCount() > 0? "success" : "error";
        } catch(PDOException $err){
            return "error";
        }
    }
}

?>