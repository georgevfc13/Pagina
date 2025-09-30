<?php
session_start();


require_once __DIR__ . '/../controller/ServicioController.php';
require_once __DIR__ . '/../controller/VacanteController.php';
$controller = new ServicioController();
$servicios = $controller->obtenerServicios(6); // mostrar solo 3 servicios
$controller = new VacanteController();
// 🔹 Traer 6 vacantes para mostrar en el home
$vacantes = $controller->obtenerVacantes(6) ?? [];



// Si hay sesión activa
if (isset($_SESSION['id'])) {
    $nombre = $_SESSION['nombre'] ?? 'Usuario';
    $tipo   = $_SESSION['tipo'] ?? '';
    $foto = $_SESSION['foto_perfil'] ?? 'assets/img/default-avatar.png'; // Ruta por defecto si no hay foto de perfil
} else {
    // Si no hay sesión, es invitado
    $nombre = 'Invitado';
    $tipo   = 'invitado';
    $foto = 'assets/img/default-avatar.png'; // Ruta por defecto para invitados
}



?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php $activePage = 'home';
    include 'partials/navbar.php'; ?>
    <!-- zona hero -->
    <section class="hero d-flex align-items-center justify-content-center text-center">
        <div class="hero-content text-white">
            <h1 class="fw-bold">Hola, <?php echo htmlspecialchars($nombre); ?>👋 </h1>
            <p class="lead">Bienvenido a GDA, tu puente entre oportunidades laborales y talento profesional</p>
            <?php if (isset($_SESSION['id'])): ?>
                <img src="<?php echo htmlspecialchars($foto && file_exists(str_replace('..','.', $foto)) ? $foto : '../assets/img/logo.jpg'); ?>"
                     alt="Foto de perfil"
                     style="width:90px;height:90px;border-radius:50%;object-fit:cover;background:#fff;box-shadow:0 0 8px #0002;">
            <?php endif; ?>
            <?php if (!isset($_SESSION['id'])): ?>
                <a href="registro.php" class="btn btn-light mt-3">Regístrate aquí</a>
            <?php endif; ?>
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
                        name="busqueda" />
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
                        <option value="la_paz">La Paz</option>
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
<section class="container my-5">
    <h1 class="fw-bold text-primary mb-3 h1">Nuestros Servicios</h1>
    <p class="lead text-secondary mx-auto " style="max-width: 600px;">
        Ofrecemos servicios profesionales para ayudar a tu empresa a crecer y tener éxito en el mercado actual.
    </p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($servicios as $servicio): ?>
            <div class="col">
                <div class="card h-100 shadow rounded-4">
                    <div class="card-body text-center">

                        <!-- Contenedor redondo del ícono -->
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 64px; height: 64px;">
                            <i class="<?= htmlspecialchars($servicio['icono'] ?? 'fa-solid fa-briefcase'); ?> fa-xl"
                               style="color: #0676cb;"></i>
                        </div>

                        <!-- Título -->
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($servicio['titulo']); ?></h5>

                        <!-- Descripción -->
                        <p class="card-text"><?= htmlspecialchars($servicio['descripcion']); ?></p>

                        <!-- Botón -->
                        <a href="#" class="btn btn-outline-primary btn-sm toggle-info">
                            Ver más <i class="fas fa-arrow-right ms-1"></i>
                        </a>

                        <!-- Información extra -->
                        <div class="info-extra collapse mt-3">
                            <div class="card card-body">
                                <h6 class="fw-bold">Información del servicio</h6>
                                <p><?= htmlspecialchars($servicio['detalles'] ?? 'Próximamente más información'); ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>







        <!-- vacantes -->

        <section class="container my-5">
    <h1 class="fw-bold text-primary mb-3">Nuestras Vacantes</h1>
    <p class="lead text-secondary mx-auto " style="max-width: 600px;">
        En GDA conectamos tu talento tu talento con empresas lideres para impulsar tu crecimiento y éxito profesional.
    </p>
       <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach ($vacantes as $vacante): ?>
        <div class="col">
            <div class="card h-100 shadow rounded-4">
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 64px; height: 64px">
                        <i class="<?= htmlspecialchars($vacante['icono'] ?? 'fa-solid fa-briefcase'); ?> fa-xl"
                           style="color: #0676cb;"></i>
                    </div>
                    <h5 class="card-title fw-bold"><?= htmlspecialchars($vacante['titulo']); ?></h5>
                    <p class="card-text"><?= htmlspecialchars($vacante['descripcion']); ?></p>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        Ver más <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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
                                    class="btn btn-outline-primary mt-auto">Ver mas</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img
                                src="../assets/img/entrevista_de_carne.jpg"
                                class="card-img-top"
                                alt="Tips entrevista laboral Colombia" />
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
                                    class="btn btn-outline-primary mt-auto">Ver mas</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img
                                src="../assets/img/trabajo.jpg"
                                class="card-img-top"
                                alt="Preguntas finales entrevista" />
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
                                    class="btn btn-outline-primary mt-auto">Ver mas</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-primary">Ver mas noticias</button>
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
                data-bs-ride="carousel">
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
                    data-bs-slide="prev">
                    <span
                        class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carruselTips"
                    data-bs-slide="next">
                    <span
                        class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
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
                            aria-expanded="true">
                            Tipos de contrato para el trabajo
                        </button>
                    </h2>
                    <div
                        id="collapseContrato"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionDerechos">
                        <div class="accordion-body">
                            En Colombia existen principalmente: <br />
                            - Contrato a término fijo <br />
                            - Contrato a término indefinido <br />
                            - Contrato por obra o labor <br /><br />
                            Todos deben estar por escrito, incluir salario, jornada y
                            condiciones claras.:
                            <a href="https://www.mintrabajo.gov.co/" target="_blank">MinTrabajo</a>
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
                            aria-expanded="false">
                            Derecho a las Vacaciones
                        </button>
                    </h2>
                    <div
                        id="collapseVacaciones"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionDerechos">
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
                            aria-expanded="false">
                            ¿Qué es el acoso laboral?
                        </button>
                    </h2>
                    <div
                        id="collapseAcoso"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionDerechos">
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
            ">
        <i class="bi bi-arrow-up fs-3"></i>
    </button>
    <!-- fin del boton de scroll -->

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <!-- fin del footer -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="../assets/js/script.js"></script>

</body>

</html>