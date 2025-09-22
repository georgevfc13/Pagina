<?php
require_once '../controller/VacanteController.php';
$mensaje = null;
$controller = new VacanteController();
$resultado = $controller->registrarVacante();
if ($resultado === true) {
    $mensaje = "Vacante publicada con éxito.";
} elseif (is_string($resultado)) {
    $mensaje = $resultado;
}
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Servicios</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="../assets/styles/vacantes.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>
    <body>
        <?php $activePage = 'vacantes'; include 'partials/navbar.php'; ?>

        <?php if (isset($mensaje)) : ?>
            <div class="container mt-3">
                <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
            </div>
        <?php endif; ?>

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
                <form method="POST" class="row g-3 justify-content-center my-4">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título de la vacante</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ejemplo: Desarrollador Web" required />
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción de la vacante</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ejemplo: Especializado en desarrollo de aplicaciones móviles" required />
                    </div>
                    <div class="col-md-6">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ejemplo: Bogotá" required />
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo de vacante</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Tiempo completo">Tiempo completo</option>
                            <option value="Medio tiempo">Medio tiempo</option>
                            <option value="Remoto">Remoto</option>
                            <option value="Prácticas">Prácticas</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre de la empresa" required />
                    </div>
                    <div class="col-md-6">
                        <label for="salario" class="form-label">Salario (opcional)</label>
                        <input type="text" class="form-control" id="salario" name="salario" placeholder="Ejemplo: $2.000.000 - $3.000.000" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-info" type="submit">Publicar vacante</button>
                    </div>
                </form>
            </div>

            <div class="container py-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    require_once __DIR__ . '/../config/dataBase.php';
                    $database = new Database();
                    $conn = $database->getConnection();
                    $sql = "SELECT * FROM vacantes ORDER BY id DESC";
                    $stmt = $conn->query($sql);
                    if ($stmt && $stmt->rowCount() > 0) {
                        $modalIndex = 0;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $modalId = 'modalVacante' . $modalIndex;
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
                            if (!empty($row['salario'])) {
                                echo "<p class='card-text mb-3'><strong>Salario:</strong> " . htmlspecialchars($row['salario']) . "</p>";
                            }
                            echo    "<button class='btn btn-info mt-auto' onclick=\"openModal('$modalId')\">Aplicar</button>
                                        </div>
                                    </div>
                                    <!-- Modal personalizado -->
                                    <div id='$modalId' class='custom-modal'>
                                        <div class='custom-modal-content'>
                                            <span class='custom-close' onclick=\"closeModal('$modalId')\">&times;</span>
                                            <h4 class='mb-3 text-primary'>¿Deseas aplicar a esta vacante?</h4>
                                            <div class='mb-2'><strong>Puesto:</strong> " . htmlspecialchars($row['titulo']) . "</div>
                                            <div class='mb-2'><strong>Ubicación:</strong> " . htmlspecialchars($row['ubicacion']) . "</div>
                                            <div class='mb-2'><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</div>
                                            <div class='mb-2'><strong>Descripción:</strong> " . htmlspecialchars($row['descripcion']) . "</div>";
                            if (!empty($row['empresa'])) {
                                echo "<div class='mb-2'><strong>Empresa:</strong> " . htmlspecialchars($row['empresa']) . "</div>";
                            }
                            if (!empty($row['salario'])) {
                                echo "<div class='mb-2'><strong>Salario:</strong> " . htmlspecialchars($row['salario']) . "</div>";
                            }
                            echo    "<div class='d-flex justify-content-center gap-3 mt-4'>
                                                <button class='btn btn-success' onclick=\"confirmarAplicacion('$modalId')\">Sí, aplicar</button>
                                                <button class='btn btn-outline-secondary' onclick=\"closeModal('$modalId')\">Cancelar</button>
                                            </div>
                                            <div id='confirmacion-$modalId' class='alert alert-success mt-3 d-none'>¡Has aplicado exitosamente!</div>
                                        </div>
                                    </div>
                                </div>";
                            $modalIndex++;
                        }
                    } else {
                        echo "<p class='text-center'>No hay vacantes disponibles en este momento. ¡Vuelve pronto!</p>";
                    }
                    ?>
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
        <script src="../assets/js/vacantes.js"></script>
    </body>
</html>
