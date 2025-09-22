<?php
require_once __DIR__ . '/../config/dataBase.php';

class Vacante {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Actualiza una vacante existente
     * @param int $id
     * @param array $data
     * @return bool|string
     */
    public function editarVacante($id, $data) {
        try {
            $sql = "UPDATE vacantes SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, tipo = :tipo, empresa = :empresa, salario = :salario WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Elimina una vacante por su ID
     * @param int $id
     * @return bool|string
     */
    public function eliminarVacante($id) {
        try {
            $sql = "DELETE FROM vacantes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Inserta una nueva vacante en la base de datos
     * @param array $data Datos de la vacante
     * @return bool|string true si se inserta, mensaje de error si falla
     */
    public function registrar($data) {
        try {
            $sql = "INSERT INTO vacantes (titulo, descripcion, ubicacion, tipo, empresa, salario) VALUES (:titulo, :descripcion, :ubicacion, :tipo, :empresa, :salario)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':salario', $data['salario']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
