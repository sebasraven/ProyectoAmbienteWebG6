<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Canton.php';

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancia del modelo con la conexión a la base de datos
$cantonModel = new Canton($pdo);

$idProvincia = $_POST['idProvincia'] ?? null;

if ($idProvincia) {
    $cantones = $cantonModel->getCantonesByProvincia($idProvincia);

    $options = '';
    foreach ($cantones as $canton) {
        $options .= '<option value="' . $canton['idCanton'] . '">' . $canton['NombreCanton'] . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">Seleccione una provincia primero</option>';
}
