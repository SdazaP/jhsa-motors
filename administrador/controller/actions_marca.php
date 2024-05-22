<?php
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
$txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$action = isset($_POST['action']) ? $_POST['action'] : "";

include("../../model/bd.php");

if (isset($action) && $action !== "") {
    switch ($action) {
        case 'registrar':
            $sentenciaSQL = $conexion->prepare("INSERT INTO marca (nombre) VALUES (:nombre)");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->execute();
            header("Location: ../view/section/marca.php");
            exit();

        case 'modificar':
            $sentenciaSQL = $conexion->prepare("UPDATE marca SET nombre = :nombre WHERE id = :id");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header("Location: ../view/section/marca.php");
            exit();

        case 'cancelar':
            header("Location: ../view/section/marca.php");
            exit();

        case 'seleccionar':
            $sql_mar = $conexion->prepare("SELECT * FROM marca WHERE id = :id");
            $sql_mar->bindParam(':id', $txtID);
            $sql_mar->execute();
            $marca = $sql_mar->fetch(PDO::FETCH_ASSOC);
            $txtNombre = $marca['nombre'];
            header("Location: ../view/section/marca.php?txtID=$txtID&txtNombre=$txtNombre");
            exit();

        case 'borrar':
            $elim_mar = $conexion->prepare("DELETE FROM marca WHERE id = :id");
            $elim_mar->bindParam(':id', $txtID);
            $elim_mar->execute();
            header("Location: ../view/section/marca.php");
            exit();

        default:
            // Acción no reconocida
            break;
    }
}
?>
