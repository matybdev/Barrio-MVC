<?php
// public/index.php

// Cargar app.php (autoload + conexión DB)
require_once __DIR__ . '/../includes/app.php';

// Cargar el Router
require_once __DIR__ . '/../Router.php';

use MVC\Router;

// Pasar la conexión $db al Router
$router = new Router($db);


// Rutas de LoginController
$router->get('index', ['LoginController', 'showLoginForm']);
$router->post('index', ['LoginController', 'showLoginForm']);

// Vista del Admin
$router->get('admin', ['LoginController', 'showPagina']);

// Guardia (Administración por parte del Admin)
$router->get('guardias', ['PaginaController', 'showGuardia']);
$router->post('crear-guardia', ['PaginaController', 'crear']);
$router->post('editar-guardia', ['PaginaController', 'editar']);
$router->post('borrar-guardia', ['PaginaController', 'borrar']);

// Horario
$router->get('horario', ['HorarioController', 'showHorario']);
$router->post('editar-horario', ['HorarioController', 'editarHorario']);
$router->post('borrar-horario', ['HorarioController', 'borrarHorario']);

// Propietario
$router->get('propietario', ['PropietarioController', 'showPropietario']);
$router->post('crear-propietario', ['PropietarioController', 'crear']);
$router->post('editar-propietario', ['PropietarioController', 'editar']);
$router->post('borrar-propietario', ['PropietarioController', 'borrar']);

// Vista del Guardia (Panel operativo principal)
$router->get('guardia', ['LoginController', 'showPagina']);

// Invitados
$router->get('invitados', ['InvitadosController', 'showInvitado']);
$router->post('crear-invitado', ['InvitadosController', 'crear']);
$router->post('editar-invitado', ['InvitadosController', 'editar']);
$router->post('borrar-invitado', ['InvitadosController', 'borrar']);

// Visitas
$router->get('visitas', ['VisitasController', 'showVisita']);
$router->post('crear-visita', ['VisitasController', 'crear']);
$router->post('editar-visita', ['VisitasController', 'editar']);
$router->post('borrar-visita', ['VisitasController', 'borrar']);


// Ejecutar la ruta según la URL
$router->dispatch($_SERVER['REQUEST_URI']);