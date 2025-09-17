<?php
require_once __DIR__ . "/../controller/usuarioJuridicoController.php";

$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new usuarioJuridicoController();
    $resultado = $controller->registrar($_POST);
    if ($resultado === true) {
        $mensaje = "✅ Registro exitoso";
        $tipo_mensaje = "success";
    } else {
        $mensaje = $resultado;
        $tipo_mensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Persona Jurídica</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
  <link rel="stylesheet" href="../assets/styles/regis.css">
  
 <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5; /* Fondo opcional */
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        </style>

</head>
<body>

 


  <form method="POST" action="">
      <h2>Registro Persona Natural</h2>
 <?php if (!empty($mensaje)): ?>
    <div class="alert alert-<?php echo $tipo_mensaje; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
      

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
