<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gda"; // tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $razon_social = $_POST['razon_social'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $terminos = isset($_POST['terminos']) ? 1 : 0;

    $sql = "INSERT INTO usuarios_juridicos 
            (razon_social, correo, password, terminos) 
            VALUES ('$razon_social', '$correo', '$password', '$terminos')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Registro de persona jurídica exitoso";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Persona Jurídica</title>
</head>
<body>
  <h2>Registro Persona Jurídica</h2>
  <form method="POST" action="">
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
  </form>
</body>
</html>
