<?php
session_start();
require_once __DIR__ . "/../controller/UsuarioNaturalController.php";

$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuarioNaturalController();
    $resultado = $controller->login($_POST);
    if ($resultado['success']) {
        $_SESSION['id'] = $resultado['usuario']['id'];
        $_SESSION['nombre'] = $resultado['usuario']['nombre'];
        $_SESSION['tipo'] = "natural";
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

 

  <main class="container py-5">

    <form method="POST" action="">

      <h2>Iniciar sesión - Persona Natural</h2>

      <!-- Aquí mostramos los mensajes -->
      <?php if (!empty($mensaje)): ?>
        <div><?php echo $mensaje; ?></div>
      <?php endif; ?>

      <label>Correo / Telefono:</label>
      <input type="text" name="contacto" required><br><br>

      <label>Contraseña:</label>
      <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="bi bi-eye"></i>
        </button>
      </div>
      <br>


      <button type="submit">Ingresar</button>

      <p>¿No tienes una cuenta? <a href="regis_natural.php" class="a">Regístrate aquí</a>
      </p>
    </form>
  </main>

  <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>