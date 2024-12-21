<?php
class Database {
    // Parámetros de la conexión
    private $host = "localhost";
    private $db_name = "denunciasDB";
    private $username = "root";
    private $password = "";
    public $conn;

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            // Fuente de datos (DSN)
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;

            // Crear una instancia de PDO
            $this->conn = new PDO($dsn, $this->username, $this->password);

            // Configurar atributos de PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Opcional: Para usar caracteres especiales (UTF-8)
            $this->conn->exec("set names utf8");

        } catch (PDOException $exception) {
            // Manejo de errores
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
