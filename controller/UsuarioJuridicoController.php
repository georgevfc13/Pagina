<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/UsuarioJuridico.php";
// dentro de controller/PerfilJuridicoController.php



class UsuarioJuridicoController {
public function login($data) {
        $correo = $data['correo'] ?? '';
        $password = $data['password'] ?? '';
        $resultado = $this->usuario->login($correo, $password);
        if (is_array($resultado)) {
            // Login exitoso
            return [
                'success' => true,
                'usuario' => $resultado,
                'mensaje' => '✅ Bienvenido, ' . $resultado['razon_social'],
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
        $this->usuario = new UsuarioJuridico($this->db);
    }

    public function registrar($data) {
        $this->usuario->razon_social = $data['razon_social'];
        $this->usuario->correo = $data['correo'];

        
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
