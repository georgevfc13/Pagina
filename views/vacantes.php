
<?php
// --- INICIO ABSOLUTO: SESIÓN Y REQUIRES ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    $id = isset($_POST['delete_id']) ? $_POST['delete_id'] : '';
    if (empty($id)) {
        $mensaje = "Error: ID de vacante no recibido.";
    } else {
        $res = $controller->eliminarVacante($id);
        if ($res === true) {
            $mensaje = "Vacante eliminada correctamente.";
        } else {
            $mensaje = "Error al eliminar vacante (ID: " . $id . "): " . htmlspecialchars($res);
        }
    }
}
if (isset($_POST['titulo'])) {
    $resultado = $controller->registrarVacante();
    if ($resultado === true) {
        $mensaje = "Vacante publicada con éxito.";
    } elseif (is_string($resultado)) {
        $mensaje = $resultado;
    }
}
?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vacantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/vacantes.css" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>

    <?php $activePage = 'vacantes'; include 'partials/navbar.php'; ?>

    <!-- Hero Section -->
    <header class="hero-section text-black text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Nuestras Vacantes Profesionales</h1>
            <p class="lead mt-3">Soluciones para el desarrollo profesional y la gestión del talento humano.</p>
        </div>
    </header>

    <main>
        <section class="text-black text-center py-5">
            <div>
                <h2 class="display-5 fw-bold">Publica tu Vacante</h2>
                <p class="lead">Ofrece oportunidades laborales en tu empresa a quienes las necesitan</p>
            </div>
        </section>
        <div class="container text-center">
            <h3>Publica tu vacante aquí</h3>
            <?php if (!isset($_SESSION['id'])): ?>
                <div class="alert alert-warning mt-3">
                    Para publicar una vacante debes iniciar sesión.<br>
                    <a href="login.php" class="btn btn-primary mt-2">Ir a iniciar sesión</a>
                </div>
            <?php else: ?>
                <form method="POST" class="row g-3 justify-content-center my-4">
                    <?php if (isset($mensaje)) : ?>
                        <div class="alert alert-info text-center"> <?php echo $mensaje; ?> </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título de la vacante</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ejemplo: Desarrollador Web, Auxiliar Administrativo" required />
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción de la vacante</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Describe brevemente el puesto" required />
                    </div>
                    <div class="col-md-6">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ejemplo: Bogotá, Remoto, Medellín" required />
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo de vacante</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Tiempo completo">Tiempo completo</option>
                            <option value="Medio tiempo">Medio tiempo</option>
                            <option value="Prácticas">Prácticas</option>
                            <option value="Remoto">Remoto</option>
                            <option value="Por proyecto">Por proyecto</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre de la empresa" required />
                    </div>
                    <div class="col-md-6">
                        <label for="salario" class="form-label">Salario (opcional)</label>
                        <input type="text" class="form-control" id="salario" name="salario" placeholder="Ejemplo: $2.000.000, a convenir" />
                    </div>
                    <div class="col-md-6">
                        <label for="vacantes_disponibles" class="form-label">Personas requeridas</label>
                        <input type="number" min="1" class="form-control" id="vacantes_disponibles" name="vacantes_disponibles" placeholder="Ejemplo: 3" required />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-info" type="submit">Publicar vacante</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <section class="container-fluid py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Vacantes publicadas</h2>
                <p class="text-muted">Descubre las oportunidades laborales disponibles y postúlate.</p>
            </div>
            <div class="contenedor-tarjetas">

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
                    $aplicados = isset($row['aplicados']) ? (int)$row['aplicados'] : 0;
                    $requeridos = isset($row['vacantes_disponibles']) ? (int)$row['vacantes_disponibles'] : 0;
                    $vacanteId = (int)$row['id'];
                    // Usar el campo usuario_tipo para distinguir el tipo de usuario que publicó la vacante
                    $usuarioId = $row['usuario_id'];
                    $usuarioTipo = $row['usuario_tipo'];
                    $badge = '';
                    $publicadoPor = '';
                    if ($usuarioTipo === 'juridico') {
                        // Buscar nombre de la empresa
                        $queryEmpresa = $conn->prepare("SELECT razon_social FROM empresa_rut WHERE id = ?");
                        $queryEmpresa->execute([$usuarioId]);
                        if ($empresa = $queryEmpresa->fetch(PDO::FETCH_ASSOC)) {
                            $badge = "<span class='badge bg-success ms-2'>Empresa</span>";
                            $publicadoPor = "<p class='card-text mb-1'><strong>Publicado por empresa:</strong> " . htmlspecialchars($empresa['razon_social']) . "</p>";
                        } else {
                            $badge = "<span class='badge bg-secondary ms-2'>Empresa desconocida</span>";
                            $publicadoPor = "<p class='card-text mb-1'><strong>Publicado por empresa:</strong> Desconocida</p>";
                        }
                    } else {
                        // Buscar nombre de la persona natural
                        $queryNatural = $conn->prepare("SELECT nombre FROM usuarios_naturales WHERE id = ?");
                        $queryNatural->execute([$usuarioId]);
                        if ($natural = $queryNatural->fetch(PDO::FETCH_ASSOC)) {
                            $badge = "<span class='badge bg-info ms-2'>Persona natural</span>";
                            $publicadoPor = "<p class='card-text mb-1'><strong>Publicado por persona natural:</strong> " . htmlspecialchars($natural['nombre']) . "</p>";
                        } else {
                            $badge = "<span class='badge bg-secondary ms-2'>Natural desconocido</span>";
                            $publicadoPor = "<p class='card-text mb-1'><strong>Publicado por persona natural:</strong> Desconocido</p>";
                        }
                    }
                    // Renderizar la tarjeta de vacante
                    echo "<div class='card shadow-sm border-0 rounded-4 tarjeta'>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title fw-bold mb-2 text-primary'>" . htmlspecialchars($row['titulo']) . $badge . "</h5>
                            <p class='card-text mb-1'>" . htmlspecialchars($row['descripcion']) . "</p>
                            <p class='card-text mb-1'><strong>Ubicación:</strong> " . htmlspecialchars($row['ubicacion']) . "</p>
                            <p class='card-text mb-1'><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</p>";
                    echo $publicadoPor;
                    if (!empty($row['salario'])) {
                        echo "<p class='card-text mb-1'><strong>Salario:</strong> " . htmlspecialchars($row['salario']) . "</p>";
                    }
                    echo "<div class='row mb-3'>
                                    <div class='col'><strong>Requeridas:</strong> <span id='requeridos-$vacanteId'>$requeridos</span></div>
                                    <div class='col'><strong>Aplicadas:</strong> <span id='aplicados-$vacanteId'>$aplicados</span></div>
                                </div>";
                    echo    "<div class='d-flex flex-wrap gap-2 mt-auto'>
                                <button class='btn btn-info' onclick='mostrarAplicarVacante($vacanteId)'>Aplicar</button>";
                    if (isset($_SESSION['id']) && $_SESSION['id'] == $row['usuario_id']) {
                        echo "<button class='btn btn-warning' onclick='mostrarEditarVacante($vacanteId)'>Editar</button>
                              <button class='btn btn-danger' onclick='eliminarVacante($vacanteId)'>Eliminar</button>";
                    }
                    echo    "</div>
                            </div>
                        </div>";
                    $modalIndex++;
                }
            } else {
                echo "<p class='text-center'>No hay vacantes disponibles en este momento. ¡Vuelve pronto!</p>";
            }
            // Cerramos el bloque PHP antes de los modales
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
            ">
        <i class="bi bi-arrow-up fs-3"></i>
    </button>
    <!-- fin del boton de scroll -->


    <?php include 'partials/footer.php'; ?>

    <!-- Modal de edición de vacante -->
    <div id="modal-editar-vacante" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 500px;">
            <div class="modal-header-servicio">
                Editar Vacante
                <span class="custom-close dark-close" onclick="cerrarModalEditarVacante()">&times;</span>
            </div>
            <form id="form-editar-vacante" class="modal-body-servicio">
                <input type="hidden" id="edit-vacante-id" name="id" />
                <input type="hidden" id="edit-vacante-usuario-tipo" name="usuario_tipo" />
                <div class="mb-2">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" id="edit-vacante-titulo" name="titulo" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="edit-vacante-descripcion" name="descripcion" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="edit-vacante-ubicacion" name="ubicacion" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Tipo</label>
                    <input type="text" class="form-control" id="edit-vacante-tipo" name="tipo" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Empresa</label>
                    <input type="text" class="form-control" id="edit-vacante-empresa" name="empresa" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Salario</label>
                    <input type="text" class="form-control" id="edit-vacante-salario" name="salario" />
                </div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button type="submit" class="btn btn-warning text-dark fw-bold">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarVacante()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de aplicar a vacante -->
    <div id="modal-aplicar-vacante" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 500px;">
            <div class="modal-header-servicio">
                Detalle de la Vacante
                <span class="custom-close dark-close" onclick="cerrarModalAplicarVacante()">&times;</span>
            </div>
            <div id="modal-aplicar-vacante-body" class="modal-body-servicio"></div>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <button class="btn btn-primary" id="btn-confirmar-aplicar" onclick="confirmarAplicarVacante()">Aplicar</button>
                <button class="btn btn-secondary" onclick="cerrarModalAplicarVacante()">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación de vacante -->
    <div id="modal-eliminar-vacante" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 400px;">
            <div class="modal-header-servicio" style="background:#ff6f6f; color:#fff;">
                Confirmar Eliminación
                <span class="custom-close dark-close" onclick="cerrarModalEliminarVacante()">&times;</span>
            </div>
            <div class="modal-body-servicio text-center">
                <div id="modal-eliminar-vacante-body" class="mb-3">¿Estás seguro de que deseas eliminar esta vacante?</div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button class="btn btn-danger fw-bold" id="btn-confirmar-eliminar-vacante" onclick="confirmarEliminacionVacante()">Eliminar</button>
                    <button class="btn btn-secondary" onclick="cerrarModalEliminarVacante()">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación de vacante -->
    <div id="modal-eliminar-vacante" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 400px;">
            <div class="modal-header-vacante" style="background:#ff6f6f; color:#fff;">
                Confirmar Eliminación
                <span class="custom-close dark-close" onclick="cerrarModalEliminarVacante()">&times;</span>
            </div>
            <div class="modal-body-vacante text-center">
                <div id="modal-eliminar-vacante-body" class="mb-3">¿Estás seguro de que deseas eliminar esta vacante?</div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button class="btn btn-danger fw-bold" id="btn-confirmar-eliminar-vacante" onclick="confirmarEliminacionVacante()">Eliminar</button>
                    <button class="btn btn-secondary" onclick="cerrarModalEliminarVacante()">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/vacantes.js"></script>
</body>

</html>