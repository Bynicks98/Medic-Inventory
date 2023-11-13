<?php
include('../../database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMedicamento = $_POST['idMedicamento'];
    $cantidadPedido = $_POST['cantidadPedido'];

    // Actualizar la cantidad en la tabla de medicamentos
    $queryUpdateMedicamento = "UPDATE medicamento SET cantidadUnidades = cantidadUnidades - :cantidad WHERE idMEDICAMENTO = :idMedicamento";
    $stmtUpdateMedicamento = $conexion->prepare($queryUpdateMedicamento);
    $stmtUpdateMedicamento->bindParam(':cantidad', $cantidadPedido);
    $stmtUpdateMedicamento->bindParam(':idMedicamento', $idMedicamento);
    $stmtUpdateMedicamento->execute();

    // Incrementar la cantidad en el apartado de pedidos (por ejemplo, en otra tabla)
    // Aquí debes realizar la lógica específica para tu aplicación
    // Puedes insertar un nuevo registro en una tabla de pedidos o realizar la acción necesaria

    // Redirigir a la página principal
    header("Location: index.php");
    exit();
}

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM medicamento WHERE idMEDICAMENTO =:idMEDICAMENTO");
    $sentencia->bindParam(":idMEDICAMENTO", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}
//lectura de los registros de las tablas
$sentencia = $conexion->prepare("SELECT * FROM medicamento");
$sentencia->execute();
$lista_medicamento = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../Plantillas/header.php"); ?>
<!-- Agrega esto dentro de la sección <head> de tu archivo index.php -->
<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    // Enlaza el botón Generar PDF
    const btnGenerarPDF = document.getElementById('generarPDF');
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace
            window.location.href = 'generar_pdf.php'; // Redirecciona al archivo generar_pdf.php
        });
    }
});
</script> -->

<br>
<h1 style="text-align: center">Medicamentos</h1>
<div class="card">
    <div class="card-header" style="text-align: right">


        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Medicamento</a>
        <a class="btn btn-success" href="generacionpdf.php?txtID=<?php echo $registro['idMEDICAMENTO'] ?>"
            role="button">Generar PDF</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Medicamento</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">fechaFabricacionMedica</th>
                        <th scope="col">fecha de Vencimiento</th>
                        <th scope="col">Cantidad de Cajas</th>
                        <th scope="col">Cantidad de unidades</th>
                        <th scope="col">Valor unidad Medicamento</th>
                        <th scope="col">Numero de Lote </th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($lista_medicamento as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idMEDICAMENTO'] ?>
                            </td>
                            <td>
                                <?php echo $registro['nombreMedica'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['descripcionMedica'] ?>
                            </td>
                            <td>
                                <?php echo $registro['fechaFabricacionMedica'] ?>
                            </td>
                            <td>
                                <?php echo $registro['fechaVencimientoMedica'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadCajas'] ?>
                            </td>
                            <td>
                                <?php echo $registro['cantidadUnidades'] ?>
                            </td>
                            <td>
                                <?php echo $registro['valorUnitMedica'] ?>
                            </td>
                            <td>
                                <?php echo $registro['noLoteMedica'] ?>
                            </td>
                            <td>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['idMEDICAMENTO'] ?>"
                                    role="button">Editar</a>
                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['idMEDICAMENTO'] ?>"
                                    role="button">Eliminar</a>
                            </td>
                            <td>
                                <form method="post" action="procesar_pedido.php">
                                    <input type="hidden" name="idMedicamento"
                                        value="<?php echo $registro['idMEDICAMENTO']; ?>">
                                    <label for="cantidadPedido">Cantidad:</label>
                                    <input type="number" name="cantidadPedido" id="cantidadPedido" required>
                                    <button type="submit" class="btn btn-primary">Solicitar Pedido</button>
                                </form>
                            </td>

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