<?php
include("../../database.php");

if (isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("DELETE FROM categoria WHERE idCATEGORIA=:idCATEGORIA");
    $sentencia->bindParam(":idCATEGORIA", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}


 $sentencia = $conexion-> prepare("SELECT * FROM categoria");
 $sentencia->execute();
 $lista_categoria = $sentencia->fetchAll(PDO::FETCH_ASSOC);

 if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia = $conexion->prepare("DELETE FROM subcategoria WHERE idSUBCATEGORIA=:idSUBCATEGORIA");
     $sentencia->bindParam(":idSUBCATEGORIA", $txtID);
    $sentencia->execute();
     header("location:index.php");
 }


$sentencia=$conexion->prepare("SELECT * FROM `subcategoria`");
$sentencia->execute();
$lista_SUBCATEGORIAS=$sentencia->fetchall(PDO::FETCH_ASSOC);



?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('.toggle-subcategories').click(function () {
        var categoryId = $(this).data('id');
        var subcategoriesRow = $('.subcategories-row[data-parent="' + categoryId + '"]');

        if (subcategoriesRow.is(':visible')) {
            subcategoriesRow.hide();
            $(this).html('<i class="fa fa-plus-circle"></i>');
        } else {
            subcategoriesRow.show();
            $(this).html('<i class="fa fa-minus-circle"></i>');
        }
    });
});
</script>


<?php include("../../Plantillas/header.php"); ?>
<br>
<h1 class="text-center text-info text-Blue">Categorias</h1>
<br>
   

 <div class="card">  <!-- bs5cardheadfoot -->
    <div class="card-header"  style="text-align: right">
        <!-- bs5button-a  -->
         <a name="" id="" class="btn btn-primary"     
         href="crear.php" role="button" >Agregar nueva Categoria</a>
    </div>
    <div class="card-body">

    <div class="table-responsive-sm container-sm" >
        <table class="table ">  <!-- bs5tabledefault  -->
            <thead>
                <tr>
                <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_categoria as $registro){?>
                   
                <tr class="parent-row">
                <td scope="row"><?php echo $registro['idCATEGORIA']?></td>
                <td> 
                    <span class="toggle-subcategories" data-id="<?php echo $registro['idCATEGORIA']; ?>">
                    <i class="fa fa-plus-circle">°</i></span>
                    <?php echo $registro['nombreCat']?>
                </td>
                <td scope="row"><?php echo $registro['DescripcionCate']?></td>
                <td>
                    <a  class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idCATEGORIA']?>" role="button">Editar</a>
                    <a  class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idCATEGORIA']?>" role="button">Eliminar</a>
                </td>
                </tr>
                <!--subcategorias-->
                <?php foreach ($lista_SUBCATEGORIAS as $registro) { ?>
    <tr class="subcategories-row" data-parent="<?php echo $registro['idCATEGORIA']; ?>" style="display: none;">
        <td></td>
        <td colspan="3">
            <td scope="row"><?php echo $registro['nombreSubcat'] ?></td>
            <!-- Puedes hacer una consulta a la base de datos y mostrar las subcategorías aquí -->
            <td>
                <p><?php echo $registro['nombreSubcat'] ?></p>
            </td>
        </td>
    </tr>
<?php }?>
                <?php }?>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
