<?php
// public/index.php

// Cargar app.php (autoload + conexión DB)
require_once __DIR__ . '/../includes/app.php';

// Cargar el Router
require_once __DIR__ . '/../Router.php';

use Controllers\PaginaController;
use MVC\Router;

// Pasar la conexión $db al Router
$router = new Router($db);


// Rutas de LoginController
$router->get('index', ['LoginController', 'showLoginForm']);
$router->post('index', ['LoginController', 'showLoginForm']);

// Vista del Admin
$router->get('admin', ['LoginController', 'showPagina']);

//Guardia
$router->get('guardias', ['PaginaController', 'showGuardia']);
$router->post('crear-guardia', ['PaginaController', 'crear']);
$router->post('editar-guardia', ['PaginaController', 'editar']);

//Horario
$router->get('horario', ['HorarioController', 'showHorario']);
$router->post('editar-horario', ['HorarioController', 'editarHorario']);

//Propietario
$router->get('propietario', ['PropietarioController', 'showPropietario']);
$router->post('crear-propietario', ['PropietarioController', 'crear']);
$router->post('editar-propietario', ['PropietarioController', 'editar']);

// Vista del Guardia
$router->get('guardia', ['LoginController', 'showPagina']);

//Invitados
$router->get('invitados',['InvitadosController', 'showInvitado']);
$router->post('crear-invitado',['InvitadosController', 'crear']);
$router->post('editar-invitado',['InvitadosController', 'editar']);

//Visitas
$router->get('visitas',['visitasController', 'showVisita']);
$router->post('crear-visita',['visitasController', 'crear']);
$router->post('editar-visita',['visitasController', 'editar']);




// Ejecutar la ruta según la URL
$router->dispatch($_SERVER['REQUEST_URI']);

