<?php
//include("database.php");
$GLOBALS['database_path'] = __DIR__ . "/../database.php";
include($GLOBALS['database_path']);
function obtenerRolUsuario($conexion)
{
    $idPersona = $_SESSION['idPersona'];
    $sentencia = $conexion->prepare("SELECT nombreRol FROM persona INNER JOIN rol ON persona.ROL_idRol = rol.idRol WHERE idPersona = :idPersona");
    $sentencia->bindParam(":idPersona", $idPersona);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    return isset($resultado['nombreRol']) ? $resultado['nombreRol'] : 'Administrador';
}
?>