<?php
class Carro {
    private $conexion;

    public function __construct($bd) {
        $this->conexion = $bd;
    }

    public function registrar($datos) {
        $sentenciaSQL = $this->conexion->prepare("INSERT INTO carros (modelo, marca, anio, color, imagen, precio) VALUES (:modelo, :marca, :anio, :color, :imagen, :precio)");
        return $sentenciaSQL->execute($datos);
    }

    public function modificar($datos) {
        $sentenciaSQL = $this->conexion->prepare("UPDATE carros SET modelo = :modelo, marca = :marca, anio = :anio, color = :color, precio = :precio WHERE id = :id");
        return $sentenciaSQL->execute($datos);
    }

    public function seleccionar($id) {
        $sql_car = $this->conexion->prepare("SELECT * FROM carros WHERE id = :id");
        $sql_car->bindParam(':id', $id);
        $sql_car->execute();
        return $sql_car->fetch(PDO::FETCH_ASSOC);
    }

    public function borrar($id) {
        $sql_car = $this->conexion->prepare("SELECT imagen FROM carros WHERE id = :id");
        $sql_car->bindParam(':id', $id);
        $sql_car->execute();
        $carro = $sql_car->fetch(PDO::FETCH_ASSOC);

        if (isset($carro["imagen"]) && $carro["imagen"] != "imagen.jpg") {
            if (file_exists("../view/img/" . $carro["imagen"])) {
                unlink("../view/img/" . $carro["imagen"]);
            }
        }

        $elim_car = $this->conexion->prepare("DELETE FROM carros WHERE id = :id");
        $elim_car->bindParam(':id', $id);
        return $elim_car->execute();
    }
}
?>
