<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gda"; // tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Buscar al usuario en la tabla de personas naturales
    $sql = "SELECT * FROM usuarios_naturales WHERE contacto='$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tipo'] = "natural";

            header("Location: dashboard_natural.php");
            exit();
        } else {
            echo "❌ Contraseña incorrecta";
        }
    } else {
        echo "❌ Usuario no encontrado";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Persona Natural</title>

    <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>

    <main class="container py-5">

  <form method="POST" action="">
      <h2>Iniciar sesión - Persona Natural</h2>
    <label>Correo / Contacto:</label>
    <input type="text" name="correo" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>

    <p>¿No tienes una cuenta? <a href="regis_natural.php">Regístrate aquí</a></p>
  </form>
</body>
</html>
