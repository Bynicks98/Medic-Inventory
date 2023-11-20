<?php
include('../../database.php');

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM medicamento WHERE idMEDICAMENTO =:idMEDICAMENTO");
    $sentencia->bindParam(":idMEDICAMENTO", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

// Verifica si se proporcionó un parámetro de subcategoría
$subcategoriaSeleccionada = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : null;

// Modifica la consulta SQL para filtrar los medicamentos por subcategoría si está seleccionada
$sql = "SELECT * FROM medicamento";
if ($subcategoriaSeleccionada) {
    $sql .= " WHERE SUBCATEGORIA_idSUBCATEGORIA = :subcategoria";
}

$sentencia = $conexion->prepare($sql);

// Asigna el valor del parámetro de subcategoría si está presente
if ($subcategoriaSeleccionada) {
    $sentencia->bindParam(":subcategoria", $subcategoriaSeleccionada);
}

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
    <div class="btn-group">

    </div>
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">

            <button type="button" class="btn btn-primary"><a name="" id="" class="btn btn-primary" href="crear.php"
                    role="button">Agregar Medicamento</a></button>
            <button type="button" class="btn btn-primary"><a href="../../fpdfReportes/index.php" target="_blank"
                    class="btn btn-primary">PDF Medicamentos</a></button>
            <button type="button" class="btn btn-primary"><a href="../../fpdfReportes/MedicPorVencer.php" target="_blank"
                    class="btn btn-primary">PDF MedPorVencer</a></button>
            <button type="button" class="btn btn-primary"><a href="../../fpdfReportes/MedicMasUsados.php" target="_blank"
                    class="btn btn-primary">PDF MedMasUsados</a></button>
        </div>
        <?php
    }
    ?>
    <div class="border-top" style="padding-top: 15px;text-align: center">

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
                        <th scope="col">Alerta de Vencimiento</th>
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
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                     <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idMEDICAMENTO']; ?>"
                                        role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idMEDICAMENTO']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idMEDICAMENTO'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?></td>
                            <td>
                                <?php
                                // Inicializa variables para almacenar nombre y lote
                                $nombreAlerta = '';
                                $loteAlerta = '';

                                // Calcula la diferencia de días entre la fecha de vencimiento y la fecha actual
                                $fechaVencimiento = strtotime($registro['fechaVencimientoMedica']);
                                $fechaActual = strtotime(date('Y-m-d'));

                                $diferenciaDias = ($fechaVencimiento - $fechaActual) / (60 * 60 * 24);

                                // Verifica si la cantidad individual es menor o igual a 10 (puedes ajustar este valor)
                                $cantidadIndividual = $registro['cantidadUnidades'];
                                $alertaFechaVencimiento = ($diferenciaDias <= 15);
                                $alertaCantidad = ($cantidadIndividual <= 10);

                                // Almacena nombre y lote si se cumplen las condiciones
                                if ($alertaFechaVencimiento && $alertaCantidad) {
                                    $nombreAlerta = $registro['nombreMedica'];
                                    $loteAlerta = $registro['noLoteMedica'];
                                    $tipoAlerta = 'ambas';
                                } elseif ($alertaFechaVencimiento) {
                                    $nombreAlerta = $registro['nombreMedica'];
                                    $loteAlerta = $registro['noLoteMedica'];
                                    $tipoAlerta = 'vencimiento';
                                } elseif ($alertaCantidad) {
                                    $nombreAlerta = $registro['nombreMedica'];
                                    $loteAlerta = $registro['noLoteMedica'];
                                    $tipoAlerta = 'cantidad';
                                } else {
                                    $nombreAlerta = '';
                                    $loteAlerta = '';
                                    $tipoAlerta = '';
                                }
                                ?>

                                <div class="alerta-icono" data-nombre="<?php echo $nombreAlerta; ?>"
                                    data-lote="<?php echo $loteAlerta; ?>" data-tipo="<?php echo $tipoAlerta; ?>">
                                    <?php
                                    // Muestra el ícono de alerta dependiendo de las condiciones
                                    if ($alertaFechaVencimiento && $alertaCantidad) {
                                        // Si ambas condiciones se cumplen
                                        echo '<i class="fas fa-exclamation-circle text-danger"></i>';
                                    } elseif ($alertaFechaVencimiento) {
                                        // Si solo la fecha de vencimiento está próxima
                                        echo '<i class="fas fa-exclamation-triangle text-warning"></i>';
                                    } elseif ($alertaCantidad) {
                                        // Si solo la cantidad individual es menor o igual a 10
                                        echo '<i class="fas fa-info-circle text-info"></i>';
                                    } else {
                                        // Si no hay alerta, muestra un espacio en blanco
                                        echo '&nbsp;';
                                    }
                                    ?>
                                </div>
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
        <script>
            // Obtén todos los elementos con la clase "alerta-icono"
            const alertaIconos = document.querySelectorAll('.alerta-icono');

            // Agrega un evento de clic a cada elemento
            alertaIconos.forEach((icono) => {
                icono.addEventListener('click', function () {
                    // Obtiene el nombre y el lote del medicamento desde los atributos de datos
                    const nombreMedicamento = this.getAttribute('data-nombre');
                    const loteMedicamento = this.getAttribute('data-lote');

                    // Obtiene el tipo de alerta desde el atributo de datos
                    const tipoAlerta = this.getAttribute('data-tipo');

                    // Construye el mensaje de alerta
                    let mensajeAlerta = `Medicamento: ${nombreMedicamento}, Lote: ${loteMedicamento}`;

                    // Agrega información específica según el tipo de alerta
                    if (tipoAlerta === 'vencimiento') {
                        mensajeAlerta += ' - Cerca de la fecha de vencimiento.';
                    } else if (tipoAlerta === 'cantidad') {
                        mensajeAlerta += ' - Cantidad por unidad baja.';
                    } else if (tipoAlerta === 'ambas') {
                        mensajeAlerta += ' - Cerca de la fecha de vencimiento y cantidad por unidad baja.';
                    }

                    // Muestra la alerta con el mensaje construido
                    alert(mensajeAlerta);
                });
            });
        </script>

        <!-- <h4 class="card-title">Title</h4> Otro estilo de la tabla
        <p class="card-text">Text</p> -->
    </div>

    <!-- <div class="card-footer text-muted">Arriba
        Footer -->
</div>
</div>

<?php include("../../Plantillas/footer.php"); ?>