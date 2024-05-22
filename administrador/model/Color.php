<?php
class Color {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function seleccionar($id) {
        $sql = "SELECT * FROM colores WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($datos) {
        $sql = "INSERT INTO colores (color) VALUES (:color)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute($datos);
    }

    public function modificar($datos) {
        $sql = "UPDATE colores SET color = :color WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute($datos);
    }

    public function borrar($id) {
        $sql = "DELETE FROM colores WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
