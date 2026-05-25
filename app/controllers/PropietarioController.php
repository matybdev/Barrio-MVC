<?php

namespace Controllers;
use MVC\Router;


class PropietarioController {
        public function showPropietario(){
         // Correct path for the header file
        include __DIR__ . '/../../includes/header.php';
        require __DIR__ . '/../../includes/app.php';

        $propietarios = $db->query("SELECT * FROM guardias ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC); 

        if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== "Admin"){
        // Redirigir a login u otra página si no es Admin
        header("Location: /index");
        exit;
    }

        // Path for the view file
        include __DIR__ . '/../views/Admin/propietario.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../../includes/app.php';

    $dni_pro   = $_POST['DNI_PRO'] ?? null;
    $nombre   = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $propiedad  = $_POST['propiedad'] ?? null;

    if (!$dni_pro || !$nombre || !$apellido || !$propiedad) {
        echo "Faltan datos obligatorios";
        return;
    }

    // MySQLi usa ? como placeholder
    $query = "INSERT INTO propietarios (DNI_PRO, nombre, apellido, propiedad) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    if (!$stmt) {
        die("Error en prepare: " . $db->error);
    }

    // Vincular parámetros: s=string, i=int, d=double
    $stmt->bind_param("ssss", $dni_pro, $nombre, $apellido, $propiedad);

    if ($stmt->execute()) {
        header("Location: /propietario?success=1");
        exit;
    } else {
        echo "Error al crear el propietario: " . $stmt->error;
    }

    $stmt->close();
        }
}

//-------------------------------------------------------------------------    

public function editar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        $id = $_POST['id_propietario'] ?? null;
        $dni     = $_POST['DNI_PRO'] ?? null;
        $nombre     = $_POST['nombre'] ?? null;
        $apellido   = $_POST['apellido'] ?? null;
        $propiedad    = $_POST['propiedad'] ?? null;

        if (!$id || !$dni || !$nombre || !$apellido || !$propiedad) {
            echo "Faltan datos obligatorios";
            return;
        }

        // Preparar la consulta de actualización
        $query = "UPDATE propietarios 
                  SET DNI_PRO = ?, nombre = ?, apellido = ?, propiedad = ? 
                  WHERE id_propietario = ?";
        $stmt = $db->prepare($query);
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: s=string, i=int
        $stmt->bind_param("ssssi", $dni, $nombre, $apellido, $propiedad, $id);

        if ($stmt->execute()) {
            header("Location: /propietario?edited=1");
            exit;
        } else {
            echo "Error al editar el Propietario: " . $stmt->error;
        }

        $stmt->close();
    }
}

//-------------------------------------------------------------------------    

//-------------------------------------------------------------------------    
public function borrar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        // Capturamos el ID asegurándonos de usar el nombre correcto del input
        $id = $_POST['id_propietario'] ?? null;

        if (!$id) {
            echo "ID obligatorio no proporcionado";
            return;
        }

        // Preparar la consulta para eliminar
        $query = "DELETE FROM propietarios WHERE id_propietario = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: i = integer
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireccionar a la vista de propietarios con un mensaje de éxito
            header("Location: /propietario?deleted=1");
            exit;
        } else {
            echo "Error al eliminar el propietario: " . $stmt->error;
        }

        $stmt->close();
    }
}
}
