<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%234285F4' d='M39.6 284.8l-13.4-13.4C11 260.2 11 239.9 26.2 224.8l230-230c10.5-10.5 27.6-10.5 38.1 0l230 230c15.2 15.2 4.5 41.8-17 41.8H480V448c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V352c0-17.7-14.3-32-32-32H224c-17.7 0-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-35.3 0-64-28.7-64-64V284.8H39.6z'/></svg>">
    <title>Barrio - Registro / Inicio</title>  
</head>
<body class="login">

<?php if (!empty($error)) : ?>
    <div class="alerta-error"><?= $error ?></div>
<?php endif; ?>

<h1 class="titulo-animado">Barrio</h1>

<div class="contenedor animate-fade-in-up">
    <div id="login">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="login.php">
            
            <div class="input-group">
                <label for="username">Tu Nombre de Usuario</label>
                <input type="text" id="username" name="username" placeholder="Ej: juanperez" required>
            </div>

            <div class="input-group">
                <label for="password">Tu Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-primario">Entrar</button>
        </form>
    </div>
</div>

</body>
</html>