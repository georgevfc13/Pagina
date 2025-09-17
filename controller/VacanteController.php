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
                'salario' => $_POST['salario'] ?? ''
            ];
            // Validación básica
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['ubicacion']) || empty($data['tipo']) || empty($data['empresa'])) {
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
}
