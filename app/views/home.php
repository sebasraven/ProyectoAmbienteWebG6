<?php
session_start();

// Verifica si el usuario está logueado y si es administrador
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReporTico</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Encabezado -->
    <header class="py-3 mb-4">
        <div class="container text-center">
            <h1 class="text-center">ReporTico</h1>
        </div>
    </header>

    <!-- Barra de Navegacion -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="home.php">ReporTico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="mapaReportes.php">Mapa de Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="misReportes.php">Mis Reportes</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="miCuenta.php">Mi Cuenta</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="ayuda.html">Ayuda</a>
                    </li>
                    <?php if ($isAdmin): ?>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="gestionarUsuarios.php">Gestionar Usuarios</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="gestionarDenuncias.php">Gestionar Reportes</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger btn-lg">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sección de Bienvenida -->
    <div class="container text-center mb-5">
        <h2>Bienvenido a ReporTico</h2>
        <p class="lead">Gestiona tus denuncias de manera eficiente y sencilla.</p>
        <hr class="my-4">
        <a class="btn btn-custom2 btn-lg" href="misReportes.php" role="button">Reportar un Problema</a>
    </div>

    <!-- Sección de Información -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box p-4 bg-light rounded">
                    <h4>¿Cómo funciona ReporTico?</h4>
                    <p>ReporTico te permite reportar incidencias en tu comunidad de manera rápida y eficiente.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box p-4 bg-light rounded">
                    <h4>Mapa de Reportes</h4>
                    <p>Visualiza todas las incidencias reportadas por otros usuarios.</p>
                    <a class="btn btn-custom3" href="mapaReportes.php" role="button">Ver Mapa</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box p-4 bg-light rounded">
                    <h4>Gestión de Reportes</h4>
                    <p>Revisa y gestiona todos tus reportes desde tu cuenta personal.</p>
                    <a class="btn btn-custom2" href="misReportes.php" role="button">Gestionar Reportes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Contacto -->
    <div class="container text-center mb-5">
        <h3>¿Tienes alguna pregunta?</h3>
        <p class="lead">Consulta nuestra <a href="ayuda.html">sección de ayuda</a> para más información.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>