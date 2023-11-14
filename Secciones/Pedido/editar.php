<?php
include("../../database.php");

if (isset($_GET['idPEDIDO'])) {
    $idPEDIDO = (isset($_GET['idPEDIDO'])) ? $_GET['idPEDIDO'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM pedido WHERE idPEDIDO = :idPEDIDO");
    $sentencia->bindParam(":idPEDIDO", $idPEDIDO);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    if ($registro) {
        $fechaPedido = $registro["fechaPedido"];
        $costoPedido = $registro["costoPedido"];
        $Nombre_Producto = $registro["Nombre_Producto"];
        $cantidadP = $registro["cantidadP"];
        $Fecha_entrega = $registro["Fecha_entrega"];
        $Fecha_envio = $registro["Fecha_envio"];
        $EstadoP = $registro["EstadoP"];
        $SUCURSALIPS_idSUCURSALIPS = $registro["SUCURSALIPS_idSUCURSALIPS"];
        $DISTRIBUIDOR_idDISTRIBUIDOR = $registro["DISTRIBUIDOR_idDISTRIBUIDOR"];
        $PAGO_idPAGO = $registro["PAGO_idPAGO"];
        $MEDICAMENTO_idMEDICAMENTO = $registro["MEDICAMENTO_idMEDICAMENTO"];
        $MEDICAMENTO_Persona_idPersona = $registro["MEDICAMENTO_Persona_idPersona"];
        $MEDICAMENTO_PERSONA_ROL_idRol = $registro["MEDICAMENTO_PERSONA_ROL_idRol"];
        $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = $registro["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"];
        $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = $registro["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"];
        $FORMULAMEDICA_idFORMULA = $registro["FORMULAMEDICA_idFORMULA"];
        $cantidad_devuelta = $registro["cantidad_devuelta"];
        // Agrega el resto de los campos según tu estructura de base de datos
    }
}

if ($_POST) {
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
    // Agrega el resto de los campos según tu estructura de base de datos

    $sentencia = $conexion->prepare("UPDATE pedido SET fechaPedido = :fechaPedido, costoPedido = :costoPedido, Nombre_Producto = :Nombre_Producto, cantidadP = :cantidadP, Fecha_entrega = :Fecha_entrega, Fecha_envio = :Fecha_envio, EstadoP = :EstadoP, SUCURSALIPS_idSUCURSALIPS = :SUCURSALIPS_idSUCURSALIPS, DISTRIBUIDOR_idDISTRIBUIDOR = :DISTRIBUIDOR_idDISTRIBUIDOR, PAGO_idPAGO = :PAGO_idPAGO, MEDICAMENTO_idMEDICAMENTO = :MEDICAMENTO_idMEDICAMENTO, MEDICAMENTO_Persona_idPersona = :MEDICAMENTO_Persona_idPersona, MEDICAMENTO_PERSONA_ROL_idRol = :MEDICAMENTO_PERSONA_ROL_idRol, MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = :MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA, MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = :MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA, FORMULAMEDICA_idFORMULA = :FORMULAMEDICA_idFORMULA, cantidad_devuelta = :cantidad_devuelta WHERE idPEDIDO = :idPEDIDO");

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
    // Agrega el resto de los campos según tu estructura de base de datos

    $sentencia->bindParam(":idPEDIDO", $idPEDIDO);
    $sentencia->execute();
    header("Location:index.php");
}

$sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat FROM categoria");
$sentenciaCat->execute();
$Categorias = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSubcat = $conexion->prepare("SELECT idSUBCATEGORIA, nombreSubcat FROM subcategoria");
$sentenciaSubcat->execute();
$Subcategorias = $sentenciaSubcat->fetchAll(PDO::FETCH_ASSOC);

$sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
$sentenciaRoles->execute();
$roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPersona = $conexion->prepare("SELECT idPersona, nombreP FROM persona");
$sentenciaPersona->execute();
$Persona = $sentenciaPersona->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include("../../Plantillas/header.php");?>
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
          <label for="costoPedido" class="form-label">Costo</label>
          <input type="text" class="form-control" name="costoPedido" id="costoPedido" aria-describedby="helpId"
            placeholder="Ingresa el costo del pedido">
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="MEDICAMENTO_idMEDICAMENTO" class="form-label">Nombre del Producto</label>
          <select class="form-select" name="MEDICAMENTO_idMEDICAMENTO" id="MEDICAMENTO_idMEDICAMENTO" required>
            <option value="">Selecciona un medicamento</option>
            <?php foreach ($nombresMedicamentos as $medicamento) { ?>
              <option value="<?php echo $medicamento['idMEDICAMENTO']; ?>">
                <?php echo $medicamento['nombreMedica']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="cantidadP" class="form-label">Cantidad</label>
          <input type="text" class="form-control" name="cantidadP" id="cantidadP" aria-describedby="helpId"
            placeholder="Ingresa la cantida del pedido">
        </div>
        <div class="mb-3">
          <label for="Fecha_entrega" class="form-label">Fecha de entrega</label>
          <input type="date" class="form-control" name="Fecha_entrega" id="Fecha_entrega" aria-describedby="helpId"
            placeholder="">
        </div>
        <div class="mb-3">
          <label for="Fecha_envio" class="form-label">Fecha de envio</label>
          <input type="date" class="form-control" name="Fecha_envio" id="Fecha_envio" aria-describedby="helpId"
            placeholder="">
        </div>
        <div class="mb-3">
          <label for="SUCURSALIPS_idSUCURSALIPS" class="form-label">Sucursal</label>
          <select class="form-select" name="SUCURSALIPS_idSUCURSALIPS" id="SUCURSALIPS_idSUCURSALIPS" required>
            <option value="">Seleccion de sucursal</option>
            <?php foreach ($idsucursal as $idSUCUR) { ?>
              <option value="<?php echo $idSUCUR['idSUCURSAL']; ?>">
                <?php echo $idSUCUR['nombreIps']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="DISTRIBUIDOR_idDISTRIBUIDOR" class="form-label">Distribuidor</label>
          <select class="form-select" name="DISTRIBUIDOR_idDISTRIBUIDOR" id="DISTRIBUIDOR_idDISTRIBUIDOR" required>
            <option value="">Selecciona un distribuidor</option>
            <?php foreach ($distribuidores as $distribuidor) { ?>
              <option value="<?php echo $distribuidor['idDISTRIBUIDOR']; ?>">
                <?php echo $distribuidor['nombreDistri']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="PAGO_idPAGO" class="form-label">Referencia de pago</label>
          <select class="form-select" name="PAGO_idPAGO" id="PAGO_idPAGO" required>
            <option value="">Selecciona la Referencia</option>
            <?php foreach ($pagos as $pago) { ?>
              <option value="<?php echo $pago['idPAGO']; ?>">
                <?php echo $pago['ReferenciaPago']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="MEDICAMENTO_Persona_idPersona" class="form-label">Nombre de la Persona</label>
          <select class="form-select" name="MEDICAMENTO_Persona_idPersona" id="MEDICAMENTO_Persona_idPersona" required>
            <option value="">Selecciona una persona</option>
            <?php foreach ($personas as $persona) { ?>
              <option value="<?php echo $persona['idPersona']; ?>">
                <?php echo $persona['nombreP']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="MEDICAMENTO_PERSONA_ROL_idRol" class="form-label">Rol de la Persona</label>
          <select class="form-select" name="MEDICAMENTO_PERSONA_ROL_idRol" id="MEDICAMENTO_PERSONA_ROL_idRol" required>
            <option value="">Selecciona un rol</option>
            <?php foreach ($roles as $rol) { ?>
              <option value="<?php echo $rol['idRol']; ?>">
                <?php echo $rol['nombreRol']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA" class="form-label">Subcategoría del Medicamento</label>
          <select class="form-select" name="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"
            id="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA" required>
            <option value="">Selecciona una subcategoría</option>
            <?php foreach ($subcategorias as $subcategoria) { ?>
              <option value="<?php echo $subcategoria['idSUBCATEGORIA']; ?>">
                <?php echo $subcategoria['nombreSubcat']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA" class="form-label">Categoría del
            Medicamento</label>
          <select class="form-select" name="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"
            id="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA" required>
            <option value="">Selecciona una categoría</option>
            <?php foreach ($categorias as $categoria) { ?>
              <option value="<?php echo $categoria['idCATEGORIA']; ?>">
                <?php echo $categoria['nombreCat']; ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="FORMULAMEDICA_idFORMULA" class="form-label">Formula medica</label>
          <select class="form-select" name="FORMULAMEDICA_idFORMULA" id="FORMULAMEDICA_idFORMULA" required>
            <option value="">Selecciona la formula medica</option>
            <?php foreach ($formulaM as $ForMed) { ?>
              <option value="<?php echo $ForMed['idFORMULA']; ?>">
                <?php echo $categoria['Referenciaformula']; ?>
              </option>
            <?php } ?>
          </select>
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
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-success" name="agregarPed">Agregar Pedido</button>
          <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
          <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </div>
    </form>
  </div>


</div>
<?php include("../../Plantillas/footer.php"); ?>