<?php
require_once __DIR__ . '/VacanteController.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vacante_id'])) {
    $vacante_id = intval($_POST['vacante_id']);
    $usuario_id = isset($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null;
    $controller = new VacanteController();
    $resultado = $controller->aplicarVacante($vacante_id, $usuario_id);
    if ($resultado === true) {
        // Obtener el nuevo número de aplicados
        require_once __DIR__ . '/../config/dataBase.php';
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT aplicados FROM vacantes WHERE id = ?');
        $stmt->execute([$vacante_id]);
        $aplicados = ($row = $stmt->fetch(PDO::FETCH_ASSOC)) ? (int)$row['aplicados'] : 0;
        echo json_encode(['success' => true, 'aplicados' => $aplicados]);
    } else {
        echo json_encode(['success' => false, 'error' => $resultado]);
    }
    exit;
}
echo json_encode(['success' => false, 'error' => 'Solicitud inválida']);
