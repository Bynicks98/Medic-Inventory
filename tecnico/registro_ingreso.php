<?php
session_start();


if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php"); 
}


$nombre_usuario = $_SESSION['nombre_usuario'];

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


$mes_actual = date("m");
$anio_actual = date("Y");


$sql = "SELECT nombre, cargo, COUNT(*) as total FROM registros_ingreso WHERE YEAR(fecha) = ? AND MONTH(fecha) = ? group by nombre, cargo";
$params = array($anio_actual, $mes_actual);

$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}


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
        
        
        
        <input type="submit" value="Registrar Ingreso">
    </form>
    
    <a href="cerrar_sesion.php">Cerrar Sesión</a>

    <table>
        <tr>
            <td>
                nombre
            </td>
            <td>
                cargo
            </td>
            <td>
                dias totales el mes <?php echo $mes_actual; ?>
            </td>
        </tr>
        <?php while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {?>
            <tr>
                <td>
                    <?php echo $row['nombre'];?>
                </td>
                <td>
                    <?php echo $row['cargo'];?>
                </td>
                <td>
                    <?php echo $row['total'];?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>