<?php

require_once 'models/PerfilJuridicoModel.php';

class PerfilJuridicoController {

    

    public function perfil() {
        session_start();
        if (!isset($_SESSION['usuario_juridico_id'])) {
            header('Location: /login');
            exit;
        }

        $idUsuario = $_SESSION['usuario_juridico_id'];
        $model = new PerfilJuridicoModel();

        $datos    = $model->getDatos($idUsuario);
        $vacantes = $model->getVacantes($idUsuario);
        $servicios = $model->getServicios($idUsuario);

        require 'views/PerfilJuridico.php';
    }
}

?>