<?php
session_start(); // asegurarte de iniciar la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador - Barrio</title>
    <link rel="stylesheet" href="assets/css/app.css">

</head>
<body>
    <header>
        <div class="navbar-left">
            <a href="admin" style="text-decoration: none; color: inherit;">
                <span class="logo">Barrio</span>
            </a>
        </div>
        
        <div class="navbar-center">
            <span class="title"><?php echo $_SESSION['rol']; ?></span>
        </div>
        
        <div class="navbar-right">
            <span class="user">
            Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?> (<?php echo $_SESSION['rol']; ?>)
            </span>
            <!-- Botón de cerrar sesión -->
            <form action="logout.php" method="post" style="display:inline;">
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        </div>    
    </header>