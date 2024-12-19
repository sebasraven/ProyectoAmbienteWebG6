<?php

class TipoDenuncia
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllTipos()
    {
        $stmt = $this->pdo->query("SELECT * FROM Tipos_Denuncias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTipoById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Tipos_Denuncias WHERE idTipoDenuncia = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
