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

// Función para registrar el ingreso
function registrarIngreso($usuario_id, $nombre, $cargo) {
    global $conn;
    
    $fecha_ingreso = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO registros_ingreso (usuario_id, nombre, cargo, fecha_ingreso) VALUES (?, ?, ?, ?)";
    $params = array($usuario_id, $nombre, $cargo, $fecha_ingreso);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registro'])) {
        $nombre = $_POST['nombre'];
        $cargo = $_POST['cargo'];
        
        // Verifica si ya se registró el ingreso para este usuario hoy
        $sql = "SELECT * FROM registros_ingreso WHERE usuario_id = ? AND CONVERT(DATE, fecha_ingreso) = CONVERT(DATE, GETDATE())";
        $params = array($_SESSION['usuario_id']);
        $stmt = sqlsrv_query($conn, $sql, $params);
        
        if (sqlsrv_has_rows($stmt)) {
            $errorRegistro = "Ya se ha registrado el ingreso para hoy";
        } else {
            // Obtiene el ID de usuario de la sesión
            $usuario_id = $_SESSION['usuario_id'];
            
            // Registra el ingreso
            registrarIngreso($usuario_id, $nombre, $cargo);
            
            // Redirige a la página de inicio de sesión
            header("Location: index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ingreso</title>
</head>
<body>
    <h1>Registro de Ingreso</h1>
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="text" name="cargo" placeholder="Cargo" required><br>
        <input type="submit" name="registro" value="Registrar Ingreso">
    </form>
    <?php if (isset($errorRegistro)) { echo "<p>$errorRegistro</p>"; } ?>
</body>
</html>
