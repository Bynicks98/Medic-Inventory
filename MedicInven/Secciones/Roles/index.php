<?php
include("../../database.php");
//Code para eliminar datos de la bd DELETE
if (isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("DELETE FROM rol WHERE idRol=:idRol");
    $sentencia->bindParam(":idRol", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}




//code para que el contenido en la base de datos de la tabla rol se muestre en la pagina 
$sentencia = $conexion->prepare("SELECT * FROM `rol`");
if ($sentencia->execute()) {
    $lista_rol = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Manejo de errores
    echo "Error en la consulta SQL: " . $sentencia->errorInfo();
}
?>

<?php include("../../Plantillas/header.php"); ?>

<h4>Listar Roles</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar User</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">idRol</th>
                    <th scope="col">nombreRol</th>
                    <th scope="col">contraseña</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_rol as $registro ) { ?>
                    <tr class="">
                    <td scope="row"><?php echo $registro['idRol']?></td>
                    <td><?php echo $registro['nombreRol']?></td>
                    <td><?php echo $registro['contrasena']?></td>
                     <td>       <!--bs5buttoninput abajo -->
                     <a  class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idRol']?>" role="button">Editar</a>
                        <a  class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idRol']?>" role="button">Eliminar</a> 
                    </td>
                    
                </tr>

                </tr>
               
                    <?php } ?>
                    
                

            </tbody>
        </table>
    </div>
    <div>
        <a href="../../fpdf/Reportes.php" target="_blank" class="btn btn-success">Generar Reportes</a>
    </div>
    
    </div>
    <div class="card-footer text-muted">
      
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>