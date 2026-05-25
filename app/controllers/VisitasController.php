<?php

namespace Controllers;
use MVC\Router;


class VisitasController{
     public function showVisita(){
         // Correct path for the header file
        include __DIR__ . '/../../includes/header.php';
        require __DIR__ . '/../../includes/app.php';
        // Path for the view file
        include __DIR__ . '/../views/Guardia/visitas.php';
    }

//-------------------------------------------------------------------------    
  public function crear() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $dni      = $_POST['DNI_VIS'] ?? null;
        $cantidad = $_POST['cantidad_personas'] ?? null;
        $patente  = $_POST['patente'] ?? null;
        $entrada  = $_POST['hora_entrada'] ?? null;
        $salida = !empty($_POST['hora_salida']) ? $_POST['hora_salida'] : null;
        $destino  = $_POST['propiedad_destino'] ?? null;

        // Validar campos obligatorios
        if (!$dni || !$cantidad || !$patente || !$entrada || !$destino) {
            echo "Faltan datos obligatorios";
            return;
        }

        // Preparar query
        $query = "INSERT INTO visitas 
          (DNI_VIS, cantidad_personas, patente, hora_entrada, hora_salida, propiedad_destino) 
          VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sissss", $dni, $cantidad, $patente, $entrada, $salida, $destino);

        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros correctamente
        // s = string, i = integer
        $stmt->bind_param("sissss", $dni, $cantidad, $patente, $entrada, $salida, $destino);

        // Ejecutar
        if ($stmt->execute()) {
            header("Location: /guardia?success=1");
            exit;
        } else {
            echo "Error al crear la visita: " . $stmt->error;
        }

        $stmt->close();
    }
}

//-------------------------------------------------------------------------    

public function editar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $id      = $_POST['id_visita'] ?? null;
        $dni     = $_POST['DNI_VIS'] ?? null;
        $cantidad = $_POST['cantidad_personas'] ?? null;
        $patente  = $_POST['patente'] ?? null;
        $entrada  = $_POST['hora_entrada'] ?? null;
        $salida   = $_POST['hora_salida'] ?? null;
        $destino  = $_POST['propiedad_destino'] ?? null;

        // Validar campos obligatorios
        if (!$id || !$dni || !$cantidad || !$patente || !$entrada || !$destino) {
            echo "Faltan datos obligatorios";
            return;
        }

        // Si hora_salida está vacía, poner NULL
        if (empty($salida)) {
            $salida = null;
        }

        // Preparar query UPDATE
        $query = "UPDATE visitas 
                  SET DNI_VIS = ?, cantidad_personas = ?, patente = ?, hora_entrada = ?, hora_salida = ?, propiedad_destino = ?
                  WHERE id_visita = ?";

        $stmt = $db->prepare($query);
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: s = string, i = int
        // Nota: bind_param no acepta null directo, si $salida es null MySQL lo aceptará
        $stmt->bind_param("sissssi", $dni, $cantidad, $patente, $entrada, $salida, $destino, $id);

        if ($stmt->execute()) {
            header("Location: /guardia?success_edit=1");
            exit;
        } else {
            echo "Error al actualizar la visita: " . $stmt->error;
        }

        $stmt->close();
    }
}

//-------------------------------------------------------------------------    
public function borrar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        // Capturamos el ID de la visita
        $id = $_POST['id_visita'] ?? null;

        if (!$id) {
            echo "ID obligatorio no proporcionado";
            return;
        }

        // Preparar la consulta para eliminar de la tabla visitas
        $query = "DELETE FROM visitas WHERE id_visita = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: i = integer
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireccionar a la vista correspondiente con un mensaje de éxito
            // Nota: Cambiá "/visitas" por "/guardia" si manejás todo desde esa misma ruta
            header("Location: /visitas?deleted=1");
            exit;
        } else {
            echo "Error al eliminar la visita: " . $stmt->error;
        }

        $stmt->close();
    }
}

}