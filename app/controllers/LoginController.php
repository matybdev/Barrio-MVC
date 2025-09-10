<?php
namespace Controllers;

class LoginController {
    protected $db;
    protected $error = '';

    public function __construct($db) {
        $this->db = $db;
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Recoger datos y limpiar
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($username === '' || $password === '') {
                $this->error = "❌ Debes completar todos los campos.";
                $this->showLoginForm();
                return;
            }

            $query = "SELECT u.id_usuario, u.username, u.password, r.nombre AS rol 
                      FROM usuarios u
                      JOIN roles r ON u.id_rol = r.id_rol
                      WHERE u.username = ? LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            $usuario = $result->fetch_assoc();


            if ($usuario) {
                if (password_verify($password, $usuario['password'])) {

                    if (session_status() === PHP_SESSION_NONE) session_start();

                    $_SESSION['usuario'] = $usuario['username'];
                    $_SESSION['rol'] = $usuario['rol'];

                    // Redirección según rol
                   if ($usuario['rol'] === "Admin") {
                        header("Location: /admin");
                    } else if($usuario['rol'] === "Guardia") {
                        header("Location: /guardia");
                    }
                    exit;

                } else {
                    $this->error = "❌ Contraseña incorrecta.";
                }
            } else {
                $this->error = "❌ Usuario no encontrado.";
            }
        }

        $this->showLoginForm();
    }

    public function showLoginForm() {
        $error = $this->error;
        include __DIR__ . '/../views/login.php';
    }

    public function showPagina() {
        if(session_status() === PHP_SESSION_NONE) session_start();

        include __DIR__ . '/../../includes/header.php'; 

        if(isset($_SESSION['rol'])){
            if($_SESSION['rol'] === "Admin"){
                include __DIR__ . '/../views/admin.php';
            } else if($_SESSION['rol'] === "Guardia"){
                include __DIR__ . '/../views/guardia.php';
            }
        } else {
            header("Location: /index");
            exit;
        }
    }
}
