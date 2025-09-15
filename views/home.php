<?php
session_start();

// Si no hay sesión activa, redirigimos al login
if (!isset($_SESSION['id'])) {
    header("Location: login_natural.php");
    exit();
}

// Guardamos en variables los datos de sesión
$nombre = $_SESSION['nombre'] ?? 'Invitado';
$tipo   = $_SESSION['tipo'] ?? '';
?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Página</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="../assets/styles/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    </head>
    <body>
        <?php $activePage = 'home'; include 'partials/navbar.php'; ?>
        <!-- zona hero -->
<section class="hero d-flex align-items-center justify-content-center text-center">
    <div class="hero-content text-white">
        <h1 class="fw-bold">Hola, <?php echo htmlspecialchars($nombre); ?> 👋</h1>
<p class="lead">Bienvenido a GDA, tu puente entre oportunidades laborales y talento profesional</p>


        <a href="registro.php" class="btn btn-light mt-3">Regístrate aquí</a>
    </div>
</section>

<main class="container py-5">
        <!-- inicio del filtro y búsqueda -->
        <section class="container my-5">
            <h2 class="text-center mb-4">Busca Vacantes o Servicios</h2>
            <form action="../resultados.php" class="row g-3 shadow p-4 rounded bg-light ">
                <!-- Barra de búsqueda -->
                <div class="col-md-6">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Desarrollador, Electricista, etc."
                        name="busqueda"
                    />
                </div>
                <!-- Filtro por tipo -->
                <div class="col-md-3">
                    <select class="form-select" name="tipo">
                        <option value="">Tipo</option>
                        <option value="vacante">Vacante</option>
                        <option value="servicio">Servicio</option>
                    </select>
                </div>
                <!-- Filtro por ubicación -->
                <div class="col-md-3">
                    <select class="form-select" name="ubicacion">
                        <option value="">Ubicación</option>
                        <option value="la_jagua">La Jagua</option>
                        <option value="aguachica">Aguachica</option>
                        <option value="becerril">Becerril</option>
                        <option value="la_paz">La Paz.</option>
                    </select>
                </div>
                <!-- Botón de búsqueda -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>
        </section>
        <!-- fin del filtro y búsqueda -->

        <!-- servicios -->

            <section class="text-center mb-5">
                <h1 class="fw-bold text-primary mb-3">Nuestros Servicios</h1>
                <p class="lead text-secondary mx-auto" style="max-width: 600px">
                    Ofrecemos servicios profesionales para ayudar a tu empresa a crecer y
                    tener éxito en el mercado actual.
                </p>
            </section>
            <section class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Servicio 1 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-laptop-code text-danger fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Desarrollo Web</h5>
                            <p class="card-text">
                                Desarrollo de sitios web a medida con tecnologías modernas.
                            </p>
                            <a href="#" class="btn btn-outline-danger btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Hago desarrollo de sitios web modernos, responsivos y
                                        optimizados para tu negocio. ¡Contáctame para más detalles!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Servicio 2 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-mobile-alt text-success fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Aplicaciones Móviles</h5>
                            <p class="card-text">
                                Apps móviles multiplataforma para iOS y Android.
                            </p>
                            <a href="#" class="btn btn-outline-success btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Soy desarrollador de apps móviles personalizadas para tu
                                        empresa, compatibles con iOS y Android.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Servicio 3 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-chart-line text-warning fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Marketing Digital</h5>
                            <p class="card-text">
                                Estrategias digitales para aumentar tu presencia y ventas.
                            </p>
                            <a href="#" class="btn btn-outline-warning btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Puedo impulsar tu marca con campañas de marketing digital
                                        efectivas y personalizadas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Servicio 4 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4" >
                        <div class="card-body text-center">
                            <div
                                class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-paint-brush text-info fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Diseño UI/UX</h5>
                            <p class="card-text">
                                Interfaces atractivas y funcionales para tus usuarios.
                            </p>
                            <a href="#" class="btn btn-outline-info btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Soy diseñador de experiencias de usuario intuitivas y
                                        visualmente atractivas para tus proyectos.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Servicio 5 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-dark bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-cloud text-dark fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Soluciones en la Nube</h5>
                            <p class="card-text">
                                Infraestructura escalable y servicios cloud para tu negocio.
                            </p>
                            <a href="#" class="btn btn-outline-dark btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Implemento soluciones en la nube seguras y escalables para
                                        tu empresa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Servicio 6 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-headset text-primary fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Soporte 24/7</h5>
                            <p class="card-text">
                                Soporte técnico permanente para que tu sistema nunca se detenga.
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Información del servicio</h6>
                                    <p>
                                        Ofrezco soporte técnico profesional las 24 horas, todos los
                                        días.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- vacantes -->
    <main class="container py-5">
            <section class="text-center mb-5">
                <h1 class="fw-bold text-primary mb-3">Nuestras Vacantes</h1>
                <p class="lead text-secondary mx-auto" style="max-width: 600px">
                 En GDA conectamos tu talento con empresas líderes para impulsar tu crecimiento y éxito profesional.
                </p>
            </section>
            <section class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Vacante 1. -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-user-tie text-success fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Analista de Datos</h5>
                            <p class="card-text">
                                Únete a nuestro equipo para analizar y transformar datos en
                                soluciones estratégicas.
                            </p>
                            <a href="#" class="btn btn-outline-success btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Experiencia en análisis de datos, manejo de SQL
                                        y Python. Ofrecemos salario competitivo, crecimiento
                                        profesional y ambiente colaborativo.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vacante 2 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-code text-warning fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Desarrollador Frontend</h5>
                            <p class="card-text">
                                Buscamos talento creativo para crear interfaces web modernas y
                                funcionales.
                            </p>
                            <a href="#" class="btn btn-outline-warning btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Conocimientos en HTML, CSS, JavaScript y
                                        frameworks como React. Beneficios: Flexibilidad laboral,
                                        capacitaciones y proyectos innovadores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vacante 3 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-network-wired text-info fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Especialista en Redes</h5>
                            <p class="card-text">
                                Sé parte de nuestro equipo gestionando y optimizando
                                infraestructuras de red.
                            </p>
                            <a href="#" class="btn btn-outline-info btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Certificaciones en redes, experiencia en
                                        administración de servidores. Ofrecemos estabilidad,
                                        formación continua y excelente clima laboral.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vacante 4 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-shield-alt text-danger fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Especialista en Ciberseguridad</h5>
                            <p class="card-text">
                                Protege sistemas y datos críticos en proyectos de alto impacto.
                            </p>
                            <a href="#" class="btn btn-outline-danger btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Experiencia en seguridad informática, manejo de
                                        herramientas de protección y auditoría. Beneficios: Bonos,
                                        capacitaciones y retos constantes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vacante 5 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-users text-primary fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Gestor de Talento Humano</h5>
                            <p class="card-text">
                                Ayuda a potenciar equipos y liderar procesos de selección y
                                capacitación.
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Experiencia en RRHH, habilidades de liderazgo y
                                        comunicación. Ofrecemos desarrollo profesional y ambiente
                                        inclusivo.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vacante 6 -->
                <div class="col">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body text-center">
                            <div
                                class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px"
                            >
                                <i class="fas fa-briefcase text-secondary fs-3"></i>
                            </div>
                            <h5 class="card-title fw-bold">Consultor Empresarial</h5>
                            <p class="card-text">
                                Brinda asesoría estratégica para el crecimiento y transformación
                                de empresas.
                            </p>
                            <a href="#" class="btn btn-outline-secondary btn-sm toggle-info"
                                >Ver más <i class="fas fa-arrow-right ms-1"></i
                            ></a>
                            <div class="info-extra collapse mt-3">
                                <div class="card card-body">
                                    <h6 class="fw-bold">Detalles de la vacante</h6>
                                    <p>
                                        Requisitos: Experiencia en consultoría, visión estratégica y
                                        capacidad analítica. Beneficios: Proyectos desafiantes y
                                        reconocimiento profesional.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- fin de vacantes -->

            <!-- inicio del mapa de vacantes -->
            <section class="container my-5">
                <h2 class="text-center text-primary mb-4">Mapa de Vacantes</h2>
                <div id="mapa" style="height: 400px; border-radius: 10px"></div>
            </section>
            <!-- fin del mapa -->

            <!-- mapa de oportunidades de estudio -->
            <h2 class="text-center my-4 text-primary">Mapa de Estudio</h2>
            <p class="text-center">
                Educate y consigue nuevas habilidades y mas oportunidades de ser
                contratado.
            </p>
            <div id="mapa-oportunidades" style="height: 500px"></div>
            <!-- fin yeste -->

            <!-- inicio pal bloc de noticias -->
            <section class="container my-5">
                <h2 class="text-center text-primary mb-4">
                    Consejos & Noticias laborales
                </h2>
                <div class="row g-4">
                    <!-- Tarjeta 1 -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="../assets/img/entrevista.jpg" class="card-img-top" />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    La IA va a cambiar la forma de conseguir empleo en Colombia
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Observa como la inteligencia artificial va a cambiar la forma de
                                    buscar trabajo.
                                </p>
                                <a
                                    href="https://www.rcnradio.com/tecnologia/la-ia-va-cambiar-la-forma-de-conseguir-empleo-en-colombia-asi-le-va-tocar-a-los-que-ya-estan-buscando-trabajo"
                                    target="_blank"
                                    class="btn btn-outline-primary mt-auto"
                                    >Ver mas</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img
                                src="../assets/img/entrevista_de_carne.jpg"
                                class="card-img-top"
                                alt="Tips entrevista laboral Colombia"
                            />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    Tips para una entrevista laboral exitosa
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Investiga la empresa, practica tus respuestas y demuestra confianza para destacar como el candidato ideal.
                                </p>
                                <a
                                    href="https://www.valoraanalitik.com/entrevista-laboral-seis-claves-para-conseguir-empleo-en-colombia"
                                    target="_blank"
                                    class="btn btn-outline-primary mt-auto"
                                    >Ver mas</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img
                                src="../assets/img/trabajo.jpg"
                                class="card-img-top"
                                alt="Preguntas finales entrevista"
                            />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    ¿Qué preguntar al final de una entrevista?
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Aprende preguntas pa haer en una entrevista de trabajo y dar
                                    una buena impresion.
                                </p>
                                <a
                                    href="https://www.semana.com/como/articulo/que-preguntas-hacer-al-final-de-una-entrevista-de-trabajo/202342/"
                                    target="_blank"
                                    class="btn btn-outline-primary mt-auto"
                                    >Ver mas</a
                                >
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-info">Ver mas noticias</button>
                    </div>
                </div>
            </section>
            <!-- fin del coso ese -->

            <!-- calendario -->
            <h2 class="text-center my-4">Eventos y Oportunidades</h2>
            <div id="calendario" class="container mb-5"></div>
            <!-- fin del calendario -->

            <!-- yeste. -->
            <h2 class="text-center my-4">Tips Laborales</h2>

            <div
                id="carruselTips"
                class="carousel slide container"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner transparente">
                    <!-- tip 1 -->
                    <div class="carousel-item active transparente">
                        <div class="card p-4 shadow-sm text-center">
                            <h5 class="mb-3">Sé puntual en las entrevistas</h5>
                            <p>
                                Llegar a tiempo demuestra responsabilidad, compromiso y respeto
                                por el entrevistador.
                            </p>
                        </div>
                    </div>

                    <!-- tip 2 -->
                    <div class="carousel-item">
                        <div class="card p-4 shadow-sm text-center">
                            <h5 class="mb-3">Conoce tus fortalezas y debilidades</h5>
                            <p>
                                Prepárate para hablar de ellas con honestidad y cómo las estás
                                mejorando.
                            </p>
                        </div>
                    </div>

                    <!-- tip 3 -->
                    <div class="carousel-item">
                        <div class="card p-4 shadow-sm text-center">
                            <h5 class="mb-3">Aprende habilidades blandas</h5>
                            <p>
                                La comunicación, el trabajo en equipo y la empatía son clave
                                para cualquier puesto.
                            </p>
                        </div>
                    </div>
                </div>

                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carruselTips"
                    data-bs-slide="prev"
                >
                    <span
                        class="carousel-control-prev-icon bg-dark rounded-circle p-2"
                    ></span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carruselTips"
                    data-bs-slide="next"
                >
                    <span
                        class="carousel-control-next-icon bg-dark rounded-circle p-2"
                    ></span>
                </button>
            </div>
            <!-- fin yeste. -->

            <br />

            <!-- leyes y derechos -->
            <h2 class="text-center my-5">Derechos del Trabajador en Colombia</h2>

            <div class="accordion container" id="accordionDerechos">
                <!-- Item 1: Tipos de contrato -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingContrato">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseContrato"
                            aria-expanded="true"
                        >
                            Tipos de contrato para el trabajo
                        </button>
                    </h2>
                    <div
                        id="collapseContrato"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionDerechos"
                    >
                        <div class="accordion-body">
                            En Colombia existen principalmente: <br />
                            - Contrato a término fijo <br />
                            - Contrato a término indefinido <br />
                            - Contrato por obra o labor <br /><br />
                            Todos deben estar por escrito, incluir salario, jornada y
                            condiciones claras.:
                            <a href="https://www.mintrabajo.gov.co/" target="_blank"
                                >MinTrabajo</a
                            >
                        </div>
                    </div>
                </div>

                <!-- Item 2: Vacaciones -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingVacaciones">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseVacaciones"
                            aria-expanded="false"
                        >
                            Derecho a las Vacaciones
                        </button>
                    </h2>
                    <div
                        id="collapseVacaciones"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionDerechos"
                    >
                        <div class="accordion-body">
                            Todo trabajador tiene derecho a
                            <strong>15 días hábiles de vacaciones</strong> por cada año
                            trabajado. Deben pagarse antes de iniciar el descanso. Si no las
                            toma, se deben compensar en dinero. Fuente: Código Sustantivo del
                            Trabajo.
                        </div>
                    </div>
                </div>

                <!-- Item 3: Acoso laboral -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAcoso">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseAcoso"
                            aria-expanded="false"
                        >
                            ¿Qué es el acoso laboral?
                        </button>
                    </h2>
                    <div
                        id="collapseAcoso"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionDerechos"
                    >
                        <div class="accordion-body">
                            Es toda conducta persistente que humilla, intimida o perjudica al
                            trabajador. Está penado por la Ley 1010 de 2006. Se puede
                            denunciar ante el comité de convivencia laboral o el Ministerio de
                            Trabajo.
                        </div>
                    </div>
                </div>
            </div>
            <!-- flojera -->

            <br />

            <!-- testimonios -->
<section class="transparente py-5">
    <div class="container text-center">
        <h2 class="mb-4">Testimonios</h2>
        <div id="carouselTestimonios" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <blockquote class="blockquote">
                        <p>
                            “Gracias a GDA conseguí mi primer empleo como
                            jugadora de roblox.”
                        </p>
                        <footer class="blockquote-footer">Sarah Bello</footer>
                    </blockquote>
                </div>
                <div class="carousel-item">
                    <blockquote class="blockquote">
                        <p>
                            “Publicamos una vacante y en 2 días contratamos al mejor
                            candidato. aury daño todo”
                        </p>
                        <footer class="blockquote-footer">La Guaquita</footer>
                    </blockquote>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonios" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonios" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>


            <!-- fin de testimonios -->

            <!-- inicio de estadisticas -->
            <section class="container my-5">
                <h2 class="text-center text-primary mb-4">Estadísticas</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <canvas id="graficoVacantesCiudades"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="graficoServiciosOfertados"></canvas>
                    </div>
                </div>
            </section>
            <!-- fin de las estadisticas -->

            <!-- estadisticas -->
                <section class="estadisticas-transparente py-5 text-center">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col">
                                <h3 class="text-primary counter" data-target="500">0</h3>
                                <p>Usuarios Registrados</p>
                            </div>
                            <div class="col">
                                <h3 class="text-primary counter" data-target="200">0</h3>
                                <p>Vacantes Activas</p>
                            </div>
                            <div class="col">
                                <h3 class="text-primary counter" data-target="100">0</h3>
                                <p>Empresas Vinculadas.</p>
                            </div>
                        </div>
                    </div>
                </section>
</main>

    </main>

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
                border-radius: 50%;
            "
        >
            <i class="bi bi-arrow-up fs-3"></i>
        </button>
        <!-- fin del boton de scroll -->

<!-- Footer -->
    <?php include 'partials/footer.php'; ?>
<!-- fin del footer -->

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            defer
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script src="../assets/js/script.js"></script>

    </body>
</html>
