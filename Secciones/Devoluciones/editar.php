<?php
include("../../database.php");

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM devoluciones WHERE idDevoluciones = :idDevoluciones");
  $sentencia->bindParam(":idDevoluciones", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  if ($registro) {
    $cantidadori= $registro["cantidadUD"];
    $cantidadD = $registro["cantidadD"];
    $nombreProducto = $registro["nombreProducto"];
    $estadoD = $registro["estadoD"];
    $motivoD = $registro["motivoD"];
    $cantidadUD = $registro["cantidadUD"];
    $idPEDIDO = $registro["PEDIDO_idPEDIDO"];
  }
}



if ($_POST) {
  // Recolectar datos (método post)
  $cantidadD = (isset($_POST["cantidadD"]) ? $_POST["cantidadD"] : "");
  $nombreProducto = (isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"] : "");
  $estadoD = (isset($_POST["estadoD"]) ? $_POST["estadoD"] : "");
  $motivoD = (isset($_POST["motivoD"]) ? $_POST["motivoD"] : "");
  $cantidadUD = (isset($_POST["cantidadUD"]) ? $_POST["cantidadUD"] : "");
  $idPEDIDO = (isset($_POST["PEDIDO_idPEDIDO"]) ? $_POST["PEDIDO_idPEDIDO"] : "");

  // Obtener la cantidad original del medicamento
  $sentenciaGetMedicamentoCantidad = $conexion->prepare("SELECT cantidadUnidades FROM medicamento WHERE idMEDICAMENTO IN (SELECT MEDICAMENTO_idMEDICAMENTO FROM pedido WHERE idPEDIDO = :idPedido)");
  $sentenciaGetMedicamentoCantidad->bindParam(":idPedido", $idPEDIDO);
  $sentenciaGetMedicamentoCantidad->execute();
  $resultado = $sentenciaGetMedicamentoCantidad->fetch(PDO::FETCH_ASSOC);

  if ($resultado) {
    // Convertir a números enteros
    $cantidadUD = intval($cantidadUD);
    $cantidadD = intval($cantidadD);

    // Calcular la diferencia entre la cantidad original y la cantidad devuelta
    $diferenciaCantidad =  $cantidadUD - $cantidadori;

    // Calcular la nueva cantidad del medicamento sumando la diferencia
    $nuevaCantidad = $diferenciaCantidad;

    // Actualizar la cantidad del medicamento
    $sentenciaUpdateMedicamento = $conexion->prepare("UPDATE medicamento SET cantidadUnidades = cantidadUnidades + :nuevaCantidad WHERE idMEDICAMENTO IN (SELECT MEDICAMENTO_idMEDICAMENTO FROM pedido WHERE idPEDIDO = :idPedido)");
    $sentenciaUpdateMedicamento->bindParam(":nuevaCantidad", $nuevaCantidad);
    $sentenciaUpdateMedicamento->bindParam(":idPedido", $idPEDIDO);

    if ($sentenciaUpdateMedicamento->execute()) {
      // Actualizar la devolución
      $sentenciaUpdateDevolucion = $conexion->prepare("UPDATE devoluciones SET cantidadD = :cantidadD, nombreProducto = :nombreProducto, estadoD = :estadoD, motivoD = :motivoD, cantidadUD = :cantidadUD, PEDIDO_idPEDIDO = :PEDIDO_idPEDIDO WHERE idDevoluciones = :idDevoluciones");

      $sentenciaUpdateDevolucion->bindParam(":cantidadD", $cantidadD);
      $sentenciaUpdateDevolucion->bindParam(":nombreProducto", $nombreProducto);
      $sentenciaUpdateDevolucion->bindParam(":estadoD", $estadoD);
      $sentenciaUpdateDevolucion->bindParam(":motivoD", $motivoD);
      $sentenciaUpdateDevolucion->bindParam(":cantidadUD", $cantidadUD);
      $sentenciaUpdateDevolucion->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);
      $sentenciaUpdateDevolucion->bindParam(":idDevoluciones", $txtID);

      if ($sentenciaUpdateDevolucion->execute()) {
        $mensaje = "Registro Actualizado";
        header("Location:index.php?mensaje=" . $mensaje);
        exit();
      } else {
        echo "Error al actualizar la devolución.";
      }
    } else {
      echo "Error al actualizar la cantidad del medicamento.";
    }
  } else {
    echo "Error al obtener la cantidad original del medicamento.";
  }
}

$sentenciaidPEDIDO = $conexion->prepare("SELECT idPEDIDO, Nombre_Producto FROM pedido");
$sentenciaidPEDIDO->execute();
$IdPEDIDO = $sentenciaidPEDIDO->fetchAll(PDO::FETCH_ASSOC);

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
      <div class="mb-3" style="display: none;">
        <label for="txtID" class="form-label">ID</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">

      </div>

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
        <input type="text" value="<?php// echo $nombreProducto; ?>" class="form-control" name="nombreProducto"
          id="nombreProducto" aria-describedby="helpId" placeholder="Nombre del Producto">

      </div> -->
      <div class="mb-3">
        <label for="motivoD" class="form-label">Motivo de la Devolucion</label>
        <input type="text" value="<?php echo $motivoD; ?>" class="form-control" name="motivoD" id="motivoD"
          aria-describedby="helpId" placeholder="Agrega el motivo de la devolucion ">

      </div>
      <div class="mb-3">
        <label for="estadoD" class="form-label">Estado de la devolución</label>
        <select class="form-select" name="estadoD" id="estadoD">
          <option value="Aprobada">Aprobada</option>
          <option value="Rechazada">Rechazada</option>
          <!-- Agrega más opciones según tus necesidades -->
        </select>
      </div>
      <!-- <div class="mb-3">
        <label for="cantidadD" class="form-label">Cantidad de cajas</label>
        <input type="text" value="" class="form-control" name="cantidadD" id="cantidadD" aria-describedby="helpId"
          placeholder="Cantidad de cajas del pedido">

        </div> -->
      <div class="mb-3">
        <label for="cantidadUD" class="form-label">Cantidad de unidades</label>
        <input type="text" value="<?php echo $cantidadUD; ?>" class="form-control" name="cantidadUD" id="cantidadUD"
          aria-describedby="helpId" placeholder="Agrega la cantidad de unidades ">

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
        <button type="submit" class="btn btn-success" name="agregarMed">Agregar Medicamento</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="cancel" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>
  <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>