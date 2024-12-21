<?php
session_start();
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/config/database.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/User.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/Provincia.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/Canton.php";

// Verifica si el usuario está logueado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.html");
    exit;
}

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancias de los modelos
$userModel = new User($pdo);
$provinciaModel = new Provincia($pdo);
$cantonModel = new Canton($pdo);
$userId = $_SESSION['idUsuario'];
$user = $userModel->getUserById($userId);

// Obtener todas las provincias
$provincias = $provinciaModel->getAllProvincias();

// Actualizar información del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        ':idProvincia' => $_POST['provincia'],
        ':idCanton' => $_POST['canton'],
        ':Nombre' => $_POST['nombre'],
        ':Apellido' => $_POST['apellido'],
        ':Correo' => $_POST['correo'],
        ':Telefono' => $_POST['telefono'],
        ':Cedula' => $_POST['cedula'],
        ':DetalleDireccion' => $_POST['direccion']
    ];

    // Si se proporciona una nueva contraseña, actualizarla
    if (!empty($_POST['password'])) {
        $data[':Password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    } else {
        unset($data[':Password']);
    }

    // Actualizar usuario en la base de datos
    if ($userModel->updateUser($userId, $data)) {
        $success = "Información actualizada correctamente.";
        // Actualizar la información en la sesión
        $_SESSION["Nombre"] = $_POST['nombre'];
        $_SESSION["Correo"] = $_POST['correo'];
    } else {
        $error = "Error al actualizar la información.";
    }

    // Refrescar los datos del usuario
    $user = $userModel->getUserById($userId);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/miCuenta.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <!-- Encabezado -->
    <header class="py-3 mb-4">
        <div class="container text-center">
            <h1 class="text-center">Mi Cuenta</h1>
        </div>
    </header>

    <!-- Barra de Navegacion Temporal -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
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
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger btn-lg">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card usuario-card p-4">
                    <!-- Nombre de Usuario -->
                    <div class="text-center mb-4">
                        <h3><?php echo htmlspecialchars($user['Nombre'] . ' ' . $user['Apellido']); ?></h3>
                        <p class="text-muted"><?php echo htmlspecialchars($user['Correo']); ?></p>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                        <?php elseif (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>
                    </div>
                    <hr>

                    <!-- Información Personal -->
                    <div class="mb-4">
                        <h4 class="d-flex justify-content-between align-items-center">
                            Información Personal
                        </h4>
                        <ul class="list-unstyled ps-4">
                            <form action="miCuenta.php" method="POST">
                                <li>
                                    <strong>Nombre:</strong>
                                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['Nombre']); ?>" class="form-control" required>
                                </li>
                                <li>
                                    <strong>Apellido:</strong>
                                    <input type="text" name="apellido" value="<?php echo htmlspecialchars($user['Apellido']); ?>" class="form-control" required>
                                </li>
                                <li>
                                    <strong>Correo Electrónico:</strong>
                                    <input type="email" name="correo" value="<?php echo htmlspecialchars($user['Correo']); ?>" class="form-control" required>
                                </li>
                                <li>
                                    <strong>Provincia:</strong>
                                    <select name="provincia" id="provincia" class="form-control" required>
                                        <option value="">Seleccione una provincia</option>
                                        <?php foreach ($provincias as $provincia): ?>
                                            <option value="<?php echo $provincia['idProvincia']; ?>" <?php echo $provincia['idProvincia'] == $user['idProvincia'] ? 'selected' : ''; ?>><?php echo $provincia['NombreProvincia']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                                <li>
                                    <strong>Cantón:</strong>
                                    <select name="canton" id="canton" class="form-control" required>
                                        <!-- Las opciones de cantones se cargarán dinámicamente -->
                                    </select>
                                </li>
                                <li>
                                    <strong>Cédula:</strong>
                                    <input type="text" name="cedula" value="<?php echo htmlspecialchars($user['Cedula']); ?>" class="form-control">
                                </li>
                                <li>
                                    <strong>Teléfono:</strong>
                                    <input type="text" name="telefono" value="<?php echo htmlspecialchars($user['Telefono']); ?>" class="form-control">
                                </li>
                                <li>
                                    <strong>Dirección:</strong>
                                    <input type="text" name="direccion" value="<?php echo htmlspecialchars($user['DetalleDireccion']); ?>" class="form-control">
                                </li>
                                <li>
                                    <strong>Nueva Contraseña:</strong>
                                    <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                                </li>
                                <br>
                                <button type="submit" class="btn btn-primary">Actualizar Información</button>
                            </form>
                        </ul>
                    </div>

                    <hr>

                    <!-- Ayuda -->
                    <div class="mb-4">
                        <h4 class="d-flex justify-content-between align-items-center">
                            Ayuda
                        </h4>
                        <p class="text-muted ps-4">Si algún problema, visita nuestra sección de <a href="ayuda.html">Ayuda</a>.</p>
                    </div>

                    <hr>

                    <!-- Términos y Condiciones -->
                    <div class="mb-4">
                        <h4 class="d-flex justify-content-between align-items-center">
                            Términos y Condiciones
                        </h4>
                        <p class="text-muted ps-4">Lee nuestros <a href="terminos.html">Términos y Condiciones</a> para saber más.</p>
                    </div>

                    <!-- Logout -->
                    <div class="text-center">
                        <button class="btn btn-logout btn-lg" onclick="window.location.href='logout.php';">Cerrar Sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar los cantones al cargar la página
            var provinciaSeleccionada = $('#provincia').val();
            if (provinciaSeleccionada) {
                cargarCantones(provinciaSeleccionada, <?php echo $user['idCanton']; ?>);
            }

            // Cargar los cantones al cambiar la provincia
            $('#provincia').change(function() {
                var idProvincia = $(this).val();
                cargarCantones(idProvincia);
            });

            // Función para cargar los cantones
            function cargarCantones(idProvincia, cantonSeleccionado = null) {
                $.ajax({
                    url: 'getCantones.php',
                    method: 'POST',
                    data: {
                        idProvincia: idProvincia
                    },
                    success: function(response) {
                        $('#canton').html(response);
                        if (cantonSeleccionado) {
                            $('#canton').val(cantonSeleccionado);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener cantones:', status, error);
                    }
                });
            }
        });
    </script>
</body>

</html>