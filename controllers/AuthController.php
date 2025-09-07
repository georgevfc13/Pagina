<?php
require_once __DIR__ . '/../config/dataBase.php';
class AuthController {
    public static function register() {
        $tipo = $_POST['registerTipo'] ?? '';
        $db = getDB();
        try {
            if ($tipo === 'natural') {
                $nombre = $_POST['nombre'] ?? '';
                $apellidos = $_POST['apellidos'] ?? '';
                $cedula = $_POST['cedula'] ?? '';
                $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
                $genero = $_POST['genero'] ?? '';
                $contactoTipo = $_POST['contactoTipo'] ?? '';
                $contacto = $_POST['contacto'] ?? '';
                $password = password_hash($_POST['passwordNatural'] ?? '', PASSWORD_DEFAULT);
                $acepta = isset($_POST['aceptaTerminosNatural']) ? 1 : 0;
                // Validar duplicidad de cédula
                $check = $db->prepare("SELECT id FROM persona_natural WHERE cedula = ?");
                $check->execute([$cedula]);
                if ($check->fetch()) {
                    header('Location: ../views/login.php?error=cedula');
                    exit();
                }
                $stmt = $db->prepare("INSERT INTO persona_natural (nombre, apellidos, cedula, fecha_nacimiento, genero, contacto_tipo, contacto, password, acepta_terminos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nombre, $apellidos, $cedula, $fechaNacimiento, $genero, $contactoTipo, $contacto, $password, $acepta]);
            } else if ($tipo === 'juridica') {
                $razonSocial = $_POST['razonSocial'] ?? '';
                $correo = $_POST['correoJuridica'] ?? '';
                $password = password_hash($_POST['passwordJuridica'] ?? '', PASSWORD_DEFAULT);
                $acepta = isset($_POST['aceptaTerminosJuridica']) ? 1 : 0;
                // Validar duplicidad de correo
                $check = $db->prepare("SELECT id FROM persona_juridica WHERE correo_contacto = ?");
                $check->execute([$correo]);
                if ($check->fetch()) {
                    header('Location: ../views/login.php?error=correo');
                    exit();
                }
                $stmt = $db->prepare("INSERT INTO persona_juridica (razon_social, correo_contacto, password, acepta_terminos) VALUES (?, ?, ?, ?)");
                $stmt->execute([$razonSocial, $correo, $password, $acepta]);
            }
            header('Location: ../views/login.php?registro=ok');
            exit();
        } catch (Exception $e) {
            header('Location: ../views/login.php?error=bd');
            exit();
        }
    }
    public static function login() {
        $tipo = $_POST['loginTipo'] ?? '';
        $db = getDB();
        if ($tipo === 'natural') {
            $cedula = $_POST['loginCedula'] ?? '';
            $password = $_POST['loginPassword'] ?? '';
            $stmt = $db->prepare("SELECT * FROM persona_natural WHERE cedula = ?");
            $stmt->execute([$cedula]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: ../views/home.php');
                exit();
            }
        } else if ($tipo === 'juridica') {
            $correo = $_POST['loginCorreo'] ?? '';
            $password = $_POST['loginPasswordJuridica'] ?? '';
            $stmt = $db->prepare("SELECT * FROM persona_juridica WHERE correo_contacto = ?");
            $stmt->execute([$correo]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: ../views/home.php');
                exit();
            }
        }
        header('Location: ../views/login.php?error=1');
        exit();
    }
}
