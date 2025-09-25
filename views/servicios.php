    <!-- Modal de confirmación de eliminación de servicio -->
    <div id="modal-eliminar-servicio" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 400px;">
            <div class="modal-header-servicio" style="background:#ff6f6f; color:#fff;">
                Confirmar Eliminación
                <span class="custom-close dark-close" onclick="cerrarModalEliminarServicio()">&times;</span>
            </div>
            <div class="modal-body-servicio text-center">
                <div id="modal-eliminar-servicio-body" class="mb-3">¿Estás seguro de que deseas eliminar este servicio?</div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button class="btn btn-danger fw-bold" id="btn-confirmar-eliminar" onclick="confirmarEliminacionServicio()">Eliminar</button>
                    <button class="btn btn-secondary" onclick="cerrarModalEliminarServicio()">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<?php
// Asegurar que la sesión y los headers se gestionen antes de cualquier salida HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../controller/ServicioController.php';
$mensaje = null;
$controller = new ServicioController();
// Procesar edición
if (isset($_POST['editar_servicio'])) {
    $id = $_POST['edit_id'];
    $data = [
        'titulo' => $_POST['edit_titulo'],
        'descripcion' => $_POST['edit_descripcion'],
        'ubicacion' => $_POST['edit_ubicacion'],
        'tipo' => $_POST['edit_tipo'],
        'empresa' => $_POST['edit_empresa'],
        'precio' => $_POST['edit_precio']
    ];
    $res = $controller->editarServicio($id, $data);
    if ($res === true) {
        $mensaje = "Servicio actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar: " . htmlspecialchars($res);
    }
}
// Procesar eliminación
if (isset($_POST['eliminar_servicio'])) {
    $id = $_POST['delete_id'];
    $res = $controller->eliminarServicio($id);
    if ($res === true) {
        $mensaje = "Servicio eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar: " . htmlspecialchars($res);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['editar_servicio']) && !isset($_POST['eliminar_servicio'])) {
    $resultado = $controller->registrarServicio();
    if ($resultado === true) {
        header('Location: servicios.php?exito=1');
        exit();
    } elseif (is_string($resultado)) {
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
    <!-- Modal de edición de servicio -->
    <div id="modal-editar-servicio" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 500px;">
            <div class="modal-header-servicio">
                Editar Servicio
                <span class="custom-close dark-close" onclick="cerrarModalEditarServicio()">&times;</span>
            </div>
            <form id="form-editar-servicio" class="modal-body-servicio">
                <input type="hidden" id="edit-servicio-id" name="id" />
                <div class="mb-2">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" id="edit-servicio-titulo" name="titulo" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="edit-servicio-descripcion" name="descripcion" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="edit-servicio-ubicacion" name="ubicacion" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Tipo</label>
                    <input type="text" class="form-control" id="edit-servicio-tipo" name="tipo" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">Empresa</label>
                    <input type="text" class="form-control" id="edit-servicio-empresa" name="empresa" />
                </div>
                <div class="mb-2">
                    <label class="form-label">Precio</label>
                    <input type="text" class="form-control" id="edit-servicio-precio" name="precio" />
                </div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button type="submit" class="btn btn-primary fw-bold">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarServicio()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios</title>

    <!-- Bootstrap y otros estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/styles/servicios.css" />
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
                <?php if (!isset($_SESSION['id'])): ?>
                    <div class="alert alert-warning mt-3">
                        Para publicar un servicio debes iniciar sesión.<br>
                        <a href="login.php" class="btn btn-primary mt-2">Ir a iniciar sesión</a>
                    </div>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </main>

    <section class="container-fluid py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Explora los Servicios Disponibles</h2>
                <p class="text-muted">Descubre a los profesionales que pueden ayudarte a llevar tu empresa al siguiente nivel.</p>
            </div>

<div class="contenedor-tarjetas">
    <?php
    require_once __DIR__ . '/../config/dataBase.php';
    $database = new Database();
    $conn = $database->getConnection();

    $sql = "SELECT * FROM servicios ORDER BY id DESC";
    $stmt = $conn->query($sql);
    if ($stmt && $stmt->rowCount() > 0) {
        $modalIndex = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicioId = (int)$row['id'];
            $titulo = htmlspecialchars($row['titulo']);
            $descripcion = htmlspecialchars($row['descripcion']);
            $ubicacion = htmlspecialchars($row['ubicacion']);
            $tipo = htmlspecialchars($row['tipo']);
            $empresa = htmlspecialchars($row['empresa']);
            $precio = htmlspecialchars($row['precio']);
            ?>
            <div class='card shadow-sm border-0 rounded-4 tarjeta' id='servicio-card-<?= $servicioId ?>'>
                <div class='card-body d-flex flex-column'>
                    <h5 class='card-title fw-bold mb-2 text-primary'><?= $titulo ?></h5>
                    <p class='card-text mb-1'><?= $descripcion ?></p>
                    <p class='card-text mb-1'><strong>Ubicación:</strong> <?= $ubicacion ?></p>
                    <p class='card-text mb-1'><strong>Tipo:</strong> <?= $tipo ?></p>
                    <p class='card-text mb-3'><strong>Precio:</strong> <?= $precio ?></p>
                    <div class='d-flex flex-wrap gap-2 mt-auto'>
                        <button class='btn btn-info' onclick='contratarServicio(<?= $servicioId ?>)'>Contratar</button>
                        <button class='btn btn-warning' onclick='mostrarEditarServicio(<?= $servicioId ?>)'>Editar</button>
                        <button class='btn btn-danger' onclick='eliminarServicio(<?= $servicioId ?>)'>Eliminar</button>
                    </div>

                </div>
            </div>
            <?php
            $modalIndex++;
        }
    } else {
        echo "<p class='text-center'>No hay servicios disponibles en este momento.</p>";
    }
    ?>
</div>

            </div>
        </section>
    </main>

    <!-- Botón de volver arriba -->
    <button id="scrollToTopBtn" class="btn btn-dark rounded-circle shadow-lg" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; display: none; width: 50px; height: 50px;">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Pie de página -->
    <?php include 'partials/footer.php'; ?>
    <!-- Modal de detalle y confirmación de contratación -->
    <div id="modal-contratar" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 500px;">
            <div class="modal-header-servicio">
                Detalle del servicio
                <span class="custom-close dark-close" onclick="cerrarModalContratar()">&times;</span>
            </div>
            <div id="modal-contratar-body" class="modal-body-servicio"></div>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <button class="btn btn-primary" id="btn-confirmar-contratar" onclick="confirmarContratacionServicio()">Contratar</button>
                <button class="btn btn-secondary" onclick="cerrarModalContratar()">Cerrar</button>
            </div>
        </div>
    </div>
    <script src="../assets/js/servicios.js"></script>
    <script src="../assets/js/servicios_debug.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
