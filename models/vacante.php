<?php
require_once __DIR__ . '/../config/dataBase.php';

class Vacante {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Inserta una nueva vacante en la base de datos
     * @param array $data Datos de la vacante
     * @return bool|string true si se inserta, mensaje de error si falla
     */
    public function registrar($data) {
        try {
            $sql = "INSERT INTO vacantes (titulo, descripcion, ubicacion, tipo, empresa, salario, vacantes_disponibles) VALUES (:titulo, :descripcion, :ubicacion, :tipo, :empresa, :salario, :vacantes_disponibles)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':vacantes_disponibles', $data['vacantes_disponibles']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Registra una aplicación a una vacante y aumenta el contador
     * @param int $vacante_id
     * @param int|null $usuario_id
     * @return bool|string
     */
    public function aplicar($vacante_id, $usuario_id = null) {
        try {
            // Registrar aplicación
            $sql = "INSERT INTO aplicaciones (vacante_id, usuario_id) VALUES (:vacante_id, :usuario_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vacante_id', $vacante_id);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            // Actualizar contador de vacantes_disponibles
            $sql2 = "UPDATE vacantes SET vacantes_disponibles = vacantes_disponibles + 1 WHERE id = :vacante_id";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(':vacante_id', $vacante_id);
            $stmt2->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
