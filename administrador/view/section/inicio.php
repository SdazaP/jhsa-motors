<?php 
    include("../template/header.php"); 

    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: index.php');
        exit;
    }
    
?>
    <div class="jumbotron">
        <h1 class="display-3">Bienvenido al administrador del sitio</h1>
        <p class="lead">Sitio para modificar, agregar y eliminar datos base de datos de los autos</p>
        <hr class="my-2">
        <p>Guia para administrador</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Descargar guia</a>
        </p>
    </div>
<?php include("../template/footer.php") ?>