<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtMarca=(isset($_POST['txtMarca']))?$_POST['txtMarca']:"";
$txtModelo=(isset($_POST['txtModelo']))?$_POST['txtModelo']:"";
$txtAnio=(isset($_POST['txtAnio']))?$_POST['txtAnio']:"";
$txtColor=(isset($_POST['txtColor']))?$_POST['txtColor']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";

$action=( isset($_POST['action']) ) ? $_POST['action']:"";

include("../config/bd.php");

if (isset($action) && $action !== "") {
    switch ($action) {
        case 'registrar':
    
            //Ejemplo
            /* $sentenciaSQL = $conexion->prepare("INSERT INTO `carros` (`Id`, `modelo`, `marca`, `anio`, `color`, `imagen`, `precio`) VALUES (NULL, 'chevy', '2', '2018', '2', 'chevy.jpg', '500000')");
            $sentenciaSQL->execute(); */
            $sentenciaSQL = $conexion->prepare("INSERT INTO `carros` (modelo, marca, anio, color, imagen, precio) VALUES (:modelo, :marca, :anio, :color, :imagen, :precio)");
            $sentenciaSQL->bindParam(':modelo', $txtModelo);
            $sentenciaSQL->bindParam(':marca', $txtMarca);
            $sentenciaSQL->bindParam(':anio', $txtAnio);
            $sentenciaSQL->bindParam(':color', $txtColor);
            $sentenciaSQL->bindParam(':imagen', $txtImagen);
            $sentenciaSQL->bindParam(':precio', $txtPrecio);
            $sentenciaSQL->execute();

            header("Location: ../section/carros.php");
            exit();
    
            break;
    
        case 'modificar':
            echo "presionado modificar";
            break;
    
        case 'cancelar':
             echo "presionado cancelar";
            break;

        case 'seleccionar':

            $sql_car =$conexion->prepare("SELECT * FROM carros WHERE id=:id");
            $sql_car->bindParam(':id',$txtID);
            $sql_car->execute();
            $carro=$sql_car->fetchAll(PDO::FETCH_ASSOC);
            $carro = $carro[0]; //para acceder si o si al elemento que selecciono

            $txtMarca = $carro['marca'];
            $txtModelo = $carro['modelo'];
            $txtAnio = $carro['anio'];
            $txtColor = $carro['color'];
            $txtPrecio = $carro['precio'];
            $txtImagen = $carro['imagen'];

            header("Location: ../section/carros.php?txtMarca=$txtMarca&txtModelo=$txtModelo&txtAnio=$txtAnio&txtColor=$txtColor&txtPrecio=$txtPrecio&txtImagen=$txtImagen");
            exit();

            break;

        case 'borrar':
            $elim_car = $conexion->prepare("DELETE FROM `carros` WHERE id=:id");
            $elim_car->bindParam(':id',$txtID);
            $elim_car->execute();
            
            header("Location: ../section/carros.php");
            exit();
            break;

        default:
            // Acción no reconocida
            break;
    }
}
?>
