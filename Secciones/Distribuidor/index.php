<!-- <?php?> -->
<?php
include("../../database.php");
 if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia = $conexion->prepare("DELETE FROM distribuidor WHERE idDISTRIBUIDOR=:idDISTRIBUIDOR");
     $sentencia->bindParam(":idDISTRIBUIDOR", $txtID);
    $sentencia->execute();
     header("location:index.php");
 }


$sentencia=$conexion->prepare("SELECT * FROM `distribuidor`");
$sentencia->execute();
$lista_SUBCATEGORIAS=$sentencia->fetchall(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Distribuidores</h1>
<br>
   

 <div class="card">  <!-- bs5cardheadfoot -->
    <div class="card-header"  style="text-align: right">
        <!-- bs5button-a  -->
         <a name="" id="" class="btn btn-primary"     
         href="crear.php" role="button" >Agregar un nuevo Distribuidor</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm container-sm" >
        <table class="table ">  <!-- bs5tabledefault  -->
            <thead>
                <tr>
                <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">NIT</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Telefono</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($lista_SUBCATEGORIAS as $registro) {?>
                <tr class="">
                <td scope="row"><?php echo $registro['idDISTRIBUIDOR'] ?> </td>
                    <td scope="row"><?php echo $registro['nombreDistri'] ?></td>
                    <td scope="row"><?php echo $registro['NIT_distribuidor'] ?></td>
                    <td scope="row"><?php echo $registro['direccionDistri'] ?> </td>
                    <td scope="row"><?php echo $registro['celularDistri'] ?></td>
                    <td scope="row"><?php echo $registro['telefonoDistri'] ?></td>
                    <td>
                    <a  name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idDISTRIBUIDOR'] ?>" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idDISTRIBUIDOR'] ?>" role="button">Eliminar</a></td>
                 </tr>
                 <?php }?>
                </tr>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
