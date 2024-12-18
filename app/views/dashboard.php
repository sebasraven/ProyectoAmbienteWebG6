<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
    <p>Esta es tu área restringida.</p>
    <a href="index.php?action=logout">Cerrar sesión</a>
</body>
</html>
