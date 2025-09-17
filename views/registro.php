<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../assets/styles/opciones.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>

<body>

  <?php $activePage = 'login'; include 'partials/navbar.php'; ?>

  <main>
    <div class="container">
      <h2 class="h2">Selecciona tipo de usuario</h2>
      <a href="regis_natural.php" class="opcion">👤 Persona Natural</a>
      <a href="regis_juridica.php" class="opcion">🏢 Persona Jurídica</a>
    </div>
  </main>

  <?php include 'partials/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>