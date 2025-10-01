<?php
require_once __DIR__ . '/../models/Vacante.php';

class VacanteController {
    // Registrar vacante (con íconos por tipo)
    public function registrarVacante() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'tipo' => $_POST['tipo'] ?? '',
                'empresa' => $_POST['empresa'] ?? '',
                'salario' => $_POST['salario'] ?? '',
            ];

            if (!isset($_SESSION)) session_start();
            if (!isset($_SESSION['id'])) {
                return 'Debes iniciar sesión para publicar una vacante.';
            }

            $data['usuario_id'] = $_SESSION['id'];
            $data['usuario_tipo'] = $_SESSION['tipo_usuario'] ?? 'natural';

            // 🔹 Iconos según tipo
            switch ($data['tipo']) {
                case 'Tecnología': $data['icono'] = 'fa-solid fa-laptop-code'; break;
                case 'Construcción': $data['icono'] = 'fa-solid fa-helmet-safety'; break;
                case 'Educación': $data['icono'] = 'fa-solid fa-chalkboard-teacher'; break;
                case 'Salud': $data['icono'] = 'fa-solid fa-user-nurse'; break;
                case 'Transporte': $data['icono'] = 'fa-solid fa-truck'; break;
                case 'Administración': $data['icono'] = 'fa-solid fa-briefcase'; break;
                default: $data['icono'] = 'fa-solid fa-briefcase';
            }

            $vacante = new Vacante();
            $resultado = $vacante->registrar($data);

            return $resultado === true ? true : 'Error al registrar la vacante: ' . $resultado;
        }
        return null;
    }

    // Obtener vacantes
    public function obtenerVacantes($limit = null) {
        $vacante = new Vacante();
        return $vacante->getVacantes($limit);
    }

    // Eliminar vacante propia
    public function eliminarVacante($id) {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            return "Debes iniciar sesión para eliminar una vacante.";
        }

        $vacante = new Vacante();
        return $vacante->eliminarVacantePropia($id, $_SESSION['id']);
    }

    // Aplicar a vacante
    public function aplicarVacante($vacante_id, $usuario_id) {
        $vacante = new Vacante();
        return $vacante->aplicar($vacante_id, $usuario_id);
    }

    // Editar vacante
    public function editarVacante($id, $data, ) {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['id'])) {
            return "Debes iniciar sesión para editar una vacante.";
        }

        $vacante = new Vacante();
        return $vacante->editarVacante($id, $data, $_SESSION['id']);
    }
}

// 👇 Bloque de acciones (cuando se accede por GET desde vistas)
if (isset($_GET['action'])) {
    $controller = new VacanteController();

    if ($_GET['action'] === 'registrar') {
        $resultado = $controller->registrarVacante();
        if ($resultado === true) {
            header('Location: ../views/vacantes.php?success=1');
        } else {
            header('Location: ../views/vacantes.php?error=' . urlencode($resultado));
        }
        exit();
    }

    if ($_GET['action'] === 'eliminar' && isset($_GET['id'])) {
        $resultado = $controller->eliminarVacante($_GET['id']);
        if ($resultado === true) {
            header('Location: ../views/vacantes.php?deleted=1');
        } else {
            header('Location: ../views/vacantes.php?error=' . urlencode($resultado));
        }
        exit();
    }

    if ($_GET['action'] === 'editar' && isset($_POST['id'])) {
        $resultado = $controller->editarVacante($_POST['id'], $_POST);
        if ($resultado === true) {
            header('Location: ../views/vacantes.php?edited=1');
        } else {
            header('Location: ../views/vacantes.php?error=' . urlencode($resultado));
        }
        exit();
    }
}
