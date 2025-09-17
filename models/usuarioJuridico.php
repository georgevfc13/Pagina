<?php
class UsuarioJuridico {
    private $conn;
    private $table = "usuarios_juridicos";

    public $razon_social;
    public $correo;
    public $password;
    public $terminos;
    

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $sql = "INSERT INTO " . $this->table . " 
            (razon_social, correo, password, terminos) 
            VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssi",
            $this->razon_social,
            $this->correo,
            $this->password,
            $this->terminos
        );

        return $stmt->execute();
    }
}
?>