<?php
include("../../database.php");

$sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat  FROM categoria");
$sentenciaCat->execute();
$Categorias = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM subcategoria WHERE idSUBCATEGORIA=:idSUBCATEGORIA");
  $sentencia->bindParam(":idSUBCATEGORIA", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  if ($registro) {
    # code...

    $NombreSubcat = $registro["nombreSubcat"];
    $DescripcionSubcat = $registro["descripcionSubcat"];
    $idCATEGORIA = $registro["CATEGORIA_idCATEGORIA"];
  }


}
if ($_POST) {

  // Recolección de datos
  $NombreSubcat = (isset($_POST["nombreSubcat"]) ? $_POST["nombreSubcat"] : "");
  $DescripcionSubcat = (isset($_POST["descripcionSubcat"]) ? $_POST["descripcionSubcat"] : "");
  $CATEGORIA_idCATEGORIA = (isset($_POST["CATEGORIA_idCATEGORIA"]) ? $_POST["CATEGORIA_idCATEGORIA"] : "");

  // Insertar datos 
  $sentencia = $conexion->prepare("UPDATE subcategoria SET  descripcionSubcat=:descripcionSubcat, nombreSubcat=:nombreSubcat, CATEGORIA_idCATEGORIA = :CATEGORIA_idCATEGORIA where idSUBCATEGORIA=:idSUBCATEGORIA");
  // Asignación de valores
  $sentencia->bindParam(":nombreSubcat", $NombreSubcat);
  $sentencia->bindParam(":descripcionSubcat", $DescripcionSubcat);
  $sentencia->bindParam(":CATEGORIA_idCATEGORIA", $CATEGORIA_idCATEGORIA);
  $sentencia->bindParam("idSUBCATEGORIA", $txtID);
  $sentencia->execute();
  $mensaje = "Registro Actualizado";
  header("Location:index.php?mensaje=" . $mensaje);
}

?>

<?php include("../../Plantillas/header.php"); ?>

<h2>Editar SubCategoria</h2>
<div class="card-body">
  <form action="" method="post" enctype="multipart/form-data">
    <!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
    <div class="mb-3" style="display: none;">
      <label for="txtID" class="form-label">ID</label>
      <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
        aria-describedby="helpId" placeholder="ID">

    </div>
    <div class="mb-3">
      <label for="nombreSubcat" class="form-label">Nombre SubCategoria</label>
      <input type="text" value="<?php echo isset($NombreSubcat) ? $NombreSubcat : ''; ?>" class="form-control" name="nombreSubcat" id="" aria-describedby="helpId"
        placeholder="Nuevo nombre de la SubCategoria">

    </div>
    <div class="mb-3">
      <label for="descripcionSubcat" class="form-label">Descripcion</label>
      <input type="text" value="<?php echo isset($DescripcionSubcat)? $DescripcionSubcat : ''; ?>" class="form-control" name="descripcionSubcat" id="descripcionSubcat" aria-describedby="helpId"
        placeholder="Nueva descripcion de la SubCategoria">

    </div>

    <div class="mb-3">
        <label for="CATEGORIA_idCATEGORIA" class="form-label">CATEGORIA</label>
        <select class="form-select form-select-lg" name="CATEGORIA_idCATEGORIA" id="CATEGORIA_idCATEGORIA">
          <option value="">Selecciona una categoría</option>
          <?php foreach ($Categorias as $categoria) { ?>
            <option value="<?php echo $categoria['idCATEGORIA']; ?>" <?php if ($categoria['idCATEGORIA'] == $idCATEGORIA)
                 echo 'selected'; ?>>
              <?php echo $categoria['nombreCat']; ?>
            </option> 
          <?php } ?>
        </select>
      </div>
    <button type="submit" class="btn btn-success" href="index.php">Editar SubCategoria</button>
    <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
  </form>
</div>

<div class="card-footer text-muted">

</div>

<?php include("../../Plantillas/footer.php"); ?>