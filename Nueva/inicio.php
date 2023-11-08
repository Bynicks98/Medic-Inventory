<?php
session_start();

// Conexión a la base de datos (de nuevo)
$serverName = "DESKTOP-P3OGUBB\SQLEXPRESS"; // Cambia esto a tu servidor SQL Server
$connectionOptions = array(
    "Database" => "dbprueba", // Cambia esto al nombre de tu base de datos
    "Uid" => "sa",
    "PWD" => "12345"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

// Función para obtener el conteo de días de ingreso para el usuario actual en el mes actual
function obtenerConteoDiasIngreso($usuario_id) {
    global $conn;
    
    $mesActual = date('m');
    $anioActual = date('Y');
    
    $sql = "SELECT COUNT(DISTINCT CONVERT(DATE, fecha_ingreso)) AS conteo_dias FROM registros_ingreso WHERE usuario_id = ? AND MONTH(fecha_ingreso) = ? AND YEAR(fecha_ingreso) = ?";
    $params = array($usuario_id, $mesActual, $anioActual);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['conteo_dias'];
}

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
}

$usuario_id = $_SESSION['usuario_id'];
$conteoDiasIngreso = obtenerConteoDiasIngreso($usuario_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Conteo de días de ingreso en el mes actual: <?php echo $conteoDiasIngreso; ?></p>
    <a href="registro_ingreso.php">Registrar un nuevo ingreso</a>
    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>