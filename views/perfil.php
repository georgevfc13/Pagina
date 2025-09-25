<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}



?>


<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Perfil</title>
<link rel="stylesheet" href="../assets/styles/regis.css">
<link rel="stylesheet" href="../assets/styles/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

</head>
<body>

<?php $activePage = 'login';
  include 'partials/navbar.php'; ?>
  <h1 style="text-align:center " >Perfil de <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>


  <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nombre = $_SESSION['nombre'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;
$foto = $_SESSION['foto'] ?? null;
?>
</body>



<div style="max-width:400px;margin:auto;padding:20px;border:1px solid #ccc;border-radius:10px;box-shadow:0 2px 8px #eee;">
  <div style="text-align:center;">
    <img src="<?php echo $foto ? htmlspecialchars($foto) : '../assets/img/logo.jpg'; ?>" alt="Foto de perfil" style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:10px;">
    <h2><?php echo htmlspecialchars($nombre); ?></h2>
    <p><strong>Tipo de usuario:</strong> <?php echo htmlspecialchars($tipo); ?></p>
  </div>
  <hr>
  <ul style="list-style:none;padding:0;">
    <li><strong>ID:</strong> <?php echo htmlspecialchars($_SESSION['id']); ?></li>
    <li><strong>Identificación:</strong> <?php echo htmlspecialchars($_SESSION['identificacion'] ?? ''); ?></li>
    <li><strong>Fecha de nacimiento:</strong> <?php echo htmlspecialchars($_SESSION['fecha_nacimiento'] ?? ''); ?></li>
    <li><strong>Género:</strong> <?php echo htmlspecialchars($_SESSION['genero'] ?? ''); ?></li>
    <li><strong>Contacto:</strong> <?php echo htmlspecialchars($_SESSION['contacto'] ?? ''); ?></li>
    <li><strong>Tipo de contacto:</strong> <?php echo htmlspecialchars($_SESSION['tipo_contacto'] ?? ''); ?></li>
  </ul>
</div>

  <?php include 'partials/footer.php'; ?>
</body>
</html>
