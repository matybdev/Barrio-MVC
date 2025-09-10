<?php
require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../Router.php';

use Controllers\LoginController;

// Instanciar controlador con $db de app.php
$controller = new LoginController($db);

// Delegar la lógica según el método HTTP
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->login(); // procesa login
} else {
    $controller->showLoginForm(); // muestra el formulario
}
