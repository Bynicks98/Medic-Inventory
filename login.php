<?php
session_start();
include('database.php');

$error = ""; // Inicializa la variable de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conexion->prepare("SELECT * FROM persona WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verifica la contraseña sin usar password_verify
        if ($contrasena === $usuario['contrasena']) {
            $_SESSION['idPersona'] = $usuario['idPersona'];
            $_SESSION['nombreP'] = $usuario['nombreP']; //le agregue este no mas para ver y saber cual es la persona que se inicia si algo se elimina y ya
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['ROL_idRol'];

            // Redirigir a la página principal después de iniciar sesión
            header("Location: index.php");
            exit();
        } else {
            $error = "Credenciales incorrectas";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            .login-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .login-container img {
                max-width: 100px;
                margin-bottom: 20px;
            }

            .login-container label {
                display: block;
                margin-bottom: 8px;
            }

            .login-container input {
                width: 100%;
                padding: 10px;
                margin-bottom: 16px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .login-container input[type="submit"] {
                background-color: #3498db;
                color: #fff;
                cursor: pointer;
            }

            .login-container input[type="submit"]:hover {
                background-color: #2980b9;
            }

            .error-message {
                color: red;
            }
        </style>
    </head>

<body>

    <div class="login-container">
        <img src="tu_logo.png" alt="Logo de la empresa">

        <h2>Login</h2>
        
        <form method="post" action="">
        <!-- el code de abajo si la persona se equivoca le alerta de "Usuario incorrecto " -->
        <?php if(isset($error)){?>
            <div class="alert alert-danger" role="alert">
            <strong><?php echo $error;?></strong> 
            </div>
        <?php } ?>
        
            <label for="correo">Correo:</label>
            <input type="text" name="correo" required><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required><br>

            <input type="submit" value="Iniciar Sesión" class="btn" name="ingresar">
        </form>
    </div>
</body>

</html>