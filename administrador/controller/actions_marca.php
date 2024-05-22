<?php
include_once("../model/bd.php");
include_once("../model/Marca.php");

class MarcaController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Marca($db);
    }

    public function handleRequest() {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : '';
        $txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : '';

        switch ($action) {
            case 'registrar':
                $this->modelo->create($txtNombre);
                $this->redirect('marca.php');
                break;

            case 'modificar':
                $this->modelo->update($txtID, $txtNombre);
                $this->redirect('marca.php');
                break;

            case 'cancelar':
                $this->redirect('marca.php');
                break;

            case 'seleccionar':
                $marca = $this->modelo->getById($txtID);
                $this->redirect('marca.php', $marca);
                break;

            case 'borrar':
                $this->modelo->delete($txtID);
                $this->redirect('marca.php');
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

$controller = new MarcaController($conexion);
$controller->handleRequest();
?>
