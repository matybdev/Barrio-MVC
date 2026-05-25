<?php

namespace Controllers;
use MVC\Router;

class HorarioController {

    // Editar horario y estado de guardia
public function editarHorario() {
    require __DIR__ . '/../../includes/app.php';

    $id = $_POST['id'];
    $horario = $_POST['horario'];
    $estado = $_POST['estado'];

    $stmt = $db->prepare("UPDATE guardias SET horario=?, estado=? WHERE id=?");
    $stmt->bind_param("ssi", $horario, $estado, $id);
    $stmt->execute();

    header("Location: /horario");
}
    public function showHorario(){
         // Correct path for the header file
        include __DIR__ . '/../../includes/header.php'; 
        require __DIR__ . '/../../includes/app.php';

        $guardias = $db->query("SELECT * FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);

        if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Admin"){
        // Redirigir a login u otra página si no es Admin
        header("Location: /index");
        exit;
        }

        
        // Path for the view file
        include __DIR__ . '/../views/Admin/horario.php';
    }

    //-------------------------------------------------------------------------    
public function borrarHorario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo "ID obligatorio no proporcionado";
            return;
        }

        // En lugar de DELETE, hacemos un UPDATE para vaciar el horario
        // Opcional: también lo pasamos a estado 'Inactivo' si tu lógica lo requiere
        $query = "UPDATE guardias SET horario = '', estado = 'Inactivo' WHERE id = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: i = integer
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireccionar a la vista de horarios con un mensaje de éxito
            header("Location: /horario?deleted_horario=1");
            exit;
        } else {
            echo "Error al vaciar el horario: " . $stmt->error;
        }

        $stmt->close();
    }
}
}