<?php
include("../../database.php");
//code para agregar datos desde la pagina y se add en la BD
if($_POST){
    print_r($_POST);

    // Recolectar datos (método post)
    $nombreRol = (isset($_POST["nombreRol"]) ? $_POST["nombreRol"] : "");
    

    // Inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO rol (idRol,nombreRol) 
    VALUES (null, :nombreRol)");

    // Asignar los valores del formulario al marcador de posición
    $sentencia->bindParam(":nombreRol", $nombreRol);
    $sentencia->execute();
    $mensaje="Registro Agregado";
    header("Location:index.php?mensaje=".$mensaje);
    
}
?>

<?php include("../../Plantillas/header.php"); ?>
<br>
crear Roles
<div class="card">
    <div class="card-header">
        Rol a asignar
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          <label for="nombreRol" class="form-label">Nombre Rol</label>
          <input type="text"
          class="form-control" name="nombreRol" id="nombreRol" aria-describedby="helpId" placeholder="Nombre del Rol...">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Rol</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>