<?php
include_once("../model/bd.php");
include_once("../model/Color.php");

$color = new Color($conexion);

$action = isset($_POST['action']) ? $_POST['action'] : '';
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
$txtColor = isset($_POST['txtColor']) ? $_POST['txtColor'] : '';

if ($action) {
    switch ($action) {
        case 'registrar':
            $datos = [
                'color' => $txtColor
            ];
            $color->registra($datos);
            redirect('color.php');
            break;

        case 'modificar':
            $datos = [
                'id' => $txtID,
                'color' => $txtColor
            ];
            $color->modificar($datos);
            redirect('color.php');
            break;

        case 'cancelar':
            redirect('color.php');
            break;

        case 'seleccionar':
            $colorSeleccionado = $color->seleccionar($txtID);
            header("Location: ../view/section/color.php?" . http_build_query($colorSeleccionado));
            break;

        case 'borrar':
            $color->delete($txtID);
            redirect('color.php');
            break;

        default:
            // Acción no reconocida
            break;    
    }
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
