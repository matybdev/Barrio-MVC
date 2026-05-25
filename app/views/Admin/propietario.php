<?php
// Incluir conexión a la DB

// Traer todos los guardias
$propietario = $db->query("SELECT * FROM propietarios ORDER BY id_propietario ASC")->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/app.css">
  <title>Barrio - Registro / Inicio</title>  
</head>


<body>
  <div class="container">
    <div class="sidebar">
      <button onclick="mostrarFormulario('crear')">CREAR</button>
      <a href="admin" style="text-decoration: none; color: inherit;">
      <button onclick="ocultarFormularios('')" >VOLVER</button>
      </a>
    </div>
  <div class="main-content">
        <!-- Tabla de guardias siempre visible -->
    <h2>Propietarios Registrados</h2>
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>ID</th>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Propiedad</th>
          <th >Editar</th>
          <th>Borrar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($propietario as $propietario): ?>
        <tr>
          <td><?= $propietario['id_propietario'] ?></td>
          <td><?= $propietario['DNI_PRO'] ?></td>
          <td><?= $propietario['nombre'] ?></td>
          <td><?= $propietario['apellido'] ?></td>
          <td><?= $propietario['propiedad'] ?></td>
          <td>
            <button type="button" onclick="cargarFormularioEditar(
              <?= $propietario['id_propietario'] ?>,
              '<?= $propietario['DNI_PRO'] ?>',
              '<?= $propietario['nombre'] ?>',
              '<?= $propietario['apellido'] ?>',
              '<?= $propietario['propiedad'] ?>',
            )" class="boton-tabla editar">Editar</button>
          </td>
          <td>
            <form action="borrar-propietario" method="POST" style="margin:0;">
              <input type="hidden" name="id_propietario" value="<?= $propietario['id_propietario'] ?>">
              <button type="submit" onclick="return confirm('¿Seguro que quieres borrar este propietario?')" class="boton-tabla borrar">Borrar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
   <!-- Formulario CREAR -->
    <div id="form-crear" class="form-container" style="display:none;">
      <h2>CREAR</h2>
      <form action="crear-propietario" method="POST">
        <input type="text" name="DNI_PRO" placeholder="DNI del Propietario" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="propiedad" placeholder="Propiedad" required>
        <button type="submit">Crear Propietario</button>
      </form>
    </div>

    <div id="form-editar" class="form-container" style="display:none;">
      <h2>EDITAR</h2>
      <form id="editar-form" action="editar-propietario" method="POST">
        <input type="hidden" name="id_propietario" id="editar-id">
        <input type="text" name="DNI_PRO" id="editar-dni" placeholder="DNI" required>
        <input type="text" name="nombre" id="editar-nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" id="editar-apellido" placeholder="Apellido" required>
        <input type="text" name="propiedad" id="editar-propiedad" placeholder="Propiedad" required>
        <button type="submit">Guardar Cambios</button>
      </form>
    </div>

    <!-- Formulario BORRAR -->
    <div id="form-borrar" class="form-container">
      <h2>BORRAR</h2>
      <input type="text" placeholder="Documento de Identidad">
      <button>Borrar Propietario</button>
    </div>
  </div>

  <script>
  function mostrarFormulario(tipo){
    document.getElementById('form-crear').style.display = 'none';
    document.getElementById('form-editar').style.display = 'none';

    if(tipo === 'crear'){
      document.getElementById('form-crear').style.display = 'block';
    } else if(tipo === 'editar'){
      document.getElementById('form-editar').style.display = 'block';
    }
  }

  function ocultarFormularios(){
    document.getElementById('form-crear').style.display = 'none';
    document.getElementById('form-editar').style.display = 'none';
  }

  function cargarFormularioEditar(id, dni, nombre, apellido, propiedad){
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-dni').value = dni;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    document.getElementById('editar-propiedad').value = propiedad;

    mostrarFormulario('editar');
  }
</script>
</body>
</html>