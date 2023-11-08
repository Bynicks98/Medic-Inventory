<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no ha iniciado sesión
    exit(); // Salir del script
}

// Recuperar los datos del formulario de registro de ingreso
$nombre = $_POST['nombre'];
$cargo = $_POST['cargo'];
// Otros campos relevantes

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

// Verificar si ya existe un registro para esa persona en el día actual
$hoy = date("Y-m-d");
$sql = "SELECT * FROM registros_ingreso WHERE nombre = ? AND fecha = ?";
$params = array($nombre, $hoy);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
    // Mostrar alerta de registro duplicado
    echo "Ya has registrado tu ingreso hoy. No puedes registrar múltiples ingresos en el mismo día.";
} else {
    // Si no existe un registro para esta persona en el día actual, proceder con el registro
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO registros_ingreso (nombre, cargo, fecha) VALUES (?, ?, ?)";
    $params = array($nombre, $cargo, $hoy);

    $insertResult = sqlsrv_query($conn, $sql, $params);

    if ($insertResult === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Redirigir de vuelta a la página de registro de ingreso con un mensaje de éxito
    header("Location: registro_ingreso.php?success=1");
}

sqlsrv_close($conn);
?>