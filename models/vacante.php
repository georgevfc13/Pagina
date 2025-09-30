<?php
require_once __DIR__ . '/../config/dataBase.php';

class Vacante {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getVacantesByUsuario($usuarioId) {
        $sql = "SELECT * FROM vacantes WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarVacantePropia($id, $usuarioId) {
        $sqlAplicaciones = "DELETE FROM aplicaciones WHERE vacante_id = :id";
        $stmtAplicaciones = $this->conn->prepare($sqlAplicaciones);
        $stmtAplicaciones->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtAplicaciones->execute();
        $sql = "DELETE FROM vacantes WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function editarVacantePropia($id, $data, $usuarioId) {
        $sql = "UPDATE vacantes SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, tipo = :tipo, empresa = :empresa, salario = :salario WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':empresa', $data['empresa']);
        $stmt->bindParam(':salario', $data['salario']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }

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

    public function eliminarVacante($id) {
        try {
            $sqlAplicaciones = "DELETE FROM aplicaciones WHERE vacante_id = :id";
            $stmtAplicaciones = $this->conn->prepare($sqlAplicaciones);
            $stmtAplicaciones->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtAplicaciones->execute();
            $sql = "DELETE FROM vacantes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Registra una vacante incluyendo el tipo de usuario que la publica
    public function registrar($data) {
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
            // Incrementar el contador de aplicados
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
