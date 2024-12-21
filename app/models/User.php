<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Usuarios WHERE Correo = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Usuarios (idProvincia, idCanton, Nombre, Apellido, Correo, Telefono, Cedula, Password, isAdmin, DetalleDireccion) 
            VALUES (:idProvincia, :idCanton, :Nombre, :Apellido, :Correo, :Telefono, :Cedula, :Password, :isAdmin, :DetalleDireccion)");
        return $stmt->execute($data);
    }

    public function verifyPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM Usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Usuarios WHERE idUsuario = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $data)
    {
        // Construir la parte SET de la consulta dinámicamente
        $setClause = [];
        foreach ($data as $key => $value) {
            $setClause[] = substr($key, 1) . " = " . $key;
        }
        $setClause = implode(", ", $setClause);

        $stmt = $this->pdo->prepare("UPDATE Usuarios SET $setClause WHERE idUsuario = :id");
        $data[':id'] = $id;
        return $stmt->execute($data);
    }


    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Usuarios WHERE idUsuario = :id");
        return $stmt->execute([':id' => $id]);
    }
}
