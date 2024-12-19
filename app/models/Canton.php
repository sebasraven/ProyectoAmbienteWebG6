<?php

class Canton
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCantones()
    {
        $stmt = $this->pdo->query("SELECT * FROM Cantones");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCantonesByProvincia($idProvincia)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Cantones WHERE idProvincia = :idProvincia");
        $stmt->execute([':idProvincia' => $idProvincia]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCantonById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Cantones WHERE idCanton = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
