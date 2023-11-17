<?php 
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: /MedicInven/login.php");
exit();

//$sentenciaUpdateMedicamento && $sentenciaUpdateMedicamento->execute()

// function obtenerRolUsuario($conexion)
// {

//   $idPersona = $_SESSION['idPersona'];
//   $sentencia = $conexion->prepare("SELECT ROL_idRol FROM persona WHERE idPersona = :idPersona");
//   $sentencia->bindParam(":idPersona", $idPersona);
//   $sentencia->execute();
//   $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

//   return isset($resultado['ROL_idRol']) ? $resultado['ROL_idRol'] : 'Administrador';
// }

// $_SESSION['idPersona'] = obtenerRolUsuario($conexion);
// var_dump($_SESSION['idPersona']);
?>
