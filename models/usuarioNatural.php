<?php

// login
class UsuarioNatural {
    public function login($contacto, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE contacto = :contacto LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":contacto", $contacto);
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
    private $table = "usuarios_naturales";

    public $id;
    public $nombre;
    public $identificacion;
    public $fecha_nacimiento;
    public $genero;
    public $contacto;
    public $tipo_contacto;
    public $password;
    public $terminos;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function existeIdentificacion($identificacion) {
    $sql = "SELECT id FROM " . $this->table . " WHERE identificacion = :identificacion LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":identificacion", $identificacion);
    $stmt->execute();

    return $stmt->rowCount() > 0; // true si ya existe
}


    public function registrar() {
    if ($this->existeIdentificacion($this->identificacion)) {
        return "⚠️ El usuario ya está registrado";
    }
        $sql = "INSERT INTO " . $this->table . " 
            (nombre, identificacion, fecha_nacimiento, genero, contacto, tipo_contacto, password, terminos) 
            VALUES (:nombre, :identificacion, :fecha_nacimiento, :genero, :contacto, :tipo_contacto, :password, :terminos)";

        $stmt = $this->conn->prepare($sql);
         // Sanitizar
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->contacto = htmlspecialchars(strip_tags($this->contacto));
        $this->tipo_contacto = htmlspecialchars(strip_tags($this->tipo_contacto));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->terminos = intval($this->terminos);

        // Bind con PDO
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":identificacion", $this->identificacion);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":contacto", $this->contacto);
        $stmt->bindParam(":tipo_contacto", $this->tipo_contacto);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":terminos", $this->terminos);

        if  ($stmt->execute()){
            return true;
            }

            else {
            return false;
            }


    }
}
?>