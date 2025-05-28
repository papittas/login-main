<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION["email"]) && !isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION["email"] ?? $_SESSION["usuario"] ?? "Usuario";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <h1 class="welcome-title">¡Bienvenido!</h1>
            <p class="welcome-text">Hola <strong><?php echo htmlspecialchars($usuario); ?></strong></p>
            <p class="welcome-text">Has iniciado sesión correctamente en el sistema.</p>
            <a href="logout.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>

