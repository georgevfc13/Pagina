<?php
require_once __DIR__ . "/../controller/EmpresaRutController.php";

$mensaje = "";
$tipo_mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EmpresaRutController();
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
  <title>Registro Empresa RUT</title>
  <link rel="stylesheet" href="../assets/styles/regis.css">
  <link rel="stylesheet" href="../assets/styles/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
<?php $activePage = 'login';
include 'partials/navbar.php'; ?>

<main class="container my-4">

  <form method="POST" action="">
    
      <h2 class="mb-4">Registro de Empresa </h2>
         <?php if (!empty($mensaje)): ?>
        <div class="green alert-<?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
      <?php endif; ?>

       <label>Foto de perfil (opcional):</label>
  <input type="file" name="foto_perfil" accept="image/*"><br><br>



      <!-- NIT -->
      <div class="mb-3">
        <label for="nit" class="form-label">NIT</label>
        <input type="text" class="form-control" id="nit" name="nit" required placeholder="Ej: 900123456-7">
      </div>

      <!-- Razón Social -->
      <div class="mb-3">
        <label for="razon_social" class="form-label">Razón Social</label>
        <input type="text" class="form-control" id="razon_social" name="razon_social" required>
      </div>

      <!-- Dirección -->
      <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required>
      </div>

      <!-- Contacto (correo o celular) -->
      <div class="mb-3">
        <label for="contacto" class="form-label">Contacto</label>
        <input type="text" class="form-control" id="contacto" name="contacto" 
               placeholder="Correo electrónico o número de celular" required>
      </div>

      <!-- Tipo de contacto -->
      <div class="mb-3">
        <label for="tipo_contacto" class="form-label">Tipo de Contacto</label>
        <select class="form-select" id="tipo_contacto" name="tipo_contacto" required>
          <option value=""> Selecciona </option>
          <option value="correo">Correo</option>
          <option value="celular">Celular</option>
        </select>
      </div>

<!-- contraseña -->
      <div>
      <label>Contraseña:</label>
    <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="bi bi-eye"></i></div>

      <!-- Términos -->
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="terminos" name="terminos" required>
        <label class="form-check-label" for="terminos">
          Acepto los términos y condiciones
        </label>
      </div>

      <button type="submit" class="btn btn-primary">Registrar Empresa</button>
      <p class="mt-3">¿Ya tienes una cuenta? <a href="login_juridica.php">Iniciar Sesión</a></p>
  </form>

</main>

<?php include 'partials/footer.php'; ?>
<script src="../assets/js/login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
