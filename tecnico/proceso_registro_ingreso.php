<?php
session_start();


if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); 
    exit(); 
}


$nombre = $_POST['nombre'];
$cargo = $_POST['cargo'];


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


$hoy = date("Y-m-d");
$sql = "SELECT * FROM registros_ingreso WHERE nombre = ? AND fecha = ? and cargo = ?";
$params = array($nombre, $hoy, $cargo);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
    // Mostrar alerta de registro duplicado
    echo "Ya has registrado tu ingreso hoy. No puedes registrar múltiples ingresos en el mismo día.";
} else {
    
    $sql = "INSERT INTO registros_ingreso (nombre, cargo) VALUES (?, ?)";
    $params = array($nombre, $cargo);

    $insertResult = sqlsrv_query($conn, $sql, $params);

    if ($insertResult === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    
    header("Location: registro_ingreso.php?success=1");
}

sqlsrv_close($conn);
?>