<?php
// AJAX para editar y eliminar vacantes
header('Content-Type: application/json');
require_once 'VacanteController.php';
$controller = new VacanteController();

if (isset($_POST['editar_vacante'])) {
    $id = $_POST['id'];
    $data = [
        'titulo' => $_POST['titulo'],
        'descripcion' => $_POST['descripcion'],
        'ubicacion' => $_POST['ubicacion'],
        'tipo' => $_POST['tipo'],
        'empresa' => $_POST['empresa'],
        'salario' => $_POST['salario']
    ];
    $res = $controller->editarVacante($id, $data);
    if ($res === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $res]);
    }
    exit;
}
if (isset($_POST['eliminar_vacante'])) {
    $id = $_POST['id'];
    $res = $controller->eliminarVacante($id);
    if ($res === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $res]);
    }
    exit;
}
echo json_encode(['success' => false, 'error' => 'Acción no válida']);
