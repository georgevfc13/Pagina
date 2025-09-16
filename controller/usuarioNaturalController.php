<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/usuarioNatural.php";

class UsuarioNaturalController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new UsuarioNatural($this->db);
    }

    public function registrar($data) {
        $this->usuario->nombre = $data['nombre'];
        $this->usuario->identificacion = $data['identificacion'];
        $this->usuario->fecha_nacimiento = $data['fecha_nacimiento'];
        $this->usuario->genero = $data['genero'];
        $this->usuario->contacto = $data['contacto'];
        $this->usuario->tipo_contacto = $data['tipo_contacto'];
        $this->usuario->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->usuario->terminos = isset($data['terminos']) ? 1 : 0;

        return $this->usuario->registrar()
            ? "✅ Registro exitoso"
            : "❌ Error al registrar";
    }
}
