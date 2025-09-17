<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
  <img src="../assets/img/logo.jpg" alt="Logo" class="logo me-2 rounded" onerror="this.onerror=null;this.src='assets/img/logo.jpg';" />
    <a class="navbar-brand" href="#">GDA</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'home') echo 'active'; ?>" href="home.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'servicios') echo 'active'; ?>" href="servicios.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'vacantes') echo 'active'; ?>" href="vacantes.php">Vacantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'nosotros') echo 'active'; ?>" href="nosotros.php">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'noticias') echo 'active'; ?>" href="noticias.php">Noticias</a>
        </li>
        <?php if (isset($_SESSION['id'])): ?>
          <!-- Usuario logueado -->
          <li class="nav-item">
            <span class="navbar-text text-white ms-3">
              👋 Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>
            </span>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="btn btn-outline-light ms-3">Cerrar sesión</a>
          </li>
        <?php else: ?>
          <!-- Invitado -->
          <li class="nav-item">
            <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'login') echo 'active'; ?>" href="login.php">Iniciar Sesión/Registrarse</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>