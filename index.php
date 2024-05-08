<?php include("view/template/header.php")?>

                    <div class="cardt  text-white">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="welcome col">
                                    <h1>
                                        Bienvenido a JHSA Motors
                                    </h1>
                                    <div class="nav">
                                        
                                    </div>
                                </div>

                                <div class="disp col">
                                    <?php
                                    include("model/bd.php");
                                    $sql_total = "SELECT COUNT(id) AS total FROM carros";
                                    $resultado_total = $conexion->query($sql_total);
                                    $total_resultados = $resultado_total->fetch(PDO::FETCH_ASSOC)["total"];
                                    ?>
                                    <p>Carros disponibles <?php echo $total_resultados?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div id="carouselExampleCaptions" class="carousel slide carousel-fade">

                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="view/img/varios.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                                </div>
                                <div class="carousel-item">
                                <img src="view/img/cooper.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                                </div>
                                <div class="carousel-item">
                                <img src="view/img/chev.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            </div>
                    </div>


                
                
<?php include("view/template/footer.php")?>