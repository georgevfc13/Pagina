<?php
// Controlador para mostrar y gestionar servicios subidos por el usuario
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
require_once '../models/servicio.php';

$usuarioId = $_SESSION['id'];
$servicioModel = new Servicio();
$servicios = $servicioModel->getServiciosByUsuario($usuarioId);

// Procesar eliminación
if (isset($_POST['eliminar_servicio'])) {
    $id = $_POST['delete_id'];
    $servicioModel->eliminarServicioPropio($id, $usuarioId);
    header('Location: servicios_subidos.php');
    exit();
}
// Procesar edición
if (isset($_POST['editar_servicio'])) {
    $id = $_POST['edit_id'];
    $data = [
        'titulo' => $_POST['edit_titulo'],
        'descripcion' => $_POST['edit_descripcion'],
        'ubicacion' => $_POST['edit_ubicacion'],
        'tipo' => $_POST['edit_tipo'],
        'empresa' => $_POST['edit_empresa'],
        'precio' => $_POST['edit_precio']
    ];
    $servicioModel->editarServicioPropio($id, $data, $usuarioId);
    header('Location: servicios_subidos.php');
    exit();
}
