<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Servicios</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/vacantes.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>
    <body>
        <?php $activePage = 'vacantes'; include 'partials/navbar.php'; ?>
        <!-- seccion hero -->
        <section class="text-black text-center py-5">
                <div>
                        <h2 class="display-5 fw-bold">Nuestras Vacantes Profesionales</h2>
                        <p class="lead">Encuentra al mejor candidato que se ajuste a tus necesidades</p>
                </div>
        </section>
        <!-- fin seccion hero -->

        <!-- inicio de servicios -->
        <main>
            <!-- publicar servicio -->
        <div class="container text-center">
            <h3>Publica tu vacante aqui</h3>
            <!-- Sección para publicar vacante -->
            <form class="row g-3 justify-content-center my-4">
                <!-- Campo para el nombre de la vacante -->
                <div class="col-md-6">
                    <label for="nombreVacante" class="form-label">Que vacante deseas publicar?</label>
                    <input type="text" class="form-control" id="nombreVacante" placeholder="Ejemplo: Desarrollador Web">
                </div>
                <!-- Campo para la descripción -->
                <div class="col-md-6">
                    <label for="descripcionVacante" class="form-label">Descripción de la vacante</label>
                    <input type="text" class="form-control" id="descripcionVacante" placeholder="Ejemplo: Especializado en desarrollo de aplicaciones móviles">
                </div>
                <!-- Campo para contacto -->
                <div class="col-md-6">
                    <label for="contactoVacante" class="form-label">Contacto</label>
                    <input type="email" class="form-control" id="contactoVacante" placeholder="correo@ejemplo.com">
                </div>
                <!-- Botón para publicar -->
                <div class="col-12">
                    <div>
                        <select class="form-select" name="contacto">
                            <option value="">Con que pueden contactarte?</option>
                            <option value="correo">Correo electronico</option>
                            <option value="telefono">Numero de telefono</option>
                        </select>
                    </div>
                    <button class="btn btn-info">Publicar vacante</button>
                </div>
            </form>
        </div>
            <!-- fin de publicar servicio -->
            <div class="container py-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Servicio 1 -->
                    <div class="col">
                        <div class="card h-100 shadow rounded-4 border-secondary-subtle">
                            <div class="card-body text-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                                    <i class="fas fa-laptop-code text-primary fs-3"></i>
                                </div>
                                <h5 class="card-title fw-bold">Ingeniería en Sistemas</h5>
                                <p class="card-text">Especialistas en desarrollo de aplicaciones móviles</p>
                            </div>
                        </div>
                    </div>
                    <!-- Servicio 2 -->
                    <div class="col">
                        <div class="card h-100 shadow rounded-4 border-secondary-subtle">
                            <div class="card-body text-center">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                                    <i class="fas fa-users text-success fs-3"></i>
                                </div>
                                <h5 class="card-title fw-bold">Gestión de Talento Humano</h5>
                                <p class="card-text">Reclutamiento, selección y capacitación para potenciar el capital humano de tu empresa.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Servicio 3 -->
                    <div class="col">
                        <div class="card h-100 shadow rounded-4 border-secondary-subtle">
                            <div class="card-body text-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                                    <i class="fas fa-chart-line text-warning fs-3"></i>
                                </div>
                                <h5 class="card-title fw-bold">Desarrollo Organizacional</h5>
                                <p class="card-text">Consultoría para mejorar procesos, clima laboral y productividad empresarial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- fin de servicios -->

         <!-- Botón Scroll hacia abajo y devuelve al inicio -->
                <button
                    id="scrollToTopBtn"
                    class="btn btn-primary"
                    style="
                        position: fixed;
                        bottom: 40px;
                        right: 30px;
                        z-index: 9999;
                        width: 50px;
                        height: 50px;
                        display: none;
                        align-items: center;
                        justify-content: center;
                    "
                >
                    <i class="bi bi-arrow-up fs-3"></i>
                </button>
                <!-- fin del boton de scroll -->
         
    <?php include 'partials/footer.php'; ?>
        <script src="scroll.js"></script>
    </body>
</html>
