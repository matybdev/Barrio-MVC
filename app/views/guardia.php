<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Opcional: Validar que el usuario tenga sesión y sea Guardia (o Admin)
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.php");
    exit;
}

// Incluimos el header unificado (ya contiene los estilos y FontAwesome)
include 'header.php'; 
?>

<main class="dashboard-centrado animate-fade-in-up">
    
    <div class="dashboard-header">
        <h1 class="titulo-gigante">Panel de Guardia</h1>
        <p class="subtitulo">Gestión de accesos y visitas del barrio</p>
    </div>

    <div class="fila-tarjetas">
        <a href="invitados" class="card animacion-flotar delay-1">
            <div class="card-icon"><i class="fa-solid fa-address-book"></i></div>
            <h3>INVITADOS</h3>
        </a>
        
        <a href="visitas" class="card animacion-flotar delay-2">
            <div class="card-icon"><i class="fa-solid fa-car-side"></i></div>
            <h3>VISITAS</h3>
        </a>
    </div>

</main>

</body>
</html>