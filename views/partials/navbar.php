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

        <li class="nav-item">
            <?php if (!isset($_SESSION['id'])): ?>
              <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage == 'login') echo 'active'; ?>" href="login.php">Registro / Inicio de sesión</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['id'])): ?>
              <a class="nav-link nav-hover" href="logout.php">Cerrar Sesión</a>
            <?php endif; ?>
          </li>
      </ul>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
     id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="<?php echo htmlspecialchars($foto); ?>"
         alt="Usuario"
         class="rounded-circle"
         width="40" height="40">
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
    <li class="dropdown-item-text fw-bold"><?php echo htmlspecialchars($nombre); ?></li>
    <li class="dropdown-item-text text-muted"><?php echo htmlspecialchars($tipo); ?></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
    <li><a class="dropdown-item" href="servicios_subidos.php">Servicios Subidos</a></li>
    <li><a class="dropdown-item" href="vacantes_aplicadas.php">Vacantes Aplicadas</a></li>
    <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
  </ul>
</li>





      </ul>

  </div>
</div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</nav>