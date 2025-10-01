<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<style>
  /* afecta a cualquier dropdown dentro de un navbar */
  .navbar .dropdown-menu {
    position: absolute !important;
    margin-top: 10px; /* opcional */
  }
</style>



<nav class="navbar navbar navbar-expand-lg navbar-dark bg-dark shadow">
<div class="container-fluid">


    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
  <img src="../assets/img/logo.jpg" alt="Logo"
       class="logo me-2 rounded"
       onerror="this.onerror=null;this.src='assets/img/logo.jpg';" />
  GDA
</a>


    <!-- Botón hamburguesa -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú colapsable -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='home') echo 'active'; ?>" href="home.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='servicios') echo 'active'; ?>" href="servicios.php">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='vacantes') echo 'active'; ?>" href="vacantes.php">Vacantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='nosotros') echo 'active'; ?>" href="nosotros.php">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='noticias') echo 'active'; ?>" href="noticias.php">Noticias</a>
        </li>

        <?php if (!isset($_SESSION['id'])): ?>
          <li class="nav-item">
            <a class="nav-link nav-hover <?php if(isset($activePage) && $activePage=='login') echo 'active'; ?>" href="login.php">Registro / Inicio de sesión</a>
          </li>
        <?php else: ?>
          
        <?php endif; ?>
      </ul>
    </div>
<!-- Ícono de usuario SI hay sesión: fuera del collapse -->
    <?php if (isset($_SESSION['id'])): ?>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center"
             href="#"
             id="userDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
      <img src="<?php echo (isset($foto) && file_exists(str_replace('..','.', $foto))) ? htmlspecialchars($foto) : '../assets/img/logo.jpg'; ?>"
        alt="Usuario"
        class="rounded-circle"
        width="40" height="40">
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li class="dropdown-item-text fw-bold">
              <?php echo isset($nombre) ? htmlspecialchars($nombre) : 'Usuario'; ?>
            </li>
            <li class="dropdown-item-text text-muted">
              <?php echo isset($tipo) ? htmlspecialchars($tipo) : ''; ?>
            </li>
            <li><hr class="dropdown-divider"></li>
          <li>
  <a class="dropdown-item" 
     href="<?php echo ($_SESSION['tipo_usuario'] ?? '') === 'juridico' ? 'perfilJuridico.php' : 'perfil.php'; ?>">
     Perfil
  </a>
</li>

            <li><a class="dropdown-item" href="servicios_subidos.php">Servicios Subidos</a></li>
            <li><a class="dropdown-item" href="vacantes_aplicadas.php">Vacantes Aplicadas</a></li>
            <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    <?php endif; ?>
    

  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
