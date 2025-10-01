<?php
session_start();
if (!isset($_SESSION['id']) || ($_SESSION['tipo_usuario'] ?? '') !== 'juridico') {
    header('Location: login_juridico.php');
    exit;
}

require_once __DIR__ . '/../controller/EmpresaRutController.php';
$controller = new EmpresaRutController();

// Actualizar si envían el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizarPerfil($_SESSION['id'], $_POST, $_FILES['foto_perfil']);
}

// Traer datos de la empresa desde sesión
$usuario = [
    'razon_social'  => $_SESSION['razon_social']  ?? '',
    'nit'           => $_SESSION['nit']           ?? '',
    'representante' => $_SESSION['representante'] ?? '',
    'contacto'      => $_SESSION['contacto']      ?? '',
    'foto_perfil'   => $_SESSION['foto_perfil']   ?? '../assets/img/logo.jpg'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil Jurídico</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/styles/style.css" />
  <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>
  <?php $activePage = 'perfil'; include 'partials/navbar.php'; ?>

  <main class="container py-4">
    <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
      <form method="POST" enctype="multipart/form-data" class="text-center">
        
        <!-- Imagen -->
        <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>"
             alt="Foto de perfil"
             style="width:100px;height:100px;border-radius:50%;object-fit:cover;">
        <br><br>

        <!-- Razón social -->
        <div class="mb-3 text-start">
          <label class="form-label">Razón social:</label>
          <input type="text" class="form-control" name="razon_social"
                 value="<?php echo htmlspecialchars($usuario['razon_social']); ?>">
        </div>

        <!-- NIT -->
        <div class="mb-3 text-start">
          <label class="form-label">NIT:</label>
          <input type="text" class="form-control" name="nit"
                 value="<?php echo htmlspecialchars($usuario['nit']); ?>">
        </div>

        <!-- Representante legal -->
        <div class="mb-3 text-start">
          <label class="form-label">Representante legal:</label>
          <input type="text" class="form-control" name="representante"
                 value="<?php echo htmlspecialchars($usuario['representante']); ?>">
        </div>

        <!-- Contacto -->
        <div class="mb-3 text-start">
          <label class="form-label">Contacto:</label>
          <input type="text" class="form-control" name="contacto"
                 value="<?php echo htmlspecialchars($usuario['contacto']); ?>">
        </div>

        <!-- Foto -->
        <div class="mb-3 text-start">
          <label class="form-label">Actualizar foto:</label>
          <input type="file" class="form-control" name="foto_perfil" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
      </form>
    </div>
  </main>
</body>
</html>
