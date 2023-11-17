<?php
include('../../database.php');

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM devoluciones WHERE idDevoluciones =:idDevoluciones");
    $sentencia->bindParam(":idDevoluciones", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);

}
//lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM devoluciones");
$sentencia->execute();
$lista_devoluciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>


<br>
<h1 style="text-align: center">Devoluciones</h1>
<div class="card">
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Devolucion</a>
        </div>
        <?php
    }
    ?>
    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del producto</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cantidad de Cajas</th>
                        <th scope="col">Cantidad de Unidades</th>
                        <th scope="col">acciones</th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($lista_devoluciones as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idDevoluciones'] ?>
                            </td>
                            <td>
                                <?php echo $registro['nombreProducto'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['motivoD'] ?>
                            </td>
                            <td>
                                <?php echo $registro['estadoD'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadD'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadUD'] ?>
                            </td>
                            <td>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idDevoluciones'] ?>"
                                    role="button">Editar</a>
                                <a class="btn btn-danger"
                                    href="javascript:borrar(<?php echo $registro['idDevoluciones']; ?>);"
                                    role="button">Eliminar</a>

                        </tr>

                    <?php } ?>
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