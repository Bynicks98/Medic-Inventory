<?php
include("../../database.php");
if ($_POST) {

  // Recolección de datos
  $NombreSucursal = isset($_POST["nombreIps"]) ? $_POST["nombreIps"] : "";
  $DireccionSucurs = isset($_POST["direccionSucur"]) ? $_POST["direccionSucur"] : "";
  $NivelSucursal = isset($_POST["nivelSucursal"]) ? $_POST["nivelSucursal"] : "";
  // Insertar datos
  $sentencia = $conexion->prepare("INSERT INTO sucursalips(idSUCURSAL, nombreIps, direccionSucur, nivelSucursal) VALUES (null, :nombreIps, :direccionSucur, :nivelSucursal)");
  // Asignación de valores
  $sentencia->bindParam(":nombreIps", $NombreSucursal);
  $sentencia->bindParam(":direccionSucur", $DireccionSucurs);
  $sentencia->bindParam(":nivelSucursal", $NivelSucursal);
  $sentencia->execute();
  $mensaje = "Registro agregado";
  header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card">
  <div class="card-header">
    <h1>Nueva Sucursal</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
      <div class="mb-3">
        <label for="nombreIps" class="form-label">Nombre de la Sucursal</label>
        <input type="text" class="form-control" name="nombreIps" id="nombreIps" aria-describedby="helpId"
          placeholder="Dale un nombre a la Sucursal">

      </div>
      <div class="mb-3">
        <label for="nivelSucursal" class="form-label">Nivel </label>
        <input type="text" class="form-control" name="nivelSucursal" id="nivelSucursal" aria-describedby="helpId"
          placeholder="Ingresa el nivel de la Sucursal">
      </div>
      <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
      <div class="mb-3">
        <label for="direccionSucur" class="form-label">Direccion</label>
        <input type="text" class="form-control" name="direccionSucur" id="direccionSucur" aria-describedby="helpId"
          placeholder="Ingresa la direccion de la Sucursal">
      </div>
      <div class="card-footer text-muted">
        <button type="submit" class="btn btn-primary">Agregar Sucursal</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
      </div>
  </div>
  </form>
</div>



<?php include("../../Plantillas/footer.php"); ?>