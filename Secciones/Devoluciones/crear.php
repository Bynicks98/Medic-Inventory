<?php
include("../../database.php");
include("procesar_devolucion.php");
if ($_POST) {

  // Recolectar datos (método post)
  // Recolectar datos (método post)
  $cantidadD = (isset($_POST["cantidadD"]) ? $_POST["cantidadD"] : "");
  $nombreProducto = (isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"] : "");
  $estadoD = (isset($_POST["estadoD"]) ? $_POST["estadoD"] : "");
  $motivoD = (isset($_POST["motivoD"]) ? $_POST["motivoD"] : "");
  $cantidadUD = (isset($_POST["cantidadUD"]) ? $_POST["cantidadUD"] : "");
  $idPEDIDO = (isset($_POST["PEDIDO_idPEDIDO"]) ? $_POST["PEDIDO_idPEDIDO"] : "");

  $sentencia = $conexion->prepare("INSERT INTO devoluciones (idDevoluciones, cantidadD, nombreProducto, estadoD, motivoD, PEDIDO_idPEDIDO)
    VALUES (null, :cantidadD, :nombreProducto, :estadoD, :motivoD, :PEDIDO_idPEDIDO)");




  // Asignar valores que tienen un solo :variable
  $sentencia->bindParam(":cantidadD", $cantidadD);
  $sentencia->bindParam(":nombreProducto", $nombreProducto);
  $sentencia->bindParam(":estadoD", $estadoD);
  $sentencia->bindParam(":motivoD", $motivoD);
  $sentencia->bindParam(":cantidadUD", $cantidadUD);
  $sentencia->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);
  $sentencia->execute();
  $mensaje="Registro agregado";
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
          placeholder="Agrega la cantidad de unidades del pedido ">

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