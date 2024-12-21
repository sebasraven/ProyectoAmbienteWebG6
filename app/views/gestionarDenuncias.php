<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Denuncia.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/EstadoDenuncia.php';

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancias de los modelos con la conexión a la base de datos
$denunciaModel = new Denuncia($pdo);
$userModel = new User($pdo);
$estadoDenunciaModel = new EstadoDenuncia($pdo);

$denuncias = $denunciaModel->getAllDenuncias();
$usuarios = $userModel->getAllUsers();
$estadosDenuncia = $estadoDenunciaModel->getAllEstados();

$userMap = [];
foreach ($usuarios as $usuario) {
    $userMap[$usuario['idUsuario']] = $usuario['Nombre'] . ' ' . $usuario['Apellido'];
}

$estadoMap = [];
foreach ($estadosDenuncia as $estado) {
    $estadoMap[$estado['idEstadoDenuncia']] = $estado['NombreDenuncia'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Denuncias</title>

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
                        <a class="nav-link" aria-current="page" href="home.html">Inicio</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="denuncia.html">Reportar un Problema</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="mapaReportes.html">Mapa de Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="misReportes.html">Mis Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="miCuenta.html">Mi Cuenta</a>
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
                    <a class="btn btn-primary" href="login.html">Login / Registrarse</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Gestionar Denuncias</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($denuncias as $denuncia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($denuncia['idDenuncias']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['DescripcionDenuncia']); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['DetalleUbicacion']); ?></td>
                            <td><?php echo htmlspecialchars($estadoMap[$denuncia['idEstadoDenuncia']]); ?></td>
                            <td><?php echo htmlspecialchars($denuncia['Fecha']); ?></td>
                            <td><?php echo htmlspecialchars($userMap[$denuncia['idUsuario']]); ?></td>
                            <td>
                                <a href="editarDenuncia.php?id=<?php echo $denuncia['idDenuncias']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminarDenuncia.php?id=<?php echo $denuncia['idDenuncias']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="crearDenuncia.php" class="btn btn-primary">Crear Nueva Denuncia</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>