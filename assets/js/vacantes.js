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