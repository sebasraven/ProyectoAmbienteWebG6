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

if (!$userId) {
    header('Location: gestionarUsuarios.php');
    exit;
}

$user = $userModel->getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':idProvincia' => 1,
        ':idCanton' => 1,
        ':Nombre' => $_POST['nombre'],
        ':Apellido' => $_POST['apellido'],
        ':Correo' => $_POST['correo'],
        ':Telefono' => $_POST['telefono'],
        ':Cedula' => $_POST['cedula'],
        ':isAdmin' => isset($_POST['isAdmin']) ? 1 : 0,
        ':DetalleDireccion' => $_POST['detalleDireccion']
    ];

    if (!empty($_POST['password'])) {
        $data[':Password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    if ($userModel->updateUser($userId, $data)) {
        $success = "Usuario actualizado correctamente.";
    } else {
        $error = "Error al actualizar el usuario.";
    }

    $user = $userModel->getUserById($userId); // Refrescar los datos del usuario
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Encabezado -->
    <header class="py-3 mb-4">
        <div class="container text-center">
            <h1 class="text-center">ReporTico</h1>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Usuario</h2>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="editarUsuario.php?id=<?php echo $userId; ?>" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['Nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($user['Apellido']); ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($user['Correo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($user['Telefono']); ?>">
            </div>
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo htmlspecialchars($user['Cedula']); ?>">
            </div>
            <div class="form-group">
                <label for="password">Contraseña (dejar en blanco para no cambiar)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="detalleDireccion">Dirección</label>
                <input type="text" class="form-control" id="detalleDireccion" name="detalleDireccion" value="<?php echo htmlspecialchars($user['DetalleDireccion']); ?>">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin" <?php echo $user['isAdmin'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="isAdmin">¿Es administrador?</label>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        </form>
        <a href="gestionarUsuarios.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>

</html>