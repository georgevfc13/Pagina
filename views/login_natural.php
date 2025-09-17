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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>

  <?php $activePage = 'login';
  include 'partials/navbar.php'; ?>

  <main class="container py-5">

    <form method="POST" action="">

      <h2>Iniciar sesión - Persona Natural</h2>

      <!-- Aquí mostramos los mensajes -->
      <?php if (!empty($mensaje)): ?>
        <div><?php echo $mensaje; ?></div>
      <?php endif; ?>

      <label>Correo / Contacto:</label>
      <input type="text" name="contacto" required><br><br>

      <label>Contraseña:</label>
      <input type="password" name="password" required><br><br>

      <button type="submit">Ingresar</button>

      <p>¿No tienes una cuenta? <a href="regis_natural.php" class="a">Regístrate aquí</a>
      </p>
    </form>
  </main>

  <?php include 'partials/footer.php'; ?> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>