<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // tu usuario
$password = "";     // tu contraseña si tienes
$dbname = "gda"; // pon el nombre correcto de tu BD

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir parámetros del formulario
$busqueda  = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$tipo      = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : '';

// Construir consulta
$sql = "SELECT * FROM vacantes WHERE 1=1";

if (!empty($busqueda)) {
    $sql .= " AND (titulo LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%')";
}
if (!empty($tipo) && $tipo != "Tipo") {
    $sql .= " AND tipo = '$tipo'";
}
if (!empty($ubicacion) && $ubicacion != "Ubicación") {
    $sql .= " AND ubicacion = '$ubicacion'";
}

// Depuración: muestra la consulta que se ejecuta



$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de búsqueda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h1>Resultados de búsqueda</h1>
  <hr>

  <?php
  if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<div class='card mb-3 p-3'>";
          echo "<h4>" . $row['titulo'] . "</h4>";
          echo "<p>" . $row['descripcion'] . "</p>";
          echo "<small><b>Ubicación:</b> " . $row['ubicacion'] . " | <b>Tipo:</b> " . $row['tipo'] . "</small>";
          echo "</div>";
      }
  } else {
      echo "<p>No se encontraron resultados.</p>";
  }

  $conn->close();
  ?>
</body>
</html>
