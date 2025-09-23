<?php
require_once __DIR__ . '/../models/vacante.php';

class VacanteController {
    public function registrarVacante() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'tipo' => $_POST['tipo'] ?? '',
                'empresa' => $_POST['empresa'] ?? '',
                'salario' => $_POST['salario'] ?? '',
                'vacantes_disponibles' => $_POST['vacantes_disponibles'] ?? 1
            ];
            // Validación básica
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['ubicacion']) || empty($data['tipo']) || empty($data['empresa']) || empty($data['vacantes_disponibles'])) {
                return 'Todos los campos obligatorios deben ser completados.';
            }
            $vacante = new Vacante();
            $resultado = $vacante->registrar($data);
            if ($resultado === true) {
                return true;
            } else {
                return 'Error al registrar la vacante: ' . $resultado;
            }
        }
        return null;
    }

        public function aplicarVacante($vacante_id, $usuario_id = null) {
        $vacante = new Vacante();
        return $vacante->aplicar($vacante_id, $usuario_id);
    }
    /**
     * Editar una vacante existente
     */

    
    public function editarVacante($id, $data) {
        $vacante = new Vacante();
        return $vacante->editarVacante($id, $data);
    }

    /**
     * Eliminar una vacante por su ID
     */
    public function eliminarVacante($id) {
        $vacante = new Vacante();
        return $vacante->eliminarVacante($id);
    }
}
