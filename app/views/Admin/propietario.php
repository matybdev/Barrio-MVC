<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


 $propietarios = $db->query("SELECT * FROM propietarios ORDER BY id_propietario ASC")->fetch_all(MYSQLI_ASSOC);

?>

<main class="modulo-container animate-fade-in-up">
    
    <div class="cabecera-modulo">
        <div class="acciones-modulo-izq">
            <a href="admin" class="btn-secundario">VOLVER</a>
            <button onclick="abrirModal('crear')" class="btn-primario">CREAR</button>
        </div>
        <div class="titulo-modulo-centro">
            <h2>Propietarios Registrados</h2>
        </div>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Propiedad</th>
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($propietarios as $prop): ?>
                <tr>
                    <td><strong><?= $prop['id_propietario'] ?></strong></td>
                    <td><?= htmlspecialchars($prop['DNI_PRO']) ?></td>
                    <td><?= htmlspecialchars($prop['nombre']) ?></td>
                    <td><?= htmlspecialchars($prop['apellido']) ?></td>
                    <td><?= htmlspecialchars($prop['propiedad']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" onclick="cargarFormularioEditar(
                            <?= $prop['id_propietario'] ?>,
                            '<?= htmlspecialchars($prop['DNI_PRO']) ?>',
                            '<?= htmlspecialchars($prop['nombre']) ?>',
                            '<?= htmlspecialchars($prop['apellido']) ?>',
                            '<?= htmlspecialchars($prop['propiedad']) ?>'
                        )" class="boton-tabla editar">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <form action="borrar-propietario" method="POST" style="margin:0;">
                            <input type="hidden" name="id_propietario" value="<?= $prop['id_propietario'] ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar a este propietario?')" class="boton-tabla borrar">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<div id="modal-fondo" class="modal-overlay" style="display: none;">
    <div class="modal-box animate-fade-in-down">
        
        <div class="modal-header">
            <h3 id="modal-titulo">Crear / Editar</h3>
            <button type="button" class="btn-cerrar" onclick="cerrarModal()">X</button>
        </div>

        <form id="form-crear" action="crear-propietario" method="POST" class="formulario-modal" style="display:none;">
            <div class="input-group">
                <label for="crear-dni">DNI del Propietario</label>
                <input type="text" name="DNI_PRO" id="crear-dni" required>
            </div>
            <div class="input-group">
                <label for="crear-nombre">Nombre</label>
                <input type="text" name="nombre" id="crear-nombre" required>
            </div>
            <div class="input-group">
                <label for="crear-apellido">Apellido</label>
                <input type="text" name="apellido" id="crear-apellido" required>
            </div>
            <div class="input-group">
                <label for="crear-propiedad">Propiedad (Ej: Manzana A Casa 1)</label>
                <input type="text" name="propiedad" id="crear-propiedad" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Crear Propietario</button>
        </form>

        <form id="form-editar" action="editar-propietario" method="POST" class="formulario-modal" style="display:none;">
            <input type="hidden" name="id_propietario" id="editar-id">
            <div class="input-group">
                <label for="editar-dni">DNI</label>
                <input type="text" name="DNI_PRO" id="editar-dni" required>
            </div>
            <div class="input-group">
                <label for="editar-nombre">Nombre</label>
                <input type="text" name="nombre" id="editar-nombre" required>
            </div>
            <div class="input-group">
                <label for="editar-apellido">Apellido</label>
                <input type="text" name="apellido" id="editar-apellido" required>
            </div>
            <div class="input-group">
                <label for="editar-propiedad">Propiedad</label>
                <input type="text" name="propiedad" id="editar-propiedad" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Guardar Cambios</button>
        </form>

    </div>
</div>

<script>
  function abrirModal(tipo) {
    // Mostrar el fondo oscuro
    document.getElementById('modal-fondo').style.display = 'flex';
    
    // Ocultar ambos formularios por defecto
    document.getElementById('form-crear').style.display = 'none';
    document.getElementById('form-editar').style.display = 'none';

    // Mostrar el formulario que corresponde y ajustar el título
    if (tipo === 'crear') {
        document.getElementById('modal-titulo').innerText = 'Crear Nuevo Propietario';
        document.getElementById('form-crear').style.display = 'block';
    } else if (tipo === 'editar') {
        document.getElementById('modal-titulo').innerText = 'Editar Propietario';
        document.getElementById('form-editar').style.display = 'block';
    }
  }

  function cerrarModal() {
    document.getElementById('modal-fondo').style.display = 'none';
  }

  function cargarFormularioEditar(id, dni, nombre, apellido, propiedad) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-dni').value = dni;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    document.getElementById('editar-propiedad').value = propiedad;
    
    abrirModal('editar');
  }
</script>
</body>
</html>