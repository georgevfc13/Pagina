<?php
require_once __DIR__ . "/../controller/usuarioNaturalController.php";

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller = new usuarioNaturalController();
  $mensaje = $controller->registrar($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Registro Persona Natural</title>
  <link rel="stylesheet" href="../assets/styles/regis.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
  <?php $activePage = 'login';
  include 'partials/navbar.php'; ?>

  <main>

    <form method="POST">
      <h2>Registro Persona Natural</h2>
 <?php if (!empty($mensaje)): ?>
    <div style="padding:10px; margin:10px 0; border-radius:5px; color:green;">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
    

      <label>Nombre:</label>
      <input type="text" name="nombre" required><br><br>

      <label>Identificación:</label>
      <input type="text" name="identificacion" required><br><br>

      <label>Fecha de Nacimiento:</label>
      <input type="date" name="fecha_nacimiento" required><br><br>

      <label>Género:</label>
      <select name="genero" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Otro</option>
      </select><br><br>

      <label>Contacto:</label>
      <input type="text" name="contacto" required><br><br>

      <label>Tipo de Contacto:</label>
      <select name="tipo_contacto" required>
        <option value="correo">Correo</option>
        <option value="telefono">Teléfono</option>
      </select><br><br>
<div>
      <label>Contraseña:</label>
    <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="bi bi-eye"></i></div>

      <label>
        <input type="checkbox" name="terminos" required> Acepto los <a href="terminos_y_condiciones.php">términos y condiciones</a>
      </label><br><br>

      <button type="submit">Registrarse</button>
      <p>¿Ya tienes una cuenta? <a href="login_natural.php">Iniciar Sesión</a></p>
    </form>

  </main>
    <?php include 'partials/footer.php'; ?>

    
   <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>