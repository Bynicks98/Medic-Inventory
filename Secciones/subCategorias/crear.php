<?php
include("../../database.php");
if ($_POST) {

  // Recolección de datos
  $NombreSubcat = (isset($_POST["nombreSubcat"]) ? $_POST["nombreSubcat"] : "");
  $DescripcionSubcat = (isset($_POST["descripcionSubcat"]) ? $_POST["descripcionSubcat"] : "");
  $idCATEGORIA = (isset($_POST["CATEGORIA_idCATEGORIA"]) ? $_POST["CATEGORIA_idCATEGORIA"] : "");
  // Insertar datos 
  $sentencia = $conexion->prepare("INSERT INTO subcategoria(idSUBCATEGORIA, descripcionSubcat, nombreSubcat , CATEGORIA_idCATEGORIA)
   VALUES (null, :nombreSubcat, :descripcionSubcat, :idCATEGORIA)");
  // Asignación de valores
  $sentencia->bindParam(":nombreSubcat", $NombreSubcat);
  $sentencia->bindParam(":descripcionSubcat", $DescripcionSubcat);
  $sentencia->bindParam(":idCATEGORIA", $idCATEGORIA);
  $sentencia->execute();
  $mensaje = "Registro agregado";
  header("Location:index.php?mensaje=" . $mensaje);
}
$sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat FROM categoria");
$sentenciaCat->execute();
$CATEGORIA = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../Plantillas/header.php"); ?>
<div class="card">
  <div class="card-header">
    <h1>Nueva SubCategoria</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
      <div class="mb-3">
        <label for="" class="form-label">Nombre SubCategoria</label>
        <input type="text" class="form-control" name="nombreSubcat" id="" aria-describedby="helpId"
          placeholder="Dale un nombre a la Categoria">

      </div>
      <div class="mb-3">
        <label for="" class="form-label">Descripcion</label>
        <input type="text" class="form-control" name="descripcionSubcat" id="" aria-describedby="helpId"
          placeholder="Añade una descripcion para la Categoria">

      </div>
      <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->

      <!-- menu desplegable idCategoria -->
      <div class="mb-3">
        <label for="idCATEGORIA" class="form-label">Categoria</label>
        <select class="form-select form-select-lg" name="CATEGORIA_idCATEGORIA" id="idCATEGORIA">
          <?php foreach ($CATEGORIA as $subcategoria) { ?>
            <option value="<?php echo $subcategoria['idCATEGORIA']; ?>">
              <?php echo $subcategoria['nombreCat']; ?>
            </option>
          <?php } ?>
        </select>
        <button type="submit" class="btn btn-success">Agregar SubCategoria</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        <div class="card-footer text-muted">
    </form>
  </div>


</div>
</div>

<?php include("../../Plantillas/footer.php"); ?>