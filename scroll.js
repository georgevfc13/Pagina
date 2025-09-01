//boton de scroll
// Mostrar/ocultar el botón al hacer scroll
window.addEventListener('scroll', function () {
  const btn = document.getElementById('scrollToTopBtn');
    if (window.scrollY > 200) {
      btn.style.display = 'flex';
    } else {
      btn.style.display = 'none';
      }
    });

// Scroll suave al inicio al hacer clic
document.getElementById('scrollToTopBtn').addEventListener('click', function () {
  window.scrollTo({ top: 0, behavior: 'smooth' });
  });


