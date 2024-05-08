<?php include("template/header.php")?>

<div class="container">
    <div class="row justify-content-center">
        <?php
        include("../controller/pagination.php");
        // Mostrar los resultados
        if ($resultado->rowCount() > 0) {
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                //var_dump($fila);
        ?>
                <div class='col-md-3'>
                    <div class='card' style='width: 18rem;'>
                        <img class="img_car" src="../administrador/view/img/<?php echo $fila['imagen']; ?>" alt="">
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo obtenerMarcaPorId($fila['marca'], $conexion) ." ". $fila["modelo"]." ".$fila["anio"]; ?></h5>
                            
                            <a href='#' class='btn btn-primary'>Ver detalles</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "0 resultados";
        }
        ?>

    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php for ($pagina = 1; $pagina <= $total_paginas; $pagina++) : ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina; ?>"><?php echo $pagina; ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

</div>

<?php include("template/footer.php")?>
