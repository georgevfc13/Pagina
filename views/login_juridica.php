<?php
session_start();
require_once __DIR__ . "/../controller/EmpresaRutController.php";

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EmpresaRutController();
    $resultado = $controller->login($_POST);

    if ($resultado['success']) {
        // OJO: en el controlador la clave es 'empresa'
        $_SESSION['id']           = $resultado['empresa']['id'];
        $_SESSION['nombre']       = $resultado['empresa']['razon_social'];
        $_SESSION['tipo']         = "Juridico";
        $_SESSION['tipo_usuario'] = "Juridico";
        $_SESSION['foto_perfil']  = $resultado['empresa']['foto_perfil'] ?? 'assets/img/default-avatar.png';

        // Redirige al home
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
    <label>NIT:</label>
    <input type="text" name="nit" required><br><br>

       <label>Contraseña:</label>
      <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="bi bi-eye"></i>

    <button type="submit">Ingresar</button>

  
<!-- // ...existing code... -->
 

    <?php if (!isset($_SESSION['id'])): ?>
      <p>¿No tienes una cuenta? <a href="regis_juridica.php">Regístrate aquí</a></p>
    <?php endif; ?>
<!-- // ...existing code... -->
  </form>
        </main>
  
  <?php include 'partials/footer.php'; ?>


    <script src="../assets/js/login.js"></script>
</body>


</html>
