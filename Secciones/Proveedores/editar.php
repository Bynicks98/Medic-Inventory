<?php
include("../../database.php");
if(isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  $sentencia = $conexion->prepare("SELECT * FROM proveedor WHERE idPROVEEDOR=:idPROVEEDOR");
   $sentencia->bindParam(":idPROVEEDOR", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  if ($registro) {
    $NombreProve = $registro["nombreProve"];
    $telefonoProve = $registro["telefonoProve"];
    $direccionProve= $registro["direccionProve"];
    $celularProve = $registro["celularProve"];
    $NITproveedores = $registro["NITproveedores"];
    $idSUCURSAL_idSUCURSAL = $registro["SUCURSALIPS_idSUCURSALIPS"];
  }
}
if ($_POST) {
  // Recolección de datos
  $NombreProve  = (isset($_POST["nombreProve"]) ? $_POST["nombreProve"] : "");
  $NITproveedores = (isset($_POST["NITproveedores"]) ? $_POST["NITproveedores"] : "");
  $direccionProve = (isset($_POST["direccionProve"]) ? $_POST["direccionProve"] : "");
  $telefonoProve = (isset($_POST["telefonoProve"]) ? $_POST["telefonoProve"] : "");
  $celularProve = (isset($_POST["celularProve"]) ? $_POST["celularProve"] : "");
  $idSUCURSAL_idSUCURSAL = (isset($_POST["SUCURSALIPS_idSUCURSALIPS"]) ? $_POST["SUCURSALIPS_idSUCURSALIPS"] : "");
  // Insertar datos 
  $sentencia = $conexion->prepare("UPDATE proveedor SET direccionProve =:direccionProve, nombreProve =:nombreProve, NITproveedores = :NITproveedores, telefonoProve = :telefonoProve, celularProve = :celularProve, SUCURSALIPS_idSUCURSALIPS = :SUCURSALIPS_idSUCURSALIPS
   where idPROVEEDOR=:idPROVEEDOR");
  // Asignación de valores
  $sentencia->bindParam(":nombreProve", $NombreProve);
  $sentencia->bindParam(":direccionProve", $direccionProve);
  $sentencia->bindParam(":NITproveedores", $NITproveedores);
  $sentencia->bindParam(":telefonoProve", $telefonoProve);
  $sentencia->bindParam(":celularProve", $celularProve);
  $sentencia->bindParam(":idPROVEEDOR", $txtID);
  $sentencia->bindParam(":SUCURSALIPS_idSUCURSALIPS", $idSUCURSAL_idSUCURSAL);
  $sentencia->execute();
  $mensaje="Registro actualizado";
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
      <label for="txtID" class="form-label">ID</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

        </div>    
        <div class="mb-3">
          <label for="" class="form-label">Nombre Proveedor</label>
          <input type="text" value="<?php echo isset($NombreProve) ? $NombreProve : ''; ?>"
            class="form-control" name="nombreProve" id="" aria-describedby="helpId" placeholder="Dale un nombre al Proveedor">

        </div>
        <div class="mb-3">
          <label for="" class="form-label">NIT</label>
          <input type="text" value="<?php echo $NITproveedores; ?>"
            class="form-control" name="NITproveedores" id="" aria-describedby="helpId" placeholder="Ingresa el NIT del Proveedor">
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Direccion</label>
          <input type="text" value="<?php echo $direccionProve; ?>"
            class="form-control" name="direccionProve" id="" aria-describedby="helpId" placeholder="Ingresa la direccion del Proveedor">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Celular</label>
          <input type="text" value="<?php echo $celularProve; ?>"
            class="form-control" name="celularProve" id="" aria-describedby="helpId" placeholder="Ingresa el celular del Proveedor">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Telefono</label>
          <input type="text" value="<?php echo $telefonoProve; ?>"
            class="form-control" name="telefonoProve" id="" aria-describedby="helpId" placeholder="Ingresa el telefono del Proveedor">
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
        <button type="submit" class="btn btn-success" >Editar Proveedor</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
   
    <div class="card-footer text-muted">
   
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>