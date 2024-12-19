<?php

class EstadoDenuncia
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllEstados()
    {
        $stmt = $this->pdo->query("SELECT * FROM Estados_Denuncias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstadoById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Estados_Denuncias WHERE idEstadoDenuncia = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
