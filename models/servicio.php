<?php
require_once __DIR__ . '/../config/dataBase.php';

class Servicio {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Inserta un nuevo servicio en la base de datos
     * @param array $data Datos del servicio
     * @return bool|string true si se inserta, mensaje de error si falla
     */
    public function registrar($data) {
        try {
            $sql = "INSERT INTO servicios (titulo, descripcion, ubicacion, tipo, empresa, precio) VALUES (:titulo, :descripcion, :ubicacion, :tipo, :empresa, :precio)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':precio', $data['precio']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
