<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no ha iniciado sesión
    exit(); // Salir del script
}

// Obtener el nombre de usuario del usuario actual
$nombre_usuario = $_SESSION['nombre_usuario'];

// Configuración de la conexión a SQL Server
$serverName = "DESKTOP-P3OGUBB\SQLEXPRESS"; // Cambia esto por tu servidor SQL Server
$connectionOptions = array(
    "Database" => "dbprueba", // Cambia esto por tu base de datos
    "Uid" => "tu_usuario", // Cambia esto por tu usuario
    "PWD" => "tu_contraseña" // Cambia esto por tu contraseña
);

// Conexión a la base de datos
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Error de conexión: " . sqlsrv_errors());
}

// Obtener el mes y el año actual
$mes_actual = date("m");
$anio_actual = date("Y");

// Consultar la base de datos para contar los registros de ingreso del usuario en el mes actual
$sql = "SELECT COUNT(*) as total FROM registros_ingreso WHERE nombre = ? AND YEAR(fecha) = ? AND MONTH(fecha) = ?";
$params = array($nombre_usuario, $anio_actual, $mes_actual);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

$total_dias_ingreso = $row['total'];

sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $nombre_usuario; ?>!</h2>
    <p>Esta es tu página de inicio.</p>
    
    <p>Has ingresado <?php echo $total_dias_ingreso; ?> días este mes.</p>
    
    <a href="registro_ingreso.php">Registrar Ingreso</a>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>