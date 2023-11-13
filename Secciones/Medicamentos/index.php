
<?php 
include('../../database.php');

if (isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("DELETE FROM medicamento WHERE idMEDICAMENTO =:idMEDICAMENTO");
    $sentencia->bindParam(":idMEDICAMENTO", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}
//lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM medicamento"); 
$sentencia->execute();
$lista_medicamento = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../Plantillas/header.php"); ?>

<br>
<h1 style="text-align: center">Medicamentos</h1>
<div class="card">
    <div class="card-header" style="text-align: right">
        

        <a name="" id="" class="btn btn-primary" 
         href="crear.php" role="button">Agregar Medicamento</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm" style="max-width: 80%; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Nombre Medicamento</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">fechaFabricacionMedica</th>
                        <th scope="col">fecha de Vencimiento</th>
                        <th scope="col">Cantidad de Cajas</th>
                        <th scope="col">Cantidad de unidades</th>
                        <th scope="col">Valor unidad Medicamento</th>
                        <th scope="col">Numero de Lote </th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
            

                <?php foreach ($lista_medicamento as $registro) { ?>
                <tr class="">
                <td scope="row"><?php echo $registro['idMEDICAMENTO']?></td>
                    <td><?php echo $registro['nombreMedica']?></td>
                    <td scope="row"><?php echo $registro['descripcionMedica']?></td>
                    <td><?php echo $registro['fechaFabricacionMedica']?></td>
                    <td><?php echo $registro['fechaVencimientoMedica']?></td>
                    <td><?php echo $registro['cantidadCajas']?></td>
                    <td><?php echo $registro['cantidadUnidades']?></td>
                    <td><?php echo $registro['valorUnitMedica']?></td>
                    <td><?php echo $registro['noLoteMedica']?></td>
                    <td>
                        <a  class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idMEDICAMENTO']?>" role="button">Editar</a>
                        <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idMEDICAMENTO']?>" role="button">Eliminar</a>
 
                </tr>
               
                <?php  }?>
                    <!-- <tr class="">
                        <td scope="row">Item</td>
                        <td>Item</td>
                        <td>Item</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        
        <!-- <h4 class="card-title">Title</h4> Otro estilo de la tabla
        <p class="card-text">Text</p> -->
    </div>
    <!-- <div class="card-footer text-muted">Arriba
        Footer -->
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>