<?php
require_once __DIR__ . '/../models/servicio.php';

class ServicioController {
    public function registrarServicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'tipo' => $_POST['tipo'] ?? '',
                'empresa' => $_POST['empresa'] ?? '',
                'precio' => $_POST['precio'] ?? ''
            ];
            // Validación básica
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['ubicacion']) || empty($data['tipo'])) {
                return 'Todos los campos obligatorios deben ser completados.';
            }
            $servicio = new Servicio();
            $resultado = $servicio->registrar($data);
            if ($resultado === true) {
                return true;
            } else {
                return 'Error al registrar el servicio: ' . $resultado;
            }
        }
        return null;
    }
    /**
     * Editar un servicio existente
     */
    public function editarServicio($id, $data) {
        $servicio = new Servicio();
        return $servicio->editarServicio($id, $data);
    }

    /**
     * Eliminar un servicio por su ID
     */
    public function eliminarServicio($id) {
        $servicio = new Servicio();
        return $servicio->eliminarServicio($id);
    }
}
