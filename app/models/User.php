<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM Usuarios WHERE Correo = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO Usuarios (idProvincia, idCanton, Nombre, Apellido, Correo, Telefono, Cedula, Password, isAdmin, DetalleDireccion) 
            VALUES (:idProvincia, :idCanton, :Nombre, :Apellido, :Correo, :Telefono, :Cedula, :Password, :isAdmin, :DetalleDireccion)");
        return $stmt->execute($data);
    }

    public function verifyPassword($plainPassword, $hashedPassword) {
        return password_verify($plainPassword, $hashedPassword);
    }
}
