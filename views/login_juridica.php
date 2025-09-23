<?php

session_start();
require_once __DIR__ . "/../controller/UsuarioJuridicoController.php";

$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuarioJuridicoController();
    $resultado = $controller->login($_POST);
    if ($resultado['success']) {
        $_SESSION['id'] = $resultado['usuario']['id'];
        $_SESSION['nombre'] = $resultado['usuario']['razon_social'];
        $_SESSION['tipo'] = "juridico";
        header("Location: home.php");
        exit();
    } else {
        $mensaje = $resultado['mensaje'];
        $tipo_mensaje = "danger";
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
  <title>Login Persona Natural</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />


  
</head>
<body>

 <?php $activePage = 'login';
  include 'partials/navbar.php'; ?>

    <main >
  <form method="POST" action="">
      <h2>Iniciar sesión - Persona Jurídica</h2>
    <label>Correo:</label>
    <input type="email" name="correo" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>

  
<!-- // ...existing code... -->
 

    <?php if (!isset($_SESSION['id'])): ?>
      <p>¿No tienes una cuenta? <a href="regis_juridica.php">Regístrate aquí</a></p>
    <?php endif; ?>
<!-- // ...existing code... -->
  </form>
        </main>
  
  <?php include 'partials/footer.php'; ?>
</body>
</html>
