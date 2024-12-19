<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Denuncia.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Provincia.php';
require_once __DIR__ . '/../models/Canton.php';
require_once __DIR__ . '/../models/TipoDenuncia.php';
require_once __DIR__ . '/../models/EstadoDenuncia.php';

$denunciaModel = new Denuncia($pdo);
$userModel = new User($pdo);
$provinciaModel = new Provincia($pdo);
$cantonModel = new Canton($pdo);
$tipoDenunciaModel = new TipoDenuncia($pdo);
$estadoDenunciaModel = new EstadoDenuncia($pdo);

$usuarios = $userModel->getAllUsers();
$provincias = $provinciaModel->getAllProvincias();
$tiposDenuncia = $tipoDenunciaModel->getAllTipos();
$estadosDenuncia = $estadoDenunciaModel->getAllEstados();

$denunciaId = $_GET['id'] ?? null;

if (!$denunciaId) {
    header('Location: gestionarDenuncias.php');
    exit;
}

$denuncia = $denunciaModel->getDenunciaById($denunciaId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':idUsuario' => $_POST['idUsuario'],
        ':idProvincia' => $_POST['idProvincia'],
        ':idCanton' => $_POST['idCanton'],
        ':idTipoDenuncia' => $_POST['idTipoDenuncia'],
        ':idEstadoDenuncia' => $_POST['idEstadoDenuncia'],
        ':DescripcionDenuncia' => $_POST['DescripcionDenuncia'],
        ':Fecha' => $_POST['Fecha'],
        ':DetalleUbicacion' => $_POST['DetalleUbicacion']
    ];

    if ($denunciaModel->updateDenuncia($denunciaId, $data)) {
        $success = "Denuncia actualizada correctamente.";
    } else {
        $error = "Error al actualizar la denuncia.";
    }

    $denuncia = $denunciaModel->getDenunciaById($denunciaId); // Refrescar los datos de la denuncia
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Denuncia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Denuncia</h2>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="editarDenuncia.php?id=<?php echo $denunciaId; ?>" method="POST">
            <div class="form-group">
                <label for="idUsuario">Usuario</label>
                <select class="form-control" id="idUsuario" name="idUsuario" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['idUsuario']; ?>" <?php echo $usuario['idUsuario'] == $denuncia['idUsuario'] ? 'selected' : ''; ?>>
                            <?php echo $usuario['Nombre'] . ' ' . $usuario['Apellido']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idProvincia">Provincia</label>
                <select class="form-control" id="idProvincia" name="idProvincia" required>
                    <?php foreach ($provincias as $provincia): ?>
                        <option value="<?php echo $provincia['idProvincia']; ?>" <?php echo $provincia['idProvincia'] == $denuncia['idProvincia'] ? 'selected' : ''; ?>>
                            <?php echo $provincia['NombreProvincia']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idCanton">Cantón</label>
                <select class="form-control" id="idCanton" name="idCanton" required>
                    <!-- Opciones de cantones se actualizarán dinámicamente -->
                </select>
            </div>
            <div class="form-group">
                <label for="idTipoDenuncia">Tipo de Denuncia</label>
                <select class="form-control" id="idTipoDenuncia" name="idTipoDenuncia" required>
                    <?php foreach ($tiposDenuncia as $tipo): ?>
                        <option value="<?php echo $tipo['idTipoDenuncia']; ?>" <?php echo $tipo['idTipoDenuncia'] == $denuncia['idTipoDenuncia'] ? 'selected' : ''; ?>>
                            <?php echo $tipo['NombreDenuncia']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idEstadoDenuncia">Estado de Denuncia</label>
                <select class="form-control" id="idEstadoDenuncia" name="idEstadoDenuncia" required>
                    <?php foreach ($estadosDenuncia as $estado): ?>
                        <option value="<?php echo $estado['idEstadoDenuncia']; ?>" <?php echo $estado['idEstadoDenuncia'] == $denuncia['idEstadoDenuncia'] ? 'selected' : ''; ?>>
                            <?php echo $estado['NombreDenuncia']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="DescripcionDenuncia">Descripción</label>
                <textarea class="form-control" id="DescripcionDenuncia" name="DescripcionDenuncia" required><?php echo htmlspecialchars($denuncia['DescripcionDenuncia']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="Fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="Fecha" name="Fecha" value="<?php echo date('Y-m-d\TH:i', strtotime($denuncia['Fecha'])); ?>" required>
            </div>
            <div class="form-group">
                <label for="DetalleUbicacion">Ubicación</label>
                <input type="text" class="form-control" id="DetalleUbicacion" name="DetalleUbicacion" value="<?php echo htmlspecialchars($denuncia['DetalleUbicacion']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Reporte</button>
        </form>
        <a href="gestionarDenuncias.php" class="btn btn-secondary mt-3">Volver</a>
    </div>

    <script>
        $(document).ready(function() {
            $('#idProvincia').change(function() {
                var idProvincia = $(this).val();
                $.ajax({
                    url: 'getCantones.php',
                    method: 'POST',
                    data: {
                        idProvincia: idProvincia
                    },
                    success: function(response) {
                        $('#idCanton').html(response);
                        // Selecciona el cantón actual de la denuncia
                        $('#idCanton').val('<?php echo $denuncia['idCanton']; ?>');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener cantones:', status, error);
                    }
                });
            });

            // Inicializa el cantón seleccionado al cargar la página
            $('#idProvincia').trigger('change');
        });
    </script>
</body>

</html>