<?php
class Marca {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function seleccionar($id) {
        $sql = "SELECT * FROM marca WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($datos) {
        $sql = "INSERT INTO marca (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute();
    }

    public function modificar($datos) {
        $sql = "UPDATE marca SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute($datos);
    }

    public function borrar($id) {
        $sql = "DELETE FROM marca WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
