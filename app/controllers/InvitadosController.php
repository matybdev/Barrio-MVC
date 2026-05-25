<?php

namespace Controllers;
use MVC\Router;


class InvitadosController{
     public function ShowInvitado(){
         // Correct path for the header file
        include __DIR__ . '/../../includes/header.php';
        require __DIR__ . '/../../includes/app.php';

        // Path for the view file
        include __DIR__ . '/../views/Guardia/invitados.php';
    }

    protected $db;
    protected $error = '';

    public function __construct($db) {
        $this->db = $db;
    }

    // Mostrar todos los invitados
    public function index() {
        $invitados = $this->db->query("SELECT * FROM invitados ORDER BY id_invitado ASC")->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../views/invitados.php'; // tu HTML de invitados
    }

    
    // Crear un nuevo invitado
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dni     = $_POST['DNI_INV'] ?? null;
            $nombre  = $_POST['nombre'] ?? null;
            $apellido= $_POST['apellido'] ?? null;

            if (!$dni || !$nombre || !$apellido) {
                echo "Faltan datos obligatorios";
                return;
            }

            $query = "INSERT INTO invitados (DNI_INV, nombre, apellido) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            if (!$stmt) die("Error en prepare: " . $this->db->error);

            $stmt->bind_param("sss", $dni, $nombre, $apellido);

            if ($stmt->execute()) {
                header("Location: /invitados?success=1");
                exit;
            } else {
                echo "Error al crear invitado: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    // Editar un invitado existente
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id      = $_POST['id_invitado'] ?? null;
            $dni     = $_POST['DNI_INV'] ?? null;
            $nombre  = $_POST['nombre'] ?? null;
            $apellido= $_POST['apellido'] ?? null;

            if (!$id || !$dni || !$nombre || !$apellido) {
                echo "Faltan datos obligatorios";
                return;
            }

            $query = "UPDATE invitados SET DNI_INV = ?, nombre = ?, apellido = ? WHERE id_invitado = ?";
            $stmt = $this->db->prepare($query);
            if (!$stmt) die("Error en prepare: " . $this->db->error);

            $stmt->bind_param("sssi", $dni, $nombre, $apellido, $id);

            if ($stmt->execute()) {
                header("Location: /invitados?success_edit=1");
                exit;
            } else {
                echo "Error al actualizar invitado: " . $stmt->error;
            }

            $stmt->close();
        }
    }


    //-------------------------------------------------------------------------    
public function borrar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require __DIR__ . '/../../includes/app.php';

        // Capturamos el ID del invitado
        $id = $_POST['id_invitado'] ?? null;

        if (!$id) {
            echo "ID obligatorio no proporcionado";
            return;
        }

        // Preparar la consulta para eliminar de la tabla invitados
        $query = "DELETE FROM invitados WHERE id_invitado = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            die("Error en prepare: " . $db->error);
        }

        // Vincular parámetros: i = integer
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireccionar a la vista de invitados con éxito
            header("Location: /invitados?deleted=1");
            exit;
        } else {
            echo "Error al eliminar el invitado: " . $stmt->error;
        }

        $stmt->close();
    }
}
}

