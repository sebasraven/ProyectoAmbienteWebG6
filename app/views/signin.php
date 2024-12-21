<?php
// signin.php
session_start();
//require_once "database.php"; // Archivo donde se establece la conexión (PDO)
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Validaciones básicas
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    try {
        // Instancia de la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Verificar si el correo ya existe
        $query = "SELECT idUsuario FROM Usuarios WHERE Correo = :correo LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":correo", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Ya existe un usuario con ese correo.";
            exit;
        }

        // Encriptar la contraseña usando password_hash (lo más recomendable)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        // Ajusta según tus columnas en la tabla (Apellido, Provincia, Canton, etc.)
        $insert = "INSERT INTO Usuarios (Nombre, Correo, Password, isAdmin)
                   VALUES (:nombre, :correo, :clave, 0)";

        $stmt = $db->prepare($insert);
        $stmt->bindParam(":nombre", $name);
        $stmt->bindParam(":correo", $email);
        $stmt->bindParam(":clave", $hashedPassword);

        if ($stmt->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            // Opcional: redirigir a login
            // header("Location: login.html");
            // exit;
        } else {
            echo "Error al registrar el usuario.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>