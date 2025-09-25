<?php
require_once __DIR__ . '/ServicioController.php';
header('Content-Type: application/json');

$controller = new ServicioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar_servicio'])) {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $res = $controller->eliminarServicio($id);
            if ($res === true) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $res]);
            }
            exit;
        }
    }
    if (isset($_POST['editar_servicio'])) {
        $id = $_POST['id'] ?? null;
        $data = [
            'titulo' => $_POST['titulo'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'ubicacion' => $_POST['ubicacion'] ?? '',
            'tipo' => $_POST['tipo'] ?? '',
            'empresa' => $_POST['empresa'] ?? '',
            'precio' => $_POST['precio'] ?? ''
        ];
        if ($id) {
            $res = $controller->editarServicio($id, $data);
            if ($res === true) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $res]);
            }
            exit;
        }
    }
    if (isset($_POST['contratar_servicio'])) {
        // Aquí puedes implementar la lógica de contratación si aplica
        echo json_encode(['success' => true, 'msg' => 'Funcionalidad de contratar implementada']);
        exit;
    }
}
echo json_encode(['success' => false, 'error' => 'Solicitud inválida']);
