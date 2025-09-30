<?php
require_once __DIR__ . '/../config/dataBase.php';

class Vacante {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // 🔹 Obtener TODAS las vacantes (con o sin límite)
    public function getVacantes($limit = null) {
        $sql = "SELECT * FROM vacantes ORDER BY id DESC";
        if ($limit) {
            $sql .= " LIMIT :limit";
        }
        $stmt = $this->conn->prepare($sql);

        if ($limit) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener vacantes por usuario
    public function getVacantesByUsuario($usuarioId) {
        $sql = "SELECT * FROM vacantes WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Registrar nueva vacante
    public function registrar($data) {
        try {
            $sql = "INSERT INTO vacantes 
                (titulo, descripcion, ubicacion, tipo, empresa, salario, usuario_id, usuario_tipo, icono) 
                VALUES (:titulo, :descripcion, :ubicacion, :tipo, :empresa, :salario, :usuario_id, :usuario_tipo, :icono)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':usuario_id', $data['usuario_id'], PDO::PARAM_INT);
            $stmt->bindParam(':usuario_tipo', $data['usuario_tipo']);
            $stmt->bindParam(':icono', $data['icono']);

            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // 🔹 Editar vacante
    public function editarVacante($id, $data) {
        try {
            $sql = "UPDATE vacantes 
                    SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, 
                        tipo = :tipo, empresa = :empresa, salario = :salario 
                    WHERE id = :id";
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

    // Eliminar vacante del usuario
    public function eliminarVacantePropia($id, $usuarioId) {
        try {
            $sqlAplicaciones = "DELETE FROM aplicaciones WHERE vacante_id = :id";
            $stmtAplicaciones = $this->conn->prepare($sqlAplicaciones);
            $stmtAplicaciones->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtAplicaciones->execute();

            $sql = "DELETE FROM vacantes WHERE id = :id AND usuario_id = :usuario_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // 🔹 Aplicar a vacante
    public function aplicar($vacante_id, $usuario_id = null) {
        try {
            $sql = "INSERT INTO aplicaciones (vacante_id, usuario_id) VALUES (:vacante_id, :usuario_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vacante_id', $vacante_id);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();

            $sql2 = "UPDATE vacantes SET aplicados = aplicados + 1 WHERE id = :id";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(':id', $vacante_id);
            $stmt2->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
