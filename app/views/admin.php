<?php
session_start();

// Verificar si hay usuario logueado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    // No hay sesión, redirigir al login
    header("Location: /login.php");
    exit;
}

// Verificar que sea Admin
// Supongamos que en la DB rol Admin = 1
if ($_SESSION['rol'] != "Admin") {
    // No es admin, redirigir a guardia.php o mostrar mensaje
    header("Location: /guardia.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Barrio - Registro / Inicio</title>  
</head>
  <!-- Cuerpo -->
  <main >
    <a href="horario" style="text-decoration: none; color: inherit;">
    <div class="card">HORARIOS</div>
    </a>
    <a href="guardias" style="text-decoration: none; color: inherit;">
        <div class="card">GUARDIAS</div>
    </a>
    <a href="propietario" style="text-decoration: none; color: inherit;">
    <div class="card">PROPIETARIOS</div>
    </a>
  </main>
</body>
</html>


