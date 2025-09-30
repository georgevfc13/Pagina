<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Soporte Técnico - Tu Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnwpHbyT38iGgWJ8E7C5A376z4O5jL3c" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <style>
        .icon-box {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .icon-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .icon-box .fa-4x {
            color: #007bff;
        }
    </style>
</head>
<body>
    <?php $activePage = 'soporte'; include 'partials/navbar.php'; ?>
    <main class="container py-5">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">¿Necesitas Ayuda?</h1>
            <p class="lead text-muted">Estamos aquí para asistirte con cualquier duda, problema o sugerencia que tengas. Elige la opción que mejor se adapte a tus necesidades.</p>
        </header>
        
        <div class="row text-center g-4">
            <div class="col-md-6 col-lg-4">
                <div class="icon-box h-100">
                    <i class="fas fa-question-circle fa-4x mb-4"></i>
                    <h2 class="h4">Preguntas Frecuentes</h2>
                    <p class="text-muted">Encuentra respuestas a las consultas más comunes en nuestra sección de FAQs.</p>
                    <a href="#" class="btn btn-primary mt-3">Ver FAQs</a>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="icon-box h-100">
                    <i class="fas fa-envelope fa-4x mb-4"></i>
                    <h2 class="h4">Formulario de Contacto</h2>
                    <p class="text-muted">Envíanos un mensaje y te responderemos lo antes posible.</p>
                    <a href="#" class="btn btn-primary mt-3">Enviar Mensaje</a>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="icon-box h-100">
                    <i class="fas fa-headset fa-4x mb-4"></i>
                    <h2 class="h4">Contacto Directo</h2>
                    <p class="text-muted">Si prefieres, puedes contactarnos directamente por email o teléfono.</p>
                    <ul class="list-unstyled mt-3 text-start">
                        <li><i class="fas fa-envelope me-2 text-primary"></i> <a href="mailto:soporte@tuempresa.com">soporte@tuempresa.com</a></li>
                        <li><i class="fas fa-phone me-2 text-primary"></i> <a href="tel:+123456789">+1 (234) 567-890</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <p class="text-muted">Nuestro horario de atención es de lunes a viernes de 9:00 a 18:00 (zona horaria local).</p>
        </div>
    </main>
    <?php include 'partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZle+S7WwHjC0I5jY1zWJ8P5dE5c" crossorigin="anonymous"></script>
    
</body>
</html>