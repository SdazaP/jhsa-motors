<?php include("../template/header.php") ?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}

include("../../model/bd.php");

$sql_col = $conexion->prepare("SELECT * FROM colores");
$sql_col->execute();
$listaColores = $sql_col->fetchAll(PDO::FETCH_ASSOC);

// Debugging los parámetros GET
    /* if (isset($_GET)) {
        echo '<pre>';
        print_r($_GET);
        echo '</pre>';
    } */
?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Datos de Color
        </div>
    </div>

    <form method="POST" action="../../controller/actions_color.php">
        <div class="form-group input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">ID</label>
            <input type="hidden" class="form-control" name="txtID" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <input type="text" class="form-control" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" placeholder="ID automático" disabled>
        </div>

        <div class="form-group input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Color</label>
            <input type="text" class="form-control" name="txtColor" value="<?php echo isset($_GET['color']) ? $_GET['color'] : ''; ?>" placeholder="Nombre del color">
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
                <th>Color</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listaColores as $color) { ?>
            <tr>
                <td><?php echo $color['id']; ?></td>
                <td><?php echo $color['color']; ?></td>
                <td>
                    <form method="post" action="../../controller/actions_color.php">
                        <input type="hidden" name="txtID" value="<?php echo $color['id']; ?>" />
                        <button type="submit" name="action" value="seleccionar" class="btn btn-primary">Seleccionar</button>
                        <button type="submit" name="action" value="borrar" class="btn btn-danger">Borrar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include("../template/footer.php") ?>
