<?
include_once("./AccesoDatos.php");

class Usuario{
    public $username;
    public $pass;
    public $nombreCompleto;
    public $rol;

    function __construct($username, $pass, $nombre, $rol){
        $this->username = $username;
        $this->pass = $pass;
        $this->nombreCompleto = $nombre;
        $this->rol = $rol;
    }
    
    function agregarUsuario(){
        // FIXME: arreglar la fecha
        $success = false;
        $message = "";
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("INSERT into Usuarios(Username, Password, Nombre, Rol, Baja, Fecha) values (:username, :pass, :nombre, :rol, 0, :fecha)");
            $consulta->bindParam(":username", $this->username, PDO::PARAM_STR, 25);
            $consulta->bindParam(":pass", $this->pass, PDO::PARAM_STR, 50);
            $consulta->bindParam(":nombre", $this->nombreCompleto, PDO::PARAM_STR, 50);
            $consulta->bindParam(":rol", $this->rol);
            $consulta->bindValue(":fecha", 'NOW()');
            $success = $consulta->execute();
        } catch(PDOException $err){
            $message = "Error al agregar usuario";
            $innerMessage = $err->getMessage();
        }

        return array("Success" => $success, "Mensaje" => $message);
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