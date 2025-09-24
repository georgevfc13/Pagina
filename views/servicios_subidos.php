<?php
// Vista para mostrar y gestionar servicios subidos por el usuario
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
require_once '../controller/ServiciosSubidosController.php';
$servicios = isset($servicios) ? $servicios : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Servicios Subidos</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body>
    <?php $activePage = 'servicios_subidos'; include 'partials/navbar.php'; ?>
    <div class="container py-5">
        <h2 class="mb-4">Tus servicios publicados</h2>
        <?php if (empty($servicios)): ?>
            <p>No has publicado servicios aún.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($servicios as $servicio): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($servicio['titulo']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($servicio['descripcion']) ?></p>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="delete_id" value="<?= $servicio['id'] ?>">
                                    <button type="submit" name="eliminar_servicio" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                <button class="btn btn-warning btn-sm" onclick="document.getElementById('edit-<?= $servicio['id'] ?>').style.display='block'">Editar</button>
                                <div id="edit-<?= $servicio['id'] ?>" style="display:none;" class="mt-3">
                                    <form method="POST">
                                        <input type="hidden" name="edit_id" value="<?= $servicio['id'] ?>">
                                        <input type="text" name="edit_titulo" value="<?= htmlspecialchars($servicio['titulo']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_descripcion" value="<?= htmlspecialchars($servicio['descripcion']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_ubicacion" value="<?= htmlspecialchars($servicio['ubicacion']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_tipo" value="<?= htmlspecialchars($servicio['tipo']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_empresa" value="<?= htmlspecialchars($servicio['empresa']) ?>" class="form-control mb-2">
                                        <input type="text" name="edit_precio" value="<?= htmlspecialchars($servicio['precio']) ?>" class="form-control mb-2">
                                        <button type="submit" name="editar_servicio" class="btn btn-success btn-sm">Guardar</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('edit-<?= $servicio['id'] ?>').style.display='none'">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php include 'partials/footer.php'; ?>
</body>
</html>
