<?php include("../template/header.php")?>
<?php 
/* print_r($_POST);
print_r($_FILES) */

session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: ../index.php');
        exit;
    }

include("../../model/bd.php");

// Consultas
$sql_col = "SELECT id, color FROM colores";
$result_col = $conexion->query($sql_col);

$sql_mar = "SELECT id, nombre FROM marca";
$result_mar = $conexion->query($sql_mar);

$sql_car =$conexion->prepare("SELECT * FROM carros");
$sql_car->execute();
$listaCarros=$sql_car->fetchAll(PDO::FETCH_ASSOC);


// Debugging los parámetros GET
/* if (isset($_GET)) {
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';
}
 */
?>



    <div class="col-md-5">

        <div class="card">
            <div class="card-header">
                    Datos de carros
            </div>
        </div>   

        <form method="POST" enctype="multipart/form-data" action="../../controller/actions_carro.php">

            <div class ="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">ID</label>
                <input type="hidden" class="form-control" id="id" name="txtID" value="<?php
                if (isset($_GET['Id'])) {
                    $txtID = $_GET['Id'];
                    echo $txtID;
                }
                ?>" placeholder="ID automatico">
                <input type="text" class="form-control" id="id" name="txtID" value="<?php
                if (isset($_GET['Id'])) {
                    $txtID = $_GET['Id'];
                    echo $txtID;
                }
                ?>" placeholder="ID automatico" disabled>
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Marca</label>
                <select class="form-select" name="txtMarca" id="marca">
                    <option selected>Selecciona</option>
                    <?php
                    while ($row = $result_mar->fetch(PDO::FETCH_ASSOC)) {
                        $selected = '';
                        if (isset($_GET['marca']) && $_GET['marca'] == $row['id']) {
                            $selected = 'selected';
                        }
                        echo "<option value='" . $row["id"] . "' $selected>" . $row["nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Modelo</label>
                <input type="text" class="form-control" value="<?php
                if (isset($_GET['modelo'])) {
                    $txtModelo = $_GET['modelo'];
                    echo $txtModelo;
                }
                ?>" name="txtModelo" id="modelo" placeholder="Modelo">
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Año</label>
                <input type="text" class="form-control" value="<?php
                if (isset($_GET['anio'])) {
                    $txtAnio = $_GET['anio'];
                    echo $txtAnio;
                }
                ?>" name="txtAnio" id="año" placeholder="AAAA">
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Color</label>
                <select class="form-select" name="txtColor" id="color">
                    <option selected>Selecciona</option>
                    <?php
                    while ($row = $result_col->fetch(PDO::FETCH_ASSOC)) {
                        $selected = '';
                        if (isset($_GET['color']) && $_GET['color'] == $row['id']) {
                            $selected = 'selected';
                        }
                        echo "<option value='" . $row["id"] . "' $selected>" . $row["color"] . "</option>";
                    }
                    ?>
                </select>
            </div>




            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Precio</label>
                <input type="text" class="form-control" value="<?php
                if (isset($_GET['precio'])) {
                    $txtPrecio = $_GET['precio'];
                    echo $txtPrecio;
                }
                ?>" name="txtPrecio" id="precio" placeholder="$">
            </div>

            <div class="form-group input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Imagen</label>
                <input type="file" class="form-control" value="<?php
                if (isset($_GET['imagen'])) {
                    $txtImagen = $_GET['imagen'];
                    echo $txtImagen;
                }?>" name="txtImagen" id="año" placeholder="xxxx">
            </div>
            
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="action" value="registrar" class="btn btn-success">Registrar</button>
                <button type="submit" name="action" value="modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="action" value="cancelar" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
        
        
    </div>
    <div class="col-md-7">
    <?php
        function obtenerMarcaPorId($marcaId, $conexion)
        {
            $sql = "SELECT nombre FROM marca WHERE id = :marcaId";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':marcaId', $marcaId, PDO::PARAM_INT);
            $stmt->execute();
            $marca = $stmt->fetch(PDO::FETCH_ASSOC);
            return $marca['nombre'];
        }
        function obtenerColorPorId($colorId, $conexion)
        {
            $sql = "SELECT color FROM colores WHERE id = :colorId";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':colorId', $colorId, PDO::PARAM_INT);
            $stmt->execute();
            $marca = $stmt->fetch(PDO::FETCH_ASSOC);
            return $marca['color'];
        }
    ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($listaCarros as $carro) { ?>
                <tr>
                    <td><?php echo $carro['Id']; ?></td>
                    <td><?php echo obtenerMarcaPorId($carro['marca'], $conexion); ?></td>
                    <td><?php echo $carro['modelo']; ?></td>
                    <td><?php echo $carro['anio']; ?></td>
                    <td><?php  echo obtenerColorPorId($carro['color'], $conexion); ?></td>
                    <td>
                        <img class="img_car" src="../img/<?php echo $carro['imagen']; ?>" alt="">
                        
                    </td>
                    <td><?php echo $carro['precio']; ?></td>

                    <td>

                        <form method="post" enctype="multipart/form-data" action="../../controller/actions_carro.php">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $carro['Id']; ?>"/>

                            <button type="submit" name="action" value="seleccionar" class="btn btn-primary">Seleccionar</button>

                            <button type="submit" name="action" value="borrar" class="btn btn-danger">Borrar</button>
                        </form>

                    </td>
                </tr>
            <?php }?>    
            </tbody>
        </table>
    </div>
<?php include("../template/footer.php")?>
