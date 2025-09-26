<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/usuarioNatural.php";

class UsuarioNaturalController {
 public function login($data) {
        $contacto = $data['contacto'] ?? '';
        $password = $data['password'] ?? '';
        $resultado = $this->usuario->login($contacto, $password);
        if (is_array($resultado)) {

            if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['id'] = $resultado['id'];
        $_SESSION['nombre'] = $resultado['nombre'];
        $_SESSION['identificacion'] = $resultado['identificacion'] ?? '';
        $_SESSION['fecha_nacimiento'] = $resultado['fecha_nacimiento'] ?? '';
        $_SESSION['genero'] = $resultado['genero'] ?? '';
        $_SESSION['contacto'] = $resultado['contacto'] ?? '';
    $_SESSION['tipo_contacto'] = $resultado['tipo_contacto'] ?? '';
    $_SESSION['tipo'] = 'natural'; // si tienes tipo definido
    $_SESSION['foto_perfil'] = $resultado['foto_perfil'] ?? null;
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
        // 🔹 Traer el usuario recién creado
    $sql = "SELECT id, nombre, identificacion, fecha_nacimiento, genero, contacto, tipo_contacto, foto_perfil 
        FROM usuarios_naturales WHERE contacto = :contacto LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":contacto", $this->usuario->contacto);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['identificacion'] = $usuario['identificacion'] ?? '';
            $_SESSION['fecha_nacimiento'] = $usuario['fecha_nacimiento'] ?? '';
            $_SESSION['genero'] = $usuario['genero'] ?? '';
            $_SESSION['contacto'] = $usuario['contacto'] ?? '';
            $_SESSION['foto_perfil'] = $usuario['foto_perfil'] ?? '';
            $_SESSION['tipo_contacto'] = $usuario['tipo_contacto'] ?? '';
            $_SESSION['tipo'] = 'natural';
            $_SESSION['foto_perfil'] = $usuario['foto_perfil'] ?? null; // 🔹 añadir esto
        }

        return "✅ Registro exitoso";
    } elseif ($resultado === false) {
        return "❌ Error al registrar";
    } else {
        return $resultado;
    }
}




  public function actualizarPerfil($id, $data, $file) {
        // 1. Actualizar datos de texto
        $this->usuario->actualizar($id, $data);

        // 2. Si viene archivo, procesarlo
        if (!empty($file['tmp_name'])) {
            $carpeta = __DIR__ . "/../uploads/fotos/";
            if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

            $nombreArchivo = uniqid('foto_') . "_" . basename($file['name']);
            $rutaServidor  = $carpeta . $nombreArchivo;
            $info = getimagesize($file['tmp_name']);
            if ($info && move_uploaded_file($file['tmp_name'], $rutaServidor)) {
                $rutaBD = "../uploads/fotos/" . $nombreArchivo;
                $this->usuario->actualizar($id, ['foto_perfil' => $rutaBD]);
                $_SESSION['foto_perfil'] = $rutaBD;
            }
        }
        // Refrescar variables de sesión básicas
        $_SESSION['nombre']           = $data['nombre'];
        $_SESSION['contacto']         = $data['contacto'];
        $_SESSION['genero']           = $data['genero'];
        $_SESSION['tipo_contacto']    = $data['tipo_contacto'];
        $_SESSION['fecha_nacimiento'] = $data['fecha_nacimiento'];
        // Si no hay foto cargada y no existe en sesión, poner default
        if (empty($_SESSION['foto_perfil'])) {
            $_SESSION['foto_perfil'] = '../assets/img/logo.jpg';
        }
    }


}

