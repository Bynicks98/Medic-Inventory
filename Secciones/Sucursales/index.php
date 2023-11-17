<?php
session_start();
include("../../database.php");
include_once("../../Plantillas/funciones.php");


if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM sucursalips WHERE idSUCURSAL=:idSUCURSAL");
    $sentencia->bindParam(":idSUCURSAL", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `sucursalips`");
$sentencia->execute();
$lista_Sucursales = $sentencia->fetchall(PDO::FETCH_ASSOC);

// Resto de tu código...
  $rolUsuario = obtenerRolUsuario($conexion);
  $_SESSION['rolUsuario'] = $rolUsuario;
  
?>


<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Sucursales</h1>
<br>
 <div class="card">  <!-- bs5cardheadfoot -->
  <div class="card-header"  style="text-align: right">
        <?php
            // Comprobar el rol del usuario para mostrar los botones correspondientes
            if ($rolUsuario == 'Administrador') {
                // Mostrar botones para el rol de Administrador
                ?>
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button" >Agregar nueva Sucursal</a>
        <?php
            } elseif ($rolUsuario == 'Asistente') {
                // Mostrar botón de edición solo para el rol de Asistente
                ?>
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button" >Agregar nueva Sucursal</a>
                <?php
            } elseif ($rolUsuario == 'Lector') {
                // Mostrar botón de lectura solo para el rol de Lector
                // ...
            }
            ?>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm container-sm" >
        <table class="table " id="tabla_id">  <!-- bs5tabledefault  -->
            <thead>
                <tr>
                <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nivel Sucursal</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead> 
            <tbody>
           
                        
                    <?php
// Suponiendo que 'admin' es el rol de un administrador
$rolUsuario = isset($_SESSION['nombreRol']) ? $_SESSION['nombreRol'] : '';

foreach ($lista_Sucursales as $registro) {
?>
    <tr class="">
        <td scope="row"><?php echo $registro['idSUCURSAL'] ?></td>
        <td scope="row"><?php echo $registro['nombreIps'] ?></td>
        <td scope="row"><?php echo $registro['nivelSucursal'] ?></td>
        <td scope="row"><?php echo $registro['direccionSucur'] ?></td>
        <td>
            <?php
            // Comprobar el rol del usuario para mostrar los botones correspondientes
            if ($rolUsuario == 'Administrador') {
                // Mostrar botones para el rol de Administrador
                ?>
                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idSUCURSAL'] ?>" role="button">Editar</a>
                <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro['idSUCURSAL']; ?>);" role="button">Eliminar</a>
                <?php
            } elseif ($rolUsuario == 'Asistente') {
                // Mostrar botón de edición solo para el rol de Asistente
                ?>
                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idSUCURSAL'] ?>" role="button">Editar</a>
                <?php
            } elseif ($rolUsuario == 'Lector') {
                // Mostrar botón de lectura solo para el rol de Lector
                // ...
            }
            ?>
        </td>
    </tr>
<?php
}
?>
                </tr>
                
                

                </tr>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
