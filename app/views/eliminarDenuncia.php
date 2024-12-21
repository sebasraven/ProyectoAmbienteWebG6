<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Denuncia.php';

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancia del modelo con la conexión a la base de datos
$denunciaModel = new Denuncia($pdo);
$denunciaId = $_GET['id'] ?? null;

if ($denunciaId) {
    if ($denunciaModel->deleteDenuncia($denunciaId)) {
        $success = "Denuncia eliminada correctamente.";
    } else {
        $error = "Error al eliminar la denuncia.";
    }
} else {
    $error = "ID de denuncia no proporcionado.";
}

header('Location: gestionarDenuncias.php');
exit;
