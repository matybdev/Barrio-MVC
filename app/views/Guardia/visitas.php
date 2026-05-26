<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$visitas = $db->query("SELECT * FROM visitas ORDER BY id_visita ASC")->fetch_all(MYSQLI_ASSOC);


?>

<main class="modulo-container animate-fade-in-up">
    
    <div class="cabecera-modulo">
        <div class="acciones-modulo-izq">
            <a href="guardia" class="btn-secundario">VOLVER</a>
            <button onclick="abrirModal('crear')" class="btn-primario">CREAR VISITA</button>
        </div>
        <div class="titulo-modulo-centro">
            <h2>Visitas Registradas</h2>
        </div>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th style="text-align: center;">Personas</th>
                    <th>Patente</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th>Propiedad Destino</th>
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitas as $visita): ?>
                <tr>
                    <td><strong><?= $visita['id_visita'] ?></strong></td>
                    <td><?= htmlspecialchars($visita['DNI_VIS']) ?></td>
                    <td style="text-align: center;"><span class="badge-horario"><?= htmlspecialchars($visita['cantidad_personas']) ?></span></td>
                    <td><?= htmlspecialchars($visita['patente'] ?: 'Sin vehículo') ?></td>
                    <td><?= htmlspecialchars($visita['hora_entrada']) ?></td>
                    <td>
                        <?php if (!empty($visita['hora_salida'])): ?>
                            <?= htmlspecialchars($visita['hora_salida']) ?>
                        <?php else: ?>
                            <span class="badge-estado activo">En el barrio</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($visita['propiedad_destino']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" onclick="cargarFormularioEditar(
                            <?= $visita['id_visita'] ?>,
                            '<?= htmlspecialchars($visita['DNI_VIS']) ?>',
                            <?= $visita['cantidad_personas'] ?>,
                            '<?= htmlspecialchars($visita['patente']) ?>',
                            '<?= htmlspecialchars($visita['hora_entrada']) ?>',
                            '<?= htmlspecialchars($visita['hora_salida']) ?>',
                            '<?= htmlspecialchars($visita['propiedad_destino']) ?>'
                        )" class="boton-tabla editar">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <form action="borrar-visita" method="POST" style="margin:0;">
                            <input type="hidden" name="id_visita" value="<?= $visita['id_visita'] ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar este registro de visita?')" class="boton-tabla borrar">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<div id="modal-fondo" class="modal-overlay" style="display: none;">
    <div class="modal-box animate-fade-in-down" style="max-width: 500px;"> <div class="modal-header">
            <h3 id="modal-titulo">Registrar Visita</h3>
            <button type="button" class="btn-cerrar" onclick="cerrarModal()">X</button>
        </div>

        <form id="form-crear" action="crear-visita" method="POST" class="formulario-modal" style="display:none;">
            <div class="input-group">
                <label for="crear-dni">DNI</label>
                <input type="text" name="DNI_VIS" id="crear-dni" required>
            </div>
            <div class="input-group">
                <label for="crear-cantidad">Cantidad de Personas</label>
                <input type="number" name="cantidad_personas" id="crear-cantidad" min="1" required>
            </div>
            <div class="input-group">
                <label for="crear-patente">Patente / Dominio</label>
                <input type="text" name="patente" id="crear-patente" placeholder="Ej: AF123JK o N/A" required>
            </div>
            <div class="input-group">
                <label for="crear-entrada">Horario de Entrada</label>
                <input type="datetime-local" name="hora_entrada" id="crear-entrada" required>
            </div>
            <div class="input-group">
                <label for="crear-salida">Horario de Salida (Opcional)</label>
                <input type="datetime-local" name="hora_salida" id="crear-salida">
            </div>
            <div class="input-group">
                <label for="crear-destino">Propiedad de Destino</label>
                <input type="text" name="propiedad_destino" id="crear-destino" placeholder="Ej: Manzana F Casa 8" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Registrar Ingreso</button>
        </form>

        <form id="form-editar" action="editar-visita" method="POST" class="formulario-modal" style="display:none;">
            <input type="hidden" name="id_visita" id="editar-id">
            
            <div class="input-group">
                <label for="editar-DNI_VIS">DNI</label>
                <input type="text" name="DNI_VIS" id="editar-DNI_VIS" required>
            </div>
            <div class="input-group">
                <label for="editar-cantidad_personas">Cantidad de Personas</label>
                <input type="number" name="cantidad_personas" id="editar-cantidad_personas" min="1" required>
            </div>
            <div class="input-group">
                <label for="editar-patente">Patente</label>
                <input type="text" name="patente" id="editar-patente" required>
            </div>
            <div class="input-group">
                <label for="editar-hora_entrada">Horario de Entrada</label>
                <input type="datetime-local" name="hora_entrada" id="editar-hora_entrada" required>
            </div>
            <div class="input-group">
                <label for="editar-hora_salida">Horario de Salida</label>
                <input type="datetime-local" name="hora_salida" id="editar-hora_salida">
            </div>
            <div class="input-group">
                <label for="editar-propiedad_destino">Propiedad de Destino</label>
                <input type="text" name="propiedad_destino" id="editar-propiedad_destino" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Guardar Cambios</button>
        </form>

    </div>
</div>

<script>
  function abrirModal(tipo) {
    document.getElementById('modal-fondo').style.display = 'flex';
    document.getElementById('form-crear').style.display = 'none';
    document.getElementById('form-editar').style.display = 'none';

    if (tipo === 'crear') {
        document.getElementById('modal-titulo').innerText = 'Registrar Nueva Visita';
        document.getElementById('form-crear').style.display = 'block';
        
        // Autocompletar la fecha y hora actual en el formulario de creación si está vacío
        const entradaInput = document.getElementById('crear-entrada');
        if(!entradaInput.value) {
            const ahora = new Date();
            ahora.setMinutes(ahora.getMinutes() - ahora.getTimezoneOffset());
            entradaInput.value = ahora.toISOString().slice(0, 16);
        }
    } else if (tipo === 'editar') {
        document.getElementById('modal-titulo').innerText = 'Editar Registro de Visita';
        document.getElementById('form-editar').style.display = 'block';
    }
  }

  function cerrarModal() {
    document.getElementById('modal-fondo').style.display = 'none';
  }

  function cargarFormularioEditar(id, dni, cantidad, patente, entrada, salida, destino) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-DNI_VIS').value = dni;
    document.getElementById('editar-cantidad_personas').value = cantidad;
    document.getElementById('editar-patente').value = patente;
    
    // Formatear fechas para los inputs datetime-local (YYYY-MM-DDTHH:MM)
    if(entrada) {
        document.getElementById('editar-hora_entrada').value = entrada.replace(" ", "T").slice(0, 16);
    }
    if(salida) {
        document.getElementById('editar-hora_salida').value = salida.replace(" ", "T").slice(0, 16);
    } else {
        document.getElementById('editar-hora_salida').value = "";
    }
    
    document.getElementById('editar-propiedad_destino').value = destino;
    
    abrirModal('editar');
  }
</script>
</body>
</html>