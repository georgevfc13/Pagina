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
    $razon_social = $_POST['razon_social'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $terminos = isset($_POST['terminos']) ? 1 : 0;

   $stmt = $conn->prepare("INSERT INTO usuarios_juridicos
    (razon_social, correo, password, terminos) 
    VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssi", 
    $razon_social,
    $correo,
    $password,
    $terminos 
);


    if ($stmt->execute()) {
        $mensaje = "✅ Registro de persona jurídica exitoso";
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
  <title>Registro Persona Jurídica</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
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
