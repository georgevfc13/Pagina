<?php
require_once __DIR__ . '/VacanteController.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $vacante_id = intval($_POST['id']);
    session_start();
    $usuario_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : null;
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
        echo json_encode(['success' => false, 'message' => $resultado]);
    }
    exit;
}
echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
