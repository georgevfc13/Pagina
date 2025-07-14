//funcionamiento del boton de ver mas
document.querySelectorAll('.ver-mas').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const info = this.parentElement.querySelector('.info-extra');
    info.classList.add('show');
    info.classList.remove('collapse');
  });
});

document.querySelectorAll('.ver-menos').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const info = this.closest('.info-extra');
    info.classList.remove('show');
    info.classList.add('collapse');
  });
});

document.querySelectorAll('.toggle-info').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const info = this.parentElement.querySelector('.info-extra');
    const isOpen = info.classList.contains('show');
    if (isOpen) {
      info.classList.remove('show');
      info.classList.add('collapse');
      this.innerHTML = 'Ver más <i class="fas fa-arrow-right ms-1"></i>';
      this.classList.remove('btn-outline-secondary');
      this.classList.add('btn-outline-primary');
    } else {
      info.classList.add('show');
      info.classList.remove('collapse');
      this.innerHTML = 'Ver menos <i class="fas fa-arrow-up ms-1"></i>';
      this.classList.remove('btn-outline-primary');
      this.classList.add('btn-outline-secondary');
    }
  });
});