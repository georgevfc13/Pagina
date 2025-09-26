<?php
class UsuarioJuridico {


     public function login($correo, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE correo = :correo LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        } else if ($usuario) {
            return "❌ Contraseña incorrecta";
        } else {
            return "❌ Usuario no encontrado";
        }
    }

    private $conn;
    private $table = "usuarios_juridicos";

    public $razon_social;
    public $correo;
    public $password;
    public $terminos;
    public $foto_perfil;
    

    public function __construct($db) {
        $this->conn = $db;
    }

    public function existeIdentificacion($correo) {
    $sql = "SELECT id FROM " . $this->table . " WHERE correo = :correo LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":correo", $correo);
    $stmt->execute();

    return $stmt->rowCount() > 0; // true si ya existe
}


    
    public function registrar() {
        if ($this->existeIdentificacion($this->correo)) {
            return "⚠️ El usuario ya está registrado";
        }
        $sql = "INSERT INTO " . $this->table . " 
            (razon_social, correo, password, terminos, foto_perfil) 
            VALUES (:razon_social, :correo, :password, :terminos, :foto_perfil)";

        $stmt = $this->conn->prepare($sql);

        // Sanitizar
        $this->razon_social = htmlspecialchars(strip_tags($this->razon_social));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->terminos = intval($this->terminos);
        $this->foto_perfil = htmlspecialchars(strip_tags($this->foto_perfil));
        // Bind con PDO
        $stmt->bindParam(":razon_social", $this->razon_social);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":terminos", $this->terminos);
        $stmt->bindParam(":foto_perfil", $this->foto_perfil);

        if  ($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }


    // Obtener datos del usuario por ID
    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener vacantes publicadas por el usuario
    public function getVacantes($id) {
        $sql = "SELECT * FROM vacantes WHERE usuario_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener servicios publicados por el usuario
    public function getServicios($id) {
        $sql = "SELECT * FROM servicios WHERE usuario_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>