<?php
include("../../database.php");
if ($_POST) {
  
  // Recolección de datos
  $NombreDistri = (isset($_POST["nombreDistri"]) ? $_POST["nombreDistri"] : "");
  $NIT_distribuidor = (isset($_POST["NIT_distribuidor"]) ? $_POST["NIT_distribuidor"] : "");
  $direccionDistri = (isset($_POST["direccionDistri"]) ? $_POST["direccionDistri"] : "");
  $telefonoDistri = (isset($_POST["telefonoDistri"]) ? $_POST["telefonoDistri"] : "");
  $celularDistri = (isset($_POST["celularDistri"]) ? $_POST["celularDistri"] : "");
  // Insertar datos 
  $sentencia = $conexion->prepare("INSERT INTO distribuidor(idDISTRIBUIDOR, direccionDistri, nombreDistri, NIT_distribuidor, telefonoDistri, celularDistri)
   VALUES (null, :direccionDistri, :nombreDistri, :NIT_distribuidor, :telefonoDistri, :celularDistri)");
  // Asignación de valores
  $sentencia->bindParam(":nombreDistri", $NombreDistri);
  $sentencia->bindParam(":direccionDistri", $direccionDistri);
  $sentencia->bindParam(":NIT_distribuidor", $NIT_distribuidor);
  $sentencia->bindParam(":telefonoDistri", $telefonoDistri);
  $sentencia->bindParam(":celularDistri", $celularDistri);
  $sentencia->execute();
  $mensaje="Registro agregado";
  header("Location:index.php?mensaje=".$mensaje);
}

?>
<?php include("../../Plantillas/header.php"); ?>
<div class="card">
    <div class="card-header">
        <h1>Nuevo Distribuidor</h1>
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          <label for="" class="form-label">Nombre Distribuidor</label>
          <input type="text"
            class="form-control" name="nombreDistri" id="" aria-describedby="helpId" placeholder="Dale un nombre al Distribuidor" required>

        </div>
        <div class="mb-3">
          <label for="" class="form-label">NIT</label>
          <input type="text"
            class="form-control" name="NIT_distribuidor" id="" aria-describedby="helpId" placeholder="Ingresa el NIT del Distribuidor" required>
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Direccion</label>
          <input type="text"
            class="form-control" name="direccionDistri" id="" aria-describedby="helpId" placeholder="Ingresa la direccion del Distribuidor" required>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Celular</label>
          <input type="text"
            class="form-control" name="celularDistri" id="" aria-describedby="helpId" placeholder="Ingresa el celular del distribuidor" required>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Telefono</label>
          <input type="text"
            class="form-control" name="telefonoDistri" id="" aria-describedby="helpId" placeholder="Ingresa el telefono del distribuidor" required>
        </div>
        <button type="submit" class="btn btn-success" >Agregar distribuidor</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
   
    <div class="card-footer text-muted">
   
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>