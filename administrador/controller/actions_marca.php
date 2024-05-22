<?php
include_once("../model/bd.php");
include_once("../model/Marca.php");

$marca = new Marca($conexion);

$action = isset($_POST['action']) ? $_POST['action'] : '';
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
$txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : '';

if ($action) {
    if (function_exists($action)) {
        $action();
    }
}

function registrar() {
    global $txtNombre, $marca;
    $datos = [
        'nombre' => $txtNombre
    ];
    $marca->registrar($datos);
    redirect('marca.php');
}

function modificar() {
    global $txtID, $txtNombre, $marca;
    $datos = [
        'id' => $txtID,
        'nombre' => $txtNombre
    ];
    $marca->modificar($datos);
    redirect('marca.php');
}

function cancelar() {
    redirect('marca.php');
}

function seleccionar() {
    global $txtID, $marca;
    $marcaSeleccionada = $marca->seleccionar($txtID);
    redirect('marca.php', $marcaSeleccionada);
}

function borrar() {
    global $txtID, $marca;
    $marca->borrar($txtID);
    redirect('marca.php');
}

function redirect($url, $data = null) {
    if ($data) {
        $query = http_build_query($data);
        header("Location: ../view/section/$url?$query");
    } else {
        header("Location: ../view/section/$url");
    }
    exit();
}
?>
