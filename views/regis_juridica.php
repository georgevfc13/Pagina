<?php
require_once __DIR__ . "/../controller/usuarioJuridicoController.php";

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new usuarioJuridicoController();
    $mensaje = $controller->registrar($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Persona Jurídica</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
  
</head>
<body>

 


  <form method="POST" action="">
      <h2>Registro Persona Natural</h2>

      

      <label>Razón Social:</label>
      <input type="text" name="razon_social" required><br><br>

      <label>Correo:</label>
      <input type="email" name="correo" required><br><br>

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
