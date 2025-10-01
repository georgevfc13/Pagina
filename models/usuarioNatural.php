<?php

// login
class UsuarioNatural {
   public function login($identificacion, $password) {
    $sql = "SELECT id, nombre, identificacion, fecha_nacimiento, genero, contacto, tipo_contacto, foto_perfil, password 
            FROM " . $this->table . " 
            WHERE identificacion = :identificacion LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":identificacion", $identificacion);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        unset($usuario['password']); // 🚫 no devolver la contraseña
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


    // Método para actualizar datos

  public function actualizar($id, $datos) {
    $campos = [];
    $params = [':id' => $id];

    if (!empty($datos['nombre'])) {
        $campos[] = "nombre = :nombre";
        $params[':nombre'] = $datos['nombre'];
    }
    if (!empty($datos['contacto'])) {
        $campos[] = "contacto = :contacto";
        $params[':contacto'] = $datos['contacto'];
    }
    if (!empty($datos['genero'])) {
        $campos[] = "genero = :genero";
        $params[':genero'] = $datos['genero'];
    }
    if (!empty($datos['tipo_contacto'])) {
        $campos[] = "tipo_contacto = :tipo_contacto";
        $params[':tipo_contacto'] = $datos['tipo_contacto'];
    }
    if (!empty($datos['fecha_nacimiento'])) {
        $campos[] = "fecha_nacimiento = :fecha_nacimiento";
        $params[':fecha_nacimiento'] = $datos['fecha_nacimiento'];
    }
    if (!empty($datos['foto_perfil'])) {
        $campos[] = "foto_perfil = :foto_perfil";
        $params[':foto_perfil'] = $datos['foto_perfil'];
    }

    if (empty($campos)) {
        return false; // nada que actualizar
    }

    $sql = "UPDATE {$this->table} SET " . implode(', ', $campos) . " WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
}


}
?>