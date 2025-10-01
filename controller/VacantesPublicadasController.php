<?php
// Controlador para mostrar y gestionar vacantes publicadas por el usuario
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
require_once '../models/vacante.php';

$usuarioId = $_SESSION['id'];
$vacanteModel = new Vacante();
$vacantes = $vacanteModel->getVacantes($usuarioId);

// Procesar eliminación
if (isset($_POST['eliminar_vacante'])) {
    $id = $_POST['delete_id'];
    $vacanteModel->eliminarVacantePropia($id, $usuarioId);
    header('Location: vacantes_aplicadas.php');
    exit();
}
// Procesar edición
if (isset($_POST['editar_vacante'])) {
    $id = $_POST['edit_id'];
    $data = [
        'titulo' => $_POST['edit_titulo'],
        'descripcion' => $_POST['edit_descripcion'],
        'ubicacion' => $_POST['edit_ubicacion'],
        'tipo' => $_POST['edit_tipo'],
        'empresa' => $_POST['edit_empresa'],
        'salario' => $_POST['edit_salario']
    ];
    $vacanteModel->editarVacante($id, $data, $usuarioId);
    header('Location: vacantes_aplicadas.php');
    exit();
}
