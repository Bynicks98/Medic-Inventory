<?php

$servidor="localhost";
$basedeDatos="medicinventory";
$usuario="root";
$contrasenia="";
try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$basedeDatos",$usuario,$contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(Exception $ex){
    echo $ex->getMessage();
}




?>
<!--Conexion de la bd-->