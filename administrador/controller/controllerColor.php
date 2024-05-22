<?php
include_once("../model/bd.php");
include_once("../model/Color.php");

$color = new Color($conexion);

$action = isset($_POST['action']) ? $_POST['action'] : '';
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
$txtColor = isset($_POST['txtColor']) ? $_POST['txtColor'] : '';

if ($action) {
    if (function_exists($action)) {
        $action();
    }
}

function registrar() {
    global $txtColor, $color;
    $datos = [
        'color' => $txtColor
    ];
    $color->registra($datos);
    redirect('color.php');
}

function modificar() {
    global $txtID, $txtColor, $color;
    $datos = [
        'id' => $txtID,
        'color' => $txtColor
    ];
    $color->modificar($datos);
    redirect('color.php');
}

function cancelar() {
    redirect('color.php');
}

function seleccionar() {
    global $txtID, $color;
    $colorSeleccionado = $color->seleccionar($txtID);
    redirect('color.php', $colorSeleccionado);
}

function borrar() {
    global $txtID, $color;
    $color->borrar($txtID);
    redirect('color.php');
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
