<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Perfil</title></head>
<body>
  <h1>Perfil de <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
  <p>Aquí podrás editar tu información en el futuro.</p>
</body>
</html>
