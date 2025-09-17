const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
  // alternar entre password y text
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  // cambiar el ícono
  this.querySelector("i").classList.toggle("bi-eye");
  this.querySelector("i").classList.toggle("bi-eye-slash");
});
