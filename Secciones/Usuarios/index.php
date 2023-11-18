<?php
include('../../database.php');

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM persona WHERE idPersona=:idPersona");
    $sentencia->bindParam(":idPersona", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);

}
//lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM persona");
$sentencia->execute();
$lista_persona = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include("../../Plantillas/header.php"); ?>


<h1 class="text-center text-info text-dark">Usuarios</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
        </div>
        <?php
    }
    ?>
    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table" id="tabla_id"> <!-- bs5tabledefault  -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Contraseña</th>

                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_persona as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idPersona'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['nombreP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['apellidosP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['telefonoP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['numeroP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['correo'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cedulaP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['contrasena'] ?>
                            </td>
                            <td>
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPersona'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idPersona']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPersona'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?>
                            </td>
                        </tr>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<!-- <script> tabla anterior
    var tabla = document.querySelector('#tabla_id1');
    var dataTable = new DataTable(tabla_id1);
</script> -->



<?php include("../../Plantillas/footer.php"); ?>