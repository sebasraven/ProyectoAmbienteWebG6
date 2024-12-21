<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancia del modelo con la conexión a la base de datos
$userModel = new User($pdo);
$userId = $_GET['id'] ?? null;

if ($userId) {
    if ($userModel->deleteUser($userId)) {
        $success = "Usuario eliminado correctamente.";
    } else {
        $error = "Error al eliminar el usuario.";
    }
} else {
    $error = "ID de usuario no proporcionado.";
}

header('Location: gestionarUsuarios.php');
exit;
