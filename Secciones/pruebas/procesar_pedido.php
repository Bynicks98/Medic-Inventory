<?php
include('../../database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMedicamento = $_POST['idMedicamento'];
    $cantidadPedido = $_POST['cantidadPedido'];

    // Realizar la lógica necesaria para gestionar el pedido
    // Puedes almacenar la información en otra tabla, enviar correos electrónicos, etc.

    // Aquí se proporciona un ejemplo simple para almacenar el pedido en una tabla "pedidos"
    $queryInsertPedido = "INSERT INTO pedido (idMedicamento, cantidadPedido) VALUES (:idMedicamento, :cantidadPedido)";
    $stmtInsertPedido = $conexion->prepare($queryInsertPedido);
    $stmtInsertPedido->bindParam(':idMedicamento', $idMedicamento);
    $stmtInsertPedido->bindParam(':cantidadPedido', $cantidadPedido);
    $stmtInsertPedido->execute();

    // Redirigir a la página principal
    header("Location: index.php");
    exit();
} else {
    // Si se accede a esta página de forma directa sin enviar el formulario, redirige a la página principal
    header("Location: index.php");
    exit();
}
?>