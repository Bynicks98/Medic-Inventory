<?php
include("../../database.php");
if(isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia = $conexion->prepare("SELECT * FROM sucursalips WHERE idSUCURSAL=:idSUCURSAL");
  $sentencia->bindParam(":idSUCURSAL", $txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $NombreSucursal=$registro["nombreIps"];
  $DireccionSucur=$registro["direccionSucur"];
  $nivelSucursal=$registro["nivelSucursal"];


}
if ($_POST) {
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  // Recolección de datos
  $NombreSucursal = isset($_POST["nombreIps"]) ? $_POST["nombreIps"] : "";
  $DireccionSucurs = isset($_POST["direccionSucur"]) ? $_POST["direccionSucur"] : "";
  $NivelSucursal = isset($_POST["nivelSucursal"]) ? $_POST["nivelSucursal"] : "";
  // Insertar datos
 
  $sentencia = $conexion->prepare("UPDATE sucursalips SET nombreIps=:nombreIps, direccionSucur=:direccionSucur, nivelSucursal=:nivelSucursal WHERE idSUCURSAL=:idSUCURSAL");
  // Asignación de valores
  $sentencia->bindParam(":idSUCURSAL", $txtID );
  $sentencia->bindParam(":nombreIps", $NombreSucursal);
  $sentencia->bindParam(":direccionSucur", $DireccionSucurs);
  $sentencia->bindParam(":nivelSucursal", $NivelSucursal);
  $sentencia->execute();
  header("Location:index.php");
}

?>

<?php include("../../Plantillas/header.php"); ?>


<div class="card">
    <div class="card-header">
        <h1>Editar Sucursal</h1>
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          
        <div class=
      <label for="txtID" class="form-label">ID</label>
      <input type="text"
      value="<?php echo  $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

    </div>
          <label for="" class="form-label">Nombre de la Sucursal</label>
          <input type="text"
          value="<?php echo $NombreSucursal;?>"
            class="form-control" name="nombreIps" id="" aria-describedby="helpId" placeholder="Dale un nombre a la Sucursal">

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Nivel </label>
          <input type="text"
          value="<?php echo $nivelSucursal;?>"
            class="form-control" name="nivelSucursal" id="" aria-describedby="helpId" placeholder="Ingresa el nivel de la Sucursal">
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Direccion</label>
          <input type="text"
          value="<?php echo $DireccionSucur;?>"
            class="form-control" name="direccionSucur" id="" aria-describedby="helpId" placeholder="Ingresa la direccion de la Sucursal">
        </div>
        <div class="card-footer text-muted">
        <button type="submit" class="btn btn-primary">Actualizar Sucursal</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </div>
    </form>
    </div>
   

</div>

<?php include("../../Plantillas/footer.php"); ?>