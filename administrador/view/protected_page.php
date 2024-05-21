<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Protegida</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p>Esta página está protegida y solo es accesible para usuarios autenticados.</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
