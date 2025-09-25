<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login_natural.php');
    exit;
}

require_once __DIR__ . '/../controller/UsuarioNaturalController.php';
$controller = new UsuarioNaturalController();

// Actualizar si envían el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizarPerfil($_SESSION['id'], $_POST, $_FILES['foto_perfil']);
}

// Traer datos del usuario (ID solo desde sesión, no visible en HTML)
// Cargar datos del usuario desde la sesión
$usuario = [
    'nombre'           => $_SESSION['nombre']           ?? '',
    'identificacion'   => $_SESSION['identificacion']   ?? '',
    'contacto'         => $_SESSION['contacto']         ?? '',
    'genero'           => $_SESSION['genero']           ?? '',
    'tipo_contacto'    => $_SESSION['tipo_contacto']    ?? '',
    'fecha_nacimiento' => $_SESSION['fecha_nacimiento'] ?? '',
    'foto_perfil'      => $_SESSION['foto_perfil']      ?? ''   // 👈 usar foto_perfil
];

?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Perfil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/styles/login.css">



</head>
<body>
  <?php $activePage = 'login'; include 'partials/navbar.php'; ?>


  <main>
  <form method="POST" enctype="multipart/form-data">
 <img src="<?php echo $usuario['foto_perfil'] ?: '../assets/img/logo.jpg'; ?>"
     style="width:100px;height:100px;border-radius:50%;object-fit:cover;">

         style="width:100px;height:100px;border-radius:50%;object-fit:cover;">
    <br><br>
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>">
    <br><br>
    <label>Identificación:</label>
    <input type="text" name="identificacion" value="<?php echo htmlspecialchars($usuario['identificacion']); ?>">
    <br><br>
    <label>Contacto:</label>
    <input type="text" name="contacto" value="<?php echo htmlspecialchars($usuario['contacto']); ?>">
    <br><br>
    <!-- resto de campos... -->
    <input type="file" name="foto_perfil" accept="image/*">
    <button type="submit">Guardar cambios</button>
  </form>
  </main>


</body>
</html>
