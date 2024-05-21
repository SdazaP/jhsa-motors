<?php 
    /* $error_message = '';
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
    } */
?>


<?php

    include("../model/bd.php");

    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Example static credentials
        /* $valid_user = 'admin';
        $valid_pass = 'password123'; */

        $user = $_POST['usuario'] ?? '';
        $pass = $_POST['contra'] ?? '';
        $captcha = $_POST['captcha'] ?? '';
        $real_captcha = $_POST['real_captcha'] ?? '';

        if ($captcha === $real_captcha) {
            //consulta preparada
            $stmt = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
            $stmt->bindParam(':usuario', $user);
            $stmt->execute();
            //user data en forma de arreglo
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

            //verificar que usuario exista
            if ($user_data) {
                //verficando contraseña de usuario
                if (password_verify($pass,$user_data['contrasenia'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user;
                    header('Location: inicio.php');
                    exit;
                } else{
                    $error_message = 'Constraseña incorrecta';
                }
            } else {
                $error_message = 'Usuario no encontrado';
            }
        } else {
            $error_message = 'El captcha ingresado es incorrecto.';
        }
    }
?>