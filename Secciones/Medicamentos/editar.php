<?php
include("../../database.php");
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM medicamento WHERE idMEDICAMENTO = :idMEDICAMENTO");
  $sentencia->bindParam(":idMEDICAMENTO", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  if ($registro) {
    $descripcionMedica = $registro["descripcionMedica"];
    $fechaVencimientoMedica = $registro["fechaVencimientoMedica"];
    $cantidadCajas = $registro["cantidadCajas"];
    $noLoteMedica = $registro["noLoteMedica"];
    $valorUnitMedica = $registro["valorUnitario"];
    $fechaFabricacionMedica = $registro["fechaFabricacionMedica"];
    $nombreMedica = $registro["nombreMedica"];
    $cantidadUnidades = $registro["cantidadUnidades"];
    $idCATEGORIA = $registro["idCATEGORIA"];
    $idSUBCATEGORIA = $registro["idSUBCATEGORIA"];
  }
}

if ($_POST) {
  $descripcionMedica = (isset($_POST["descripcionMedica"]) ? $_POST["descripcionMedica"] : "");
  $fechaVencimientoMedica = (isset($_POST["fechaVencimientoMedica"]) ? $_POST["fechaVencimientoMedica"] : "");
  $cantidadCajas = (isset($_POST["cantidadCajas"]) ? $_POST["cantidadCajas"] : "");
  $noLoteMedica = (isset($_POST["noLoteMedica"]) ? $_POST["noLoteMedica"] : "");
  $valorUnitMedica = (isset($_POST["valorUnitMedica"]) ? $_POST["valorUnitMedica"] : "");
  $fechaFabricacionMedica = (isset($_POST["fechaFabricacionMedica"]) ? $_POST["fechaFabricacionMedica"] : "");
  $nombreMedica = (isset($_POST["nombreMedica"]) ? $_POST["nombreMedica"] : "");
  $cantidadUnidades = (isset($_POST["cantidadUnidades"]) ? $_POST["cantidadUnidades"] : "");
  $idCATEGORIA = (isset($_POST["SUBCATEGORIA_CATEGORIA_idCATEGORIA"]) ? $_POST["SUBCATEGORIA_CATEGORIA_idCATEGORIA"] : "");
  $idSUBCATEGORIA = (isset($_POST["SUBCATEGORIA_idSUBCATEGORIA"]) ? $_POST["SUBCATEGORIA_idSUBCATEGORIA"] : "");
  $idRol = (isset($_POST["Persona_ROL_idRol"]) ? $_POST["Persona_ROL_idRol"] : "");
  $idPersona = (isset($_POST["Persona_idPersona"]) ? $_POST["Persona_idPersona"] : "");

  $sentencia = $conexion->prepare("UPDATE medicamento SET descripcionMedica = :descripcionMedica, fechaVencimientoMedica = :fechaVencimientoMedica, cantidadCajas = :cantidadCajas, noLoteMedica = :noLoteMedica, valorUnitMedica = :valorUnitMedica, fechaFabricacionMedica = :fechaFabricacionMedica, nombreMedica = :nombreMedica, cantidadUnidades = :cantidadUnidades, SUBCATEGORIA_CATEGORIA_idCATEGORIA = :idCATEGORIA, SUBCATEGORIA_idSUBCATEGORIA = :idSUBCATEGORIA WHERE idMEDICAMENTO = :idMEDICAMENTO");

  $sentencia->bindParam(":descripcionMedica", $descripcionMedica);
  $sentencia->bindParam(":fechaVencimientoMedica", $fechaVencimientoMedica);
  $sentencia->bindParam(":cantidadCajas", $cantidadCajas);
  $sentencia->bindParam(":noLoteMedica", $noLoteMedica);
  $sentencia->bindParam(":valorUnitMedica", $valorUnitMedica);
  $sentencia->bindParam(":fechaFabricacionMedica", $fechaFabricacionMedica);
  $sentencia->bindParam(":nombreMedica", $nombreMedica);
  $sentencia->bindParam(":cantidadUnidades", $cantidadUnidades);
  $sentencia->bindParam(":idCATEGORIA", $idCATEGORIA);
  $sentencia->bindParam(":idSUBCATEGORIA", $idSUBCATEGORIA);
  $sentencia->bindParam(":idMEDICAMENTO", $txtID);

  $sentencia->execute();
  header("Location:index.php");
}
$sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat  FROM categoria");
$sentenciaCat->execute();
$Categorias = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSubcat = $conexion->prepare("SELECT idSUBCATEGORIA, nombreSubcat FROM subcategoria");
$sentenciaSubcat->execute();
$Subcategorias = $sentenciaSubcat->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../Plantillas/header.php"); ?>

<br>

<div class="card">
  <div class="card-header">
    Datos del Medicamento
  </div>
  <div class="card-body">

    <form action="" method="post">
      <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">

      </div>
      <div class="mb-3">
        <label for="nombreMedica" class="form-label">Nombre </label>
        <input type="text" value="<?php echo $nombreMedica; ?>" class="form-control" name="nombreMedica" id="nombreMedica" aria-describedby="helpId"
          placeholder="Añade un nombre a tu medicamento">

      </div>
      <div class="mb-3">
        <label for="descripcionMedica" class="form-label">Descripcion del medicamento</label>
        <input type="text" value="<?php echo $descripcionMedica; ?>" class="form-control" name="descripcionMedica" id="descripcionMedica"
          aria-describedby="helpId" placeholder="Agrega el tipo de tu medicamento">

      </div>
      <div class="mb-3">
        <label for="fechaFabricacionMedica" class="form-label">Fecha de Fabricacion</label>
        <input type="date" value="<?php echo $fechaFabricacionMedica; ?>" class="form-control" name="fechaFabricacionMedica" id="fechaFabricacionMedica"
          aria-describedby="helpId" placeholder="elija la fecha de fabricacion">

      </div>
      <div class="mb-3">
        <label for="fechaVencimientoMedica" class="form-label">Fecha de Vencimiento</label>
        <input type="date" value="<?php echo $fechaVencimientoMedica; ?>" class="form-control" name="fechaVencimientoMedica" id="fechaVencimientoMedica"
          aria-describedby="helpId" placeholder="elija la fecha de fabricacion.">

      </div>
  </div>
  <div class="mb-3">
    <label for="cantidadCajas" class="form-label">Cantidad de cajas</label>
    <input type="text" value="<?php echo $cantidadCajas; ?>" class="form-control" name="cantidadCajas" id="cantidadCajas" aria-describedby="helpId" placholder="
      de cajasbricacion">

  </div>
  <div class="mb-3">
    <label for="cantidadUnidades" class="form-label">Cantidad de Unidades</label>
    <input type="text" value="<?php echo $cantidadUnidades; ?>" class="form-control" name="cantidadUnidades" id="ica" id="cantidadUnidades"
      aria-describedby="helpId" placeholder="elija la fecha de fabricacion">

  </div>
  <div class="mb-3">
    <label for="valorUnitMedica" class="form-label">valorUnitMedica</label>
    <input type="text" value="<?php echo $valorUnitMedica; ?>" class="form-control" name="valorUnitMedica" id="ica" id="valorUnitMedica"
      aria-describedby="helpId" placeholder="elija la fecha de fabricacion">

  </div>
  <div class="mb-3">
    <label for="noLoteMedica" class="form-label">noLoteMedica</label>
    <input type="text" value="<?php echo $noLoteMedica; ?>" class="form-control" name="noLoteMedica" id="ica" id="noLoteMedica" aria-describedby="helpId"
      placeholder="elija la fecha de fabricacion">

  </div>
  <div class="mb-3">
    <label for="idCATEGORIA" class="form-label">CATEGORIA</label>
    <select class="form-select form-select-lg" name="SUBCATEGORIA_CATEGORIA_idCATEGORIA" id="idCATEGORIA">
    <option value="">Selecciona una categoría</option>
      <?php foreach ($Categorias as $medicamento) { ?>
        <option value="<?php echo $medicamento['idCATEGORIA']; ?>">
          <?php echo $medicamento['nombreCat']; ?>
        </option>
      <?php } ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="idSUBCATEGORIA" class="form-label">SUBCATEGORIA</label>
    <select class="form-select form-select-lg" name="SUBCATEGORIA_idSUBCATEGORIA" id="idSUBCATEGORIA">
    <option value="">Selecciona una Subcategoría</option>
      <?php foreach ($Subcategorias as $medicamento) { ?>
        <option value="<?php echo $medicamento['idSUBCATEGORIA']; ?>">
          <?php echo $medicamento['nombreSubcat']; ?>
        </option>
      <?php } ?>
    </select>
  </div>

  <!-- FK categoria y subcategoria -->

  <!--  -->

  <!-- bs5buttondefault para los botones  add user abajo -->
  <button type="submit" class="btn btn-success" name="agregarMed">Agregar Medicamento</button>
  <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
  <a name="cancel" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
  </form>

</div>
<div class="card-footer text-muted"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $("#idCATEGORIA").change(function() {
        var categoriaSeleccionada = $(this).val();

        $.ajax({
            url: "obtener_subcategorias.php", // Aquí debería ser el archivo correcto si decides crear uno
            type: "POST",
            data: { idCategoria: categoriaSeleccionada },
            success: function(data) {
                $("#idSUBCATEGORIA").html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener subcategorías:", error);
            }
        });
    });
});
</script>


<?php include("../../Plantillas/footer.php"); ?>