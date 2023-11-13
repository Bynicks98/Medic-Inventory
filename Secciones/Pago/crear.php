<?php
include("../../database.php");

if ($_POST) {
    $estadoPago = (isset($_POST["estadoPago"]) ? $_POST["estadoPago"] : "");
    $fechaPago = (isset($_POST["fechaPago"]) ? $_POST["fechaPago"] : "");
    $hechoPor = (isset($_POST["hechoPor"]) ? $_POST["hechoPor"] : "");

    $sentencia = $conexion->prepare("INSERT INTO pago (idPAGO, estadoPago, fechaPago, hechoPor) 
    VALUES (null, :estadoPago, :fechaPago, :hechoPor)");

    $sentencia->bindParam(":estadoPago", $estadoPago);
    $sentencia->bindParam(":fechaPago", $fechaPago);
    $sentencia->bindParam(":hechoPor", $hechoPor);

    $sentencia->execute();
    $mensaje="Registro agregado";
    header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card"> 
    <div class="card-header">
        <h1>Nuevo Pago</h1>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="estadoPago" class="form-label">Estado</label>
                <select name="estadoPago" class="form-select">
                    <option value="Completo">Completo</option>
                    <option value="Incompleto">Incompleto</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechaPago" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fechaPago" id="fechaPago" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
                <label for="hechoPor" class="form-label">Persona que paga</label>
                <input type="text" class="form-control" name="hechoPor" id="hechoPor" aria-describedby="helpId" placeholder="Ingresa el nombre de la persona que realiza el pago">
            </div>
            <button type="submit" class="btn btn-success">Agregar Pago</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
