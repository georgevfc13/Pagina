<?php

session_start();
require_once __DIR__ . "/../controller/UsuarioJuridicoController.php";

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
  <title>Login Persona Jurídica</title>
  <link rel="stylesheet" href="../assets/styles/login.css">


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
      <h2>Iniciar sesión - Persona Jurídica</h2>
    <label>Correo:</label>
    <input type="email" name="correo" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>

     <p>¿No tienes una cuenta? <a href="regis_juridica.php">Regístrate aquí</a></p>
  </form>
</body>
</html>
