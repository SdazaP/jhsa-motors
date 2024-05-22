<?php
include_once("../model/bd.php");
include_once("../model/Marca.php");

$marca = new Marca($conexion);


$action = isset($_POST['action']) ? $_POST['action'] : '';
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
$txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : '';

if($action){
    switch ($action) {
        case 'registrar':
            $datos = [
                'nombre' => $txtNombre
            ];
            $marca->registrar($datos);
            redirect('marca.php');
            break;

        case 'modificar':
            $datos = [
                'id' => $txtID,
                'nombre' => $txtNombre
            ];
            $marca->modificar($datos);
            redirect('marca.php');
            break;

        case 'cancelar':
            redirect('marca.php');
            break;

        case 'seleccionar':
            $marcaSeleccionada = $marca->seleccionar($txtID);
            header("Location: ../view/section/marca.php?" . http_build_query($marcaSeleccionada));
            break;

        case 'borrar':
            $marca->delete($txtID);
            $this->redirect('marca.php');
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
?>
