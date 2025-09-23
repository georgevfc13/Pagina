<?php
require_once '../controller/VacanteController.php';
$mensaje = null;
$controller = new VacanteController();
// Procesar edición
if (isset($_POST['editar_vacante'])) {
    $id = $_POST['edit_id'];
    $data = [
        'titulo' => $_POST['edit_titulo'],
        'descripcion' => $_POST['edit_descripcion'],
        'ubicacion' => $_POST['edit_ubicacion'],
        'tipo' => $_POST['edit_tipo'],
        'empresa' => $_POST['edit_empresa'],
        'salario' => $_POST['edit_salario']
    ];
    $res = $controller->editarVacante($id, $data);
    if ($res === true) {
        $mensaje = "Vacante actualizada correctamente.";
    } else {
        $mensaje = "Error al actualizar: " . htmlspecialchars($res);
    }
}
// Procesar eliminación
if (isset($_POST['eliminar_vacante'])) {
    $id = $_POST['delete_id'];
    $res = $controller->eliminarVacante($id);
    if ($res === true) {
        $mensaje = "Vacante eliminada correctamente.";
    } else {
        $mensaje = "Error al eliminar: " . htmlspecialchars($res);
    }
}
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
                    <div class="col-md-6">
                        <label for="vacantes_disponibles" class="form-label">Número de vacantes disponibles</label>
                        <input type="number" class="form-control" id="vacantes_disponibles" name="vacantes_disponibles" min="1" value="1" required />
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
                            echo    "<div class='d-flex flex-wrap gap-2 mt-auto'>
                                <button class='btn btn-info' onclick=\"openModal('$modalId')\">Aplicar</button>
                                <button class='btn btn-warning' onclick=\"openEditModal('edit$modalId')\">Editar</button>
                                <button class='btn btn-danger' onclick=\"openDeleteModal('delete$modalId')\">Eliminar</button>
                            </div>
                            </div>
                        </div>
                        <!-- Modal aplicar -->
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
                        <!-- Modal editar -->
                        <div id='edit$modalId' class='custom-modal'>
                            <div class='custom-modal-content'>
                                <span class='custom-close' onclick=\"closeModal('edit$modalId')\">&times;</span>
                                <h4 class='mb-3 text-warning'>Editar vacante</h4>
                                <form method='POST' class='edit-form' action='' autocomplete='off'>
                                    <input type='hidden' name='edit_id' value='" . $row['id'] . "'>
                                    <div class='mb-2'><label class='form-label'>Título</label><input type='text' class='form-control' name='edit_titulo' value='" . htmlspecialchars($row['titulo']) . "' required></div>
                                    <div class='mb-2'><label class='form-label'>Descripción</label><input type='text' class='form-control' name='edit_descripcion' value='" . htmlspecialchars($row['descripcion']) . "' required></div>
                                    <div class='mb-2'><label class='form-label'>Ubicación</label><input type='text' class='form-control' name='edit_ubicacion' value='" . htmlspecialchars($row['ubicacion']) . "' required></div>
                                    <div class='mb-2'><label class='form-label'>Tipo</label><input type='text' class='form-control' name='edit_tipo' value='" . htmlspecialchars($row['tipo']) . "' required></div>
                                    <div class='mb-2'><label class='form-label'>Empresa</label><input type='text' class='form-control' name='edit_empresa' value='" . htmlspecialchars($row['empresa']) . "' required></div>
                                    <div class='mb-2'><label class='form-label'>Salario</label><input type='text' class='form-control' name='edit_salario' value='" . htmlspecialchars($row['salario']) . "'></div>
                                    <div class='d-flex justify-content-center gap-3 mt-3'>
                                        <button type='submit' name='editar_vacante' class='btn btn-warning'>Guardar</button>
                                        <button type='button' class='btn btn-outline-secondary' onclick=\"closeModal('edit$modalId')\">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal eliminar -->
                        <div id='delete$modalId' class='custom-modal'>
                            <div class='custom-modal-content'>
                                <span class='custom-close' onclick=\"closeModal('delete$modalId')\">&times;</span>
                                <h4 class='mb-3 text-danger'>¿Eliminar vacante?</h4>
                                <p>Esta acción no se puede deshacer.</p>
                                <form method='POST' action=''>
                                    <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                    <div class='d-flex justify-content-center gap-3 mt-3'>
                                        <button type='submit' name='eliminar_vacante' class='btn btn-danger'>Eliminar</button>
                                        <button type='button' class='btn btn-outline-secondary' onclick=\"closeModal('delete$modalId')\">Cancelar</button>
                                    </div>
                                </form>
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
        function openEditModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function openDeleteModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            var conf = document.getElementById('confirmacion-' + id);
            if(conf) conf.classList.add('d-none');
        }
        function confirmarAplicacion(id) {
            var conf = document.getElementById('confirmacion-' + id);
            if(conf) conf.classList.remove('d-none');
            setTimeout(function(){ closeModal(id); }, 1500);
        }
        </script>
        <script src="scroll.js"></script>
    </body>
</html>
