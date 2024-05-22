<?php
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
$txtColor = isset($_POST['txtColor']) ? $_POST['txtColor'] : "";
$action = isset($_POST['action']) ? $_POST['action'] : "";

include("../../model/bd.php");

if (isset($action) && $action !== "") {
    switch ($action) {
        case 'registrar':
            $sentenciaSQL = $conexion->prepare("INSERT INTO colores (color) VALUES (:color)");
            $sentenciaSQL->bindParam(':color', $txtColor);
            $sentenciaSQL->execute();
            header("Location: ../view/section/color.php");
            exit();

        case 'modificar':
            $sentenciaSQL = $conexion->prepare("UPDATE colores SET color = :color WHERE id = :id");
            $sentenciaSQL->bindParam(':color', $txtColor);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header("Location: ../view/section/color.php");
            exit();

        case 'cancelar':
            header("Location: ../view/section/color.php");
            exit();

        case 'seleccionar':
            $sql_col = $conexion->prepare("SELECT * FROM colores WHERE id = :id");
            $sql_col->bindParam(':id', $txtID);
            $sql_col->execute();
            $color = $sql_col->fetch(PDO::FETCH_ASSOC);
            $txtColor = $color['color'];
            header("Location: ../view/section/color.php?txtID=$txtID&txtColor=$txtColor");
            exit();

        case 'borrar':
            $elim_col = $conexion->prepare("DELETE FROM colores WHERE id = :id");
            $elim_col->bindParam(':id', $txtID);
            $elim_col->execute();
            header("Location: ../view/section/color.php");
            exit();

        default:
            // Acción no reconocida
            break;
    }
}
?>
