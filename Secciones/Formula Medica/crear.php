<?php
include("../../database.php");

if ($_POST) {
    // Recolectar datos (método post)
    $Referenciaformula = (isset($_POST["Referenciaformula"]) ? $_POST["Referenciaformula"] : "");
    $estadoFormula = (isset($_POST["estadoFormula"]) ? $_POST["estadoFormula"] : "");
    $fechaFormula = (isset($_POST["fechaFormula"]) ? $_POST["fechaFormula"] : "");
    $observacionesFormula = (isset($_POST["observacionesFormula"]) ? $_POST["observacionesFormula"] : "");
    $pagoFormula = (isset($_POST["pagoFormula"]) ? $_POST["pagoFormula"] : "");

    // Inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO formulamedica (idFORMULA, Referenciaformula,estadoFormula, fechaFormula, observacionesFormula, pagoFormula) 
    VALUES (null, :Referenciaformula, :estadoFormula, :fechaFormula, :observacionesFormula, :pagoFormula)");

    // Asignar los valores del formulario a los marcadores de posición
    $sentencia->bindParam(":Referenciaformula", $Referenciaformula);
    $sentencia->bindParam(":estadoFormula", $estadoFormula);
    $sentencia->bindParam(":fechaFormula", $fechaFormula);
    $sentencia->bindParam(":observacionesFormula", $observacionesFormula);
    $sentencia->bindParam(":pagoFormula", $pagoFormula);

    $sentencia->execute();
    $mensaje = "Registro agregado";
    header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h1>Nueva Fórmula</h1>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="Referenciaformula" class="form-label">
                    <h6>Referencia de la formula medica</h6>
                </label>
                <input type="text" class="form-control" name="Referenciaformula" id="Referenciaformula" aria-describedby="helpId"
                    placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="fechaFormula" class="form-label">
                    <h6>Fecha</h6>
                </label>
                <input type="date" class="form-control" name="fechaFormula" id="fechaFormula" aria-describedby="helpId"
                    placeholder="" required>
            </div>

            <div class="mb-3">
                <label for="estadoFormula" class="form-label">
                    <h6>Estado</h6>
                </label>
                <select name="estadoFormula" class="form-select">
                    <option value="Completo">Completo</option>
                    <option value="Incompleto">Incompleto</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="observacionesFormula" class="form-label">
                    <h6>Observación</h6>
                </label>
                <input type="text" class="form-control" name="observacionesFormula" id="observacionesFormula"
                    aria-describedby="helpId" placeholder="Añade una observación" required>
            </div>

            <div class="mb-3">
                <label for="pagoFormula" class="form-label">
                    <h6>Pago</h6>
                </label>
                <input type="number" class="form-control" name="pagoFormula" id="pagoFormula" aria-describedby="helpId"
                    placeholder="Añade un monto de pago" required>
            </div>

            <button type="submit" class="btn btn-success">Agregar Fórmula</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>