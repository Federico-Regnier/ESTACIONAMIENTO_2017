<?
include_once("AccesoDatos.php");

class Usuario{
    
    public static function AgregarUsuario($usuario){
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
            $status = "success";
            $message = "Usuario agregado con exito";
        } catch(PDOException $err){
            $message = $err->getMessage();
        }

        return array("Status" => $status, "Mensaje" => $message);
    }

    public static function TraerUsuarios(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Apellido, Nombre,  DNI, Usuario, Turno, Rol, Fecha, Baja FROM Usuarios ORDER BY Apellido, Nombre");
            $consulta->execute();
            return $consulta->fetchall(PDO::FETCH_ASSOC);
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    public static function TraerUsuario($id){
        if(empty($id))
            return array();
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT  ID as id,
                                                        Usuario as usuario,
                                                        Nombre as nombre, 
                                                        Apellido as apellido, 
                                                        DNI as dni,
                                                        Turno as turno, 
                                                        Baja as estado, 
                                                        Rol as rol
                                                FROM Usuarios 
                                                WHERE ID =:id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado : array();
            
        } catch(PDOException $err){
            return array();
        }
    }

    public static function ModificarUsuario($usuario){
        if(!isset($usuario["id"]) || $usuario["id"] <= 0){
            return json_encode($usuario);
        }

        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Usuarios
                                                SET Nombre =:nombre, 
                                                    Apellido =:apellido, 
                                                    DNI =:dni,
                                                    Turno =:turno, 
                                                    Baja =:estado, 
                                                    Rol =:rol
                                                WHERE ID =:id");
            $consulta->bindValue(":id", $usuario["id"], PDO::PARAM_INT);
            $consulta->bindValue(":nombre",$usuario["nombre"], PDO::PARAM_STR);
            $consulta->bindValue(":apellido",$usuario["apellido"], PDO::PARAM_STR);
            $consulta->bindValue(":dni",$usuario["dni"], PDO::PARAM_STR);
            $consulta->bindValue(":turno", $usuario["turno"], PDO::PARAM_INT);
            $consulta->bindValue(":estado",$usuario["estado"], PDO::PARAM_INT);
            $consulta->bindValue(":rol",$usuario["rol"], PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->rowCount() > 0 ? "success" : "Error al modificar el usuario";
            
        } catch(PDOException $err){
            return "Error al comunicarse con la base de datos";
        }

    }

    public static function ModificarPass($id, $passActual, $passNueva){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Usuarios SET Password= :passNueva WHERE ID = :id && Password = :passActual");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->bindValue(":passNueva", $passNueva, PDO::PARAM_STR);
            $consulta->bindValue(":passActual", $passActual, PDO::PARAM_STR);
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return "success";
            }
            return "Contrase&ntilde;a incorrecta";
            
        } catch(PDOException $err){
            return "Error al comunicarse con la base de datos";
        }

    }

    public static function ExisteUsuario($username){
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

    public static function Login($username, $pass){
        if(empty($username) || empty($pass)){
            return "Usuario o contrase&ntilde;a incorrectos";
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT ID, Rol, Baja FROM Usuarios WHERE Usuario = :user AND Password = :pass");
            $consulta->bindValue(":user", $username, PDO::PARAM_STR);
            $consulta->bindValue(":pass", $pass, PDO::PARAM_STR);
            $consulta->execute();
            
            if($consulta->rowCount() > 0){
                $user = $consulta->fetch(PDO::FETCH_ASSOC);
                if($user["Baja"] == 0){
                    return Usuario::RegistrarLogin($user["ID"])? $user : "Error al ingresar";
                } else{
                    return "Usuario Suspendido";
                }
            }

            return "Usuario o contrase&ntilde;a incorrectos";

        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    public static function RegistrarLogin($id){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT INTO login_usuarios(ID_Usuario, Login) VALUES (:id, NOW())");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            return $consulta->execute();
        } catch(PDOException $err){
            return false;
        }
    }

    public static function SuspenderUsuario($id){
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

    public static function HabilitarUsuario($id){
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
    
    public static function BorrarUsuario($id){
        if($id < 1){
            return "error";
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE Usuarios SET Baja = 2 WHERE ID = :id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->rowCount() > 0? "success" : "error";
        } catch(PDOException $err){
            return "error";
        }
    }

    public static function DatosLoginUsuario($id){
        if($id < 1){
            return array();
        }
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT Login, Logout 
                                                FROM login_usuarios
                                                WHERE ID_Usuario =:id");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchall(PDO::FETCH_ASSOC);
        } catch(PDOException $err){
            return array();
        }
    }

    public static function RegistrarLogout($id){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("UPDATE `login_usuarios` usr,
                                                (SELECT ID FROM login_usuarios WHERE ID_Usuario = :id AND Logout IS NULL ORDER BY ID DESC LIMIT 1) as tmp
                                                SET Logout = NOW()
                                                WHERE usr.ID = tmp.ID ");
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            if($consulta->execute()){
                return "success";
            }
            return "error";
        } catch(PDOException $err){
            return "error";
        }
    }
}

?>