<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

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
