<?php
include("../../database.php");

if($_POST){
    
    $idCATEGORIA = (isset($_POST["idCATEGORIA"]) ? $_POST["idCATEGORIA"] : "");
    $nombreCat = (isset($_POST["nombreCat"]) ? $_POST["nombreCat"] : "");
    $DescripcionCate = (isset($_POST["DescripcionCate"]) ? $_POST["DescripcionCate"] : "");

    $sentencia = $conexion->prepare("INSERT INTO categoria (idCATEGORIA, nombreCat, DescripcionCate) VALUES (null, :nombreCat, :DescripcionCate)");
    $sentencia->bindParam(":nombreCat", $nombreCat);
    $sentencia->bindParam(":DescripcionCate", $DescripcionCate);

    $sentencia->execute();
    header("location:index.php");
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h1>Nueva Categoria</h1>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombreCat" class="form-label">Nombre Categoria</label>
                <input type="text" class="form-control" name="nombreCat" id="nombreCat" aria-describedby="helpId" placeholder="Dale un nombre a la Categoria">
            </div>
            <div class="mb-3">
                <label for="DescripcionCate" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="DescripcionCate" id="DescripcionCate" aria-describedby="helpId" placeholder="Añade una descripcion para la Categoria">
            </div>
            <button type="submit" class="btn btn-success">Agregar Categoria</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
