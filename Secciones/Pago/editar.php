<?php
include("../../database.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM pago WHERE idPAGO = :idPAGO");
    $sentencia->bindParam(":idPAGO", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);  

    if ($registro) {
        $estadoPago = $registro["estadoPago"];
        $fechaPago = $registro["fechaPago"];
        $hechoPor = $registro["hechoPor"];
    }
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $estadoPago = (isset($_POST["estadoPago"]) ? $_POST["estadoPago"] : "");
    $fechaPago = (isset($_POST["fechaPago"]) ? $_POST["fechaPago"] : "");
    $hechoPor = (isset($_POST["hechoPor"]) ? $_POST["hechoPor"] : "");

    $sentencia = $conexion->prepare("UPDATE pago SET estadoPago = :estadoPago, fechaPago = :fechaPago, hechoPor = :hechoPor WHERE idPAGO = :idPAGO");

    $sentencia->bindParam(":estadoPago", $estadoPago);
    $sentencia->bindParam(":fechaPago", $fechaPago);
    $sentencia->bindParam(":hechoPor", $hechoPor);
    $sentencia->bindParam(":idPAGO", $txtID);

    $sentencia->execute();
    $mensaje="Registro Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>

<div class="card">
    <div class="card-header">
        <h1>Editar Pago</h1>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="estadoPago" class="form-label">Estado</label>
                <select name="estadoPago" class="form-select">
                    <option value="Completo" <?php if ($estadoPago === 'Completo') echo 'selected'; ?>>Completo</option>
                    <option value="Incompleto" <?php if ($estadoPago === 'Incompleto') echo 'selected'; ?>>Incompleto</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fechaPago" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fechaPago" value="<?php echo $fechaPago; ?>" id="fechaPago" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="hechoPor" class="form-label">Persona que paga</label>
                <input type="text" class="form-control" name="hechoPor" value="<?php echo $hechoPor; ?>" id="hechoPor" aria-describedby="helpId" placeholder="Ingresa el nombre de la persona que realiza el pago">
            </div>

            <button type="submit" class="btn btn-success">Editar Pago</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>
