<?php
include("../../database.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM proveedor WHERE idPROVEEDOR=:idPROVEEDOR");
    $sentencia->bindParam(":idPROVEEDOR", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}


$sentencia = $conexion->prepare("SELECT * FROM `proveedor`");
$sentencia->execute();
$lista_PROVEEDOR = $sentencia->fetchall(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Proveedores</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nuevo Proveedor</a>
        </div>
        <?php
    }
    ?>
    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="tabla " id="tabla_id"> <!-- bs5tabledefault  -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">NIT</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lista_PROVEEDOR as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idPROVEEDOR'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['nombreProve'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['NITproveedores'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['direccionProve'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['celularProve'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['telefonoProve'] ?>
                            </td>
                            <td>
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPROVEEDOR'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idPROVEEDOR']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPROVEEDOR'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?> </td>
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