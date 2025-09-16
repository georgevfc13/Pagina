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
</head>
<body>
 

  <form method="POST">
      <h2>Registro Persona Natural</h2>

      <?php if ($mensaje != ""): ?>
          <div><?php echo $mensaje; ?></div>
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

      <label>Contraseña:</label>
      <input type="password" name="password" required><br><br>

      <label>
        <input type="checkbox" name="terminos" required> Acepto los términos y condiciones
      </label><br><br>

      <button type="submit">Registrarse</button>
      <p>¿Ya tienes una cuenta? <a href="login_natural.php">Iniciar Sesión</a></p>
  </form>
</body>
</html>
