<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gda";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contacto = $_POST['contacto'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM usuarios_naturales WHERE contacto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $contacto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        // Aquí ya tenemos el usuario
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tipo'] = "natural";
            header("Location: home.php");
            exit();
        } else {
            $mensaje = "❌ Contraseña incorrecta";
        }
    } else {
        $mensaje = "❌ Usuario no encontrado";
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Persona Natural</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
  <style>
    .alerta {
      background: #f8d7da;
      color: #842029;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #f5c2c7;
      border-radius: 8px;
      text-align: center;
    }
  </style>
</head>
<body>

<main class="container py-5">
  <form method="POST" action="">
    
    <h2>Iniciar sesión - Persona Natural</h2>

    <!-- Aquí mostramos los mensajes -->
    <?php if (!empty($mensaje)): ?>
      <div class="alerta"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <label>Correo / Contacto:</label>
    <input type="text" name="contacto" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>

    <p>¿No tienes una cuenta? <a href="regis_natural.php" class="a">Regístrate aquí</a>
 </p>

 <p>o</p>

 <button><a href="home.php" class="btn-primary ">Continúa como invitado</a></button>
  </form>
</main>
