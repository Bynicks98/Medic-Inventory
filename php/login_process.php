<?php
session_start();

// Configuración de la conexión a SQL Server
$serverName = "DESKTOP-P3OGUBB\SQLEXPRESS"; // Cambia esto por tu servidor SQL Server
$connectionOptions = array(
    "Database" => "dbprueba", // Cambia esto por tu base de datos
    "Uid" => "sa", // Cambia esto por tu usuario
    "PWD" => "12345" // Cambia esto por tu contraseña
);

// Conexión a la base de datos
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Error de conexión: " . sqlsrv_errors());
}

// Recuperar los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
$params = array($nombre_usuario, $contrasena);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
    // Las credenciales son correctas, iniciar sesión
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    header("Location: inicio.php"); // Redirigir a la página de inicio después del inicio de sesión exitoso
} else {
    // Las credenciales son incorrectas, mostrar mensaje de error
    echo "Credenciales incorrectas. Inténtalo de nuevo.";
}

sqlsrv_close($conn);
?>