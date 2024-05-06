<?php 
    $error_message = '';
    if ($_POST) {
        $captcha = $_POST['captcha'];
        $real_captcha = $_POST['real_captcha'];
        // Aquí validas el captcha
        if ($captcha == $real_captcha) {
            // Si el captcha es correcto, rediriges al usuario
            header('Location:inicio.php');
        } else {
            // Si el captcha es incorrecto, muestras un mensaje de error
            $error_message =  "El captcha ingresado es incorrecto.";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/style.css?v=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-info justify-content-center">
    <ul class="nav navbar-nav ">
        <li class="nav-item active">
            <a class="nav-link active" href="#">Administrador</span></a>
        </li>
    </ul>
</nav>

<div class="container">
    <div class="row">
        <div class="row align-items-center">
            <form method="POST" class="col needs-validation" novalidate>
                <div class="col-md-6">
                    <label for="validationCustomUsername" class="form-label">Usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" name="usuario" id="validationCustomUsername" placeholder="usuario123..." aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Por favor coloca un usuario real.
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-6">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contra" placeholder="********" id="exampleInputPassword1">
                </div>
                <br>

                <input type="hidden" id="captcha" name="captcha">
                <input type="hidden" id="real_captcha" name="real_captcha">
                
                <button id="access" type="submit" class="btn btn-primary" onclick="showCaptcha()">Acceder</button>

                <?php if (!empty($error_message)) : ?>
                    <div class="error-message">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>


            </form>
            <div class="col">
                <img class="img-fluid" src="img/admin.jpg" alt="admin">
            </div>
        </div>
    </div>
</div>

<script src="script/captcha.js"></script>


<?php include("template/footer.php")?>