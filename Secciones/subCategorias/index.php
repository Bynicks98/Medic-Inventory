<?php
include("../../database.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM subcategoria WHERE idSUBCATEGORIA=:idSUBCATEGORIA");
    $sentencia->bindParam(":idSUBCATEGORIA", $txtID);
    $sentencia->execute();
    header("location:index.php");
}


$sentencia = $conexion->prepare("SELECT * FROM `subcategoria`");
$sentencia->execute();
$lista_SUBCATEGORIAS = $sentencia->fetchall(PDO::FETCH_ASSOC);

?>


<?php include("../../Plantillas/header.php"); ?>
<h1 class="text-center text-info text-dark">SubCategorias</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva SubCategoria</a>
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
                        <th scope="col" style="display: none;">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lista_SUBCATEGORIAS as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idSUBCATEGORIA'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['nombreSubcat'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['descripcionSubcat'] ?>
                            </td>
                            <td scope="row" style="display: none;">
                                <?php echo $registro['CATEGORIA_idCATEGORIA'] ?>
                            </td>
                            <td>
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idSUBCATEGORIA'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idSUBCATEGORIA']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idSUBCATEGORIA'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?>
                                </td>
                        </tr>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>