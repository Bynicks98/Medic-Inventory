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



?>



<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Categorias</h1>
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
                <tr class="">
                <td scope="row"><?php echo $registro['idCATEGORIA']?></td>
                    
                    <td><?php echo $registro['nombreCat']?></td>
                    <td scope="row"><?php echo $registro['DescripcionCate']?></td>
                    <td>
                     <a  class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idCATEGORIA']?>" role="button">Editar</a>
                        <a  class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idCATEGORIA']?>" role="button">Eliminar</a>
                </tr>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
