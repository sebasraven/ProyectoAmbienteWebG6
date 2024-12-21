<?php
// login.php
session_start();
//require_once "database.php"; // Archivo donde se establece la conexión (PDO)
require_once "C:/xampp/htdocs/ProyectoAmbienteWebG6/app/config/database.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    try {
        // Instancia de la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Consulta para comprobar el usuario
        $query = "SELECT * FROM Usuarios WHERE Correo = :correo LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":correo", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Obtenemos el registro
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificamos la contraseña
            if (password_verify($password, $user["Password"])) {
                // Contraseña válida
                $_SESSION["idUsuario"] = $user["idUsuario"];
                $_SESSION["Nombre"] = $user["Nombre"];
                $_SESSION["Correo"] = $user["Correo"];
                $_SESSION["isAdmin"] = $user["isAdmin"]; 

                // Redirigir a home.html
                header("Location: home.html");
                exit;
            } else {
                // Contraseña incorrecta
                echo "Credenciales inválidas. Contraseña incorrecta.";
            }
        } else {
            // No existe el usuario
            echo "No existe una cuenta registrada con ese correo.";
        }
    } catch (PDOException $e) {
        echo "Error al iniciar sesión: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
