<?php 
include("../../database.php");

if (isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM categoria WHERE idCATEGORIA=:idCATEGORIA");
    $sentencia->bindParam(":idCATEGORIA", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $nombreCat = $registro["nombreCat"];
        $DescripcionCate = $registro["DescripcionCate"];
    }
}

if ($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreCat = (isset($_POST["nombreCat"])) ? $_POST["nombreCat"] : "";
    $DescripcionCate = (isset($_POST["DescripcionCate"])) ? $_POST["DescripcionCate"] : "";

    $sentencia = $conexion->prepare("UPDATE categoria SET nombreCat=:nombreCat, DescripcionCate=:DescripcionCate WHERE idCATEGORIA=:idCATEGORIA");

    $sentencia->bindParam(":nombreCat", $nombreCat);
    $sentencia->bindParam(":DescripcionCate", $DescripcionCate);
    $sentencia->bindParam(":idCATEGORIA", $txtID);

    $sentencia->execute();
    header("Location:index.php");
}

?>

<?php include("../../Plantillas/header.php"); ?>

<h2>Editar Categoria</h2>
<div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="txtID" class="form-label">ID</label>
            <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

        <div class="mb-3">
            <label for="nombreCat" class="form-label">Nombre Categoria</label>
            <input type="text" class="form-control" name="nombreCat" value="<?php echo $nombreCat; ?>" aria-describedby="helpId" placeholder="Nuevo nombre de la Categoria">
        </div>

        <div class="mb-3">
            <label for="DescripcionCate" class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="DescripcionCate" value="<?php echo $DescripcionCate; ?>" aria-describedby="helpId" placeholder="Nueva descripcion de la Categoria">
        </div>

        <button type="submit" class="btn btn-success">Editar Categoria</button>
        <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
</div>
<div class="card-footer text-muted">
</div>

<?php include("../../Plantillas/footer.php"); ?>