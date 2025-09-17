<?php
session_start();
session_unset();       // Limpia todas las variables
session_destroy();     // Destruye la sesión

// Creamos una sesión nueva como visitante
session_start();
$_SESSION['tipo'] = "invitado";

// Redirigimos al home
header("Location: home.php");
exit();
?>
