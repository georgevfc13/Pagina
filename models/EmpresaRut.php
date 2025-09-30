<?php
class EmpresaRut
{
    private $conn;
    private $table = "empresa_rut";

    // Propiedades que corresponden a las columnas de la tabla
    public $nit;
    public $razon_social;
    public $direccion;
    public $contacto;       // puede ser correo o celular
    public $tipo_contacto;  // 'correo' o 'celular'
    public $password;
    public $terminos;
    public $foto_perfil;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Iniciar sesión: busca por contacto (correo) y verifica contraseña
     */
    public function login($nit, $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE nit = :nit LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nit", $nit);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario; // Datos del usuario
        } elseif ($usuario) {
            return "❌ Contraseña incorrecta";
        } else {
            return "❌ Usuario no encontrado";
        }
    }

    /**
     * Verifica si ya existe un registro con el mismo NIT
     */
    public function existeNIT($nit)
    {
        $sql = "SELECT id FROM {$this->table} WHERE nit = :nit LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nit", $nit);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    /**
     * Registra una nueva empresa
     */
    public function registrar()
    {
        if ($this->existeNIT($this->nit)) {
            return "⚠️ La empresa con este NIT ya está registrada";
        }

        $sql = "INSERT INTO {$this->table}
                (nit, razon_social, direccion, contacto, tipo_contacto, password, terminos, foto_perfil)
                VALUES
                (:nit, :razon_social, :direccion, :contacto, :tipo_contacto, :password, :terminos, :foto_perfil)";

        $stmt = $this->conn->prepare($sql);

        // Sanitizar y preparar
        $this->nit           = htmlspecialchars(strip_tags($this->nit));
        $this->razon_social  = htmlspecialchars(strip_tags($this->razon_social));
        $this->direccion     = htmlspecialchars(strip_tags($this->direccion));
        $this->contacto      = htmlspecialchars(strip_tags($this->contacto));
        $this->tipo_contacto = htmlspecialchars(strip_tags($this->tipo_contacto));
        $this->password      = password_hash($this->password, PASSWORD_DEFAULT); // HASH seguro
        $this->terminos      = intval($this->terminos);
        $this->foto_perfil   = htmlspecialchars(strip_tags($this->foto_perfil));

        // Bind con PDO
        $stmt->bindParam(":nit", $this->nit);
        $stmt->bindParam(":razon_social", $this->razon_social);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":contacto", $this->contacto);
        $stmt->bindParam(":tipo_contacto", $this->tipo_contacto);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":terminos", $this->terminos);
        $stmt->bindParam(":foto_perfil", $this->foto_perfil);

        return $stmt->execute() ? true : false;
    }

    /**
     * Obtener datos de una empresa por ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
