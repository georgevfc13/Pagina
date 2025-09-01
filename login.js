document.getElementById("tipoLogin").onchange = function () {
  document.getElementById("loginNatural").style.display = this.value === "natural" ? "block" : "none";
  document.getElementById("loginJuridica").style.display = this.value === "juridica" ? "block" : "none";
};

// Mostrar campos según el tipo de usuario en REGISTRO
document.getElementById("tipoRegistro").onchange = function () {
  document.getElementById("registroNatural").style.display = this.value === "natural" ? "block" : "none";
  document.getElementById("registroJuridica").style.display = this.value === "juridica" ? "block" : "none";
};

// Giro de tarjeta y cambio de clase del body
document.getElementById("flipToRegister").onclick = function (e) {
  e.preventDefault();
  document.getElementById("card").classList.add("girar");
  document.body.classList.remove("centrado-vertical");
  document.body.classList.add("scroll-vertical");
};
document.getElementById("flipToLogin").onclick = function (e) {
  e.preventDefault();
  document.getElementById("card").classList.remove("girar");
  document.body.classList.remove("scroll-vertical");
  document.body.classList.add("centrado-vertical");
};

// Validación de login
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const tipo = document.getElementById("tipoLogin").value;
  let usuario, clave;

  if (tipo === "natural") {
    usuario = document.getElementById("usuario").value.trim();
    clave = document.getElementById("clave").value.trim();
  } else {
    usuario = document.getElementById("nitLogin").value.trim();
    clave = document.getElementById("claveJuridica").value.trim();
  }

  if (usuario === "" || clave === "") {
    alert("Por favor, complete todos los campos.");
    return;
  }

  alert("Inicio de sesión exitoso");
});

// Validación de registro
document.getElementById("registerForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const tipo = document.getElementById("tipoRegistro").value;
  let valido = true;
  let campos = [];

  if (tipo === "natural") {
    campos = [
      "cedula",
      "fechaNacimiento",
      "nombre",
      "apellido",
      "claveNatural",
      "confirmarClave"
    ];
  } else {
    campos = [
      "nombreEmpresa",
      "nit",
      "direccion",
      "contacto"
    ];
  }

  let mensaje = "";
  campos.forEach(id => {
    const input = document.getElementById(id);
    if (!input.value.trim()) {
      input.classList.add("error");
      valido = false;
    } else {
      input.classList.remove("error");
    }
  });

  // Validar contraseñas iguales solo para natural
  if (tipo === "natural") {
    const clave = document.getElementById("claveNatural").value;
    const confirmar = document.getElementById("confirmarClave").value;
    if (clave !== confirmar) {
      valido = false;
      mensaje = "Las contraseñas no coinciden";
      document.getElementById("claveNatural").classList.add("error");
      document.getElementById("confirmarClave").classList.add("error");
    }
  }

  if (!valido && mensaje === "") {
    mensaje = "Campos incompletos";
  }

  document.getElementById("mensajeError").innerText = mensaje;

  if (valido && mensaje === "") {
    document.getElementById("mensajeError").innerText = "";
    alert("Registro exitoso");
  }
});


