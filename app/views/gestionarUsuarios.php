<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancia del modelo con la conexión a la base de datos
$userModel = new User($pdo);
$usuarios = $userModel->getAllUsers();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

    <!-- Barra de Navegacion Temporal -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="mapaReportes.html">Mapa de Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="misReportes.html">Mis Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="miCuenta.php">Mi Cuenta</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="ayuda.html">Ayuda</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="gestionarUsuarios.php">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="gestionarDenuncias.php">Gestionar Reportes</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Gestionar Usuarios</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['idUsuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Nombre'] . ' ' . $usuario['Apellido']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Correo']); ?></td>
                            <td>
                                <a href="editarUsuario.php?id=<?php echo $usuario['idUsuario']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminarUsuario.php?id=<?php echo $usuario['idUsuario']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="crearUsuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>