<?php
// AJAX para editar y eliminar vacantes
header('Content-Type: application/json');
require_once 'VacanteController.php';
$controller = new VacanteController();

if (isset($_POST['editar_vacante'])) {
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'error' => 'Debes iniciar sesión para editar.']);
        exit;
    }
    $id = $_POST['id'];
    $data = [
        'titulo' => $_POST['titulo'],
        'descripcion' => $_POST['descripcion'],
        'ubicacion' => $_POST['ubicacion'],
        'tipo' => $_POST['tipo'],
        'empresa' => $_POST['empresa'],
        'salario' => $_POST['salario'],
        'usuario_tipo' => $_POST['usuario_tipo'] ?? ($_SESSION['tipo_usuario'] ?? 'natural'),
        'usuario_id' => $_SESSION['id']
    ];
    // DEBUG: mostrar datos recibidos
    file_put_contents(__DIR__.'/debug_vacante_ajax.log', date('Y-m-d H:i:s')."\n".json_encode($_POST)."\n", FILE_APPEND);
    $res = $controller->editarVacante($id, $data);
    if ($res === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $res]);
    }
    exit;
}
if (isset($_POST['eliminar_vacante'])) {
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'error' => 'Debes iniciar sesión para eliminar.']);
        exit;
    }
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
