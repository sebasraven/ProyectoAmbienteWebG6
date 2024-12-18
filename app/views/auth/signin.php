<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportico - Crear Cuenta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signin.css">
</head>
<body>
    <div class="container-fluid bg-primary min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 30rem;">
            <div class="card-body">
                <h3 class="card-title text-center text-primary mb-4">Crear Cuenta</h3>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php elseif (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                <form action="index.php?action=signin" method="POST">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Crea una contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                </form>
                <div class="text-center mt-3">
                    <a href="index.php?action=login">¿Ya tienes una cuenta? Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
