<?php
class Color {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM colores";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM colores WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($color) {
        $sql = "INSERT INTO colores (color) VALUES (:color)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':color', $color);
        $stmt->execute();
    }

    public function update($id, $color) {
        $sql = "UPDATE colores SET color = :color WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM colores WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
