<?php
// signin.php
session_start();
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/config/database.php";
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/models/User.php"; // Asegúrate de incluir el modelo User

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

        // Crear instancia del modelo User
        $userModel = new User($db);

        // Verificar si el correo ya existe
        if ($userModel->findByEmail($email)) {
            echo "Ya existe un usuario con ese correo.";
            exit;
        }

        // Encriptar la contraseña usando password_hash (lo más recomendable)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Datos para la creación del usuario
        $data = [
            ':idProvincia' => 1,
            ':idCanton' => 1,
            ':Nombre' => $name,
            ':Apellido' => '',
            ':Correo' => $email,
            ':Telefono' => '',
            ':Cedula' => '',
            ':Password' => $hashedPassword,
            ':isAdmin' => 0,
            ':DetalleDireccion' => ''
        ];

        // Insertar el nuevo usuario
        if ($userModel->create($data)) {
            // Redirigir a la página de inicio de sesión
            header("Location: login.html");
            exit;
        } else {
            echo "Error al registrar el usuario.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
