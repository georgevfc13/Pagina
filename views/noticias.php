<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Noticias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/noticias.css" />
    </head>
    <body>
        <?php $activePage = 'noticias'; include 'partials/navbar.php'; ?>
        <main class="container py-5">
            <div class="col-md-4">
                <div class="card">
                    <img src="../assets/img/freelance.png" class="card-img-top" alt="..." />
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
                            >Ver más</a
                        >
                    </div>
                </div>
            </div>
        </main>

        <?php include 'partials/footer.php'; ?>
    </body>
</html>