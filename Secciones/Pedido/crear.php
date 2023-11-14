<?php include("../../Plantillas/header.php");
if ($_POST) {
  $idPEDIDO = (isset($_POST["idPEDIDO"]) ? $_POST["idPEDIDO"] : "");
  $fechaPedido = (isset($_POST["fechaPedido"]) ? $_POST["fechaPedido"] : "");
  $costoPedido = (isset($_POST["costoPedido"]) ? $_POST["costoPedido"] : "");
  $Nombre_Producto = (isset($_POST["Nombre_Producto"]) ? $_POST["Nombre_Producto"] : "");
  $cantidadP = (isset($_POST["cantidadP"]) ? $_POST["cantidadP"] : "");
  $Fecha_entrega = (isset($_POST["Fecha_entrega"]) ? $_POST["Fecha_entrega"] : "");
  $Fecha_envio = (isset($_POST["Fecha_envio"]) ? $_POST["Fecha_envio"] : "");
  $EstadoP = (isset($_POST["EstadoP"]) ? $_POST["EstadoP"] : "");
  $SUCURSALIPS_idSUCURSALIPS = (isset($_POST["SUCURSALIPS_idSUCURSALIPS"]) ? $_POST["SUCURSALIPS_idSUCURSALIPS"] : "");
  $DISTRIBUIDOR_idDISTRIBUIDOR = (isset($_POST["DISTRIBUIDOR_idDISTRIBUIDOR"]) ? $_POST["DISTRIBUIDOR_idDISTRIBUIDOR"] : "");
  $PAGO_idPAGO = (isset($_POST["PAGO_idPAGO"]) ? $_POST["PAGO_idPAGO"] : "");
  $MEDICAMENTO_idMEDICAMENTO = (isset($_POST["MEDICAMENTO_idMEDICAMENTO"]) ? $_POST["MEDICAMENTO_idMEDICAMENTO"] : "");
  $MEDICAMENTO_Persona_idPersona = (isset($_POST["MEDICAMENTO_Persona_idPersona"]) ? $_POST["MEDICAMENTO_Persona_idPersona"] : "");
  $MEDICAMENTO_PERSONA_ROL_idRol = (isset($_POST["MEDICAMENTO_PERSONA_ROL_idRol"]) ? $_POST["MEDICAMENTO_PERSONA_ROL_idRol"] : "");
  $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = (isset($_POST["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"]) ? $_POST["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"] : "");
  $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = (isset($_POST["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"]) ? $_POST["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"] : "");
  $FORMULAMEDICA_idFORMULA = (isset($_POST["FORMULAMEDICA_idFORMULA"]) ? $_POST["FORMULAMEDICA_idFORMULA"] : "");
  $cantidad_devuelta = (isset($_POST["cantidad_devuelta"]) ? $_POST["cantidad_devuelta"] : "");

  $sentencia = $conexion->prepare("INSERT INTO pedido (idPEDIDO, fechaPedido, costoPedido, Nombre_Producto, cantidadP, Fecha_entrega, Fecha_envio, EstadoP, SUCURSALIPS_idSUCURSALIPS, DISTRIBUIDOR_idDISTRIBUIDOR, PAGO_idPAGO, MEDICAMENTO_idMEDICAMENTO, MEDICAMENTO_Persona_idPersona, MEDICAMENTO_PERSONA_ROL_idRol, MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA, MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA, FORMULAMEDICA_idFORMULA, cantidad_devuelta)
VALUES (null, :fechaPedido, :costoPedido, :Nombre_Producto, :cantidadP, :Fecha_entrega, :Fecha_envio, :EstadoP, :SUCURSALIPS_idSUCURSALIPS, :DISTRIBUIDOR_idDISTRIBUIDOR, :PAGO_idPAGO, :MEDICAMENTO_idMEDICAMENTO, :MEDICAMENTO_Persona_idPersona, :MEDICAMENTO_PERSONA_ROL_idRol, :MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA, :MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA, :FORMULAMEDICA_idFORMULA, :cantidad_devuelta)");

  $sentencia->bindParam(":fechaPedido", $fechaPedido);
  $sentencia->bindParam(":costoPedido", $costoPedido);
  $sentencia->bindParam(":Nombre_Producto", $Nombre_Producto);
  $sentencia->bindParam(":cantidadP", $cantidadP);
  $sentencia->bindParam(":Fecha_entrega", $Fecha_entrega);
  $sentencia->bindParam(":Fecha_envio", $Fecha_envio);
  $sentencia->bindParam(":EstadoP", $EstadoP);
  $sentencia->bindParam(":SUCURSALIPS_idSUCURSALIPS", $SUCURSALIPS_idSUCURSALIPS);
  $sentencia->bindParam(":DISTRIBUIDOR_idDISTRIBUIDOR", $DISTRIBUIDOR_idDISTRIBUIDOR);
  $sentencia->bindParam(":PAGO_idPAGO", $PAGO_idPAGO);
  $sentencia->bindParam(":MEDICAMENTO_idMEDICAMENTO", $MEDICAMENTO_idMEDICAMENTO);
  $sentencia->bindParam(":MEDICAMENTO_Persona_idPersona", $MEDICAMENTO_Persona_idPersona);
  $sentencia->bindParam(":MEDICAMENTO_PERSONA_ROL_idRol", $MEDICAMENTO_PERSONA_ROL_idRol);
  $sentencia->bindParam(":MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA", $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA);
  $sentencia->bindParam(":MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA", $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA);
  $sentencia->bindParam(":FORMULAMEDICA_idFORMULA", $FORMULAMEDICA_idFORMULA);
  $sentencia->bindParam(":cantidad_devuelta", $cantidad_devuelta);

  $sentencia->execute();
  header("location:index.php");
}

$sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
$sentenciaRoles->execute();
$roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPersona = $conexion->prepare("SELECT idPersona, nombreP FROM persona");
$sentenciaPersona->execute();
$Persona = $sentenciaPersona->fetchAll(PDO::FETCH_ASSOC);

$sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat  FROM categoria");
$sentenciaCat->execute();
$Categorias = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);


$sentenciaSubcat = $conexion->prepare("SELECT idSUBCATEGORIA, nombreSubcat FROM subcategoria ");
$sentenciaSubcat->execute();
$Subcategorias = $sentenciaSubcat->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST[""]) && $_POST[""]) {
  $sentencia2 = $conexion->prepare("UPDATE medicamento set cantidadCajas = :cantidadCajas where idMEDICAMENTO = ");
}
?>

<div class="card">
  <div class="card-header">
    <h1>Nuevo Pedido</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
      <div class="mb-3">
        <label for="fechaPedido" class="form-label">Fecha del Pedido</label>
        <input type="date" class="form-control" name="fechaPedido" id="fechaPedido" aria-describedby="helpId"
          placeholder="">
        <div class="mb-3">
          <label for="" class="form-label">Costo</label>
          <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
            placeholder="Ingresa el costo del pedido">
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Nombre del Producto</label>
          <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
            placeholder="Ingresa el nombre del producto">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Cantidad</label>
          <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
            placeholder="Ingresa la cantida del pedido">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Fecha de entrega</label>
          <input type="date" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Fecha de envio</label>
          <input type="date" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <h6>Estado</h6>
        <input type="text" class="form-control" id="opcion-seleccionada" readonly
          placeholder="Añade un estado al pedido">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Seleccionar
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#" data-value="opcion1">Completo</a></li>
          <li><a class="dropdown-item" href="#" data-value="opcion2">En Reparto</a></li>
          <li><a class="dropdown-item" href="#" data-value="opcion3">Incompleto</a></li>
        </ul>
    </form>
  </div>

  <div class="card-footer text-muted">
    <a name="" id="" class="btn btn-success" href="index.php" role="button">Agregar Pedido</a>
    <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
  </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>