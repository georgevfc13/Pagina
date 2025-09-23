<?php 
class PerfilJuridicoModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getDatos($idUsuario) {
        $query = $this->db->getConnection()->prepare("SELECT * FROM usuarios_juridicos WHERE id = :id");
        $query->execute(['id' => $idUsuario]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getVacantes($idUsuario) {
        $query = $this->db->getConnection()->prepare("SELECT * FROM vacantes WHERE id_usuario = :id");
        $query->execute(['id' => $idUsuario]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicios($idUsuario) {
        $query = $this->db->getConnection()->prepare("SELECT * FROM servicios WHERE id_usuario = :id");
        $query->execute(['id' => $idUsuario]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
 
?>