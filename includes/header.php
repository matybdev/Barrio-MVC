<?php
// Solo iniciamos sesión si no hay una activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%234285F4' d='M39.6 284.8l-13.4-13.4C11 260.2 11 239.9 26.2 224.8l230-230c10.5-10.5 27.6-10.5 38.1 0l230 230c15.2 15.2 4.5 41.8-17 41.8H480V448c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V352c0-17.7-14.3-32-32-32H224c-17.7 0-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-35.3 0-64-28.7-64-64V284.8H39.6z'/></svg>">
    
    <title>Panel - Barrio</title>
</head>
<body>
    <header class="navbar animate-fade-in-down">
        
        <div class="navbar-left">
    <?php 
    // Determinamos la ruta de inicio según el rol
    $rutaInicio = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Admin') ? 'admin' : 'guardia'; 
    ?>
    <a href="<?= $rutaInicio ?>" class="logo-link">
        <span class="logo"><i class="fa-solid fa-house-chimney"></i> Barrio</span>
    </a>
</div>
        
        <div class="navbar-center">
            <span class="badge-rol"><?= htmlspecialchars($_SESSION['rol'] ?? 'Invitado'); ?></span>
        </div>
        
        <div class="navbar-right">
            <span class="user-greeting">
                Hola, <strong><?= htmlspecialchars($_SESSION['usuario'] ?? 'Usuario'); ?></strong>
            </span>
            <form action="logout.php" method="post" class="form-logout">
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Salir
                </button>
            </form>
        </div>    
        
    </header>