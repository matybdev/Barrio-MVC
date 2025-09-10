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
}