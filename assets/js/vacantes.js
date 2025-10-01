// --- MODALES Y ACCIONES PARA VACANTES ---
let vacanteSeleccionadaId = null;
let vacanteEliminarId = null;

function mostrarAplicarVacante(id) {
    // Obtener datos de la tarjeta
    const card = document.querySelector(`.tarjeta button[onclick*='mostrarAplicarVacante(${id})']`).closest('.tarjeta');
    if (!card) return;
    const titulo = card.querySelector('.card-title').textContent.trim();
    const descripcion = card.querySelectorAll('.card-text')[0].textContent;
    const ubicacion = card.querySelectorAll('.card-text')[1].textContent;
    const tipo = card.querySelectorAll('.card-text')[2].textContent;
    let empresa = '';
    let salario = '';
    card.querySelectorAll('.card-text').forEach(el => {
        if (el.textContent.includes('Empresa:')) empresa = el.textContent;
        if (el.textContent.includes('Salario:')) salario = el.textContent;
    });
    let html = `<div style='text-align:center; font-size:1.1rem; font-weight:bold; margin-bottom:10px;'>${titulo}</div>`;
    html += `<div><b>${ubicacion}</b></div>`;
    html += `<div class='mb-2'><b>${tipo}</b></div>`;
    html += `<div style='margin-bottom:10px;'>${descripcion}</div>`;
    if (empresa) html += `<div><b>${empresa}</b></div>`;
    if (salario) html += `<div><b>${salario}</b></div>`;
    document.getElementById('modal-aplicar-vacante-body').innerHTML = html;
    document.getElementById('modal-aplicar-vacante').style.display = 'flex';
    setTimeout(() => document.getElementById('modal-aplicar-vacante').classList.add('show'), 10);
    vacanteSeleccionadaId = id;
    // Asignar el evento al botón cada vez que se muestra el modal
    var btn = document.getElementById('btn-confirmar-aplicar');
    if (btn) {
        btn.onclick = confirmarAplicarVacante;
        btn.style.display = '';
    }
}
function cerrarModalAplicarVacante() {
    const modal = document.getElementById('modal-aplicar-vacante');
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);
    vacanteSeleccionadaId = null;
}
function confirmarAplicarVacante() {
    if (!vacanteSeleccionadaId) return;
    fetch('../controller/aplicar_vacante.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(vacanteSeleccionadaId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el número de aplicados en la tarjeta
            const aplicadosSpan = document.getElementById('aplicados-' + vacanteSeleccionadaId);
            if (aplicadosSpan) {
                aplicadosSpan.textContent = data.aplicados;
            }
            document.getElementById('modal-aplicar-vacante-body').innerHTML = `<div class='text-success text-center' style='font-size:1.2rem;'><b>¡Has aplicado a la vacante exitosamente!</b></div>`;
            document.getElementById('btn-confirmar-aplicar').style.display = 'none';
            setTimeout(() => {
                cerrarModalAplicarVacante();
                document.getElementById('btn-confirmar-aplicar').style.display = '';
            }, 1800);
        } else {
            alert(data.message || 'No se pudo aplicar a la vacante.');
        }
    })
    .catch(() => alert('Error de conexión.'));
}

function mostrarEditarVacante(id) {
    // Buscar la tarjeta de la vacante
    const card = document.querySelector(`.tarjeta button[onclick*='mostrarEditarVacante(${id})']`).closest('.tarjeta');
    if (!card) return;
    const titulo = card.querySelector('.card-title').textContent.trim();
    const descripcion = card.querySelectorAll('.card-text')[0].textContent;
    const ubicacion = card.querySelectorAll('.card-text')[1].textContent.replace('Ubicación:', '').trim();
    const tipo = card.querySelectorAll('.card-text')[2].textContent.replace('Tipo:', '').trim();
    let empresa = '';
    let salario = '';
    let usuarioTipo = '';
    card.querySelectorAll('.card-text').forEach(el => {
        if (el.textContent.includes('Empresa:')) empresa = el.textContent.replace('Empresa:', '').trim();
        if (el.textContent.includes('Salario:')) salario = el.textContent.replace('Salario:', '').trim();
        if (el.textContent.includes('Publicado por empresa:')) usuarioTipo = 'juridico';
        if (el.textContent.includes('Publicado por persona natural:')) usuarioTipo = 'natural';
    });
    document.getElementById('edit-vacante-id').value = id;
    document.getElementById('edit-vacante-titulo').value = titulo;
    document.getElementById('edit-vacante-descripcion').value = descripcion;
    document.getElementById('edit-vacante-ubicacion').value = ubicacion;
    document.getElementById('edit-vacante-tipo').value = tipo;
    document.getElementById('edit-vacante-empresa').value = empresa;
    document.getElementById('edit-vacante-salario').value = salario;
    document.getElementById('edit-vacante-usuario-tipo').value = usuarioTipo;
    document.getElementById('modal-editar-vacante').style.display = 'flex';
    setTimeout(() => document.getElementById('modal-editar-vacante').classList.add('show'), 10);
    vacanteEditandoId = id;
}
function cerrarModalEditarVacante() {
    const modal = document.getElementById('modal-editar-vacante');
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);
    vacanteEditandoId = null;
}
document.getElementById('form-editar-vacante').onsubmit = function(e) {
    e.preventDefault();
    if (!vacanteEditandoId) return;
    const data = {
        id: document.getElementById('edit-vacante-id').value,
        titulo: document.getElementById('edit-vacante-titulo').value,
        descripcion: document.getElementById('edit-vacante-descripcion').value,
        ubicacion: document.getElementById('edit-vacante-ubicacion').value,
        tipo: document.getElementById('edit-vacante-tipo').value,
        empresa: document.getElementById('edit-vacante-empresa').value,
        salario: document.getElementById('edit-vacante-salario').value,
        usuario_tipo: document.getElementById('edit-vacante-usuario-tipo').value
    };
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/vacante_ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var params = 'editar_vacante=1';
    for (var key in data) {
        params += '&' + encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
    }
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) {
                    document.getElementById('form-editar-vacante').innerHTML = `<div class='text-success text-center' style='font-size:1.1rem;'><b>¡Vacante editada exitosamente!</b></div>`;
                    setTimeout(() => { location.reload(); }, 1200);
                } else {
                    document.getElementById('form-editar-vacante').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al editar la vacante.</b></div>`;
                }
            } catch(e) {
                document.getElementById('form-editar-vacante').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
            }
        }
    };
    xhr.send(params);
};

function eliminarVacante(id) {
    vacanteEliminarId = id;
    document.getElementById('modal-eliminar-vacante-body').innerHTML = '¿Estás seguro de que deseas eliminar esta vacante?';
    document.getElementById('btn-confirmar-eliminar-vacante').style.display = '';
    document.getElementById('modal-eliminar-vacante').style.display = 'flex';
    setTimeout(() => document.getElementById('modal-eliminar-vacante').classList.add('show'), 10);
}
function cerrarModalEliminarVacante() {
    const modal = document.getElementById('modal-eliminar-vacante');
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);
    vacanteEliminarId = null;
}
function confirmarEliminacionVacante() {
    if (!vacanteEliminarId) return;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/vacante_ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) {
                    document.getElementById('modal-eliminar-vacante-body').innerHTML = `<div class='text-success text-center' style='font-size:1.1rem;'><b>¡Vacante eliminada exitosamente!</b></div>`;
                    document.getElementById('btn-confirmar-eliminar-vacante').style.display = 'none';
                    setTimeout(() => { location.reload(); }, 1200);
                } else {
                    document.getElementById('modal-eliminar-vacante-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al eliminar la vacante.</b></div>`;
                }
            } catch(e) {
                document.getElementById('modal-eliminar-vacante-body').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
            }
        }
    };
    xhr.send('eliminar_vacante=1&id=' + encodeURIComponent(vacanteEliminarId));
}

// Exponer funciones globales para los botones inline
window.mostrarAplicarVacante = mostrarAplicarVacante;
window.cerrarModalAplicarVacante = cerrarModalAplicarVacante;
window.confirmarAplicarVacante = confirmarAplicarVacante;
window.mostrarEditarVacante = mostrarEditarVacante;
window.cerrarModalEditarVacante = cerrarModalEditarVacante;
window.eliminarVacante = eliminarVacante;
window.cerrarModalEliminarVacante = cerrarModalEliminarVacante;
window.confirmarEliminacionVacante = confirmarEliminacionVacante;
// --- MODAL DE EDICIÓN DE VACANTE ---
let vacanteEditandoId = null;
function openEditModal(id) {
    // id es el id de la vacante (numérico)
    // Buscar la tarjeta de la vacante
    let card = null;
    const cards = document.querySelectorAll('.tarjeta');
    cards.forEach(function(c) {
        if (c.querySelector('.btn-warning') && c.querySelector('.btn-warning').getAttribute('onclick').includes("openEditModal")) {
            // Extraer el id de la vacante de la función onclick
            const onclick = c.querySelector('.btn-warning').getAttribute('onclick');
            if (onclick.includes("'editmodalVacante" + id + "'")) {
                card = c;
            }
        }
    });
    // Alternativamente, buscar por data-id si lo agregas
    // card = document.querySelector(`.tarjeta[data-id='${id}']`);
    if (!card) return;
    // Obtener datos de la tarjeta
    const titulo = card.querySelector('.card-title').childNodes[0].textContent.trim();
    const descripcion = card.querySelectorAll('.card-text')[0].textContent;
    const ubicacion = card.querySelectorAll('.card-text')[1].textContent.replace('Ubicación:', '').trim();
    const tipo = card.querySelectorAll('.card-text')[2].textContent.replace('Tipo:', '').trim();
    let empresa = '';
    let salario = '';
    if (card.querySelectorAll('.card-text').length > 3) {
        // Buscar empresa y salario
        for (let i = 3; i < card.querySelectorAll('.card-text').length; i++) {
            const txt = card.querySelectorAll('.card-text')[i].textContent;
            if (txt.includes('Empresa:')) empresa = txt.replace('Empresa:', '').trim();
            if (txt.includes('Salario:')) salario = txt.replace('Salario:', '').trim();
        }
    }
    // Llenar el formulario del modal
    document.getElementById('edit-vacante-id').value = id;
    document.getElementById('edit-vacante-titulo').value = titulo;
    document.getElementById('edit-vacante-descripcion').value = descripcion;
    document.getElementById('edit-vacante-ubicacion').value = ubicacion;
    document.getElementById('edit-vacante-tipo').value = tipo;
    document.getElementById('edit-vacante-empresa').value = empresa;
    document.getElementById('edit-vacante-salario').value = salario;
    document.getElementById('modal-editar-vacante').style.display = 'flex';
    setTimeout(() => document.getElementById('modal-editar-vacante').classList.add('show'), 10);
    vacanteEditandoId = id;
}
function cerrarModalEditarVacante() {
    const modal = document.getElementById('modal-editar-vacante');
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);
    vacanteEditandoId = null;
}
document.getElementById('form-editar-vacante').onsubmit = function(e) {
    e.preventDefault();
    if (!vacanteEditandoId) return;
    const data = {
        id: document.getElementById('edit-vacante-id').value,
        titulo: document.getElementById('edit-vacante-titulo').value,
        descripcion: document.getElementById('edit-vacante-descripcion').value,
        ubicacion: document.getElementById('edit-vacante-ubicacion').value,
        tipo: document.getElementById('edit-vacante-tipo').value,
        empresa: document.getElementById('edit-vacante-empresa').value,
        salario: document.getElementById('edit-vacante-salario').value,
        usuario_tipo: document.getElementById('edit-vacante-usuario-tipo').value
    };
    // AJAX para editar vacante
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/vacante_ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var params = 'editar_vacante=1';
    for (var key in data) {
        params += '&' + encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
    }
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) {
                    document.getElementById('form-editar-vacante').innerHTML = `<div class='text-success text-center' style='font-size:1.1rem;'><b>¡Vacante editada exitosamente!</b></div>`;
                    setTimeout(() => { location.reload(); }, 1200);
                } else {
                    document.getElementById('form-editar-vacante').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error al editar la vacante.</b></div>`;
                }
            } catch(e) {
                document.getElementById('form-editar-vacante').innerHTML = `<div class='text-danger text-center' style='font-size:1.1rem;'><b>Error inesperado.</b></div>`;
            }
        }
    };
    xhr.send(params);
};
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

function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function openEditModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function openDeleteModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function showDeleteConfirm(modalId) {
            document.getElementById('delete'+modalId).style.display = 'flex';
            document.getElementById('delete-confirm-'+modalId).style.display = 'block';
            document.getElementById('delete-form-'+modalId).style.display = 'none';
        }
        function showDeleteForm(modalId) {
            document.getElementById('delete-confirm-'+modalId).style.display = 'none';
            document.getElementById('delete-form-'+modalId).style.display = 'block';
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            var conf = document.getElementById('confirmacion-' + id);
            if(conf) conf.classList.add('d-none');
        }

        // Nueva función para aplicar a vacante vía AJAX
        function aplicarVacante(vacanteId, modalId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/aplicar_vacante.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    try {
                        var res = JSON.parse(xhr.responseText);
                        if (res.success) {
                            // Actualizar número de aplicados en la tarjeta y modal
                            document.getElementById('aplicados-' + vacanteId).textContent = res.aplicados;
                            var modalAplicados = document.getElementById('modal-aplicados-' + vacanteId);
                            if (modalAplicados) modalAplicados.textContent = res.aplicados;
                            // Mostrar confirmación
                            var conf = document.getElementById('confirmacion-' + modalId);
                            if(conf) conf.classList.remove('d-none');
                            setTimeout(function(){ closeModal(modalId); }, 1500);
                        } else {
                            alert('Error al aplicar: ' + (res.error || 'Error desconocido.'));
                        }
                    } catch(e) {
                        alert('Error inesperado.');
                    }
                }
            };
            xhr.send('vacante_id=' + encodeURIComponent(vacanteId));
        }

    // Integrar AJAX en el modal visual de aplicar vacante, asegurando que el botón exista
    document.addEventListener('DOMContentLoaded', function() {
        var btnConfirmarAplicar = document.getElementById('btn-confirmar-aplicar');
        if (btnConfirmarAplicar) {
            btnConfirmarAplicar.onclick = function() {
                if (!window.vacanteSeleccionadaId) return;
                fetch('../controller/aplicar_vacante.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + encodeURIComponent(window.vacanteSeleccionadaId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar el número de aplicados en la tarjeta
                        const aplicadosSpan = document.getElementById('aplicados-' + window.vacanteSeleccionadaId);
                        if (aplicadosSpan) {
                            aplicadosSpan.textContent = data.aplicados;
                        }
                        document.getElementById('modal-aplicar-vacante-body').innerHTML = `<div class='text-success text-center' style='font-size:1.2rem;'><b>¡Has aplicado a la vacante exitosamente!</b></div>`;
                        btnConfirmarAplicar.style.display = 'none';
                        setTimeout(() => {
                            cerrarModalAplicarVacante();
                            btnConfirmarAplicar.style.display = '';
                        }, 1800);
                    } else {
                        alert(data.message || 'No se pudo aplicar a la vacante.');
                    }
                })
                .catch(() => alert('Error de conexión.'));
            }
        }
    });