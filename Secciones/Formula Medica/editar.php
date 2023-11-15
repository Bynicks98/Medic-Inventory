<?php
include("../../database.php");
$estadoFormula = '';
$fechaFormula = '';
$observacionesFormula = '';
$pagoFormula = '';
$txtID = '';
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM formulamedica WHERE idFORMULA = :idFORMULA");
    $sentencia->bindParam(":idFORMULA", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $Referenciaformula = $registro["Referenciaformula"];
        $estadoFormula = $registro["estadoFormula"];
        $fechaFormula = $registro["fechaFormula"];
        $observacionesFormula = $registro["observacionesFormula"];
        $pagoFormula = $registro["pagoFormula"];
    }
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Referenciaformula = (isset($_POST["Referenciaformula"]) ? $_POST["Referenciaformula"] : "");
    $estadoFormula = (isset($_POST["estadoFormula"]) ? $_POST["estadoFormula"] : "");
    $fechaFormula = (isset($_POST["fechaFormula"]) ? $_POST["fechaFormula"] : "");
    $observacionesFormula = (isset($_POST["observacionesFormula"]) ? $_POST["observacionesFormula"] : "");
    $pagoFormula = (isset($_POST["pagoFormula"]) ? $_POST["pagoFormula"] : "");

    $sentencia = $conexion->prepare("UPDATE formulamedica SET estadoFormula = :estadoFormula, Referenciaformula = :Referenciaformula, fechaFormula = :fechaFormula, observacionesFormula = :observacionesFormula, pagoFormula = :pagoFormula WHERE idFORMULA = :idFORMULA");

    $sentencia->bindParam(":Referenciaformula", $Referenciaformula);
    $sentencia->bindParam(":estadoFormula", $estadoFormula);
    $sentencia->bindParam(":fechaFormula", $fechaFormula);
    $sentencia->bindParam(":observacionesFormula", $observacionesFormula);
    $sentencia->bindParam(":pagoFormula", $pagoFormula);
    $sentencia->bindParam(":idFORMULA", $txtID);

    $sentencia->execute();
    $mensaje="Registro actualizado";
    header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h1>Editar Fórmula</h1>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="Referenciaformula" class="form-label"><h6>Referencia de la formula</h6></label>
                <input type="text" value="<?php echo $Referenciaformula; ?>" class="form-control" name="Referenciaformula" value="<?php echo $Referenciaformula; ?>" placeholder="Referencia de la formula">
            </div>
            <div class="mb-3">
                <label for="fechaFormula" class="form-label"><h6>Fecha</h6></label>
                <input type="date" value="<?php echo $fechaFormula; ?>" class="form-control" name="fechaFormula" value="<?php echo $fechaFormula; ?>" placeholder="Fecha">
            </div>
            <div class="mb-3">
                <label for="estadoFormula" class="form-label"><h6>Estado</h6></label>
                <input type="text" value="<?php echo $estadoFormula; ?>" class="form-control" name="estadoFormula" value="<?php echo $estadoFormula; ?>" placeholder="Estado">
            </div>

            <div class="mb-3">
                <label for="observacionesFormula" class="form-label"><h6>Observación</h6></label>
                <input type="text" value="<?php echo $observacionesFormula; ?>" class="form-control" name="observacionesFormula" value="<?php echo $observacionesFormula; ?>" placeholder="Observación">
            </div>

            <div class="mb-3">
                <label for="pagoFormula" class="form-label"><h6>Pago</h6></label>
                <input type="text" value="<?php echo $pagoFormula; ?>" class="form-control" name="pagoFormula" value="<?php echo $pagoFormula; ?>" placeholder="Pago">
            </div>

            <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
            <button type="submit" class="btn btn-success">Editar Fórmula</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
