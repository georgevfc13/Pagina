<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
    <?php $activePage = 'blog'; include 'partials/navbar.php'; ?>
    <main class="container py-5">
       
<section class="container py-5">
  <h1 class="fw-bold text-center mb-4">Blog</h1>
  <p class="text-center text-muted mb-5">
    Bienvenido a nuestro blog. Aquí encontrarás artículos, consejos y novedades sobre empleo, tecnología e innovación. 
    Próximamente estaremos publicando más contenido pensado para ayudarte a crecer personal y profesionalmente.
  </p>

  <article class="mb-5">
    <h3>Cómo prepararte para una entrevista laboral</h3>
    <p>
      Una entrevista de trabajo puede ser un momento decisivo en tu carrera. Muy pronto compartiremos estrategias y recomendaciones 
      para destacar como candidato ideal y enfrentar las preguntas más comunes con seguridad.
    </p>
  </article>

  <article class="mb-5">
    <h3>El futuro del trabajo con Inteligencia Artificial</h3>
    <p>
      La inteligencia artificial está transformando la manera en que trabajamos y buscamos empleo. En los próximos artículos 
      exploraremos cómo esta tecnología abre nuevas oportunidades laborales y qué habilidades serán más valoradas en el futuro.
    </p>
  </article>

  <article class="mb-5">
    <h3>Tendencias laborales en 2025</h3>
    <p>
      El mundo laboral evoluciona rápidamente. Te mostraremos las profesiones más demandadas, consejos para adaptarte al cambio 
      y cómo aprovechar las nuevas oportunidades que trae este año.
    </p>
  </article>

  <p class="text-center text-muted">
    🔔 Muy pronto más artículos y recursos. ¡Mantente atento!
  </p>
</section>


    </main>
    <?php include 'partials/footer.php'; ?>
</body>
</html>