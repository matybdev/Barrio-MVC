<?php
session_start();

// Verificar si hay usuario logueado y si es Admin
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: /login.php");
    exit;
}

if ($_SESSION['rol'] != "Admin") {
    header("Location: /guardia.php");
    exit;
}

?>

<main class="dashboard-centrado">
    <div class="dashboard-header animate-fade-in-down">
        <h1 class="titulo-gigante">Panel de Control</h1>
        <p class="subtitulo">Seleccioná un módulo para gestionar el barrio</p>
    </div>

    <div class="fila-tarjetas">
        <a href="horario" class="card animacion-flotar delay-1">
            <div class="card-icon"><i class="fa-solid fa-clock"></i></div>
            <h3>HORARIOS</h3>
        </a>
        
        <a href="guardias" class="card animacion-flotar delay-2">
            <div class="card-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <h3>GUARDIAS</h3>
        </a>
        
        <a href="propietario" class="card animacion-flotar delay-3">
            <div class="card-icon"><i class="fa-solid fa-house-user"></i></div>
            <h3>PROPIETARIOS</h3>
        </a>
    </div>
</main>
</body>
</html>