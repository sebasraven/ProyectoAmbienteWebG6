<?php

class AuthController {
    private $userModel;

    public function __construct() {
        global $pdo; // Usamos la conexión global
        $this->userModel = new User($pdo);
    }

    public function showLogin() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function showSignIn() {
        include __DIR__ . '/../views/auth/signin.php';
    }

    public function login($postData) {
        $correo = $postData['email'] ?? '';
        $password = $postData['password'] ?? '';

        if (!empty($correo) && !empty($password)) {
            $user = $this->userModel->findByEmail($correo);
            if ($user && $this->userModel->verifyPassword($password, $user['Password'])) {
                // Credenciales válidas
                $_SESSION['user_id'] = $user['idUsuario'];
                $_SESSION['user_name'] = $user['Nombre'] . ' ' . $user['Apellido'];
                $_SESSION['is_admin'] = $user['isAdmin'];
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        } else {
            $error = "Por favor, complete todos los campos.";
        }

        // Si hay error, volver a mostrar la vista de login con el mensaje
        include __DIR__ . '/../views/auth/login.php';
    }

    public function register($postData) {
        $nombreCompleto = $postData['name'] ?? '';
        $correo = $postData['email'] ?? '';
        $password = $postData['password'] ?? '';
        $confirmPassword = $postData['confirm-password'] ?? '';

        if (!empty($nombreCompleto) && !empty($correo) && !empty($password) && !empty($confirmPassword)) {
            if ($password === $confirmPassword) {
                $partesNombre = explode(' ', trim($nombreCompleto));
                $nombre = $partesNombre[0];
                $apellido = (count($partesNombre) > 1) ? implode(' ', array_slice($partesNombre, 1)) : '';

                // Verificar si el usuario ya existe
                $existe = $this->userModel->findByEmail($correo);
                if ($existe) {
                    $error = "Ya existe un usuario con este correo.";
                } else {
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                    $data = [
                        ':idProvincia' => 1,
                        ':idCanton' => 1,
                        ':Nombre' => $nombre,
                        ':Apellido' => $apellido,
                        ':Correo' => $correo,
                        ':Telefono' => '',
                        ':Cedula' => '',
                        ':Password' => $passwordHash,
                        ':isAdmin' => 0,
                        ':DetalleDireccion' => ''
                    ];
                    $success = $this->userModel->create($data) ? "Usuario registrado correctamente." : "Error al crear el usuario.";
                }
            } else {
                $error = "Las contraseñas no coinciden.";
            }
        } else {
            $error = "Por favor, complete todos los campos.";
        }

        include __DIR__ . '/../views/auth/signin.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
