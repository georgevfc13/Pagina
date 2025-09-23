<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/usuarioNatural.php";

class UsuarioNaturalController {
 public function login($data) {
        $contacto = $data['contacto'] ?? '';
        $password = $data['password'] ?? '';
        $resultado = $this->usuario->login($contacto, $password);
        if (is_array($resultado)) {
            // Login exitoso
            return [
                'success' => true,
                'usuario' => $resultado,
                'mensaje' => '✅ Bienvenido, ' . $resultado['nombre'],
            ];
        } else {
            // Error de login
            return [
                'success' => false,
                'mensaje' => $resultado,
            ];
        }
    }


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

        $resultado = $this->usuario->registrar();
        
            if ($resultado === true) {
        return "✅ Registro exitoso";
    } elseif ($resultado === false) {
        return "❌ Error al registrar";
    } else {
        // Si devuelve string (ejemplo: "⚠️ La cédula ya está registrada")
        return $resultado;
    }
            
    }
}
