
<?php
require_once '../controller/ServicioController.php';
$mensaje = null;
$controller = new ServicioController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controller->registrarServicio();
    if ($resultado === true) {
        // Redirigir con mensaje para evitar reenvío del formulario
        header('Location: servicios.php?exito=1');
        exit();
    } elseif (is_string($resultado)) {
        // Redirigir con mensaje de error
        header('Location: servicios.php?error=' . urlencode($resultado));
        exit();
    }
}
if (isset($_GET['exito'])) {
    $mensaje = "Servicio publicado con éxito.";
} elseif (isset($_GET['error'])) {
    $mensaje = $_GET['error'];
}
?>



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
    <header class="hero-section text-black text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Nuestros Servicios Profesionales</h1>
            <p class="lead mt-3">Soluciones integrales para la gestión del talento humano y el desarrollo de tu organización.</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main>
        <section class="text-black text-center py-5">
            <div>
                <h2 class="display-5 fw-bold">Publica tu Servicio</h2>
                <p class="lead">Ofrece tu talento o el de tu empresa a quienes lo necesitan</p>
            </div>
        </section>
        <main>
            <div class="container text-center">
                <h3>Publica tu servicio aquí</h3>
                <form method="POST" class="row g-3 justify-content-center my-4">
                    <?php if (isset($mensaje)) : ?>
                        <div class="alert alert-info text-center"> <?php echo $mensaje; ?> </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título del servicio</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ejemplo: Clases de matemáticas, Reparación de PC" required />
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción del servicio</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Describe brevemente lo que ofreces" required />
                    </div>
                    <div class="col-md-6">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ejemplo: Bogotá, Virtual, a domicilio" required />
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo de servicio</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Reparaciones">Reparaciones</option>
                            <option value="Clases particulares">Clases particulares</option>
                            <option value="Transporte">Transporte</option>
                            <option value="Cuidado personal">Cuidado personal</option>
                            <option value="Tecnología">Tecnología</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa (opcional)</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre de la empresa o deja vacío si eres independiente" />
                    </div>
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio (opcional)</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Ejemplo: $50.000 por hora, a convenir" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-info" type="submit">Publicar servicio</button>
                    </div>
                </form>
            </div>
        </main>

        <section class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Explora los Servicios Disponibles</h2>
                <p class="text-muted">Descubre a los profesionales que pueden ayudarte a llevar tu empresa al siguiente nivel.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
                require_once __DIR__ . '/../config/dataBase.php';
                $database = new Database();
                $conn = $database->getConnection();

                $sql = "SELECT * FROM servicios ORDER BY id DESC";
                $stmt = $conn->query($sql);
                if ($stmt && $stmt->rowCount() > 0) {
                    $modalIndex = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $modalId = 'modalServicio' . $modalIndex;
                        echo "<div class='col'>
                                <div class='card h-100 shadow-sm border-0 rounded-4' style='background:rgba(255,255,255,0.95);'>
                                    <div class='card-body d-flex flex-column'>
                                        <h5 class='card-title fw-bold mb-2 text-primary'>" . htmlspecialchars($row['titulo']) . "</h5>
                                        <p class='card-text mb-1'>" . htmlspecialchars($row['descripcion']) . "</p>
                                        <p class='card-text mb-1'><strong>Ubicación:</strong> " . htmlspecialchars($row['ubicacion']) . "</p>
                                        <p class='card-text mb-1'><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</p>";
                        if (!empty($row['empresa'])) {
                            echo "<p class='card-text mb-1'><strong>Empresa:</strong> " . htmlspecialchars($row['empresa']) . "</p>";
                        }
                        if (!empty($row['precio'])) {
                            echo "<p class='card-text mb-3'><strong>Precio:</strong> " . htmlspecialchars($row['precio']) . "</p>";
                        }
                        echo    "<button class='btn btn-info mt-auto' onclick=\"openModal('$modalId')\">Contratar</button>
                                    </div>
                                </div>
                                <!-- Modal personalizado -->
                                <div id='$modalId' class='custom-modal'>
                                    <div class='custom-modal-content'>
                                        <span class='custom-close' onclick=\"closeModal('$modalId')\">&times;</span>
                                        <h4 class='mb-3 text-primary'>¿Deseas contratar este servicio?</h4>
                                        <div class='mb-2'><strong>Servicio:</strong> " . htmlspecialchars($row['titulo']) . "</div>
                                        <div class='mb-2'><strong>Ubicación:</strong> " . htmlspecialchars($row['ubicacion']) . "</div>
                                        <div class='mb-2'><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</div>
                                        <div class='mb-2'><strong>Descripción:</strong> " . htmlspecialchars($row['descripcion']) . "</div>";
                        if (!empty($row['empresa'])) {
                            echo "<div class='mb-2'><strong>Empresa:</strong> " . htmlspecialchars($row['empresa']) . "</div>";
                        }
                        if (!empty($row['precio'])) {
                            echo "<div class='mb-2'><strong>Precio:</strong> " . htmlspecialchars($row['precio']) . "</div>";
                        }
                        echo    "<div class='d-flex justify-content-center gap-3 mt-4'>
                                            <button class='btn btn-success' onclick=\"confirmarAplicacion('$modalId')\">Sí, contratar</button>
                                            <button class='btn btn-outline-secondary' onclick=\"closeModal('$modalId')\">Cancelar</button>
                                        </div>
                                        <div id='confirmacion-$modalId' class='alert alert-success mt-3 d-none'>¡Has contratado este servicio!</div>
                                    </div>
                                </div>
                            </div>";
                        $modalIndex++;
                    }
                } else {
                    echo "<p class='text-center'>No hay servicios disponibles en este momento. ¡Sé el primero en publicar uno!</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Botón de volver arriba -->
    <button id="scrollToTopBtn" class="btn btn-dark rounded-circle shadow-lg" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; display: none; width: 50px; height: 50px;">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Pie de página -->
    <?php include 'partials/footer.php'; ?>
    <style>
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0; top: 0; width: 100vw; height: 100vh;
        background: rgba(0, 123, 255, 0.15);
        justify-content: center;
        align-items: center;
    }
    .custom-modal-content {
        background: #fff;
        border-radius: 18px;
        padding: 2.5rem 2rem 2rem 2rem;
        box-shadow: 0 8px 32px rgba(0,123,255,0.18);
        max-width: 420px;
        width: 95vw;
        position: relative;
        text-align: left;
    }
    .custom-close {
        position: absolute;
        top: 18px; right: 22px;
        font-size: 2rem;
        color: #0d6efd;
        cursor: pointer;
    }
    .custom-modal-content h4 {
        font-weight: 700;
    }
    .custom-modal-content button {
        min-width: 120px;
    }
    .d-none { display: none !important; }
    </style>
    <script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
        // Oculta mensaje de confirmación si se reabre
        var conf = document.getElementById('confirmacion-' + id);
        if(conf) conf.classList.add('d-none');
    }
    function confirmarAplicacion(id) {
        var conf = document.getElementById('confirmacion-' + id);
        if(conf) conf.classList.remove('d-none');
        setTimeout(function(){ closeModal(id); }, 1500);
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="scroll.js"></script>
</body>
</html>
