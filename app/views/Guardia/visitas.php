<?php
// Incluir conexión a la DB

// Traer todos los guardias
$visitas = $db->query("SELECT * FROM visitas ORDER BY id_visita ASC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/app.css">
  <title>Barrio - Administración de Visitas</title>  
</head>
<body>
<div class="container">
  <div class="sidebar">
    <button onclick="mostrarFormulario('crear')">CREAR</button>
    <a href="admin"><button onclick="ocultarFormularios()">VOLVER</button></a>
  </div>

  <div class="main-content">
    <!-- Tabla de visitas -->
    <h2>Visitas Registradas</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>CANTIDAD DE PERSONAS</th>
                <th>PATENTE</th>
                <th>HORA ENTRADA</th>
                <th>HORA SALIDA</th>
                <th>PROPIEDAD DE DESTINO</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitas as $visita): ?>
            <tr>
                <td><?= $visita['id_visita'] ?></td>
                <td><?= $visita['DNI_VIS'] ?></td>
                <td><?= $visita['cantidad_personas'] ?></td>
                <td><?= $visita['patente'] ?></td>
                <td><?= $visita['hora_entrada'] ?></td>
                <td><?= $visita['hora_salida'] ?></td>
                <td><?= $visita['propiedad_destino'] ?></td>
                <td>
                    <button type="button" onclick="cargarFormularioEditar(
                        <?= $visita['id_visita'] ?>,
                        '<?= $visita['DNI_VIS'] ?>',
                        '<?= $visita['cantidad_personas'] ?>',
                        '<?= $visita['patente'] ?>',
                        '<?= $visita['hora_entrada'] ?>',
                        '<?= $visita['hora_salida'] ?>',
                        '<?= $visita['propiedad_destino'] ?>'
                    )" class="boton-tabla editar">Editar</button>
                </td>
                <td>
                    <form action="borrar-visita" method="POST" style="margin:0;">
                        <input type="hidden" name="id_visita" value="<?= $visita['id_visita'] ?>">
                        <button type="submit" onclick="return confirm('¿Seguro que quieres borrar este registro de visita?')" class="boton-tabla borrar">Borrar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulario CREAR -->
    <div id="form-crear" class="form-container" style="display:none;">
        <h2>CREAR VISITA</h2>
        <form action="crear-visita" method="POST">
            <input type="text" name="DNI_VIS" placeholder="DNI" required>
            <input type="number" name="cantidad_personas" placeholder="Cantidad de Personas" required>
            <input type="text" name="patente" placeholder="Patente" required>
            <input type="datetime-local" name="hora_entrada" placeholder="Horario de entrada" required>
            <input type="datetime-local" name="hora_salida" placeholder="Horario de salida">
            <input type="text" name="propiedad_destino" placeholder="Propiedad de destino" required>
            <button type="submit">Crear Visita</button>
        </form>
    </div>

    <!-- Formulario EDITAR -->
    <div id="form-editar" class="form-container" style="display:none;">
        <h2>EDITAR VISITA</h2>
        <form id="editar-form" action="editar-visita" method="POST">
            <input type="hidden" name="id_visita" id="editar-id">
            <input type="text" name="DNI_VIS" id="editar-DNI_VIS" placeholder="DNI" required>
            <input type="number" name="cantidad_personas" id="editar-cantidad_personas" placeholder="Cantidad de Personas" required>
            <input type="text" name="patente" id="editar-patente" placeholder="Patente" required>
            <input type="datetime-local" name="hora_entrada" id="editar-hora_entrada" placeholder="Horario de entrada" required>
            <input type="datetime-local" name="hora_salida" id="editar-hora_salida" placeholder="Horario de salida">
            <input type="text" name="propiedad_destino" id="editar-propiedad_destino" placeholder="Propiedad de destino" required>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
function mostrarFormulario(tipo) {
    document.querySelectorAll('.form-container').forEach(div => div.style.display = 'none');
    document.getElementById('form-' + tipo).style.display = 'block';
}

function ocultarFormularios() {
    document.querySelectorAll('.form-container').forEach(div => div.style.display = 'none');
}

function cargarFormularioEditar(id, DNI, cantidad, patente, entrada, salida, destino) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-DNI_VIS').value = DNI;
    document.getElementById('editar-cantidad_personas').value = cantidad;
    document.getElementById('editar-patente').value = patente;
    document.getElementById('editar-hora_entrada').value = entrada;
    document.getElementById('editar-hora_salida').value = salida;
    document.getElementById('editar-propiedad_destino').value = destino;
    mostrarFormulario('editar');
}
</script>
