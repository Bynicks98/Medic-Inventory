<?php
// ... (tu lógica de conexión a la base de datos)

include("../../database.php");

if (isset($_POST['productoId'])) {
    $productoId = $_POST['productoId'];

    // Consultas SQL para obtener las categorías y subcategorías asociadas al medicamento seleccionado
    $sentenciaCategoriasMedicamento = $conexion->prepare("SELECT C.idCATEGORIA, C.nombreCat FROM categoria C INNER JOIN subcategoria SC ON C.idCATEGORIA = SC.SUBCATEGORIA_CATEGORIA_idCATEGORIA
                                                         INNER JOIN medicamento M ON SC.idSUBCATEGORIA = M.SUBCATEGORIA_idSUBCATEGORIA
                                                         WHERE M.idMEDICAMENTO = :productoId");
    $sentenciaCategoriasMedicamento->bindParam(":productoId", $productoId);
    $sentenciaCategoriasMedicamento->execute();
    $categorias = $sentenciaCategoriasMedicamento->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaSubcategoriasMedicamento = $conexion->prepare("SELECT SC.idSUBCATEGORIA, SC.nombreSubcat
                                                            FROM subcategoria SC
                                                            INNER JOIN medicamento M ON SC.idSUBCATEGORIA = M.SUBCATEGORIA_idSUBCATEGORIA
                                                            WHERE M.idMEDICAMENTO = :productoId");
    $sentenciaSubcategoriasMedicamento->bindParam(":productoId", $productoId);
    $sentenciaSubcategoriasMedicamento->execute();
    $subcategorias = $sentenciaSubcategoriasMedicamento->fetchAll(PDO::FETCH_ASSOC);

    // Organiza los resultados en un array para devolverlos como respuesta JSON
    $result = array(
        'categories' => $categorias,
        'subcategories' => $subcategorias
    );

    // Devuelve los resultados como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    // Si no se recibe el ID del producto, muestra un mensaje de error
    echo 'Error: ID de producto no recibido.';
}
?>