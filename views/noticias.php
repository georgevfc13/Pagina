<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Noticias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap 5 JS (con Popper incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <link rel="stylesheet" href="../assets/styles/noticias.css" />
        <style>
            .noticia-img {
                width: 100%;
                height: 220px;
                object-fit: cover;
            }
        </style>
    </head>
    <body>
        <?php $activePage = 'noticias'; include 'partials/navbar.php'; ?>
        
        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/freelance.png" class="card-img-top noticia-img" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title">
                                Cómo destacar tu perfil en plataformas de empleo freelance
                            </h5>
                            <p class="card-text">
                                Aprende estrategias efectivas para hacer que tu perfil destaque y
                                atraiga más clientes o empleadores en plataformas como Freelancer,
                                Workana y Upwork.
                            </p>
                            <a
                                href="https://www.freelancermap.com/blog/es/perfil-freelance-ejemplos-consejos/"
                                class="btn btn-outline-primary"
                                target="_blank"
                                >Ver más</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/mancito_rojo.png" class="card-img-top noticia-img" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title">Cómo destacar en tu trabajo</h5>
                            <p class="card-text">
                                Descubre estrategias efectivas para sobresalir en tu entorno laboral y
                                alcanzar tus objetivos profesionales.
                            </p>
                            <a
                                href="https://blogs.udima.es/ciencias-trabajo-recursos-humanos/sobresalir-en-el-trabajo-estas-son-las-habilidades-necesarias/"
                                class="btn btn-outline-primary"
                                target="_blank"
                                >Ver más</a>
                        </div>
                    </div>
                </div>
      <!-- Sección Blog -->
<section class="container py-5">
  <div class="text-center mb-4">
   
  
  </div>

  <!-- Tarjetas de artículos -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <img src="../assets/img/entrevista-otra.jpg" class="card-img-top" alt="Artículo">
        <div class="card-body">
          <h5 class="card-title">Cómo prepararte para una entrevista laboral</h5>
          <p class="card-text">Muy pronto encontrarás consejos prácticos para destacar en tus entrevistas.</p>
          <a href="#" class="btn btn-outline-primary btn-sm disabled">Leer más</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <img src="../assets/img/ia.png" class="card-img-top" alt="Artículo">
        <div class="card-body">
          <h5 class="card-title">El futuro del trabajo con IA</h5>
          <p class="card-text">Explora cómo la inteligencia artificial está transformando el mundo laboral.</p>
          <a href="#" class="btn btn-outline-primary btn-sm disabled">Leer más</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <img src="../assets/img/tendencias.jpg" class="card-img-top" alt="Artículo">
        <div class="card-body">
          <h5 class="card-title">Tendencias laborales 2025</h5>
          <p class="card-text">Muy pronto te mostraremos las oportunidades más demandadas este año.</p>
          <a href="#" class="btn btn-outline-primary btn-sm disabled">Leer más</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Botón de llamada a la acción -->
  <div class="text-center mt-4">
    <a href="#" class="btn btn-primary btn-lg disabled">Ver más artículos</a>
  </div>
</section>
            </div>
        </main>

        <?php include 'partials/footer.php'; ?>
    </body>
</html>