<?php
include('../../database.php');

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM categoria WHERE idCATEGORIA=:idCATEGORIA");
    $sentencia->bindParam(":idCATEGORIA", $txtID);
    $sentencia->execute();
    header("Location:index.php");

}

$sentencia = $conexion->prepare("SELECT * FROM categoria");
$sentencia->execute();
$lista_categorias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM subcategoria");
$sentencia->execute();
$lista_subcategorias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../Plantillas/header.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .subcategoria-header {
        background-color: lightblue;
        color: blue;
        text-align: center;
        padding: 5px;
    }

    .subcategoria-text {
        border: 1px solid lightblue;
        padding: 5px;
    }
</style>
<script>
    $(document).ready(function () {
        $('.toggle-subcategories').click(function () {
            var categoryId = $(this).data('id');
            var subcategoriesRow = $('.subcategories-row[data-parent="' + categoryId + '"]');

            if (subcategoriesRow.is(':visible')) {
                subcategoriesRow.hide();
                $(this).html('<i class="fa fa-plus-circle"></i>'); // Cambio al ícono de "más"
            } else {
                subcategoriesRow.show();
                $(this).html('<i class="fa fa-minus-circle"></i>'); // Cambio al ícono de "menos"
            }
        });
    });
</script>

<br>
<h1 class="text-center text-info text-dark">Categorias</h1>
<br>

<div class="card">
<?php
    if ($rolUsuario === 'Administrador' || $rolUsuario === 'Asistente') {
        ?>
        <div class="card-header" style="text-align: right">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar nueva Categoria</a>
        </div>
        <?php
    }
    ?>
    <div class="card-body">
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_categorias as $categoria): ?>
                        <tr class="parent-row">
                            <td scope="row">
                                <?= $categoria['idCATEGORIA'] ?>
                            </td>
                            <td>
                                <span class="toggle-subcategories" data-id="<?= $categoria['idCATEGORIA'] ?>">
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                                <?= $categoria['nombreCat'] ?>
                            </td>
                            <td scope="row">
                                <?= $categoria['DescripcionCate'] ?>
                            </td>
                        </tr>
                        <!-- Subcategorías asociadas a esta categoría -->
                        <?php $subcategoriasMostradas = false; ?>
                        <?php foreach ($lista_subcategorias as $subcategoria): ?>
                            <?php if ($subcategoria['CATEGORIA_idCATEGORIA'] == $categoria['idCATEGORIA']): ?>
                                <?php if (!$subcategoriasMostradas): ?>
                                    <tr class="subcategories-row" data-parent="<?= $categoria['idCATEGORIA'] ?>" style="display: none;">
                                        <td colspan="4" class="text-center">
                                            <div class="subcategoria-header">
                                                Subcategorías
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $subcategoriasMostradas = true; ?>
                                <?php endif; ?>
                                <tr class="subcategories-row" data-parent="<?= $categoria['idCATEGORIA'] ?>" style="display: none;">
                                <td></td>
                                    <td colspan="">
                                    <td scope="row" class="subcategories-row text-center">
                                        <a
                                            href="/MedicInven/Secciones/Medicamentos/index.php?subcategoria=<?= $subcategoria['idSUBCATEGORIA'] ?>">
                                            <div class="subcategoria-text">
                                                <?= $subcategoria['nombreSubcat'] ?>
                                            </div>
                                        </a>
                                    </td>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>