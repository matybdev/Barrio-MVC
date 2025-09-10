<?php
// Incluir conexión a la DB

// Traer todos los guardias
$guardias = $db->query("SELECT * FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/app.css">
  <title>Barrio - Administración de Guardias</title>  
</head>
<body>
<div class="container">
  <div class="sidebar">
    <button onclick="mostrarFormulario('crear')">CREAR</button>
    <a href="admin"><button onclick="ocultarFormularios()">VOLVER</button></a>
  </div>

  <div class="main-content">
    <!-- Tabla de guardias siempre visible -->
    <h2>Guardias Registrados</h2>
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cédula</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Horario</th>
          <th>Estado</th>
          <th >Editar</th>
          <th>Borrar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($guardias as $guardia): ?>
        <tr>
          <td><?= $guardia['id'] ?></td>
          <td><?= $guardia['cedula'] ?></td>
          <td><?= $guardia['nombre'] ?></td>
          <td><?= $guardia['apellido'] ?></td>
          <td><?= $guardia['horario'] ?></td>
          <td><?= $guardia['estado'] ?></td>
          <td>
            <button type="button" onclick="cargarFormularioEditar(
              <?= $guardia['id'] ?>,
              '<?= $guardia['cedula'] ?>',
              '<?= $guardia['nombre'] ?>',
              '<?= $guardia['apellido'] ?>',
            )" class="boton-tabla editar">Editar</button>
          </td>
          <td>
            <form action="borrar-guardia" method="POST" style="margin:0;">
              <input type="hidden" name="id" value="<?= $guardia['id'] ?>">
              <button type="submit" onclick="return confirm('¿Seguro que quieres borrar este guardia?')" class="boton-tabla borrar">Borrar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Formulario CREAR -->
    <div id="form-crear" class="form-container" style="display:none;">
      <h2>CREAR</h2>
      <form action="crear-guardia" method="POST">
        <input type="text" name="cedula" placeholder="Número de Cedula" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="horario" placeholder="Horario" required>
        <button type="submit">Crear Guardia</button>
      </form>
    </div>

    <!-- Formulario EDITAR -->
    <div id="form-editar" class="form-container" style="display:none;">
      <h2>EDITAR</h2>
      <form id="editar-form" action="editar-guardia" method="POST">
        <input type="hidden" name="id" id="editar-id">
        <input type="text" name="cedula" id="editar-cedula" placeholder="Cédula" required>
        <input type="text" name="nombre" id="editar-nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" id="editar-apellido" placeholder="Apellido" required>
        <button type="submit">Guardar Cambios</button>
      </form>
    </div>

    <!-- Formulario BORRAR (alternativo, también se puede usar el botón de la tabla) -->
    <div id="form-borrar" class="form-container" style="display:none;">
      <h2>BORRAR</h2>
      <p>Para borrar, usa el botón "Borrar" en la tabla de guardias.</p>
    </div>
  </div>
</div>

<script>
  function mostrarFormulario(tipo) {
    document.querySelectorAll('.form-container').forEach(div => div.style.display='none');
    document.getElementById('form-' + tipo).style.display='block';
  }

  function ocultarFormularios() {
    document.querySelectorAll('.form-container').forEach(div => div.style.display='none');
  }

  function cargarFormularioEditar(id, cedula, nombre, apellido) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-cedula').value = cedula;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    mostrarFormulario('editar'); // Muestra solo el formulario de edición
  }
</script>
</body>
</html>
