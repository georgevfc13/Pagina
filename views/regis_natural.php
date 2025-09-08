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
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $contacto = $_POST['contacto'];
    $tipo_contacto = $_POST['tipo_contacto'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $terminos = isset($_POST['terminos']) ? 1 : 0;

    $sql = "INSERT INTO usuarios_naturales 
            (nombre, cedula, fecha_nacimiento, genero, contacto, tipo_contacto, password, terminos) 
            VALUES ('$nombre', '$cedula', '$fecha_nacimiento', '$genero', '$contacto', '$tipo_contacto', '$password', '$terminos')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Registro de persona natural exitoso";
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
  <title>Registro Persona Natural</title>
</head>
<body>
  <h2>Registro Persona Natural</h2>
  <form method="POST" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Cédula:</label>
    <input type="text" name="cedula" required><br><br>

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
  </form>
</body>
</html>
