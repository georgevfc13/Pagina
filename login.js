// login.js
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault(); // Evita recargar la página

  const usuario = document.getElementById("usuario").value.trim();
  const clave = document.getElementById("clave").value.trim();

  if (usuario === "" || clave === "") {
    alert("Por favor, complete todos los campos.");
    return;
  }

  // Aquí puedes hacer lógica adicional, por ejemplo enviar a otra página
  alert("Inicio de sesión exitoso");
});