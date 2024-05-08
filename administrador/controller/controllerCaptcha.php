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
