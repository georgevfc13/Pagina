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

// el script del mapa
document.addEventListener("DOMContentLoaded", function () {
  // pa que el mapa que se muestre sea en la jagua
    const mapa = L.map('mapa', {
      scrollWheelZoom: false}).setView([10.1, -73.3], 10);


  // este es pa cargar un mapa de OpenStreetMap
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(mapa);

  const vacantes = [
    {
      titulo: "Celador",
      lat: 9.555774159560068,
      lng: -73.33499886092615,
    },
    {
      titulo: "Alguien pa que puye",
      lat: 9.562868102518381,
      lng: -73.33157941460846,
    },
    {
      titulo: "Atendedor",
      lat: 9.562561289714909,
      lng: -73.3326576626357,
    },
  ];

  // Agregar marcadores
  vacantes.forEach((vacante) => {
    L.marker([vacante.lat, vacante.lng])
      .addTo(mapa)
      .bindPopup(`<b>${vacante.titulo}</b><br>La Jagua de Ibirico`);
  });
});
