<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtMarca=(isset($_POST['txtMarca']))?$_POST['txtMarca']:"";
$txtModelo=(isset($_POST['txtModelo']))?$_POST['txtModelo']:"";
$txtAnio=(isset($_POST['txtAnio']))?$_POST['txtAnio']:"";
$txtColor=(isset($_POST['txtColor']))?$_POST['txtColor']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";

$action=( isset($_POST['action']) ) ? $_POST['action']:"";

include("../../model/bd.php");

if (isset($action) && $action !== "") {
    switch ($action) {
        case 'registrar':
    
            //Ejemplo
            /* $sentenciaSQL = $conexion->prepare("INSERT INTO `carros` (`Id`, `modelo`, `marca`, `anio`, `color`, `imagen`, `precio`) VALUES (NULL, 'chevy', '2', '2018', '2', 'chevy.jpg', '500000')");
            $sentenciaSQL->execute(); */
            //Consulta
            $sentenciaSQL = $conexion->prepare("INSERT INTO `carros` (modelo, marca, anio, color, imagen, precio) VALUES (:modelo, :marca, :anio, :color, :imagen, :precio)");

            //Pasar valores a la sentencia
            $sentenciaSQL->bindParam(':modelo', $txtModelo);
            $sentenciaSQL->bindParam(':marca', $txtMarca);
            $sentenciaSQL->bindParam(':anio', $txtAnio);
            $sentenciaSQL->bindParam(':color', $txtColor);

            //Crear nombre a imagen
            $fecha = new Datetime();
            $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            //subir imagen
            if ($tmpImagen!="") {
                move_uploaded_file($tmpImagen,"../view/img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':precio', $txtPrecio);
            $sentenciaSQL->execute();
            //redirigir 
            header("Location: ../view/section/carros.php");
            exit();
    
            break;
    
        case 'modificar':
            //consulta
            $sentenciaSQL = $conexion->prepare("UPDATE carros SET modelo= :modelo, marca = :marca, anio = :anio, color = :color, precio = :precio WHERE id = :id");
            //pasar valores
            $sentenciaSQL->bindParam(':modelo', $txtModelo);
            $sentenciaSQL->bindParam(':marca', $txtMarca);
            $sentenciaSQL->bindParam(':anio', $txtAnio);
            $sentenciaSQL->bindParam(':color', $txtColor);
            $sentenciaSQL->bindParam(':precio', $txtPrecio);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            //modificar imagen
            if($txtImagen!=""){
                //Subir imagen
                $fecha = new Datetime();
                $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

                $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
                move_uploaded_file($tmpImagen,"../view/img/".$nombreArchivo);

                //Eliminar imagen anterior
                $sql_car =$conexion->prepare("SELECT imagen FROM carros WHERE id=:id");
                $sql_car->bindParam(':id',$txtID);
                $sql_car->execute();
                $carro=$sql_car->fetch(PDO::FETCH_LAZY);

                if (isset($carro["imagen"]) && ($carro["imagen"]!="imagen.jpg")) {

                    if (file_exists("../view/img/".$carro["imagen"])) {

                        unlink("../view/img/".$carro["imagen"]);
                    }
                }
                //Actualizar nombre
                $sentenciaSQL = $conexion->prepare("UPDATE carros SET imagen=:imagen WHERE id = :id");
                $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
            }

            
            // Redireccionar
            header("Location: ../view/section/carros.php");
            exit();
            break;
    
        case 'cancelar':
            header("Location: ../view/section/carros.php");
            exit();
            break;

        case 'seleccionar':
            //consulta
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

            header("Location: ../view/section/carros.php?txtID=$txtID&txtMarca=$txtMarca&txtModelo=$txtModelo&txtAnio=$txtAnio&txtColor=$txtColor&txtPrecio=$txtPrecio&txtImagen=$txtImagen");
            exit();

            break;

        case 'borrar':
            //consulta
            $sql_car =$conexion->prepare("SELECT imagen FROM carros WHERE id=:id");
            $sql_car->bindParam(':id',$txtID);
            $sql_car->execute();
            $carro=$sql_car->fetch(PDO::FETCH_LAZY);
            //quitar vinculo de imagen
            if (isset($carro["imagen"]) && ($carro["imagen"]!="imagen.jpg")) {

                if (file_exists("../view/img/".$carro["imagen"])) {

                    unlink("../view/img/".$carro["imagen"]);
                }
            }
            //eliminar registro completo
            $elim_car = $conexion->prepare("DELETE FROM `carros` WHERE id=:id");
            $elim_car->bindParam(':id',$txtID);
            $elim_car->execute();
            
            header("Location: ../view/section/carros.php");
            exit();
            break;

        default:
            // Acción no reconocida
            break;
    }
}
?>
