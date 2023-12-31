<?php
include('../../database.php');

function obtenerIdMedicamentoDesdePedido($idPedido)
{
    global $conexion;
    $sentencia = $conexion->prepare("SELECT MEDICAMENTO_idMEDICAMENTO FROM pedido WHERE idPEDIDO = :idPedido");
    $sentencia->bindParam(":idPedido", $idPedido);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $resultado['MEDICAMENTO_idMEDICAMENTO'];
}
if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM devoluciones WHERE idDevoluciones =:idDevoluciones");
    $sentencia->bindParam(":idDevoluciones", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);

}

$sentenciaNombresMedicamentos = $conexion->prepare("SELECT idMEDICAMENTO, nombreMedica FROM medicamento");
$sentenciaNombresMedicamentos->execute();
$nombresMedicamentos = $sentenciaNombresMedicamentos->fetchAll(PDO::FETCH_ASSOC);
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
                        <th scope="col" style="display: none;">Cantidad de Cajas</th>
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
                                <?php
                                // Buscar el nombre del medicamento utilizando el ID correspondiente
                                $nombreMedicamento = "";
                                if (isset($registro['PEDIDO_idPEDIDO'])) {
                                    // Obtener el ID del medicamento asociado con el pedido
                                    $idMedicamento = obtenerIdMedicamentoDesdePedido($registro['PEDIDO_idPEDIDO']);
                                    // Buscar el nombre del medicamento utilizando el ID
                                    foreach ($nombresMedicamentos as $medicamento) {
                                        if ($medicamento['idMEDICAMENTO'] == $idMedicamento) {
                                            $nombreMedicamento = $medicamento['nombreMedica'];
                                            break;
                                        }
                                    }
                                }
                                echo $nombreMedicamento;
                                ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['motivoD'] ?>
                            </td>
                            <td>
                                <?php echo $registro['estadoD'] ?>
                            </td>
                            <td style="display: none;">
                                <?php echo $registro['cantidadD'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadUD'] ?>
                            </td>
                            <td>
                                <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idDevoluciones'] ?>"
                                        role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idDevoluciones']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idDevoluciones'] ?>"
                                        role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?>
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