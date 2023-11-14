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

    // Consultar la cantidad actual en la tabla de devoluciones
    $consulta_devolucion = $conexion->prepare("SELECT cantidadDevueltaEnPedido FROM devoluciones WHERE PEDIDO_idPEDIDO = :idPEDIDO");
    $consulta_devolucion->bindParam(":idPEDIDO", $idPEDIDO);
    $consulta_devolucion->execute();

    // Verificar si la consulta se ejecuta correctamente
    if ($consulta_devolucion) {
        // Obtener el resultado de la consulta
        $resultado_devolucion = $consulta_devolucion->fetch(PDO::FETCH_ASSOC);

        // Verificar que el resultado es un array antes de acceder al índice
        if (is_array($resultado_devolucion)) {
            $cantidad_devuelta_actual = $resultado_devolucion['cantidadDevueltaEnPedido'];

            // Calcular la nueva cantidad devuelta en la tabla de devoluciones
            $nueva_cantidad_devolucion = $cantidad_devuelta_actual + $cantidadD;

            // Actualizar la cantidad de unidades en la tabla de medicamentos
            $consulta_medicamento = $conexion->prepare("SELECT cantidadUnidades FROM medicamento WHERE idMEDICAMENTO = :idMEDICAMENTO");
            $consulta_medicamento->bindParam(":idMEDICAMENTO", $idPEDIDO);
            $consulta_medicamento->execute();

            // Verificar si la consulta se ejecuta correctamente
            if ($consulta_medicamento) {
                // Obtener el resultado de la consulta
                $resultado_medicamento = $consulta_medicamento->fetch(PDO::FETCH_ASSOC);

                // Verificar que el resultado es un array antes de acceder al índice
                if (is_array($resultado_medicamento)) {
                    $cantidad_medicamento_actual = $resultado_medicamento['cantidadUnidades'];

                    // Verificar que no se devuelvan más medicamentos de los que se recibieron originalmente
                    if ($cantidadD <= $cantidad_medicamento_actual) {
                        // Calcular la nueva cantidad en la tabla de medicamentos (restar la cantidad devuelta)
                        $nueva_cantidad_medicamento = $cantidad_medicamento_actual - $cantidadD;

                        // Actualizar la cantidad en la tabla de medicamentos
                        $actualizar_medicamento = $conexion->prepare("UPDATE medicamento SET cantidadUnidades = :nueva_cantidad_medicamento WHERE idMEDICAMENTO = :idMEDICAMENTO");
                        $actualizar_medicamento->bindParam(":nueva_cantidad_medicamento", $nueva_cantidad_medicamento);
                        $actualizar_medicamento->bindParam(":idMEDICAMENTO", $idPEDIDO);
                        $actualizar_medicamento->execute();

                        // Insertar la devolución en la tabla de devoluciones
                        $insertar_devolucion = $conexion->prepare("INSERT INTO devoluciones (idDevoluciones, cantidadD, nombreProducto, estadoD, motivoD, cantidadDevueltaEnPedido, PEDIDO_idPEDIDO)
                        VALUES (null, :cantidadD, :nombreProducto, :estadoD, :motivoD, :nueva_cantidad_devolucion, :PEDIDO_idPEDIDO)");

                        // Asignar valores que tienen un solo :variable
                        $insertar_devolucion->bindParam(":cantidadD", $cantidadD);
                        $insertar_devolucion->bindParam(":nombreProducto", $nombreProducto);
                        $insertar_devolucion->bindParam(":estadoD", $estadoD);
                        $insertar_devolucion->bindParam(":motivoD", $motivoD);
                        $insertar_devolucion->bindParam(":nueva_cantidad_devolucion", $nueva_cantidad_devolucion);
                        $insertar_devolucion->bindParam(":PEDIDO_idPEDIDO", $idPEDIDO);
                        $insertar_devolucion->execute();

                        $mensaje = "Registro agregado";
                        header("Location: index.php?mensaje=" . $mensaje);
                        exit();
                    } else {
                        // Manejo de error: La cantidad devuelta es mayor a la cantidad originalmente recibida
                        die("Error: La cantidad devuelta es mayor a la cantidad originalmente recibida.");
                    }
                } else {
                    // Manejo de error: El resultado de la consulta de medicamento no es un array
                    die("Error: No se pudo obtener la cantidad de medicamento.");
                }
            } else {
                // Manejo de error: Problema al ejecutar la consulta de medicamento
                die("Error: Problema al consultar la cantidad de medicamento.");
            }
        } else {
            // Manejo de error: El resultado de la consulta de devolución no es un array
            die("Error: No se pudo obtener la cantidad devuelta.");
        }
    } else {
        // Manejo de error: Problema al ejecutar la consulta de devolución
        die("Error: Problema al consultar la cantidad devuelta.");
    }
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