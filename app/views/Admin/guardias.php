<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$guardias = $db->query("SELECT * FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);


?>

<main class="modulo-container animate-fade-in-up">
    
    <div class="cabecera-modulo">
        <div class="acciones-modulo-izq">
            <a href="admin" class="btn-secundario">VOLVER</a>
            <button onclick="abrirModal('crear')" class="btn-primario">CREAR</button>
        </div>
        <div class="titulo-modulo-centro">
            <h2> Guardias Registrados</h2>
        </div>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Horario</th>
                    <th>Estado</th>
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guardias as $guardia): ?>
                <tr>
                    <td><strong><?= $guardia['id'] ?></strong></td>
                    <td><?= htmlspecialchars($guardia['cedula']) ?></td>
                    <td><?= htmlspecialchars($guardia['nombre']) ?></td>
                    <td><?= htmlspecialchars($guardia['apellido']) ?></td>
                    <td><span class="badge-horario"><?= htmlspecialchars($guardia['horario']) ?></span></td>
                    <td>
                        <span class="badge-estado <?= strtolower($guardia['estado']) == 'activo' ? 'activo' : 'inactivo' ?>">
                            <?= htmlspecialchars($guardia['estado']) ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" onclick="cargarFormularioEditar(
                            <?= $guardia['id'] ?>,
                            '<?= $guardia['cedula'] ?>',
                            '<?= $guardia['nombre'] ?>',
                            '<?= $guardia['apellido'] ?>',
                            '<?= $guardia['horario'] ?>'
                        )" class="boton-tabla editar">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <form action="borrar-guardia" method="POST" style="margin:0;">
                            <input type="hidden" name="id" value="<?= $guardia['id'] ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que querés borrar a <?= $guardia['nombre'] ?>?')" class="boton-tabla borrar">Borrar</button>
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
            <button type="button" class="btn-cerrar" onclick="cerrarModal()">✖</button>
        </div>

        <form id="form-crear" action="crear-guardia" method="POST" class="formulario-modal" style="display:none;">
            <div class="input-group">
                <label>Número de Cédula</label>
                <input type="text" name="cedula" required>
            </div>
            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="input-group">
                <label>Apellido</label>
                <input type="text" name="apellido" required>
            </div>
            <div class="input-group">
                <label>Horario</label>
                <input type="text" name="horario" placeholder="Ej: Mañana (06:00 - 14:00)" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem;">Guardar Guardia</button>
        </form>

        <form id="form-editar" action="editar-guardia" method="POST" class="formulario-modal" style="display:none;">
            <input type="hidden" name="id" id="editar-id">
            <div class="input-group">
                <label>Cédula</label>
                <input type="text" name="cedula" id="editar-cedula" required>
            </div>
            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="nombre" id="editar-nombre" required>
            </div>
            <div class="input-group">
                <label>Apellido</label>
                <input type="text" name="apellido" id="editar-apellido" required>
            </div>
            <div class="input-group">
                <label>Horario</label>
                <input type="text" name="horario" id="editar-horario" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem;">Actualizar Cambios</button>
        </form>

    </div>
</div>

<script>
  function abrirModal(tipo) {
    // Mostrar el fondo oscuro
    document.getElementById('modal-fondo').style.display = 'flex';
    
    // Ocultar ambos formularios por las dudas
    document.getElementById('form-crear').style.display = 'none';
    document.getElementById('form-editar').style.display = 'none';

    // Mostrar solo el que necesitamos y cambiar el título
    if (tipo === 'crear') {
        document.getElementById('modal-titulo').innerText = 'Crear Nuevo Guardia';
        document.getElementById('form-crear').style.display = 'block';
    } else {
        document.getElementById('modal-titulo').innerText = 'Editar Guardia';
        document.getElementById('form-editar').style.display = 'block';
    }
  }

  function cerrarModal() {
    document.getElementById('modal-fondo').style.display = 'none';
  }

  function cargarFormularioEditar(id, cedula, nombre, apellido, horario) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-cedula').value = cedula;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    document.getElementById('editar-horario').value = horario;
    
    abrirModal('editar');
  }
</script>
</body>
</html>