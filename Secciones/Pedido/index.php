<?php


include("../../database.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM pedido WHERE idPEDIDO =:idPEDIDO");
    $sentencia->bindParam(":idPEDIDO", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}


$sentenciaNombresMedicamentos = $conexion->prepare("SELECT idMEDICAMENTO, nombreMedica FROM medicamento");
$sentenciaNombresMedicamentos->execute();
$nombresMedicamentos = $sentenciaNombresMedicamentos->fetchAll(PDO::FETCH_ASSOC);


$sentencia = $conexion->prepare("SELECT * FROM `pedido`");
$sentencia->execute();
$lista_pedido = $sentencia->fetchall(PDO::FETCH_ASSOC);

$tipoPedido = isset($_GET['tipoPedido']) ? $_GET['tipoPedido'] : null;

$sentencia = $conexion->prepare("
    SELECT 
        p.idPEDIDO, 
        p.Tipo_pedido, 
        p.fechaPedido, 
        p.costoPedido, 
        p.MEDICAMENTO_idMEDICAMENTO, /* Asegúrate de incluir esta columna en la selección */
        COALESCE(m.nombreMedica) AS Nombre_Producto, 
        p.cantidadP, 
        p.Fecha_entrega, 
        p.Fecha_envio, 
        p.EstadoP 
        /* Otras columnas */
    FROM pedido p
    LEFT JOIN medicamento m ON p.MEDICAMENTO_idMEDICAMENTO = m.idMEDICAMENTO
");


if ($tipoPedido) {
    // Agregar la condición de filtrado si se ha seleccionado un tipo de pedido
    $sentencia = $conexion->prepare("
        SELECT 
            p.idPEDIDO, 
            p.Tipo_pedido, 
            p.fechaPedido, 
            p.costoPedido, 
            p.MEDICAMENTO_idMEDICAMENTO, /* Asegúrate de incluir esta columna en la selección */
            COALESCE(m.nombreMedica) AS Nombre_Producto, 
            p.cantidadP, 
            p.Fecha_entrega, 
            p.Fecha_envio, 
            p.EstadoP 
            /* Otras columnas */
        FROM pedido p
        LEFT JOIN medicamento m ON p.MEDICAMENTO_idMEDICAMENTO = m.idMEDICAMENTO
        WHERE p.Tipo_pedido = :tipoPedido
    ");

    $sentencia->bindValue(":tipoPedido", $tipoPedido);
    $sentencia->execute();
    $lista_pedido = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si no hay filtro, ejecutar la consulta sin ninguna condición adicional
    $sentencia->execute();
    $lista_pedido = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

include("../../Plantillas/header.php");
?>

<h1 class="text-center text-info text-dark">Pedidos</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>

        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar un Nuevo Pedido</a>
            <a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF']; ?>?tipoPedido=Entrada">Filtrar Entradas</a>
            <a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF']; ?>?tipoPedido=Salida">Filtrar Salidas</a>
        </div>
        <?php
    } else if ($rolUsuario == 'Lector') {
        ?>
            <div class="card-header" style="text-align: right">
                <a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF']; ?>?tipoPedido=Entrada">Filtrar Entradas</a>
                <a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF']; ?>?tipoPedido=Salida">Filtrar Salidas</a>
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
                        <th scope="col">tipo de pedido</th>
                        <th scope="col">Fecha del Pedido</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Nombre del producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha de entrega</th>
                        <th scope="col">Fecha de envio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lista_pedido as $registro) { ?>
                        <tr class="">

                            <td scope="row">
                                <?php echo $registro['idPEDIDO'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['Tipo_pedido'] ?>
                            </td>
                            <td>
                                <?php echo $registro['fechaPedido'] ?>
                            </td>
                            <td>
                                <?php echo $registro['costoPedido'] ?>
                            </td>
                            <td>
                                <?php
                                // Verificar el nombre del medicamento según el ID
                                $nombreMedicamento = "ID no encontrado"; // Valor por defecto si el ID no tiene correspondencia
                                foreach ($nombresMedicamentos as $medicamento) {
                                    if ($medicamento['idMEDICAMENTO'] == $registro['MEDICAMENTO_idMEDICAMENTO']) {
                                        $nombreMedicamento = $medicamento['nombreMedica'];
                                        break;
                                    }
                                }
                                echo $nombreMedicamento;
                                ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadP'] ?>
                            </td>
                            <td>
                                <?php echo $registro['Fecha_entrega'] ?>
                            </td>
                            <td>
                                <?php echo $registro['Fecha_envio'] ?>
                            </td>
                            <td>
                                <?php echo $registro['EstadoP'] ?>
                            </td>
                            <td>
                                <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPEDIDO'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idPEDIDO']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idPEDIDO'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>