
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Barrio - Registro / Inicio</title>  
</head>
<body class="login">

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<h1>Barrio</h1>

<div class="contenedor">
    <div id="login">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="login.php"">

            <label for="username">Tu Nombre de Usuario</label>
            <input type="text" name="username" placeholder="Nombre de Usuario" required>

            <label for="password">Tu Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</div>

</body>
</html>
