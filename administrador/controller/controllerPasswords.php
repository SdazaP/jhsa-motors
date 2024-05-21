<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
/* include("../model/bd.php");
    $consulta = "SELECT id, contrasenia FROM usuarios";
    $resultado = $conexion->query($consulta);

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $id = $fila['id'];
        $contrasena = $fila['contrasenia'];
        //encriptar
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

        $actualizacion = "UPDATE usuarios SET contrasenia = '$contrasena_encriptada' WHERE id = $id";
        $conexion->query($actualizacion);
    }
 */
?>