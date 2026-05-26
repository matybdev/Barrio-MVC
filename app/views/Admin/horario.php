<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$guardias = $db->query("SELECT id, cedula, horario, estado FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);




?>

<main class="modulo-container animate-fade-in-up">
    
    <div class="cabecera-modulo">
        <div class="acciones-modulo-izq">
            <a href="admin" class="btn-secundario">VOLVER</a>
        </div>
        <div class="titulo-modulo-centro">
            <h2>Horarios de Guardias</h2>
        </div>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Horario</th>
                    <th>Estado</th>
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guardias as $guardia): ?>
                <tr>
                    <td><?= htmlspecialchars($guardia['cedula']) ?></td>
                    <td><span class="badge-horario"><?= htmlspecialchars($guardia['horario']) ?></span></td>
                    <td>
                        <span class="badge-estado <?= ($guardia['estado'] == 'activo') ? 'activo' : 'inactivo' ?>">
                            <?= htmlspecialchars($guardia['estado']) ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" onclick="cargarFormularioEditar(
                            <?= $guardia['id'] ?>,
                            '<?= htmlspecialchars($guardia['horario']) ?>',
                            '<?= htmlspecialchars($guardia['estado']) ?>'
                        )" class="boton-tabla editar">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <form action="borrar-horario" method="POST" style="margin:0;">
                            <input type="hidden" name="id" value="<?= $guardia['id'] ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar el horario de este guardia?')" class="boton-tabla borrar">Borrar Horario</button>
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
            <h3>Editar Horario</h3>
            <button type="button" class="btn-cerrar" onclick="cerrarModal()">X</button>
        </div>

        <form id="form-editar" action="editar-horario" method="POST" class="formulario-modal">
            <input type="hidden" name="id" id="editar-id">
            
            <div class="input-group">
                <label for="editar-horario">Horario</label>
                <input type="text" name="horario" id="editar-horario" required>
            </div>
            
            <div class="input-group">
                <label for="editar-estado">Estado</label>
                <select name="estado" id="editar-estado" style="width: 100%; padding: 0.9rem 1rem; border: 2px solid #ddd; border-radius: 0.5rem; background-color: #fafafa; font-family: inherit;" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Guardar Cambios</button>
        </form>

    </div>
</div>

<script>
  function abrirModal() {
    document.getElementById('modal-fondo').style.display = 'flex';
  }

  function cerrarModal() {
    document.getElementById('modal-fondo').style.display = 'none';
  }

  function cargarFormularioEditar(id, horario, estado) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-horario').value = horario;
    document.getElementById('editar-estado').value = estado;
    
    abrirModal();
  }
</script>
</body>
</html>