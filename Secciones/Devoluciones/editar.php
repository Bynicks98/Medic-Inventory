<?php
include("../../database.php");
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM devoluciones WHERE idDevoluciones = :idDevoluciones");
  $sentencia->bindParam(":idDevoluciones", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  if ($registro) {
    $cantidadD = $registro["cantidadD"];
    $nombreProducto = $registro["nombreProducto"];
    $estadoD = $registro["estadoD"];
    $motivoD = $registro["motivoD"];
    $cantidadD = $registro["cantidadUD"];
    $idPEDIDO = $registro["idPEDIDO"];
  }
}

if ($_POST) {

  // Recolectar datos (método post)
  // Recolectar datos (método post)
  $cantidadD = (isset($_POST["cantidadD"]) ? $_POST["cantidadD"] : "");
  $nombreProducto = (isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"] : "");
  $estadoD = (isset($_POST["estadoD"]) ? $_POST["estadoD"] : "");
  $motivoD = (isset($_POST["motivoD"]) ? $_POST["motivoD"] : "");
  $cantidadUD = (isset($_POST["cantidadUD"]) ? $_POST["cantidadUD"] : "");
  $idPEDIDO = (isset($_POST["PEDIDO_idPEDIDO"]) ? $_POST["PEDIDO_idPEDIDO"] : "");

  $sentencia = $conexion->prepare("UPDATE devoluciones SET cantidadD = :cantidadD, nombreProducto = :nombreProducto, estadoD = :estadoD, motivoD = :motivoD, cantidadUD = :cantidadUD, PEDIDO_idPEDIDO = :PEDIDO_idPEDIDO where idDevoluciones = :idDevoluciones");


  // Asignar valores que tienen un solo :variable
  $sentencia->bindParam(":cantidadD", $cantidadD);
  $sentencia->bindParam(":nombreProducto", $nombreProducto);
  $sentencia->bindParam(":estadoD", $estadoD);
  $sentencia->bindParam(":motivoD", $motivoD);
  $sentencia->bindParam(":cantidadUD", $cantidadUD);
  $sentencia->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);
  $sentencia->bindParam(":idDevoluciones", $txtID);
  $sentencia->execute();
  $mensaje="Registro Actualizado";
  header("Location:index.php?mensaje=".$mensaje);
}
$sentenciaidPEDIDO = $conexion->prepare("SELECT idPEDIDO, Nombre_Producto FROM pedido");
$sentenciaidPEDIDO->execute();
$IdPEDIDO = $sentenciaidPEDIDO->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../Plantillas/header.php"); ?>

<br>


<div class="card">
  <div class="card-header">
    Datos de la devolucion
  </div>
  <div class="card-body">

    <form action="" method="post">
      <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">

      </div>
      <div class="mb-3">
        <label for="nombreProducto" class="form-label">Nombre Producto</label>
        <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" aria-describedby="helpId"
          placeholder="Nombre del Producto">

      </div>
      <div class="mb-3">
        <label for="motivoD" class="form-label">Motivo de la Devolucion</label>
        <input type="text" class="form-control" name="motivoD" id="motivoD" aria-describedby="helpId"
          placeholder="Agrega el motivo de la devolucion ">

      </div>
      <div class="mb-3">
        <label for="estadoD" class="form-label">Estado de la devolución</label>
        <select class="form-select" name="estadoD" id="estadoD">
        <option value="Aprobada">Aprobada</option>
        <option value="Rechazada">Rechazada</option>
        <!-- Agrega más opciones según tus necesidades -->
        </select>
      </div>
      <div class="mb-3">
        <label for="cantidadD" class="form-label">Cantidad de cajas</label>
        <input type="text" class="form-control" name="cantidadD" id="cantidadD" aria-describedby="helpId"
          placeholder="Cantidad de cajas del pedido">

        </div>
      <div class="mb-3">
        <label for="cantidadUD" class="form-label">Cantidad de unidades</label>
        <input type="text" class="form-control" name="cantidadUD" id="cantidadUD" aria-describedby="helpId"
          placeholder="Agrega la cantidad de unidades ">

      </div>
        <!-- FK categoria y subcategoria -->
        <div class="mb-3">
          <label for="idPEDIDO" class="form-label">PEDIDO</label>
          <select class="form-select form-select-lg" name="PEDIDO_idPEDIDO" id="idPEDIDO">
            <?php foreach ($IdPEDIDO as $PEDIDOd) { ?>
              <option value="<?php echo $PEDIDOd['idPEDIDO']; ?>">
                <?php echo $PEDIDOd['Nombre_Producto']; ?>
              </option>
            <?php } ?>
          </select>



          <!--  -->

          <!-- bs5buttondefault para los botones  add user abajo -->
          <button type="submit" class="btn btn-success" name="agregarMed">Agregar Medicamento</button>
          <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
          <a name="cancel" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>
  <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>