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

            if (!isset($_SESSION)) session_start();
            if (!isset($_SESSION['id'])) {
                return 'Debes iniciar sesión para publicar un servicio.';
            }

            $data['usuario_id'] = $_SESSION['id'];
            $data['usuario_tipo'] = isset($_SESSION['tipo_usuario']) && in_array($_SESSION['tipo_usuario'], ['natural','juridico'])
                ? $_SESSION['tipo_usuario']
                : 'natural';

            // 🔹 Asignar icono según el tipo
            switch ($data['tipo']) {
                case 'Reparaciones':
                    $data['icono'] = 'fa-solid fa-screwdriver-wrench';
                    break;
                case 'Clases particulares':
                    $data['icono'] = 'fa-solid fa-chalkboard-teacher';
                    break;
                case 'Transporte':
                    $data['icono'] = 'fa-solid fa-truck';
                    break;
                case 'Cuidado personal':
                    $data['icono'] = 'fa-solid fa-user-nurse';
                    break;
                case 'Tecnología':
                    $data['icono'] = 'fa-solid fa-laptop-code';
                    break;
                case 'Otro':
                    $data['icono'] = 'fa-solid fa-briefcase';
                    break;
                default:
                    $data['icono'] = 'fa-solid fa-briefcase'; // genérico
            }

            $servicio = new Servicio();
            $resultado = $servicio->registrar($data);

            return $resultado === true ? true : 'Error al registrar el servicio: ' . $resultado;
        }
        return null;
    }

    public function editarServicio($id, $data) {
        $servicio = new Servicio();
        return $servicio->editarServicio($id, $data);
    }

    public function eliminarServicio($id) {
        $servicio = new Servicio();
        return $servicio->eliminarServicio($id);
    }

    public function obtenerServicios($limit = null) {
        $servicio = new Servicio();
        return $servicio->getAllServicios($limit);
    }
}

// 👇 Bloque para manejar acciones (fuera de la clase)
if (isset($_GET['action']) && $_GET['action'] === 'registrar') {
    $controller = new ServicioController();
    $resultado = $controller->registrarServicio();

    if ($resultado === true) {
        header('Location: ../views/servicios.php?success=1');
    } else {
        header('Location: ../views/servicios.php?error=' . urlencode($resultado));
    }
    exit();
}
