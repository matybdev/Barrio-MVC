<?php

namespace Controllers;
use MVC\Router;

class PaginaController {

    public function showGuardia(){

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
        include __DIR__ . '/../views/Admin/guardias.php';
        
        
    }

//-------------------------------------------------------------------------    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../../includes/app.php';

    $cedula   = $_POST['cedula'] ?? null;
    $nombre   = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $horario  = $_POST['horario'] ?? null;

    if (!$cedula || !$nombre || !$apellido) {
        echo "Faltan datos obligatorios";
        return;
    }

    // MySQLi usa ? como placeholder
    $query = "INSERT INTO guardias (cedula, nombre, apellido, horario) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    if (!$stmt) {
        die("Error en prepare: " . $db->error);
    }

    // Vincular parámetros: s=string, i=int, d=double
    $stmt->bind_param("ssss", $cedula, $nombre, $apellido, $horario);

    if ($stmt->execute()) {
        header("Location: /guardias?success=1");
        exit;
    } else {
        echo "Error al crear el guardia: " . $stmt->error;
    }

    $stmt->close();
        }
}

//-------------------------------------------------------------------------    

public function editar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $id = $_POST['id'] ?? null;
        $cedula     = $_POST['cedula'] ?? null;
        $nombre     = $_POST['nombre'] ?? null;
        $apellido   = $_POST['apellido'] ?? null;
        $horario    = $_POST['horario'] ?? null;

        if (!$id || !$cedula || !$nombre || !$apellido) {
            echo "Faltan datos obligatorios";
            return;
        }

        // Preparar la consulta de actualización
        $query = "UPDATE guardias 
                  SET cedula = ?, nombre = ?, apellido = ?, horario = ? 
                  WHERE id = ?";
        $stmt = $db->prepare($query);
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: s=string, i=int
        $stmt->bind_param("ssssi", $cedula, $nombre, $apellido, $horario, $id);

        if ($stmt->execute()) {
            header("Location: /guardias?edited=1");
            exit;
        } else {
            echo "Error al editar el guardia: " . $stmt->error;
        }

        $stmt->close();
    }
}

//-------------------------------------------------------------------------    
public function borrar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo "ID obligatorio no proporcionado";
            return;
        }

        // Preparar la consulta para eliminar
        $query = "DELETE FROM guardias WHERE id = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: i = integer
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireccionar con un mensaje de éxito
            header("Location: /guardias?deleted=1");
            exit;
        } else {
            echo "Error al eliminar el guardia: " . $stmt->error;
        }

        $stmt->close();
    }
} 



}