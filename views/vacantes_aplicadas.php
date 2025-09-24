<?php
// Vista para mostrar y gestionar vacantes publicadas por el usuario
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
require_once '../controller/VacantesPublicadasController.php';
$vacantes = isset($vacantes) ? $vacantes : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Vacantes Publicadas</title>
    <link rel="stylesheet" href="../assets/styles/vacantes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body>
    <?php $activePage = 'vacantes_aplicadas'; include 'partials/navbar.php'; ?>
    <div class="container py-5">
        <h2 class="mb-4">Tus vacantes publicadas</h2>
        <?php if (empty($vacantes)): ?>
            <p>No has publicado vacantes aún.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($vacantes as $vacante): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($vacante['titulo']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($vacante['descripcion']) ?></p>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="delete_id" value="<?= $vacante['id'] ?>">
                                    <button type="submit" name="eliminar_vacante" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                <button class="btn btn-warning btn-sm" onclick="document.getElementById('edit-<?= $vacante['id'] ?>').style.display='block'">Editar</button>
                                <div id="edit-<?= $vacante['id'] ?>" style="display:none;" class="mt-3">
                                    <form method="POST">
                                        <input type="hidden" name="edit_id" value="<?= $vacante['id'] ?>">
                                        <input type="text" name="edit_titulo" value="<?= htmlspecialchars($vacante['titulo']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_descripcion" value="<?= htmlspecialchars($vacante['descripcion']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_ubicacion" value="<?= htmlspecialchars($vacante['ubicacion']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_tipo" value="<?= htmlspecialchars($vacante['tipo']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_empresa" value="<?= htmlspecialchars($vacante['empresa']) ?>" required class="form-control mb-2">
                                        <input type="text" name="edit_salario" value="<?= htmlspecialchars($vacante['salario']) ?>" class="form-control mb-2">
                                        <button type="submit" name="editar_vacante" class="btn btn-success btn-sm">Guardar</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('edit-<?= $vacante['id'] ?>').style.display='none'">Cancelar</button>
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
