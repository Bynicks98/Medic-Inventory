<?php include("../../Plantillas/header.php"); ?>

<h1 class="text-center text-info text-dark">Pedidos</h1>
<br>


<div class="card"> <!-- bs5cardheadfoot -->
    <div class="card-header" style="text-align: right">
        <!-- bs5button-a  -->
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar un nuevo Pedido</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm container-sm">
            <table class="table " id="tabla_id"> <!-- bs5tabledefault  -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha del Pedido</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Nombre del producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha de entrega</th>
                        <th scope="col">Fecha de envio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">1234 </td>
                        <td scope="row">2/11/2023</td>
                        <td scope="row">50.000</td>
                        <td scope="row">Acetaminofen</td>
                        <td scope="row">50 Cajas</td>
                        <td scope="row">3/11/2023</td>
                        <td scope="row">2/11/2023</td>
                        <td scope="row">En Reparto</td>
                        
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>