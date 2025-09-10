<?php
// Traer todos los invitados
$invitados = $db->query("SELECT * FROM invitados ORDER BY id_invitado ASC")->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
  <div class="sidebar">
    <button onclick="mostrarFormulario('crear')">CREAR</button>
    <a href="admin"><button onclick="ocultarFormularios()">VOLVER</button></a>
  </div>

  <div class="main-content">
    <h2>Invitados Registrados</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invitados as $invitado): ?>
            <tr>
                <td><?= $invitado['id_invitado'] ?></td>
                <td><?= $invitado['DNI_INV'] ?></td>
                <td><?= $invitado['nombre'] ?></td>
                <td><?= $invitado['apellido'] ?></td>
                <td>
                    <button type="button" onclick="cargarFormularioEditar(
                        <?= $invitado['id_invitado'] ?>,
                        '<?= $invitado['DNI_INV'] ?>',
                        '<?= $invitado['nombre'] ?>',
                        '<?= $invitado['apellido'] ?>'
                    )" class="boton-tabla editar">Editar</button>
                </td>
                <td>
                    <form action="borrar-invitado" method="POST" style="margin:0;">
                        <input type="hidden" name="id" value="<?= $invitado['id_invitado'] ?>">
                        <button type="submit" onclick="return confirm('¿Seguro que quieres borrar este invitado?')" class="boton-tabla borrar">Borrar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulario CREAR -->
    <div id="form-crear" class="form-container" style="display:none;">
        <h2>CREAR INVITADO</h2>
        <form action="crear-invitado" method="POST">
            <input type="text" name="DNI_INV" placeholder="DNI" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <button type="submit">Crear Invitado</button>
        </form>
    </div>

    <!-- Formulario EDITAR -->
    <div id="form-editar" class="form-container" style="display:none;">
        <h2>EDITAR INVITADO</h2>
        <form id="editar-form" action="editar-invitado" method="POST">
            <input type="hidden" name="id_invitado" id="editar-id">
            <input type="text" name="DNI_INV" id="editar-DNI_INV" placeholder="DNI" required>
            <input type="text" name="nombre" id="editar-nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" id="editar-apellido" placeholder="Apellido" required>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
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

function cargarFormularioEditar(id, dni, nombre, apellido) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-DNI_INV').value = dni;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    mostrarFormulario('editar');
}
</script>
