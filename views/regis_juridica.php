<?php
require_once __DIR__ . "/../controller/usuarioJuridicoController.php";

$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new usuarioJuridicoController();
    $resultado = $controller->registrar($_POST);
    if ($resultado === true) {
        $mensaje = "✅ Registro exitoso";
        $tipo_mensaje = "success";
    } else {
        $mensaje = $resultado;
        $tipo_mensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Persona Natural</title>
  <link rel="stylesheet" href="../assets/styles/regis.css">
  <link rel="stylesheet" href="../assets/styles/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
        


<body>
<?php $activePage = 'login';
  include 'partials/navbar.php'; ?>
 
<main>

  <form method="POST" action="">
      <h2>Registro Persona Jurídica</h2>
 <?php if (!empty($mensaje)): ?>
    <div class="alert alert-<?php echo $tipo_mensaje; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
      



      <label>Razón Social:</label>
      <input type="text" name="razon_social" required><br><br>

      <label>Correo:</label>
      <input type="email" name="correo" required><br><br>
<div>
      <label>Contraseña:</label>
    <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="bi bi-eye"></i></div>

     
    <label action="/perfil-juridico/subir-foto" method="post" enctype="multipart/form-data"> Foto de perfil:</label><br>
    <input type="file" name="foto" accept="image/*" required>
    <button type="submit">Subir</button>


      <label>
        <input type="checkbox" name="terminos" required> Acepto los términos y condiciones
      </label><br><br>

      <button type="submit">Registrarse</button>
      <p>¿Ya tienes una cuenta? <a href="login_juridica.php">Iniciar Sesión</a></p>
  </form>

     </main>
    <?php include 'partials/footer.php'; ?>
 <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 
</body>
</html>
