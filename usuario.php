<?

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
        $success = false;
        $message = "";
        try{
            $pdo = new PDO('mysql:host:localhost; dbname:Estacionamiento', 'root', '12345');
            $consulta = $pdo->query("INSERT into Usuarios(Username, Password, Nombre, Rol, Baja, Fecha) values (:username, :pass, :nombre, :rol, 0, :fecha)");
            $consulta->bindParam(":username", $this->username);
            $consulta->bindParam(":pass", $this->pass);
            $consulta->bindParam(":nombre", $this->nombreCompleto);
            $consulta->bindParam(":rol", $this->rol);
            $consulta->bindValue(":fecha", 'NOW()');
            $consulta->execute();
            $success = true;

        }catch($e){
            $message = "Error al agregar usuario;
            
        }
        return array("Success" -> $success, "Mensaje" -> $message);
    }
}

?>