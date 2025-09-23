<?php
// Redirecciona a la vista principal (home.html)
header('Location: views/home.php');

// index.php o layout principal
$router->get('/perfil-juridico', 'PerfilJuridicoController@perfil');
exit();