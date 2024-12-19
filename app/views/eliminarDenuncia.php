<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Denuncia.php';

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
