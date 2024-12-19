<?php

class Provincia
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProvincias()
    {
        $stmt = $this->pdo->query("SELECT * FROM Provincias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProvinciaById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Provincias WHERE idProvincia = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
