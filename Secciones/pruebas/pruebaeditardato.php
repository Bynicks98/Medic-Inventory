<?php

include("../../database.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';
    $sentencia = $conexion->prepare("SELECT * from pedido where idPEDIDO = :idPEDIDO");
    $sentencia->bindParam(":idPEDIDO", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    if ($registro) {

        $fechaPedido = $registro["fechaPedido"];
        $idPEDIDO = $registro["idPEDIDO"];

    }
}

if ($_POST) {
    $fechaPedido = (isset($_POST["fechaPedido"]) ? $_POST["fechaPedido"] : "");
    $idPEDIDO = (isset($_POST["idPEDIDO"]) ? $_POST["idPEDIDO"] : "");

    $sentenciaActualizarPedido = $conexion->prepare("UPDATE pedido SET fechaPedido = :fechaPedido WHERE idPEDIDO = :idPEDIDO");

    $sentenciaActualizarPedido->bindParam(":fechaPedido", $fechaPedido);
    $sentenciaActualizarPedido->bindParam(":idPEDIDO", $idPEDIDO);
    $sentenciaActualizarPedido->execute();
}



?>
<form action="" method="post">
    <div class="mb-3">
        <label for="idPEDIDO" class="form-label" >idPEDIDO</label>
        <input type="text" class="form-control" name="idPEDIDO" id="idPEDIDO" aria-describedby="helpId"
            placeholder="" value="<?php echo isset($idPEDIDO) ? $idPEDIDO : ''; ?>">

    </div>
    <div class="mb-3">
        <label for="fechaPedido" class="form-label">Fecha del Pedido</label>
        <input type="date" class="form-control" name="fechaPedido" id="fechaPedido" aria-describedby="helpId"
            placeholder="" value="<?php echo isset($fechaPedido) ? $fechaPedido : ''; ?>">
    </div>
    <div class="card-footer text-muted">
        <button type="submit" class="btn btn-success">Editar Pedido</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </div>
</form>