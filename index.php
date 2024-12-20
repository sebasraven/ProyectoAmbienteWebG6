<?php //El front controller (index.php) se encarga de la navegación
session_start();

require_once __DIR__ . '/app/config/database.php'; // Contiene la conexión $pdo
require_once __DIR__ . '/app/models/User.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

// Determina la acción en base al query param 'action'
$action = $_GET['action'] ?? null;
$controller = new AuthController();

// Rutas simples de ejemplo
switch ($action) {
    case 'login':
        // Proceso de login (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login($_POST);
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'signin':
        // Proceso de registro (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register($_POST);
        } else {
            $controller->showSignIn();
        }
        break;
        
    case 'logout':
        $controller->logout();
        break;
        
    case 'dashboard':
        // Verificar sesión
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        include __DIR__ . '/app/views/home.html';
        break;
        
    default:
        // Por defecto redirigir al login
        header('Location: index.php?action=login');
        break;
}
