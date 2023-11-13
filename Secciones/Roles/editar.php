<?php 
include("../../database.php");

if (isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM rol WHERE idRol=:idRol");
    $sentencia->bindParam(":idRol", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);  //ejecuta la consulta preparada y recupera la siguiente fila de resultados de la base de datos
    if ($registro) {
        $nombreRol = $registro["nombreRol"];
        
    }
}

if ($_POST){
   
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreRol = (isset($_POST["nombreRol"]) ? $_POST["nombreRol"] : "");
    

    $sentencia = $conexion->prepare("UPDATE rol SET nombreRol=:nombreRol WHERE idRol=:idRol");

    $sentencia->bindParam(":nombreRol", $nombreRol);
    
    $sentencia->bindParam(":idRol", $txtID);

    $sentencia->execute();
    $mensaje="Registro Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
}

?>

<?php include("../../Plantillas/header.php"); ?>
<!-- tomamos la tabla de crear para usarla como referencia en editar abajo -->
<br>
Edit
<div class="card">
    <div class="card-header">
        Rol a asignar
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
    <!-- se agrega un bs5forminput readonly solamente lectura del id abajo -->
    
    <div class="mb-3">
      <label for="txtID" class="form-label">ID</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

    </div>
        <div class="mb-3">
          <label for="nombreRol" class="form-label">Nombre Rol</label>
          <input type="text"
          value="<?php echo $nombreRol;?>"
          class="form-control" name="nombreRol" id="nombreRol" aria-describedby="helpId" placeholder="Nombre del Rol...">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>