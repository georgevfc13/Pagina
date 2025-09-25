
// ...todas las funciones JS aquí...

// Al final del archivo, exponer funciones globales:
window.eliminarServicio = eliminarServicio;
window.cerrarModalEliminarServicio = cerrarModalEliminarServicio;
window.confirmarEliminacionServicio = confirmarEliminacionServicio;
window.mostrarEditarServicio = mostrarEditarServicio;
window.cerrarModalEditarServicio = cerrarModalEditarServicio;
window.contratarServicio = contratarServicio;
window.cerrarModalContratar = cerrarModalContratar;
window.confirmarContratacionServicio = confirmarContratacionServicio;
// --- MODAL DE ELIMINAR SERVICIO ---
let servicioEliminarId = null;
function eliminarServicio(id) {
	servicioEliminarId = id;
	document.getElementById('modal-eliminar-servicio-body').innerHTML = '¿Estás seguro de que deseas eliminar este servicio?';
	document.getElementById('btn-confirmar-eliminar').style.display = '';
	document.getElementById('modal-eliminar-servicio').style.display = 'flex';
	setTimeout(() => document.getElementById('modal-eliminar-servicio').classList.add('show'), 10);
}
function cerrarModalEliminarServicio() {
	const modal = document.getElementById('modal-eliminar-servicio');
	modal.classList.remove('show');
	setTimeout(() => { modal.style.display = 'none'; }, 300);
	servicioEliminarId = null;
}
function confirmarEliminacionServicio() {
	if (!servicioEliminarId) return;
	// AJAX para eliminar servicio
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../controller/servicio_ajax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			try {
				var res = JSON.parse(xhr.responseText);
				if (res.success) {
					document.getElementById('modal-eliminar-servicio-body').innerHTML = `<div class='text-success text-center' style='font-size:1.1rem;'><b>¡Servicio eliminado exitosamente!</b></div>`;
					document.getElementById('btn-confirmar-eliminar').style.display = 'none';
					setTimeout(() => { location.reload(); }, 1200);
				} else {
					document.getElementById('modal-eliminar-servicio-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al eliminar el servicio.</b></div>`;
				}
			} catch(e) {
				document.getElementById('modal-eliminar-servicio-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
			}
		}
	};
	xhr.send('eliminar_servicio=1&id=' + encodeURIComponent(servicioEliminarId));
}
// --- MODAL DE EDICIÓN DE SERVICIO ---
let servicioEditandoId = null;
function mostrarEditarServicio(id) {
	// Buscar la tarjeta del servicio
	const card = document.getElementById('servicio-card-' + id);
	if (!card) return;
	// Obtener datos de la tarjeta
	const titulo = card.querySelector('.card-title').textContent.trim();
	const descripcion = card.querySelectorAll('.card-text')[0].textContent;
	const ubicacion = card.querySelectorAll('.card-text')[1].textContent.replace('Ubicación:', '').trim();
	const tipo = card.querySelectorAll('.card-text')[2].textContent.replace('Tipo:', '').trim();
	let empresa = '';
	let precio = '';
	if (card.querySelectorAll('.card-text').length > 4) {
		empresa = card.querySelectorAll('.card-text')[4].textContent.replace('Empresa:', '').trim();
	}
	if (card.querySelectorAll('.card-text').length > 3) {
		precio = card.querySelectorAll('.card-text')[3].textContent.replace('Precio:', '').trim();
	}
	// Llenar el formulario del modal
	document.getElementById('edit-servicio-id').value = id;
	document.getElementById('edit-servicio-titulo').value = titulo;
	document.getElementById('edit-servicio-descripcion').value = descripcion;
	document.getElementById('edit-servicio-ubicacion').value = ubicacion;
	document.getElementById('edit-servicio-tipo').value = tipo;
	document.getElementById('edit-servicio-empresa').value = empresa;
	document.getElementById('edit-servicio-precio').value = precio;
	document.getElementById('modal-editar-servicio').style.display = 'flex';
	setTimeout(() => document.getElementById('modal-editar-servicio').classList.add('show'), 10);
	servicioEditandoId = id;
}
function cerrarModalEditarServicio() {
	const modal = document.getElementById('modal-editar-servicio');
	modal.classList.remove('show');
	setTimeout(() => { modal.style.display = 'none'; }, 300);
	servicioEditandoId = null;
}
document.getElementById('form-editar-servicio').onsubmit = function(e) {
	e.preventDefault();
	if (!servicioEditandoId) return;
	const data = {
		id: document.getElementById('edit-servicio-id').value,
		titulo: document.getElementById('edit-servicio-titulo').value,
		descripcion: document.getElementById('edit-servicio-descripcion').value,
		ubicacion: document.getElementById('edit-servicio-ubicacion').value,
		tipo: document.getElementById('edit-servicio-tipo').value,
		empresa: document.getElementById('edit-servicio-empresa').value,
		precio: document.getElementById('edit-servicio-precio').value
	};
	// AJAX para editar servicio
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../controller/servicio_ajax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	var params = 'editar_servicio=1';
	for (var key in data) {
		params += '&' + encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
	}
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			try {
				var res = JSON.parse(xhr.responseText);
				if (res.success) {
					document.getElementById('form-editar-servicio').innerHTML = `<div class='text-success text-center' style='font-size:1.1rem;'><b>¡Servicio editado exitosamente!</b></div>`;
					setTimeout(() => { location.reload(); }, 1200);
				} else {
					document.getElementById('form-editar-servicio').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al editar el servicio.</b></div>`;
				}
			} catch(e) {
				document.getElementById('form-editar-servicio').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
			}
		}
	};
	xhr.send(params);
};
// --- MODAL DE CONTRATAR SERVICIO ---


function contratarServicio(id) {
	// Obtener datos de la tarjeta
	const card = document.getElementById('servicio-card-' + id);
	if (!card) return;
	const titulo = card.querySelector('.card-title').textContent;
	const descripcion = card.querySelectorAll('.card-text')[0].textContent;
	const ubicacion = card.querySelectorAll('.card-text')[1].textContent;
	const tipo = card.querySelectorAll('.card-text')[2].textContent;
	const precio = card.querySelectorAll('.card-text')[3].textContent;
	let empresa = '';
	if (card.querySelectorAll('.card-text').length > 4) {
		empresa = card.querySelectorAll('.card-text')[4].textContent;
	}
	servicioSeleccionado = id;
	let html = `<div style='text-align:center; font-size:1.1rem; font-weight:bold; margin-bottom:10px;'>${titulo}</div>`;
	html += `<div><b>${ubicacion}</b></div>`;
	html += `<div class='mb-2'><b>${tipo}</b></div>`;
	html += `<div style='margin-bottom:10px;'>${descripcion}</div>`;
	if (empresa) html += `<div><b>Empresa:</b> ${empresa}</div>`;
	html += `<div><b>${precio}</b></div>`;
	document.getElementById('modal-contratar-body').innerHTML = html;
	const modal = document.getElementById('modal-contratar');
	modal.style.display = 'flex';
	setTimeout(() => modal.classList.add('show'), 10);
}
function cerrarModalContratar() {
	const modal = document.getElementById('modal-contratar');
	modal.classList.remove('show');
	setTimeout(() => { modal.style.display = 'none'; }, 300);
	servicioSeleccionado = null;
}
function confirmarContratacionServicio() {
	if (!servicioSeleccionado) return;
	// Aquí puedes llamar a la función AJAX real si lo deseas
	// Por ahora solo muestra mensaje de éxito
	document.getElementById('modal-contratar-body').innerHTML = `<div class='text-success text-center' style='font-size:1.2rem;'><b>¡Has contratado el servicio exitosamente!</b></div>`;
	document.getElementById('btn-confirmar-contratar').style.display = 'none';
	setTimeout(() => {
		cerrarModalContratar();
		document.getElementById('btn-confirmar-contratar').style.display = '';
	}, 1800);
}
// Eliminar servicio


// Editar servicio
function editarServicio(id, data, cardElem) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../controller/servicio_ajax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	var params = 'editar_servicio=1&id=' + encodeURIComponent(id);
	for (var key in data) {
		params += '&' + encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
	}
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			try {
				var res = JSON.parse(xhr.responseText);
				if (res.success) {
					   // alert('Servicio editado correctamente.');
					if (cardElem) location.reload();
				} else {
					   // alert('Error al editar: ' + (res.error || 'Error desconocido.'));
				}
			} catch(e) {
				   // alert('Error inesperado.');
			}
		}
	};
	xhr.send(params);
}


// La función contratarServicio que muestra el modal ya está definida arriba.

// Lógica AJAX al confirmar contratación:
function confirmarContratacionServicio() {
	if (!servicioSeleccionado) return;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../controller/servicio_ajax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			try {
				var res = JSON.parse(xhr.responseText);
				if (res.success) {
					document.getElementById('modal-contratar-body').innerHTML = `<div class='text-success text-center' style='font-size:1.2rem;'><b>¡Has contratado el servicio exitosamente!</b></div>`;
				} else {
					document.getElementById('modal-contratar-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al contratar el servicio.</b></div>`;
				}
				document.getElementById('btn-confirmar-contratar').style.display = 'none';
				setTimeout(() => {
					cerrarModalContratar();
					document.getElementById('btn-confirmar-contratar').style.display = '';
				}, 1800);
			} catch(e) {
				document.getElementById('modal-contratar-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
			}
		}
	};
	xhr.send('contratar_servicio=1&id=' + encodeURIComponent(servicioSeleccionado));
}
