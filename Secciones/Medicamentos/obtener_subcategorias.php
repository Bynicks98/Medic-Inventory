<?php
include("../../database.php");

if ($_POST && isset($_POST["idCategoria"])) {
    // Validar y obtener el ID de la categoría seleccionada
    $idCategoria = filter_var($_POST["idCategoria"], FILTER_VALIDATE_INT);

    if ($idCategoria !== false) {
        // Preparar y ejecutar la consulta para obtener subcategorías
        $sentenciaSubcat = $conexion->prepare("SELECT idSUBCATEGORIA, nombreSubcat FROM subcategoria WHERE CATEGORIA_idCATEGORIA = :idCategoria");
        $sentenciaSubcat->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
        $sentenciaSubcat->execute();
        $subcategorias = $sentenciaSubcat->fetchAll(PDO::FETCH_ASSOC);

        // Devolver las opciones de subcategorías en formato HTML
        if (!empty($subcategorias)) {
            foreach ($subcategorias as $subcategoria) {
                echo '<option value="' . $subcategoria['idSUBCATEGORIA'] . '">' . $subcategoria['nombreSubcat'] . '</option>';
            }
        } else {
            echo '<option value="">No hay subcategorías disponibles</option>';
        }
    } else {
        echo '<option value="">Error: Categoría no válida</option>';
    }
}
?>