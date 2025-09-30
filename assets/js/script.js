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
  // Coordenadas centrales (La Jagua de Ibirico)
  const centro = [9.564642895405072, -73.33608547628114];

  // === MAPA DE VACANTES ===
  const mapaVacantes = L.map('mapa', {
    scrollWheelZoom: false
  }).setView(centro, 14);

  // Capa satelital Esri
  L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri — Source: Esri, Earthstar Geographics, CNES/Airbus DS, USGS, USDA, AEX, GeoEye',
    maxZoom: 18,
  }).addTo(mapaVacantes);

  const vacantes = [
    {
      titulo: "Celador",
      lat: 9.55559786573379,
      lng: -73.33501448639316,
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

  vacantes.forEach((vacante) => {
    const urlGoogleMaps = `https://www.google.com/maps?q=${vacante.lat},${vacante.lng}`;
    L.marker([vacante.lat, vacante.lng])
      .addTo(mapaVacantes)
      .bindPopup(`
        <b>${vacante.titulo}</b><br>
        La Jagua de Ibirico<br>
        <a href="${urlGoogleMaps}" target="_blank" style="color: blue; text-decoration: underline;">Ver en Google Maps</a>
      `);
  });

  // === MAPA DE OPORTUNIDADES DE ESTUDIO ===
  const mapaEstudio = L.map('mapa-oportunidades', {
    scrollWheelZoom: false
  }).setView(centro, 14);

  // Capa satelital Esri
  L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri — Source: Esri, Earthstar Geographics, CNES/Airbus DS, USGS, USDA, AEX, GeoEye',
    maxZoom: 18,
  }).addTo(mapaEstudio);

  const lugares = [
    {
      nombre: "SENA subsede La Jagua de Ibirico",
      coordenadas: [9.560627800125882, -73.34501507183114],
      descripcion: "Centro de formación profesional del SENA en La Jagua de Ibirico.",
      enlace: "https://www.sena.edu.co/",
      imagen: "assets/img/logo-sena.png"
    },
  ];

  lugares.forEach(lugar => {
    const [lat, lng] = lugar.coordenadas;
    const urlGoogleMaps = `https://www.google.com/maps?q=${lat},${lng}`;

    const marcador = L.marker(lugar.coordenadas).addTo(mapaEstudio);
    marcador.bindPopup(`
      <strong>${lugar.nombre}</strong><br>
      <img src="${lugar.imagen}" width="100"><br>
      ${lugar.descripcion}<br>
      <a href="${lugar.enlace}" target="_blank">Ver más</a><br>
      <a href="${urlGoogleMaps}" target="_blank" style="color: blue; text-decoration: underline;">Ver en Google Maps</a>
    `);
  });
});

//graficos

//pueblos con más vacantes
new Chart(document.getElementById("graficoVacantesCiudades"), {
  type: "bar",
  data: {
    labels: ["La Jagua", "Aguachica", "Becerril", "La Paz", "Curumaní"],
    datasets: [{
      label: "Vacantes",
      data: [62, 20, 29, 20, 15],
      backgroundColor: "rgba(54, 162, 235, 0.6)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

//servicios más ofertados
new Chart(document.getElementById("graficoServiciosOfertados"), {
  type: "bar",
  data: {
    labels: ["Electricista", "Diseñador", "Desarrollador Web", "Celador", "Atendedor"],
    datasets: [{
      label: "Servicios",
      data: [15, 20, 25, 10, 18],
      backgroundColor: "rgba(54, 162, 235, 0.6)",
      borderWidth: 1
    }]
  },
  options: {
    responsive: true
  }
});

//calendario
  document.addEventListener('DOMContentLoaded', function () {
    const calendarioEl = document.getElementById('calendario');

    const calendar = new FullCalendar.Calendar(calendarioEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      },
      events: [
        {
          title: 'Feria de Empleo SENA',
          start: '2025-07-24',
          description: 'Pa que trabajes',
          url: 'https://agenciapublicadeempleo.sena.edu.co/',
        },
        {
          title: 'Charla: Hoja de Vida Moderna',
          start: '2025-07-22',
          description: 'Pa la hoja de vida',
          url: 'https://www.mintrabajo.gov.co/',
        },
        {
          title: 'Taller de habilidades',
          start: '2025-08-03',
          description: 'Pa que aprendas',
          url: '#'
        },
        {
          title: 'Dia de entregar el proyecto',
          start: '2025-10-09',
          descripcion: 'Pa entregarla',
          url: '#',
        }
      ],
      eventClick: function (info) {
        info.jsEvent.preventDefault(); 
        if (info.event.url) {
          window.open(info.event.url, '_blank');
        }
      },
      eventDidMount: function (info) {
        info.el.setAttribute('title', info.event.extendedProps.description);
      }
    });

    calendar.render();
  });

//Pa que los numeros de las estadisticas se muevan
  const counters = document.querySelectorAll(".counter");
  let countersStarted = false;

  function animateCounters() {
    if (countersStarted) return; // Solo ejecutar una vez
    counters.forEach(counter => {
      const target = +counter.getAttribute("data-target");
      let count = 0;
      const increment = target / 100; // Ajusta la velocidad aquí

      const updateCounter = () => {
        if (count < target) {
          count += increment;
          counter.textContent = Math.ceil(count);
          requestAnimationFrame(updateCounter);
        } else {
          counter.textContent = target;
        }
      };

      updateCounter();
    });
    countersStarted = true;
  }

  // Detectar si el contenedor está visible en el viewport
  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
    );
  }

  // Escucha de scroll
  window.addEventListener("scroll", () => {
    const statsSection = document.querySelector(".counter").parentElement.parentElement;
    if (isInViewport(statsSection)) {
      animateCounters();
    }
  });


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