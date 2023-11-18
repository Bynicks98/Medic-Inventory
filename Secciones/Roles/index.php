<?php
include("../../database.php");

// Code para eliminar datos de la bd DELETE
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM rol WHERE idRol=:idRol");
    $sentencia->bindParam(":idRol", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}
// Code para agregar roles si no existen
$rolesIniciales = [
    ['idRol' => 1, 'nombreRol' => 'Administrador'],
    ['idRol' => 2, 'nombreRol' => 'Asistente'],
    ['idRol' => 3, 'nombreRol' => 'Lector'],
];

foreach ($rolesIniciales as $rol) {
    $sql = "INSERT INTO rol (idRol, nombreRol) VALUES (:idRol, :nombreRol)
            ON DUPLICATE KEY UPDATE idRol = idRol";  // Ignorar duplicados
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idRol', $rol['idRol']);
    $stmt->bindParam(':nombreRol', $rol['nombreRol']);

    if ($stmt->execute()) {
        //echo "Rol " . $rol['nombreRol'] . " agregado correctamente<br>";
    } else {
        echo "Error al agregar el rol " . $rol['nombreRol'] . ": " . implode(" ", $stmt->errorInfo()) . "<br>";
    }
}

// Code para que el contenido en la base de datos de la tabla rol se muestre en la pagina 
$sentencia = $conexion->prepare("SELECT * FROM `rol`");
if ($sentencia->execute()) {
    $lista_rol = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Manejo de errores
    echo "Error en la consulta SQL: " . $sentencia->errorInfo();
}


?>


<?php include("../../Plantillas/header.php"); ?>
<br><br>
<h2 style="text-align: center">Listar Roles</h2>
<br><br>
<div class="card">
    <?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Rol</a>
        </div>
        <?php
    }
    ?>
    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">idRol</th>
                        <th scope="col">nombreRol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_rol as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['idRol'] ?>
                            </td>
                            <td>
                                <?php echo $registro['nombreRol'] ?>
                            </td>
                            <td> <!--bs5buttoninput abajo -->
                            <?php
                                // Comprobar el rol del usuario para mostrar los botones correspondientes
                                if ($rolUsuario == 'Administrador') {
                                    // Mostrar botones para el rol de Administrador
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idRol'] ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger"
                                        href="javascript:borrar(<?php echo $registro['idRol']; ?>);"
                                        role="button">Eliminar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Asistente') {
                                    // Mostrar botón de edición solo para el rol de Asistente
                                    ?>
                                    <a name="" id="" class="btn btn-info"
                                        href="editar.php?txtID=<?php echo $registro['idRol'] ?>" role="button">Editar</a>
                                    <?php
                                } elseif ($rolUsuario == 'Lector') {
                                    // Mostrar botón de lectura solo para el rol de Lector
                                    // ...
                                }
                                ?></td>

                        </tr>

                        </tr>

                    <?php } ?>



                </tbody>
            </table>
        </div>


    </div>
    <div class="card-footer text-muted">
    </div>
</div>


<?php include("../../Plantillas/footer.php"); ?>