



<h1>Mi Perfil Jurídico</h1>

<h3>Datos Registrados</h3>
<p>Nombre: <?= htmlspecialchars($datos['nombre_empresa']) ?></p>
<p>Email: <?= htmlspecialchars($datos['email']) ?></p>
<img src="<?= htmlspecialchars($datos['foto_perfil'] ?? '/img/default-user.png'); ?>" width="120" />

<h3>Vacantes Publicadas</h3>
<ul>
<?php foreach ($vacantes as $v): ?>
   <li><?= htmlspecialchars($v['titulo']) ?></li>
<?php endforeach; ?>
</ul>

<h3>Servicios Publicados</h3>
<ul>
<?php foreach ($servicios as $s): ?>
   <li><?= htmlspecialchars($s['nombre_servicio']) ?></li>
<?php endforeach; ?>
</ul>

</div>