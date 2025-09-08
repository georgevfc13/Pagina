<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuestros Servicios Profesionales - Tu Empresa</title>

    <!-- Bootstrap y otros estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>

    <!-- Barra de navegación -->
    <?php $activePage = 'servicios'; include 'partials/navbar.php'; ?>

    <!-- Encabezado con fondo azul (como en Vacantes) -->
    <header class="hero-section bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Nuestros Servicios Profesionales</h1>
            <p class="lead mt-3">Soluciones integrales para la gestión del talento humano y el desarrollo de tu organización.</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main>
        <section class="container py-5 form-section mt-0">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Publica tu Servicio</h2>
                <p class="text-muted">¿Eres un profesional? Comparte tu experiencia y conecta con empresas que necesitan tus habilidades.</p>
            </div>

            <form class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <label for="serviceName" class="form-label">Nombre del servicio que ofreces</label>
                    <input type="text" class="form-control" id="serviceName" placeholder="Ej: Consultoría en Marketing Digital" required>
                </div>
                <div class="col-md-6">
                    <label for="serviceDescription" class="form-label">Descripción de tu servicio</label>
                    <textarea class="form-control" id="serviceDescription" rows="3" placeholder="Ej: Especializado en creación de estrategias de SEO y campañas de publicidad en redes sociales para startups." required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="contactMethod" class="form-label">Método de contacto preferido</label>
                    <select class="form-select" id="contactMethod" required>
                        <option value="">Selecciona una opción</option>
                        <option value="email">Correo electrónico</option>
                        <option value="phone">Número de teléfono</option>
                        <option value="whatsapp">WhatsApp</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="contactInfo" class="form-label">Información de contacto</label>
                    <input type="text" class="form-control" id="contactInfo" placeholder="ejemplo@correo.com o +123456789" required>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Publicar Servicio</button>
                </div>
            </form>
        </section>

        <section class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Explora los Servicios Disponibles</h2>
                <p class="text-muted">Descubre a los profesionales que pueden ayudarte a llevar tu empresa al siguiente nivel.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Tarjeta 1 -->
                <div class="col">
                    <div class="card service-card h-100 shadow-sm rounded-4">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="service-icon-box bg-primary bg-opacity-10 text-primary rounded-circle mb-4">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h5 class="card-title fw-bold">Ingeniería en Sistemas</h5>
                            <p class="card-text text-muted mb-4">Especialistas en desarrollo de aplicaciones móviles, web y soluciones de software a medida.</p>
                            <a href="#" class="btn btn-outline-primary mt-auto">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="col">
                    <div class="card service-card h-100 shadow-sm rounded-4">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="service-icon-box bg-success bg-opacity-10 text-success rounded-circle mb-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="card-title fw-bold">Gestión de Talento Humano</h5>
                            <p class="card-text text-muted mb-4">Servicios de reclutamiento, selección y capacitación para potenciar el capital humano de tu empresa.</p>
                            <a href="#" class="btn btn-outline-success mt-auto">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="col">
                    <div class="card service-card h-100 shadow-sm rounded-4">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="service-icon-box bg-warning bg-opacity-10 text-warning rounded-circle mb-4">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5 class="card-title fw-bold">Desarrollo Organizacional</h5>
                            <p class="card-text text-muted mb-4">Consultoría para mejorar procesos, clima laboral y productividad empresarial de forma sostenible.</p>
                            <a href="#" class="btn btn-outline-warning mt-auto">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Botón de volver arriba -->
    <button id="scrollToTopBtn" class="btn btn-dark rounded-circle shadow-lg" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; display: none; width: 50px; height: 50px;">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Pie de página -->
    <?php include 'partials/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="scroll.js"></script>
</body>
</html>
