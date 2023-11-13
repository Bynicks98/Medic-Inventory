<!-- <?php?> -->
<?php
include("../../database.php");
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia = $conexion->prepare("DELETE FROM sucursalips WHERE idSUCURSAL=:idSUCURSAL");
    $sentencia->bindParam(":idSUCURSAL", $txtID);
    $sentencia->execute();
    header("location:index.php");
}


$sentencia=$conexion->prepare("SELECT * FROM `sucursalips`");
$sentencia->execute();
$lista_Sucursales=$sentencia->fetchall(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Sucursales</h1>
<br>
   

 <div class="card">  <!-- bs5cardheadfoot -->
    <div class="card-header"  style="text-align: right">
        <!-- bs5button-a  -->
         <a name="" id="" class="btn btn-primary"     
         href="crear.php" role="button" >Agregar nueva Sucursal</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm container-sm" >
        <table class="table ">  <!-- bs5tabledefault  -->
            <thead>
                <tr>
                <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nivel Sucursal</th>
                    <th scope="col">Direccion</th>

                </tr>
            </thead> 
            <tbody>
            <?php
            foreach ($lista_Sucursales as $registro) {?>
                <tr class="">
                <td scope="row"><?php echo $registro['idSUCURSAL'] ?> </td>
                    <td scope="row"><?php echo $registro['nombreIps'] ?></td>
                    <td scope="row"><?php echo $registro['nivelSucursal'] ?></td>
                    <td scope="row"><?php echo $registro['direccionSucur'] ?></td>

                    <td>
                        <a  name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idSUCURSAL'] ?>" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idSUCURSAL'] ?>" role="button">Eliminar</a></td>
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
