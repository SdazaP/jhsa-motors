<?php include("../template/header.php") ?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}

include("../../model/bd.php");

$sql_mar = $conexion->prepare("SELECT * FROM marca");
$sql_mar->execute();
$listaMarcas = $sql_mar->fetchAll(PDO::FETCH_ASSOC);

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
            Datos de Marca
        </div>
    </div>

    <form method="POST" action="../../controller/actions_marca.php">
        <div class="form-group input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">ID</label>
            <input type="hidden" class="form-control" name="txtID" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <input type="text" class="form-control" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" placeholder="ID automático" disabled>
        </div>

        <div class="form-group input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Nombre</label>
            <input type="text" class="form-control" name="txtNombre" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>" placeholder="Nombre de la marca">
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
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listaMarcas as $marca) { ?>
            <tr>
                <td><?php echo $marca['id']; ?></td>
                <td><?php echo $marca['nombre']; ?></td>
                <td>
                    <form method="post" action="../../controller/actions_marca.php">
                        <input type="hidden" name="txtID" value="<?php echo $marca['id']; ?>" />
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
