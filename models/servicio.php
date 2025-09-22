<?php
require_once __DIR__ . '/../config/dataBase.php';

class Servicio {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Actualiza un servicio existente
     * @param int $id
     * @param array $data
     * @return bool|string
     */
    public function editarServicio($id, $data) {
        try {
            $sql = "UPDATE servicios SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, tipo = :tipo, empresa = :empresa, precio = :precio WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':precio', $data['precio']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Elimina un servicio por su ID
     * @param int $id
     * @return bool|string
     */
    public function eliminarServicio($id) {
        try {
            $sql = "DELETE FROM servicios WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
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
