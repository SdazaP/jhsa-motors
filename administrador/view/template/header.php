<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/sitio" ?>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light justify-content-center">

        <ul class="nav navbar-nav ">

            <a class="nav-item nav-link active" href="#">Administrador del sitio web</a>
            <a class="nav-item nav-link" href="<?php echo $url."/administrador/view/section/inicio.php"?>">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url."/administrador/view/section/carros.php"?>">Carros</a>
            <a class="nav-item nav-link" href="<?php echo $url."/administrador/controller/controllerLogOut.php"?>">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url."/"?>">Ver sitio web</a>
            
        </ul>

    </nav>

    <div class="container">
        <div class="row">