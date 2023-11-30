<?php
include("../../database.php");
if ($_POST) {
  
  // Recolección de datos
  $NombreProve = (isset($_POST["nombreProve"]) ? $_POST["nombreProve"] : "");
  $NITproveedores = (isset($_POST["NITproveedores"]) ? $_POST["NITproveedores"] : "");
  $direccionProve = (isset($_POST["direccionProve"]) ? $_POST["direccionProve"] : "");
  $telefonoProve = (isset($_POST["telefonoProve"]) ? $_POST["telefonoProve"] : "");
  $celularProve = (isset($_POST["celularProve"]) ? $_POST["celularProve"] : "");
  $idSUCURSAL_idSUCURSAL = (isset($_POST["SUCURSALIPS_idSUCURSALIPS"]) ? $_POST["SUCURSALIPS_idSUCURSALIPS"] : "");
  // Insertar datos 
  $sentencia = $conexion->prepare("INSERT INTO proveedor(idPROVEEDOR, direccionProve, nombreProve, NITproveedores, telefonoProve, celularProve, SUCURSALIPS_idSUCURSALIPS)
   VALUES (null, :direccionProve, :nombreProve, :NITproveedores, :telefonoProve, :celularProve, :SUCURSALIPS_idSUCURSALIPS)");
  // Asignación de valores
  $sentencia->bindParam(":nombreProve", $NombreProve);
  $sentencia->bindParam(":direccionProve", $direccionProve);
  $sentencia->bindParam(":NITproveedores", $NITproveedores);
  $sentencia->bindParam(":telefonoProve", $telefonoProve);
  $sentencia->bindParam(":celularProve", $celularProve);
  $sentencia->bindParam(":SUCURSALIPS_idSUCURSALIPS", $idSUCURSAL_idSUCURSAL);
  $sentencia->execute();
  $mensaje="Registro agregado";
  header("Location:index.php?mensaje=".$mensaje);
}
$sentenciaSUCURSAL = $conexion->prepare("SELECT idSUCURSAL, nombreIps FROM sucursalips");
$sentenciaSUCURSAL->execute();
$Sucur = $sentenciaSUCURSAL->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>
<div class="card">
    <div class="card-header">
        <h1>Nuevo Proveedor</h1>
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          <label for="" class="form-label">Nombre Proveedor</label>
          <input type="text"
            class="form-control" name="nombreProve" id="" aria-describedby="helpId" placeholder="Dale un nombre al Proveedor" required>

        </div>
        <div class="mb-3">
          <label for="" class="form-label">NIT</label>
          <input type="text"
            class="form-control" name="NITproveedores" id="" aria-describedby="helpId" placeholder="Ingresa el NIT del Proveedor" required>
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Direccion</label>
          <input type="text"
            class="form-control" name="direccionProve" id="" aria-describedby="helpId" placeholder="Ingresa la direccion del Proveedor" required>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Celular</label>
          <input type="text"
            class="form-control" name="celularProvee" id="" aria-describedby="helpId" placeholder="Ingresa el celular del Proveedor" required>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Telefono</label>
          <input type="text"
            class="form-control" name="telefonoProve" id="" aria-describedby="helpId" placeholder="Ingresa el telefono del Proveedor" required>
        </div>
        <div class="mb-3">
    <label for="idSUCURSAL" class="form-label">Sucursal a la que esta provee</label>
    <select class="form-select form-select-lg" name="SUCURSALIPS_idSUCURSALIPS" id="idSUCURSAL">
      <?php foreach ($Sucur as $Sucursales) { ?>
        <option value="<?php echo $Sucursales['idSUCURSAL']; ?>">
          <?php echo $Sucursales['nombreIps']; ?>
        </option>
      <?php } ?>
    </select>
  </div>
        <button type="submit" class="btn btn-success" >Agregar Proveedor</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
   
    <div class="card-footer text-muted">
   
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>