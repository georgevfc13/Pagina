<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/usuarioNatural.php";

class UsuarioNaturalController {
 public function login($data):array    {
     $identificacion = $data['identificacion'] ?? '';
     $password = $data['password'] ?? '';
     $resultado = $this->usuario->login($identificacion, $password);
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
            $_SESSION['foto_perfil'] = $usuario['foto_perfil'] ?? '../assets/img/mancitoSinfoto.png';
            $_SESSION['tipo_contacto'] = $usuario['tipo_contacto'] ?? '';
            $_SESSION['tipo'] = 'natural';
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
        $datosActualizar = $data;
        // Si viene archivo, procesarlo
        if (!empty($file['tmp_name'])) {
            $carpeta = __DIR__ . "/../uploads/fotos/";
            if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

            $nombreArchivo = uniqid('foto_') . "_" . basename($file['name']);
            $rutaServidor  = $carpeta . $nombreArchivo;
            $info = getimagesize($file['tmp_name']);
            if ($info && move_uploaded_file($file['tmp_name'], $rutaServidor)) {
                $rutaBD = "../uploads/fotos/" . $nombreArchivo;
                $datosActualizar['foto_perfil'] = $rutaBD;
            }
        } else {
            // Si no se sube imagen, no modificar foto_perfil
            unset($datosActualizar['foto_perfil']);
        }
        $this->usuario->actualizar($id, $datosActualizar);
        // Refrescar TODA la sesión con los datos actuales de la BD
        $sql = "SELECT id, nombre, identificacion, fecha_nacimiento, genero, contacto, tipo_contacto, foto_perfil FROM usuarios_naturales WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['identificacion'] = $usuario['identificacion'] ?? '';
            $_SESSION['fecha_nacimiento'] = $usuario['fecha_nacimiento'] ?? '';
            $_SESSION['genero'] = $usuario['genero'] ?? '';
            $_SESSION['contacto'] = $usuario['contacto'] ?? '';
            $_SESSION['tipo_contacto'] = $usuario['tipo_contacto'] ?? '';
            // Si la ruta existe y el archivo existe, usarla; si no, default
            if (!empty($usuario['foto_perfil']) && file_exists(str_replace('..','.', $usuario['foto_perfil']))) {
                $_SESSION['foto_perfil'] = $usuario['foto_perfil'];
            } else {
                $_SESSION['foto_perfil'] = '../assets/img/mancitoSinfoto.png';
            }
            $_SESSION['tipo'] = 'natural';
        } else {
            // fallback si no se encuentra el usuario
            $_SESSION['foto_perfil'] = '../assets/img/mancitoSinfoto.png';
        }
    }


}

