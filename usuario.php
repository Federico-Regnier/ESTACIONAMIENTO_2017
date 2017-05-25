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
        // Falta checkear que el usuario no exista y arreglar la fecha
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

    function traerUsuarios(){
        try{
            $pdo = AccesoDatos::getAccesoDB();
            $consulta = $pdo->RetornarConsulta("SELECT (Username, Password, Nombre, Rol) from Usuarios");
            $consulta->execute();
            return $consulta->fetchall();
        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }
}

?>