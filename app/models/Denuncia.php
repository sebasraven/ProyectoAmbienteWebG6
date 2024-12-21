<?php

class Denuncia
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Denuncias (idUsuario, idProvincia, idCanton, idTipoDenuncia, idEstadoDenuncia, DescripcionDenuncia, Fecha, DetalleUbicacion) 
            VALUES (:idUsuario, :idProvincia, :idCanton, :idTipoDenuncia, :idEstadoDenuncia, :DescripcionDenuncia, :Fecha, :DetalleUbicacion)");
        return $stmt->execute($data);
    }

    public function getAllDenuncias()
    {
        $stmt = $this->pdo->query("SELECT * FROM Denuncias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDenunciaById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Denuncias WHERE idDenuncias = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDenunciasByUser($idUsuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Denuncias WHERE idUsuario = :idUsuario");
        $stmt->execute([':idUsuario' => $idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateDenuncia($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE Denuncias SET idUsuario = :idUsuario, idProvincia = :idProvincia, idCanton = :idCanton, idTipoDenuncia = :idTipoDenuncia, idEstadoDenuncia = :idEstadoDenuncia, DescripcionDenuncia = :DescripcionDenuncia, Fecha = :Fecha, DetalleUbicacion = :DetalleUbicacion WHERE idDenuncias = :id");
        $data[':id'] = $id;
        return $stmt->execute($data);
    }

    public function deleteDenuncia($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Denuncias WHERE idDenuncias = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getDenunciasByUserWithFilters($idUsuario, $tipoReporte = null, $ubicacion = null, $estado = null, $fechaHora = null)
    {
        $query = "SELECT * FROM Denuncias WHERE idUsuario = :idUsuario";
        $params = [':idUsuario' => $idUsuario];

        if ($tipoReporte) {
            $query .= " AND idTipoDenuncia = :idTipoDenuncia";
            $params[':idTipoDenuncia'] = $tipoReporte;
        }

        if ($ubicacion) {
            $query .= " AND DetalleUbicacion LIKE :ubicacion";
            $params[':ubicacion'] = "%$ubicacion%";
        }

        if ($estado) {
            $query .= " AND idEstadoDenuncia = :idEstadoDenuncia";
            $params[':idEstadoDenuncia'] = $estado;
        }

        if ($fechaHora) {
            if ($fechaHora == "asc") {
                $query .= " ORDER BY Fecha ASC";
            } else {
                $query .= " ORDER BY Fecha DESC";
            }
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDenunciasWithFilters($tipoReporte = null, $ubicacion = null, $estado = null, $fechaHora = null)
    {
        $query = "SELECT * FROM Denuncias WHERE 1=1";
        $params = [];

        if ($tipoReporte) {
            $query .= " AND idTipoDenuncia = :idTipoDenuncia";
            $params[':idTipoDenuncia'] = $tipoReporte;
        }

        if ($ubicacion) {
            $query .= " AND DetalleUbicacion LIKE :ubicacion";
            $params[':ubicacion'] = "%$ubicacion%";
        }

        if ($estado) {
            $query .= " AND idEstadoDenuncia = :idEstadoDenuncia";
            $params[':idEstadoDenuncia'] = $estado;
        }

        if ($fechaHora) {
            if ($fechaHora == "asc") {
                $query .= " ORDER BY Fecha ASC";
            } else {
                $query .= " ORDER BY Fecha DESC";
            }
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
