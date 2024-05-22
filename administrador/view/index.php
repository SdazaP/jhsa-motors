<?php
session_start();
include("../controller/controllerCaptcha.php");

// Si ya esta logeado te mandara a inicio.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /sitio/administrador/view/section/inicio.php');
    exit;
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
            <a class="nav-link active" href="#">Administrador</a>
        </li>
    </ul>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="POST" class="needs-validation p-4 border rounded bg-light shadow" novalidate>
                <div class="mb-3">
                    <label for="validationCustomUsername" class="form-label">Usuario</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" name="usuario" id="validationCustomUsername" placeholder="usuario123..." aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Por favor coloca un usuario real.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contra" placeholder="********" id="exampleInputPassword1" required>
                    <div class="invalid-feedback">
                        Por favor coloca tu contraseña.
                    </div>
                </div>
                
                <input type="hidden" id="captcha" name="captcha">
                <input type="hidden" id="real_captcha" name="real_captcha">
                
                <button id="access" type="submit" class="btn btn-primary w-100" onclick="showCaptcha()">Acceder</button>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <img class="img-fluid" src="img/admin.jpg" alt="admin">
        </div>
    </div>
</div>

<script src="script/captcha.js"></script>

<?php include("template/footer.php")?>
