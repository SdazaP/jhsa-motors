<?php
include_once("../model/bd.php");
include_once("../model/Color.php");

class ColorController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Color($db);
    }

    public function handleRequest() {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
        $txtColor = isset($_POST['txtColor']) ? $_POST['txtColor'] : '';

        switch ($action) {
            case 'registrar':
                $this->modelo->create($txtColor);
                $this->redirect('color.php');
                break;

            case 'modificar':
                $this->modelo->update($txtID, $txtColor);
                $this->redirect('color.php');
                break;

            case 'cancelar':
                $this->redirect('color.php');
                break;

            case 'seleccionar':
                $color = $this->modelo->getById($txtID);
                $this->redirect('color.php', $color);
                break;

            case 'borrar':
                $this->modelo->delete($txtID);
                $this->redirect('color.php');
                break;

            default:
                // Acción no reconocida
                break;
        }
    }

    private function redirect($url, $data = null) {
        if ($data) {
            $query = http_build_query($data);
            header("Location: ../view/section/$url?$query");
        } else {
            header("Location: ../view/section/$url");
        }
        exit();
    }
}

$controller = new ColorController($conexion);
$controller->handleRequest();
?>
