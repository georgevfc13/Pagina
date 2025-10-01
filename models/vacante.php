<?php
// models/Vacante.php
require_once __DIR__ . '/../config/dataBase.php';

class Vacante {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // ---------------------------
    // REGISTRAR VACANTE
    // ---------------------------
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

    // ---------------------------
    // OBTENER VACANTES
    // ---------------------------
    public function getVacantes($limit = null) {
        try {
            $sql = "SELECT * FROM vacantes ORDER BY id DESC";
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // ---------------------------
    // ELIMINAR VACANTE PROPIA
    // ---------------------------
    public function eliminarVacantePropia($id, $usuario_id) {
        try {
            // Verificar que el usuario sea el propietario
            $sqlCheck = "SELECT usuario_id FROM vacantes WHERE id = :id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtCheck->execute();
            $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            if (!$row || $row['usuario_id'] != $usuario_id) {
                return "No tienes permisos para eliminar esta vacante.";
            }

            $sql = "DELETE FROM vacantes WHERE id = :id AND usuario_id = :usuario_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ---------------------------
    // YA APLICÓ
    // ---------------------------
    public function yaAplico($vacante_id, $usuario_id) {
        $sql = "SELECT COUNT(*) FROM aplicaciones WHERE vacante_id = :vacante_id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':vacante_id', $vacante_id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // ---------------------------
    // APLICAR A VACANTE
    // ---------------------------
    public function aplicar($vacante_id, $usuario_id) {
        if (!$usuario_id) {
            return "Usuario no autenticado";
        }
        try {
            if ($this->yaAplico($vacante_id, $usuario_id)) {
                return "Ya aplicaste a esta vacante";
            }

            $this->conn->beginTransaction();

            $sql = "INSERT INTO aplicaciones (vacante_id, usuario_id, fecha_aplicacion) 
                    VALUES (:vacante_id, :usuario_id, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vacante_id', $vacante_id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->execute();

            $sql2 = "UPDATE vacantes SET aplicados = aplicados + 1 WHERE id = :id";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(':id', $vacante_id, PDO::PARAM_INT);
            $stmt2->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return $e->getMessage();
        }
    }

    // ---------------------------
    // EDITAR VACANTE
    // ---------------------------
    public function editarVacante($id, $data) {
        try {
            // Verificar que el usuario sea el propietario
            $sqlCheck = "SELECT usuario_id FROM vacantes WHERE id = :id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtCheck->execute();
            $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            if (!$row || $row['usuario_id'] != $data['usuario_id']) {
                return "No tienes permisos para editar esta vacante.";
            }

            $sql = "UPDATE vacantes SET 
                        titulo = :titulo, 
                        descripcion = :descripcion, 
                        ubicacion = :ubicacion, 
                        tipo = :tipo, 
                        empresa = :empresa,
                        salario = :salario 
                    WHERE id = :id AND usuario_id = :usuario_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $data['usuario_id'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ---------------------------
    // OBTENER UNA VACANTE POR ID
    // ---------------------------
    public function getById($id) {
        $sql = "SELECT * FROM vacantes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
