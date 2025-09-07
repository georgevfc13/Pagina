<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../controllers/AuthController.php';
    if (isset($_POST['registerTipo'])) {
        AuthController::register();
    } else if (isset($_POST['loginTipo'])) {
        AuthController::login();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acceso - GDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/styles/login.css" />
</head>
<body>
    <?php $activePage = 'login'; include 'partials/navbar.php'; ?>
    <main class="main-login">
        <div class="login-flip-container">
            <div class="login-flipper" id="flipper">
                <!-- Login -->
                <div class="login-front">
                    <h2 class="login-title">Iniciar Sesión</h2>
                    <?php if (isset($_GET['error'])): ?>
                    <div class="error-text">Usuario o contraseña incorrectos</div>
                    <?php endif; ?>
                    <?php if (isset($_GET['registro'])): ?>
                    <div class="text-success text-center mb-2">Registro exitoso, ahora puedes iniciar sesión</div>
                    <?php endif; ?>
                    <form id="loginForm" method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label for="loginTipo" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="loginTipo" name="loginTipo">
                                <option value="natural">Persona Natural</option>
                                <option value="juridica">Persona Jurídica</option>
                            </select>
                        </div>
                        <div id="loginNatural">
                            <div class="mb-3">
                                <label for="loginCedula" class="form-label">Número de Cédula</label>
                                <input type="text" class="form-control" id="loginCedula" name="loginCedula" />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="loginPassword" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword" />
                                <span class="toggle-password" onclick="togglePassword('loginPassword')">&#128065;</span>
                            </div>
                        </div>
                        <div id="loginJuridica" style="display:none;">
                            <div class="mb-3">
                                <label for="loginCorreo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="loginCorreo" name="loginCorreo" />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="loginPasswordJuridica" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="loginPasswordJuridica" name="loginPasswordJuridica" />
                                <span class="toggle-password" onclick="togglePassword('loginPasswordJuridica')">&#128065;</span>
                            </div>
                        </div>
                        <div class="mb-2 text-end">
                            <a href="#" class="btn-link">Olvidé mi contraseña</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Iniciar Sesión</button>
                    </form>
                    <div class="mt-3 text-center">
                        <button class="btn-link" id="showRegister" type="button">¿No tienes cuenta? Regístrate</button>
                    </div>
                </div>
                <!-- Registro -->
                <div class="login-back">
                    <h2 class="login-title">Registro</h2>
                    <form id="registerForm" method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label for="registerTipo" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="registerTipo" name="registerTipo">
                                <option value="natural">Persona Natural</option>
                                <option value="juridica">Persona Jurídica</option>
                            </select>
                        </div>
                        <div id="registerNatural">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" />
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" />
                            </div>
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Número de Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" />
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" />
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género (opcional)</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="">Selecciona</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contacto</label>
                                <select class="form-select mb-2" id="contactoTipo" name="contactoTipo">
                                    <option value="correo">Correo electrónico</option>
                                    <option value="telefono">Número de teléfono</option>
                                </select>
                                <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Correo o teléfono" />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="passwordNatural" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="passwordNatural" name="passwordNatural" />
                                <span class="toggle-password" onclick="togglePassword('passwordNatural')">&#128065;</span>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="aceptaTerminosNatural" name="aceptaTerminosNatural" />
                                <label class="form-check-label" for="aceptaTerminosNatural">
                                    Acepto los términos y condiciones y la política de privacidad
                                </label>
                            </div>
                        </div>
                        <div id="registerJuridica" style="display:none;">
                            <div class="mb-3">
                                <label for="razonSocial" class="form-label">Razón social</label>
                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" />
                            </div>
                            <div class="mb-3">
                                <label for="correoJuridica" class="form-label">Correo electrónico de contacto</label>
                                <input type="email" class="form-control" id="correoJuridica" name="correoJuridica" />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="passwordJuridica" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="passwordJuridica" name="passwordJuridica" />
                                <span class="toggle-password" onclick="togglePassword('passwordJuridica')">&#128065;</span>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="aceptaTerminosJuridica" name="aceptaTerminosJuridica" />
                                <label class="form-check-label" for="aceptaTerminosJuridica">
                                    Acepto los términos y condiciones y la política de privacidad
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Registrarse</button>
                    </form>
                    <div class="mt-3 text-center">
                        <button class="btn-link" id="showLogin" type="button">¿Ya tienes cuenta? Inicia sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer style="width:100%;margin-top:auto;">
        <?php include 'partials/footer.php'; ?>
    </footer>
    <script>
        // Giro vertical
        document.getElementById('showRegister').onclick = function() {
            document.getElementById('flipper').classList.add('flipped');
        };
        document.getElementById('showLogin').onclick = function() {
            document.getElementById('flipper').classList.remove('flipped');
        };
        document.getElementById('loginTipo').onchange = function() {
            document.getElementById('loginNatural').style.display = this.value === 'natural' ? 'block' : 'none';
            document.getElementById('loginJuridica').style.display = this.value === 'juridica' ? 'block' : 'none';
        };
        document.getElementById('registerTipo').onchange = function() {
            document.getElementById('registerNatural').style.display = this.value === 'natural' ? 'block' : 'none';
            document.getElementById('registerJuridica').style.display = this.value === 'juridica' ? 'block' : 'none';
        };
        function togglePassword(id) {
            var input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
