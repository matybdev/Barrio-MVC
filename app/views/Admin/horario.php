<?php
// Incluye la conexión a la base de datos

// Traer todos los guardias
$guardias = $db->query("SELECT id, cedula, horario, estado FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/app.css">
  <title>Horarios de Guardias</title>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <a href="admin"><button>VOLVER</button></a>
    </div>

    <div class="main-content">
      <h2>Horarios de Guardias</h2>

      <!-- Tabla de guardias -->
      <table border="1" cellpadding="5">
        <thead>
          <tr>
            <th>Cédula</th>
            <th>Horario</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Borrar</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($guardias as $guardia): ?>
          <tr>
            <td><?= $guardia['cedula'] ?></td>
            <td><?= $guardia['horario'] ?></td>
            <td><?= $guardia['estado'] ?></td>
            <td>
              <button type="button" onclick="cargarFormularioEditar(
                <?= $guardia['id'] ?>,
                '<?= $guardia['horario'] ?>',
                '<?= $guardia['estado'] ?>'
              )" class="boton-tabla editar">Editar</button>
            </td>
            <td>
              <form action="borrar-horario" method="POST" style="margin:0;">
                <input type="hidden" name="id" value="<?= $guardia['id'] ?>">
                <button type="submit" onclick="return confirm('¿Seguro que quieres borrar el horario de este guardia?')" class="boton-tabla borrar">Borrar Horario</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Formulario EDITAR -->
      <div id="form-editar" class="form-container" style="display:none; margin-top:20px;">
        <h2>Editar Horario</h2>
        <form id="editar-form" action="editar-horario" method="POST">
          <input type="hidden" name="id" id="editar-id">
          <input type="text" name="horario" id="editar-horario" placeholder="Horario" required>
          <select name="estado" id="editar-estado" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
          <button type="submit">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>

<script>
  function cargarFormularioEditar(id, horario, estado){
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-horario').value = horario;
    document.getElementById('editar-estado').value = estado;
    document.getElementById('form-editar').style.display = 'block'; // Muestra el formulario
  }
</script>
</body>
</html>
