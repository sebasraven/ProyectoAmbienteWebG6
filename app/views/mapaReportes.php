<?php
session_start();
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/config/database.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/Denuncia.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/TipoDenuncia.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/User.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/EstadoDenuncia.php";

// Verifica si el usuario está logueado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.html");
    exit;
}

// Obtener la conexión a la base de datos
$database = new Database();
$pdo = $database->getConnection();

// Crear instancias de los modelos
$denunciaModel = new Denuncia($pdo);
$tipoDenunciaModel = new TipoDenuncia($pdo);
$userModel = new User($pdo);
$estadoDenunciaModel = new EstadoDenuncia($pdo);

// Obtener los filtros
$tipoReporte = $_GET['tipoReporte'] ?? null;
$ubicacion = $_GET['ubicacion'] ?? null;
$estado = $_GET['estado'] ?? null;
$fechaHora = $_GET['fechaHora'] ?? null;

// Obtener todas las denuncias con los filtros aplicados
$denuncias = $denunciaModel->getDenunciasWithFilters($tipoReporte, $ubicacion, $estado, $fechaHora);

// Obtener tipos de denuncia para el filtro
$tiposDenuncia = $tipoDenunciaModel->getAllTipos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Reportes</title>

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
            <h1 class="text-center">Mapa de Reportes</h1>
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

    <!-- Mapa de Google Maps de Prueba -->
    <div class="mb-4 d-flex justify-content-center">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3304.730594763145!2d-84.07798372762775!3d9.933196528725496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2scr!4v1731557785934!5m2!1sen!2scr"
            width="100%" height="400" style="border:0;" allowfullscreen=""
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Sección de Filtros en Cards -->
    <div class="container mb-4">
        <div class="row">
            <!-- Filtro Tipo de Reporte -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="filtroDropbox" class="form-label">Filtrar por Tipo de Reporte:</label>
                        <select class="form-select" id="filtroDropbox" aria-label="Filtro de Ejemplo" onchange="aplicarFiltros()">
                            <option value="">Seleccionar opción</option>
                            <?php foreach ($tiposDenuncia as $tipo): ?>
                                <option value="<?php echo $tipo['idTipoDenuncia']; ?>" <?php echo $tipoReporte == $tipo['idTipoDenuncia'] ? 'selected' : ''; ?>>
                                    <?php echo $tipo['NombreDenuncia']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtro Ubicación -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="filtroUbicacion" class="form-label">Filtrar por Ubicación:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="filtroUbicacion"
                                placeholder="Buscar ubicación..." aria-label="Filtrar por ubicación" value="<?php echo htmlspecialchars($ubicacion); ?>" onkeyup="aplicarFiltros()">
                            <button class="btn btn-primary" type="button" onclick="aplicarFiltros()">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtro Estado -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="filtroEstado" class="form-label">Filtrar por Estado:</label>
                        <select class="form-select" id="filtroEstado" aria-label="Filtro por Estado" onchange="aplicarFiltros()">
                            <option value="">Seleccionar opción</option>
                            <option value="1" <?php echo $estado == 1 ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="2" <?php echo $estado == 2 ? 'selected' : ''; ?>>En Progreso</option>
                            <option value="3" <?php echo $estado == 3 ? 'selected' : ''; ?>>Resuelto</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtro Fecha y Hora -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="filtroFechaHora" class="form-label">Ordenar por Fecha y Hora:</label>
                        <select class="form-select" id="filtroFechaHora" aria-label="Filtro por Fecha y Hora" onchange="aplicarFiltros()">
                            <option value="">Seleccionar opción</option>
                            <option value="asc" <?php echo $fechaHora == 'asc' ? 'selected' : ''; ?>>Ascendente (Más antiguos primero)</option>
                            <option value="desc" <?php echo $fechaHora == 'desc' ? 'selected' : ''; ?>>Descendente (Más recientes primero)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Reportes -->
    <div class="table-responsive">
        <h2 class="text-center mb-4">Detalle de los Reportes</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Reporte</th>
                    <th>Fecha y Hora</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($denuncias as $denuncia): ?>
                    <?php
                    $usuario = $userModel->getUserById($denuncia['idUsuario']);
                    $estado = $estadoDenunciaModel->getEstadoById($denuncia['idEstadoDenuncia']);
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['Nombre'] . ' ' . $usuario['Apellido']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['DescripcionDenuncia']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['Fecha']); ?></td>
                        <td><?php echo htmlspecialchars($denuncia['DetalleUbicacion']); ?></td>
                        <td><?php echo htmlspecialchars($estado['NombreDenuncia']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Script para aplicar filtros -->
    <script>
        function aplicarFiltros() {
            const tipoReporte = document.getElementById('filtroDropbox').value;
            const ubicacion = document.getElementById('filtroUbicacion').value;
            const estado = document.getElementById('filtroEstado').value;
            const fechaHora = document.getElementById('filtroFechaHora').value;

            const url = new URL(window.location.href);
            url.searchParams.set('tipoReporte', tipoReporte);
            url.searchParams.set('ubicacion', ubicacion);
            url.searchParams.set('estado', estado);
            url.searchParams.set('fechaHora', fechaHora);
            window.location.href = url.href;
        }
    </script>
</body>

</html>