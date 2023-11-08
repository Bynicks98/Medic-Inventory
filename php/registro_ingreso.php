<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no ha iniciado sesión
}

// Mostrar la página de registro de ingreso
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ingreso</title>
</head>
<body>
    <h2>Registro de Ingreso</h2>
    <p>Bienvenido, <?php echo $nombre_usuario; ?>!</p>
    
    <form method="post" action="proceso_registro_ingreso.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required><br><br>
        
        <!-- Otros campos relevantes -->
        
        <input type="submit" value="Registrar Ingreso">
    </form>
    
    <a href="inicio.php">Volver a la Página de Inicio</a>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>