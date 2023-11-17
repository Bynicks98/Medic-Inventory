<?php
include("../../database.php");
// Code para eliminar datos de la BD DELETE
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM pago WHERE idPAGO = :idPAGO");
    $sentencia->bindParam(":idPAGO", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}

// Lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM pago");
$sentencia->execute();
$lista_pago = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Pagos</h1>
<br>

<div class="card">
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Pago</a>
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
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de Pago</th>
                        <th scope="col">Persona que pagó</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_pago as $registro) { ?>
                        <tr>
                            <td scope="row">
                                <?php echo $registro['idPAGO'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['estadoPago'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['fechaPago'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['hechoPor'] ?>
                            </td>
                            <td>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idPAGO'] ?>"
                                    role="button">Editar</a>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['idPAGO']; ?>);"
                                    role="button">Eliminar</a>
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