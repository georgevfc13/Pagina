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

         <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'Iniciar Sesion') echo 'active'; ?>" href="login.php">Iniciar Sesión</a>
        </li>
           <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'cerrarSesion') echo 'active'; ?>" href="logout.php">Cerrar Sesión</a>a></li>


         <!-- Perfil -->
<?php if (isset($_SESSION['usuario_juridico_id'])): ?>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="<?= htmlspecialchars($datosUsuarioJuridico['foto_perfil'] ?? '/img/default-user.png'); ?>"
         alt="Perfil"
         class="rounded-circle"
         style="width:40px;height:40px;object-fit:cover;">
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
    <li><a class="dropdown-item" href="/perfil-juridico">Mi perfil</a></li>
    <li><a class="dropdown-item" href="/vacantes/mis-vacantes">Mis vacantes</a></li>
    <li><a class="dropdown-item" href="/servicios/mis-servicios">Mis servicios</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
  </ul>
</li>
<?php endif; ?>


      </ul>

  </div>
</div>
    </div>
  </div>
</nav>