<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir conexión a la DB
// $invitados = $db->query("SELECT * FROM invitados ORDER BY id_invitado ASC")->fetch_all(MYSQLI_ASSOC);

// Datos de prueba temporales para visualizar el diseño
$invitados = [
    ['id_invitado' => 1, 'DNI_INV' => '32456789', 'nombre' => 'María', 'apellido' => 'López'],
    ['id_invitado' => 2, 'DNI_INV' => '41234567', 'nombre' => 'Esteban', 'apellido' => 'Quito']
];

include 'header.php'; 
?>

<main class="modulo-container animate-fade-in-up">
    
    <div class="cabecera-modulo">
        <div class="acciones-modulo-izq">
            <a href="guardia" class="btn-secundario">VOLVER</a>
            <button onclick="abrirModal('crear')" class="btn-primario">CREAR INVITADO</button>
        </div>
        <div class="titulo-modulo-centro">
            <h2>Invitados Registrados</h2>
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
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invitados as $invitado): ?>
                <tr>
                    <td><strong><?= $invitado['id_invitado'] ?></strong></td>
                    <td><?= htmlspecialchars($invitado['DNI_INV']) ?></td>
                    <td><?= htmlspecialchars($invitado['nombre']) ?></td>
                    <td><?= htmlspecialchars($invitado['apellido']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" onclick="cargarFormularioEditar(
                            <?= $invitado['id_invitado'] ?>,
                            '<?= htmlspecialchars($invitado['DNI_INV']) ?>',
                            '<?= htmlspecialchars($invitado['nombre']) ?>',
                            '<?= htmlspecialchars($invitado['apellido']) ?>'
                        )" class="boton-tabla editar">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <form action="borrar-invitado" method="POST" style="margin:0;">
                            <input type="hidden" name="id_invitado" value="<?= $invitado['id_invitado'] ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar a este invitado?')" class="boton-tabla borrar">Borrar</button>
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

        <form id="form-crear" action="crear-invitado" method="POST" class="formulario-modal" style="display:none;">
            <div class="input-group">
                <label for="crear-dni">DNI del Invitado</label>
                <input type="text" name="DNI_INV" id="crear-dni" required>
            </div>
            <div class="input-group">
                <label for="crear-nombre">Nombre</label>
                <input type="text" name="nombre" id="crear-nombre" required>
            </div>
            <div class="input-group">
                <label for="crear-apellido">Apellido</label>
                <input type="text" name="apellido" id="crear-apellido" required>
            </div>
            <button type="submit" class="btn-primario" style="margin-top: 1rem; width: 100%;">Crear Invitado</button>
        </form>

        <form id="form-editar" action="editar-invitado" method="POST" class="formulario-modal" style="display:none;">
            <input type="hidden" name="id_invitado" id="editar-id">
            <div class="input-group">
                <label for="editar-DNI_INV">DNI</label>
                <input type="text" name="DNI_INV" id="editar-DNI_INV" required>
            </div>
            <div class="input-group">
                <label for="editar-nombre">Nombre</label>
                <input type="text" name="nombre" id="editar-nombre" required>
            </div>
            <div class="input-group">
                <label for="editar-apellido">Apellido</label>
                <input type="text" name="apellido" id="editar-apellido" required>
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
        document.getElementById('modal-titulo').innerText = 'Crear Nuevo Invitado';
        document.getElementById('form-crear').style.display = 'block';
    } else if (tipo === 'editar') {
        document.getElementById('modal-titulo').innerText = 'Editar Invitado';
        document.getElementById('form-editar').style.display = 'block';
    }
  }

  function cerrarModal() {
    document.getElementById('modal-fondo').style.display = 'none';
  }

  function cargarFormularioEditar(id, dni, nombre, apellido) {
    document.getElementById('editar-id').value = id;
    document.getElementById('editar-DNI_INV').value = dni;
    document.getElementById('editar-nombre').value = nombre;
    document.getElementById('editar-apellido').value = apellido;
    
    abrirModal('editar');
  }
</script>
</body>
</html>