<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/EmpresaRut.php";

class EmpresaRutController {

    private $db;
    private $empresa;

    public function __construct() {
        $database   = new Database();
        $this->db   = $database->getConnection();
        // Se instancia el MODELO, no el controlador
        $this->empresa = new EmpresaRut($this->db);
    }

    /**
     * Login de empresa por NIT y contraseña
     */
    public function login($data) {
        $nit      = $data['nit']      ?? '';
        $password = $data['password'] ?? '';

        $resultado = $this->empresa->login($nit, $password);

        if (is_array($resultado)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Guardar datos en sesión
            $_SESSION['id']            = $resultado['id'];
            $_SESSION['razon_social']  = $resultado['razon_social'];
            $_SESSION['nit']           = $resultado['nit'];
            $_SESSION['representante'] = $resultado['representante'] ?? '';
            $_SESSION['contacto']      = $resultado['contacto']      ?? '';
            $_SESSION['foto_perfil']   = $resultado['foto_perfil']   ?? '../assets/img/logo.jpg';
            $_SESSION['tipo_usuario']  = 'juridico';

            return [
                'success' => true,
                'empresa' => $resultado,
                'mensaje' => '✅ Bienvenido, ' . $resultado['razon_social'],
            ];
        } else {
            return [
                'success' => false,
                'mensaje' => $resultado, // mensaje de error desde el modelo
            ];
        }
    }

    /**
     * Registro de nueva empresa
     */
    public function registrar($data) {
        $this->empresa->nit           = $data['nit']           ?? '';
        $this->empresa->razon_social  = $data['razon_social']  ?? '';
        $this->empresa->direccion     = $data['direccion']     ?? '';
        $this->empresa->contacto      = $data['contacto']      ?? '';
        $this->empresa->tipo_contacto = $data['tipo_contacto'] ?? 'correo';
        $this->empresa->password      = $data['password']      ?? '';
        $this->empresa->terminos      = isset($data['terminos']) ? 1 : 0;

        // Foto de perfil (por defecto)
        $rutaPredeterminada = '../assets/img/mancitoSinfoto.png';
        $fotoFinal = $rutaPredeterminada;

        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $tmpName       = $_FILES['foto_perfil']['tmp_name'];
            $nombreArchivo = uniqid('foto_') . '_' . basename($_FILES['foto_perfil']['name']);
            $destino       = '../assets/img/' . $nombreArchivo;

            if (move_uploaded_file($tmpName, $destino)) {
                $fotoFinal = $destino;
            }
        }
        $this->empresa->foto_perfil = $fotoFinal;

        // Insertar en BD
        $resultado = $this->empresa->registrar();

        if ($resultado === true) {
            return "✅ Registro exitoso";
        } elseif ($resultado === false) {
            return "❌ Error al registrar";
        } else {
            return $resultado; // mensaje de error o NIT existente
        }
    }

    /**
     * Actualizar perfil de empresa
     */
    public function actualizarPerfil($id, $data, $file) {
        // Actualizar datos principales
        $this->empresa->actualizar($id, $data);

        // Procesar foto si se subió
        if (!empty($file['tmp_name'])) {
            $carpeta = __DIR__ . "/../uploads/fotos/";
            if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

            $nombreArchivo = uniqid('foto_') . "_" . basename($file['name']);
            $rutaServidor  = $carpeta . $nombreArchivo;

            $info = getimagesize($file['tmp_name']);
            if ($info && move_uploaded_file($file['tmp_name'], $rutaServidor)) {
                $rutaBD = "../uploads/fotos/" . $nombreArchivo;
                $this->empresa->actualizar($id, ['foto_perfil' => $rutaBD]);
                $_SESSION['foto_perfil'] = $rutaBD;
            }
        }

        // Refrescar variables de sesión
        $_SESSION['razon_social']  = $data['razon_social']  ?? $_SESSION['razon_social'];
        $_SESSION['nit']           = $data['nit']           ?? $_SESSION['nit'];
        $_SESSION['representante'] = $data['representante'] ?? $_SESSION['representante'];
        $_SESSION['contacto']      = $data['contacto']      ?? $_SESSION['contacto'];

        if (empty($_SESSION['foto_perfil'])) {
            $_SESSION['foto_perfil'] = '../assets/img/logo.jpg';
        }
    }
}
