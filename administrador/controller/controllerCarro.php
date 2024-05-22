<?php
include("../model/bd.php");
include("../model/Carro.php");

$carro = new Carro($conexion);

$action = (isset($_POST['action'])) ? $_POST['action'] : "";
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtModelo = (isset($_POST['txtModelo'])) ? $_POST['txtModelo'] : "";
$txtAnio = (isset($_POST['txtAnio'])) ? $_POST['txtAnio'] : "";
$txtColor = (isset($_POST['txtColor'])) ? $_POST['txtColor'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";

if ($action) {
    if (function_exists($action)) {
        $action();
    }
}

function registrar() {
    global $txtModelo, $txtMarca, $txtAnio, $txtColor, $txtImagen, $txtPrecio, $carro;
    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
    $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
    if ($tmpImagen != "") {
        move_uploaded_file($tmpImagen, "../view/img/" . $nombreArchivo);
    }
    $datos = [
        'modelo' => $txtModelo,
        'marca' => $txtMarca,
        'anio' => $txtAnio,
        'color' => $txtColor,
        'imagen' => $nombreArchivo,
        'precio' => $txtPrecio
    ];
    $carro->registrar($datos);
    header("Location: ../view/section/carros.php");
    exit();
}

function modificar() {
    global $txtID, $txtModelo, $txtMarca, $txtAnio, $txtColor, $txtImagen, $txtPrecio, $carro;
    $datos = [
        'id' => $txtID,
        'modelo' => $txtModelo,
        'marca' => $txtMarca,
        'anio' => $txtAnio,
        'color' => $txtColor,
        'precio' => $txtPrecio
    ];
    $carro->modificar($datos);
    if ($txtImagen != "") {
        $fecha = new DateTime();
        $nombreArchivo = $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"];
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        move_uploaded_file($tmpImagen, "../view/img/" . $nombreArchivo);
        $carro->modificar(['id' => $txtID, 'imagen' => $nombreArchivo]);
    }
    header("Location: ../view/section/carros.php");
    exit();
}

function seleccionar() {
    global $txtID, $carro;
    $carroSeleccionado = $carro->seleccionar($txtID);
    header("Location: ../view/section/carros.php?" . http_build_query($carroSeleccionado));
    exit();
}

function borrar() {
    global $txtID, $carro;
    $carro->borrar($txtID);
    header("Location: ../view/section/carros.php");
    exit();
}

function cancelar() {
    header("Location: ../view/section/carros.php");
    exit();
}
?>
