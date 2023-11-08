<?php
session_start();

// Configuración de la conexión a SQL Server
$serverName = "DESKTOP-P3OGUBB\SQLEXPRESS"; // Cambia esto por tu servidor SQL Server
$connectionOptions = array(
    "Database" => "dbprueba", // Cambia esto por tu base de datos
    "Uid" => "sa", // Cambia esto por tu usuario
    "PWD" => "12345" // Cambia esto por tu contraseña
);


$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Error de conexión: " . sqlsrv_errors());
}


$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];


$sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
$params = array($nombre_usuario, $contrasena);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
    
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    header("Location: registro_ingreso.php"); 
} else {

    echo "Credenciales incorrectas. Inténtalo de nuevo.";
}

sqlsrv_close($conn);
?>