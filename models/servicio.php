<?php
require_once __DIR__ . '/../config/dataBase.php';

class Servicio {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Editar servicio (general)
    public function editarServicio($id, $data) {
        try {
            $sql = "UPDATE servicios 
                    SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, 
                        tipo = :tipo, empresa = :empresa, precio = :precio 
                    WHERE id = :id";
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

    // Eliminar servicio (general)
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

    // Registrar un servicio incluyendo el tipo de usuario que lo publica
    public function registrar($data) {
        try {
            $sql = "INSERT INTO servicios 
                    (titulo, descripcion, ubicacion, tipo, empresa, precio, usuario_id, usuario_tipo, icono) 
                    VALUES (:titulo, :descripcion, :ubicacion, :tipo, :empresa, :precio, :usuario_id, :usuario_tipo, :icono)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':precio', $data['precio']);
            $stmt->bindParam(':usuario_id', $data['usuario_id'], PDO::PARAM_INT);
            $stmt->bindParam(':usuario_tipo', $data['usuario_tipo']);
            $stmt->bindParam(':icono', $data['icono']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Servicios publicados por un usuario
    public function getServiciosByUsuario($usuarioId) {
        $sql = "SELECT * FROM servicios WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar servicio propio (usuario autenticado)
    public function eliminarServicioPropio($id, $usuarioId) {
        $sql = "DELETE FROM servicios WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Editar servicio propio
    public function editarServicioPropio($id, $data) {
        try {
            $sql = "UPDATE servicios 
                    SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, 
                        tipo = :tipo, empresa = :empresa, precio = :precio, icono = :icono 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':tipo', $data['tipo']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':precio', $data['precio']);
            $stmt->bindParam(':icono', $data['icono']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Traer todos los servicios (ej. página principal)
    public function getAllServicios($limit = null) {
        try {
            $sql = "SELECT * FROM servicios ORDER BY id DESC";
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
