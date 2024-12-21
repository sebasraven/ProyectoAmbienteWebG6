<?php
session_start();

// Si el usuario ya inició sesión (por ejemplo, si existe idUsuario en $_SESSION),
// se redirige directamente a home.html
if (isset($_SESSION["idUsuario"])) {
    header("Location: app/views/home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reportico - Inicio</title>
    <!-- Enlaces a Bootstrap u otro framework si lo deseas -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Fondo con imagen y efecto de desenfoque */
        body {
            color: white;
        }

        /* Estilos para el contenedor principal */
        .container-fluid {
            background: rgba(30, 58, 95, 0.8);
            /* Azul oscuro con transparencia */
            padding: 50px;
            border-radius: 15px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FFC107;
            /* Amarillo dorado */
        }

        p {
            font-size: 1.2rem;
        }

        .btn-primary {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #1E3A5F;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 10px 20px;
        }

        .btn-success {
            font-size: 1.1rem;
            font-weight: bold;
            padding: 10px 20px;
        }

        .btn-primary:hover,
        .btn-success:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="text-center mb-4">
            <h1>¡Bienvenido a Reportico!</h1>
            <p>Gestiona tus denuncias de manera ágil y segura.</p>
        </div>
        <div class="d-flex justify-content-center">
            <a href="app\views\login.html" class="btn btn-primary mr-2">Iniciar Sesión</a>
            <a href="app\views\signin.html" class="btn btn-success">Registrarse</a>
        </div>
    </div>

</body>

</html>