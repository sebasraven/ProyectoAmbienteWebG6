<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportico - Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container-fluid custom-bg min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 25rem;">
            <div class="card-body">
                <h3 class="card-title text-center text-primary mb-4">Iniciar Sesión</h3>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form action="index.php?action=login" method="POST">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php?action=signin">¿No tienes una cuenta? Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
