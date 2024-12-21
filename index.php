<?php
session_start();

// Si el usuario ya inició sesión (por ejemplo, si existe idUsuario en $_SESSION),
// se redirige directamente a home.html
//if (isset($_SESSION["idUsuario"])) {
//    header("Location: index.php");
//    exit;
//}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportico - Inicio</title>
    <!-- Enlaces a Bootstrap u otro framework si lo deseas -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
