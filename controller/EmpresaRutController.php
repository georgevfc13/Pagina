<?php
require_once __DIR__ . "/../config/dataBase.php";
require_once __DIR__ . "/../models/EmpresaRut.php";
// controller/EmpresaRUTController.php

class EmpresaRutController {

    private $db;
    private $empresa;

    public function __construct() {
        $database   = new Database();
        $this->db   = $database->getConnection();
        // Aquí debe instanciar el MODELO, no el controlador
        $this->empresa = new EmpresaRut($this->db);
    }

    /**
     * Login por contacto (correo o celular) y contraseña
     */
    public function login($data) {
        $nit = $data['nit'] ?? '';
        $password = $data['password'] ?? '';

        $resultado = $this->empresa->login($nit, $password);

        if (is_array($resultado)) {
            return [
                'success' => true,
                'empresa' => $resultado,
                'mensaje' => '✅ Bienvenido, ' . $resultado['razon_social'],
            ];
        } else {
            return [
                'success' => false,
                'mensaje' => $resultado,
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

        // Foto de perfil
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
}
