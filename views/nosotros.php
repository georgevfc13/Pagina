<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nosotros</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/nosotros.css" />
    </head>
    <body>
        <?php $activePage = 'nosotros'; include 'partials/navbar.php'; ?>
        <!-- seccion hero -->
        <section class="bg-primary text-white text-center py-5">
                <div>
                        <h2 class="display-5 fw-bold">Nosotros</h2>
                        <p class="lead">¿Quiénes somos?</p>
                        <p class="lead">Somos una empresa dedicada a brindar soluciones a lo que necesitas, comprometidos con la excelencia y la satisfacción de nuestros clientes.</p>
                </div>
        </section>
        <!-- fin seccion hero -->

        <!-- seccion de historia -->
        <section class=" text-white">
            <h2 class="text-center py-3 text-dark historia"><strong>Historia</strong></h2>
            <div class="container-fluid bg-secondary py-5">
                <div class="row align-items-center justify-content-center">
                    <!-- Imagen -->
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <img src="../assets/img/empresa.jpg" alt="empresa" class="imagen_esa img-fluid rounded">
                    </div>
                    <!-- Texto -->
                    <div class="col-md-6">
                        <p class="text-center">
                            Iniciamos en el año 2025 con el objetivo de facilitar a las personas a encontrar lo que necesiten en el área laboral, 
                            enfocándonos en permitir ofrecer vacantes y adquirir servicios. Desde entonces hemos trabajado con clientes de diferentes sectores, 
                            logrando crecer y consolidarnos en el mercado. Con el tiempo, hemos trabajado con clientes de diferentes sectores, 
                            logrando crecer, innovar y consolidarnos como una plataforma confiable y dinámica. Nuestro compromiso sigue siendo conectar a las personas 
                            con oportunidades que transformen su vida profesional.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mision, vision y valores -->
        <section class="container py-5">
            <div class="row text-center">
                <div class="col-md-4">
                    <h4>Misión</h4>
                    <p>Facilitar el acceso a oportunidades laborales y servicios a través de soluciones digitales confiables e innovadoras.</p>
                </div>
                <div class="col-md-4">
                    <h4>Visión</h4>
                    <p>Ser la plataforma líder en conectar talento con oportunidades, impulsando el crecimiento profesional y empresarial en Latinoamérica.</p>
                </div>
                <div class="col-md-4">
                    <h4>Valores</h4>
                    <ul class="list-unstyled">
                        <li>✔ Compromiso</li>
                        <li>✔ Transparencia</li>
                        <li>✔ Innovación</li>
                        <li>✔ Empatía</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- fin de la cosa esa larga -->

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
