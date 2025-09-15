<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gda";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = ""; // <-- Variable para guardar el mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $identificacion = $_POST['identificacion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $contacto = $_POST['contacto'];
    $tipo_contacto = $_POST['tipo_contacto'];
   $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $terminos = isset($_POST['terminos']) ? 1 : 0;
   $stmt = $conn->prepare("INSERT INTO usuarios_naturales 
    (nombre, identificacion, fecha_nacimiento, genero, contacto, tipo_contacto, password, terminos) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssi", 
    $nombre, 
    $identificacion, 
    $fecha_nacimiento, 
    $genero, 
    $contacto, 
    $tipo_contacto, 
    $passwordHash,   // <-- aquí se guarda tal cual
    $terminos
);


    if ($stmt->execute()) {
        $mensaje = "✅ Registro de persona natural exitoso";
    } else {
        $mensaje = "❌ Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Persona Natural</title>
  <link rel="stylesheet" href="../assets/styles/regis.css">
  <style>
      .mensaje {
          margin: 10px 0;
          padding: 10px;
          border-radius: 5px;
          font-weight: bold;
      }
      .exito { background: #d4edda; color: #155724; }
      .error { background: #f8d7da; color: #721c24; }
  </style>
</head>
<body>

 


  <form method="POST" action="">
      <h2>Registro Persona Natural</h2>

      <!-- Mostrar el mensaje aquí -->
      <?php if ($mensaje != ""): ?>
          <div class="mensaje <?php echo (strpos($mensaje, '✅') !== false) ? 'exito' : 'error'; ?>">
              <?php echo $mensaje; ?>
          </div>
      <?php endif; ?>

      <label>Nombre:</label>
      <input type="text" name="nombre" required><br><br>

      <label>identificación:</label>
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
