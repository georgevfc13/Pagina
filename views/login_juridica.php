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

    // Buscar en la tabla de personas jurídicas
    $sql = "SELECT * FROM usuarios_juridicos WHERE correo='$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['razon_social'] = $row['razon_social'];
            $_SESSION['tipo'] = "juridica";

            header("Location: dashboard_juridico.php");
            exit();
        } else {
            echo "❌ Contraseña incorrecta";
        }
    } else {
        echo "❌ Empresa no encontrada";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Persona Jurídica</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
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
