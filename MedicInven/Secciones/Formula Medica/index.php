<?php 
include('../../database.php');

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM formulamedica WHERE idFORMULA = :idFORMULA");
    $sentencia->bindParam(":idFORMULA", $txtID);
    $sentencia->execute();
    header("Location: index.php");
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
    <div class="card-header" style="text-align: right">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Formula</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm container-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
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
                            <td scope="row"><?php echo $registro['idFORMULA']?></td>
                            <td scope="row"><?php echo $registro['fechaFormula']?></td>
                            <td scope="row"><?php echo $registro['estadoFormula']?></td>
                            <td scope="row"><?php echo $registro['observacionesFormula']?></td>
                            <td scope="row"><?php echo $registro['pagoFormula']?></td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idFORMULA']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idFORMULA']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
