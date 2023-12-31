<?php
include("../../database.php");

if ($_POST) {
  // Recolectar datos (método post)
  $cantidadD = (isset($_POST["cantidadD"]) ? $_POST["cantidadD"] : "");
  $nombreProducto = (isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"] : "");
  $estadoD = (isset($_POST["estadoD"]) ? $_POST["estadoD"] : "");
  $motivoD = (isset($_POST["motivoD"]) ? $_POST["motivoD"] : "");
  $cantidadUD = (isset($_POST["cantidadUD"]) ? $_POST["cantidadUD"] : "");
  $idPEDIDO = (isset($_POST["PEDIDO_idPEDIDO"]) ? $_POST["PEDIDO_idPEDIDO"] : "");

  // Insertar la devolución en la tabla devoluciones
  $sentencia = $conexion->prepare("INSERT INTO devoluciones (idDevoluciones, cantidadD, nombreProducto, estadoD, motivoD, cantidadUD, PEDIDO_idPEDIDO)
      VALUES (null, :cantidadD, :nombreProducto, :estadoD, :motivoD, :cantidadUD, :PEDIDO_idPEDIDO)");

  // Asignar valores
  $sentencia->bindParam(":cantidadD", $cantidadD);
  $sentencia->bindParam(":nombreProducto", $nombreProducto);
  $sentencia->bindParam(":estadoD", $estadoD);
  $sentencia->bindParam(":motivoD", $motivoD);
  $sentencia->bindParam(":cantidadUD", $cantidadUD);
  $sentencia->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);

  // Ejecutar la inserción de la devolución
  if ($sentencia->execute()) {
    // Obtener el ID del medicamento asociado al pedido
    $sentenciaIdMedicamento = $conexion->prepare("SELECT MEDICAMENTO_idMEDICAMENTO FROM pedido WHERE idPEDIDO = :idPedido");
    $sentenciaIdMedicamento->bindParam(":idPedido", $idPEDIDO);
    $sentenciaIdMedicamento->execute();
    $resultadoIdMedicamento = $sentenciaIdMedicamento->fetch(PDO::FETCH_ASSOC);

    if ($resultadoIdMedicamento) {
      $MEDICAMENTO_idMEDICAMENTO = $resultadoIdMedicamento['MEDICAMENTO_idMEDICAMENTO'];

      // Actualizar la cantidad de unidades del medicamento
      $sentenciaUpdateMedicamento = $conexion->prepare("UPDATE medicamento SET cantidadUnidades = cantidadUnidades + :cantidadPedido WHERE idMEDICAMENTO = :medicamentoID");
      $sentenciaUpdateMedicamento->bindParam(":cantidadPedido", $cantidadUD, PDO::PARAM_INT);
      $sentenciaUpdateMedicamento->bindParam(":medicamentoID", $MEDICAMENTO_idMEDICAMENTO);

      // Ejecutar la actualización del medicamento
      if ($sentenciaUpdateMedicamento->execute()) {
        // Cantidad de unidades actualizada correctamente
        // Redireccionar o mostrar mensaje de éxito
        header("Location: index.php");
        exit();
      } else {
        // Mensaje de error al actualizar la cantidad de unidades
        echo "Error al actualizar la cantidad de unidades del medicamento.";
      }
    } else {
      // No se pudo obtener el ID del medicamento asociado al pedido
      echo "Error al obtener el ID del medicamento asociado al pedido.";
    }
  } else {
    // Mensaje de error al insertar la devolución
    echo "Error al insertar la devolución.";
  }
}

$sentenciaidPEDIDO = $conexion->prepare("SELECT idPEDIDO, Nombre_Producto FROM pedido");
$sentenciaidPEDIDO->execute();
$IdPEDIDO = $sentenciaidPEDIDO->fetchAll(PDO::FETCH_ASSOC);
// Obtener nombres de medicamentos para el formulario
$sentenciaNombresMedicamentos = $conexion->prepare("SELECT idMEDICAMENTO, nombreMedica FROM medicamento");
$sentenciaNombresMedicamentos->execute();
$nombresMedicamentos = $sentenciaNombresMedicamentos->fetchAll(PDO::FETCH_ASSOC);

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
        <label for="nombreProducto" class="form-label">Nombre del Producto</label>
        <select class="form-select" name="nombreProducto" id="nombreProducto" required>
          <option value="">Selecciona un medicamento</option>
          <?php foreach ($nombresMedicamentos as $medicamento) { ?>
            <option value="<?php echo $medicamento['idMEDICAMENTO']; ?>" <?php if (isset($MEDICAMENTO_idMEDICAMENTO) && $MEDICAMENTO_idMEDICAMENTO == $medicamento['idMEDICAMENTO'])
                 echo 'selected'; ?>>
              <?php echo $medicamento['nombreMedica']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <!-- <div class="mb-3">
        <label for="nombreProducto" class="form-label">Nombre Producto</label>
        <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" aria-describedby="helpId"
          placeholder="Nombre del Producto">

      </div> -->
      <div class="mb-3">
        <label for="motivoD" class="form-label">Motivo de la Devolucion</label>
        <input type="text" class="form-control" name="motivoD" id="motivoD" aria-describedby="helpId"
          placeholder="Agrega el motivo de la devolucion " required>

      </div>

      <div class="mb-3">
        <label for="estadoD" class="form-label">Estado de la devolución</label>
        <select class="form-select" name="estadoD" id="estadoD">
          <option value="Aprobada">Aprobada</option>
          <option value="Rechazada">Rechazada</option>
          <!-- Agrega más opciones según tus necesidades -->
        </select>
      </div>
      <div class="mb-3" style="display: none;">
        <label for="cantidadD" class="form-label">Cantidad de cajas</label>
        <input type="text" class="form-control" name="cantidadD" id="cantidadD" aria-describedby="helpId"
          placeholder="Cantidad de cajas del pedido" required>

      </div>
      <div class="mb-3">
        <label for="cantidadUD" class="form-label">Cantidad de unidades</label>
        <input type="text" class="form-control" name="cantidadUD" id="cantidadUD" aria-describedby="helpId"
          placeholder="Agrega la cantidad de unidades del pedido " required>

      </div>
      <!-- FK categoria y subcategoria -->
      <div class="mb-3">
        <label for="idPEDIDO" class="form-label">PEDIDO</label>
        <select class="form-select form-select-lg" name="PEDIDO_idPEDIDO" id="idPEDIDO">
          <?php foreach ($IdPEDIDO as $PEDIDOd) { ?>
            <option value="<?php echo $PEDIDOd['idPEDIDO']; ?>">
              <?php echo $PEDIDOd['idPEDIDO']; ?>
            </option>
          <?php } ?>
        </select>



        <!--  -->

        <!-- bs5buttondefault para los botones  add user abajo -->
        <button type="submit" class="btn btn-success">Agregar Devolucion</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="cancel" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>
  <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>