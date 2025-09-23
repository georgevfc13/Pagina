<?php
// Redirecciona a la vista principal (home.html)
header('Location: views/home.php');

// index.php o layout principal

// luego incluye el navbar
require 'views/partials/navbar.php';

exit();