<?php
session_start();

// Conexión a la base de datos
$serverName = "DESKTOP-P3OGUBB\SQLEXPRESS"; // Cambia esto a tu servidor SQL Server
$connectionOptions = array(
    "Database" => "dbprueba", // Cambia esto al nombre de tu base de datos
    "Uid" => "sa",
    "PWD" => "12345"
);


$conn = sqlsrv_connect($serverName, $connectionOptions);

// Función para validar el inicio de sesión
function login($username, $password) {
    global $conn;
    
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_has_rows($stmt)) {
        return true;
    } else {
        return false;
    }
}

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (login($username, $password)) {
            // Inicio de sesión exitoso, redirige a la página de registro de ingreso
            header("Location: registro_ingreso.php");
        } else {
            $errorLogin = "Credenciales incorrectas";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Nombre de Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <?php if (isset($errorLogin)) { echo "<p>$errorLogin</p>"; } ?>
</body>
</html>
