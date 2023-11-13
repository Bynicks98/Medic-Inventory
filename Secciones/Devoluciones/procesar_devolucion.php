<?php
include("../../database.php");

if ($_POST) {
    // Recolectar datos (método post)
    $cantidadD = (isset($_POST["cantidadD"]) ? $_POST["cantidadD"] : "");
    $nombreProducto = (isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"] : "");
    $estadoD = (isset($_POST["estadoD"]) ? $_POST["estadoD"] : "");
    $motivoD = (isset($_POST["motivoD"]) ? $_POST["motivoD"] : "");
    $idPEDIDO = (isset($_POST["PEDIDO_idPEDIDO"]) ? $_POST["PEDIDO_idPEDIDO"] : "");

    try {
        $conexion->beginTransaction();

        $sentencia = $conexion->prepare("INSERT INTO devoluciones (idDevoluciones, cantidadD, nombreProducto, estadoD, motivoD, PEDIDO_idPEDIDO)
    VALUES (null, :cantidadD, :nombreProducto, :estadoD, :motivoD, :PEDIDO_idPEDIDO)");

        // Actualiza la cantidad_devuelta según el estado
        if ($estadoD === 'Aprobada') {
            $sql = "UPDATE pedido SET cantidad_devuelta = cantidad_devuelta + :cantidadD WHERE idPEDIDO = :idPEDIDO";
        } elseif ($estadoD === 'Rechazada') {
            $sql = "UPDATE pedido SET cantidad_devuelta = cantidad_devuelta - :cantidadD WHERE idPEDIDO = :idPEDIDO";
        }

        $sentencia->bindParam(":cantidadD", $cantidadD);
        $sentencia->bindParam(":nombreProducto", $nombreProducto);
        $sentencia->bindParam(":estadoD", $estadoD);
        $sentencia->bindParam(":motivoD", $motivoD);
        $sentencia->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);
        $sentencia->execute();

        $sentenciaPedido = $conexion->prepare($sql);
        $sentenciaPedido->bindParam(":idPEDIDO", $idPEDIDO);
        $sentenciaPedido->bindParam(":cantidadD", $cantidadD);
        $sentenciaPedido->execute();

        $conexion->commit();

        header("Location: index.php?mensaje=La devolución se registró correctamente");
        exit();
    } catch (Exception $e) {
        $conexion->rollBack();

        header("Location: index.php?mensaje=Error al procesar la devolución: " . $e->getMessage());
        exit();
    }
}
?>
