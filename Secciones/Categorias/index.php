<?php
include("../../database.php");

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM categoria WHERE idCATEGORIA=:idCATEGORIA");
    $sentencia->bindParam(":idCATEGORIA", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);

}


$sentencia = $conexion->prepare("SELECT * FROM categoria");
$sentencia->execute();
$lista_categoria = $sentencia->fetchAll(PDO::FETCH_ASSOC);



?>



<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Categorias</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Categoria</a>
        </div>
        <?php
    }
    ?>

    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table " id="tabla_id"> <!-- bs5tabledefault  -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_categoria as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idCATEGORIA'] ?>
                            </td>

                            <td>
                                <?php echo $registro['nombreCat'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['DescripcionCate'] ?>
                            </td>
                            <td>
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idCATEGORIA'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idCATEGORIA']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idCATEGORIA'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?></tr>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>