<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/UsuarioJuridico.php";

class UsuarioJuridicoController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new UsuarioJuridico($this->db);
    }

    public function registrar($data) {
        $this->usuario->razon_social = $data['razon_social'];
        $this->usuario->correo = $data['correo'];

        
        $this->usuario->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->usuario->terminos = isset($data['terminos']) ? 1 : 0;

        return $this->usuario->registrar()
            ? "✅ Registro exitoso"
            : "❌ Error al registrar";
    }
}
