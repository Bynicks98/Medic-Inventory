<?php
include('../../database.php');

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM formulamedica WHERE idFORMULA = :idFORMULA");
    $sentencia->bindParam(":idFORMULA", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}

// Lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM formulamedica");
$sentencia->execute();
$lista_formulamedica = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Formulas Medicas</h1>
<br>

<div class="card">
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Formula</a>
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
                        <th scope="col">Referencia</th>
                        <th scope="col">Fecha de la Formula</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_formulamedica as $registro) { ?>
                        <tr>
                            <td scope="row">
                                <?php echo $registro['idFORMULA'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['Referenciaformula'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['fechaFormula'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['estadoFormula'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['observacionesFormula'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['pagoFormula'] ?>
                            </td>
                            <td>
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idFORMULA'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idFORMULA']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idFORMULA'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>