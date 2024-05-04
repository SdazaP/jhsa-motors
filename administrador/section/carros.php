<?php include("../template/header.php")?>
<?php 
/* print_r($_POST);
print_r($_FILES) */
$txtMarca=(isset($_POST['txtMarca']))?$_POST['txtMarca']:"";
$txtModelo=(isset($_POST['txtModelo']))?$_POST['txtModelo']:"";
$txtAnio=(isset($_POST['txtAnio']))?$_POST['txtAnio']:"";
$txtColor=(isset($_POST['txtColor']))?$_POST['txtColor']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$action=(isset($_POST['action']))?$_POST['action']:"";

/* echo $txtID."<br/>";
echo $txtMarca."<br/>";
echo $txtAnio."<br/>";
echo $txtColor."<br/>";
echo $txtModelo."<br/>";
echo $txtImagen."<br/>";
echo $action."<br/>"; */

/* switch ($action) {
    case 'registrar':
        echo "presionado registrar";
        break;
    case 'modificar':
        echo "presionado modificar";
        break;
    case 'cancelar':
         echo "presionado cancelar";
        break;
} */

include("../config/bd.php");

// Consulta SQL para obtener los colores
$sql_col = "SELECT id, color FROM colores";
$result_col = $conexion->query($sql_col);

$sql_mar = "SELECT id, nombre FROM marca";
$result_mar = $conexion->query($sql_mar);

switch ($action) {
    case 'registrar':

        
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

        echo "presionado registrar";
        break;
    case 'modificar':
        echo "presionado modificar";
        break;
    case 'cancelar':
         echo "presionado cancelar";
        break;
}

?>



    <div class="col-md-5">

        <div class="card">
            <div class="card-header">
                    Datos de carros
            </div>
        </div>   

        <form method="POST" enctype="multipart/form-data">

            

            <div class ="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">ID</label>
                <input type="text" class="form-control"  placeholder="ID automatico" disabled>
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Marca</label>
                <select class="form-select" name="txtMarca" id="marca">
                    <option selected>Selecciona</option>
                    <?php
                    // Iterar sobre los resultados y crear opciones del menú desplegable
                    while ($row = $result_mar->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Modelo</label>
                <input type="text" class="form-control" name="txtModelo" id="modelo" placeholder="Modelo">
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Año</label>
                <input type="text" class="form-control" name="txtAnio" id="año" placeholder="AAAA">
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Color</label>
                <select class="form-select" name="txtColor" id="color">
                    <option selected>Selecciona</option>
                    <?php
                    // Iterar sobre los resultados y crear opciones del menú desplegable
                    while ($row = $result_col->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["color"] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Precio</label>
                <input type="text" class="form-control" name="txtPrecio" id="precio" placeholder="$">
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input type="file" class="form-control" name="txtImagen" id="año" placeholder="xxxx">
            </div>
            
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="action" value="registrar" class="btn btn-success">Registrar</button>
                <button type="submit" name="action" value="modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="action" value="cancelar" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
        
        
    </div>
    <div class="col-md-7">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
            </tbody>
        </table>
    </div>
<?php include("../template/footer.php")?>
