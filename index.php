<?php
    //Conexion con la base
    include_once("dbconn.php");
    
    $mensaje = '';
    $tipo_mensaje = '';
    
    if(isset($_POST['Enviar'])) {
        // Obtener las credenciales del formulario
        $usuario = trim($_POST['User']);
        $password = $_POST['pass'];

        // Verificar si el usuario existe en la base de datos
        $sql = "SELECT * FROM registronuevo WHERE user = '$usuario'";
        $result = mysqli_query($conex, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['pass'];

            if (password_verify($password, $hashedPassword)) {
                // Contraseña correcta, iniciar sesión
                session_start();
                $_SESSION["usuario"] = $usuario;
                header("Location: accesocorrecto.php");
                exit();
            } else {
                // Contraseña incorrecta
                $mensaje = "Contraseña incorrecta.";
                $tipo_mensaje = "error";
            }
        } else {
            // Usuario inexistente
            $mensaje = "Usuario inexistente.";
            $tipo_mensaje = "error";
        }

        mysqli_close($conex);
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="main-card">
            <h1 class="main-title">Inicia sesión</h1>
            <?php if (!empty($mensaje)) echo "<div class='error-msg'>$mensaje</div>"; ?>
            <form action="index.php" method="POST">
                <button type="button" class="btn-google">Continuar con Google</button>
                <hr class="hr">
                <hr>
                <input type="text" name="User" class="form-control-custom" placeholder="Email o usuario" required>
                <div class="password-container">
                    <input type="password" name="pass" class="form-control-custom" placeholder="Contraseña" style="padding-right: 45px;" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <svg id="eyeIcon" class="eye-icon" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg id="eyeOffIcon" class="eye-icon" style="display: none;" viewBox="0 0 24 24">
                            <path d="m9.88 9.88 4.24 4.24"></path>
                            <path d="m15.5 15.5 3.5 3.5"></path>
                            <path d="M17.02 17.02c-2.76 2.3-6.38 3.98-10.02 3.98C3 21 1 12 1 12s1.67-4.9 4.64-6.32"></path>
                            <path d="m2 2 20 20"></path>
                            <path d="M6.98 6.98C4.35 8.7 3 12 3 12s4 8 11 8c1.36 0 2.63-.39 3.74-1.02"></path>
                        </svg>
                    </button>
                </div>
                <button type="submit" class="btn-primary" name='Enviar'>Iniciar Sesión</button>
            </form>
            <div class="links-container">
                <a href="recuperar_clave.php" class="forgot-password d-block mb-3 mx-auto">¿Has olvidado la contraseña?</a>
                <div class="register-text">
                    ¿No tenés cuenta? <a href="alta.php" class="register-link">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            const eyeOff = document.getElementById('eyeOffIcon');
            if (input.type === "password") {
                input.type = "text";
                eye.style.display = "none";
                eyeOff.style.display = "block";
            } else {
                input.type = "password";
                eye.style.display = "block";
                eyeOff.style.display = "none";
            }
        }
    </script>
</body>
</html>

