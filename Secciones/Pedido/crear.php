<?php include("../../Plantillas/header.php"); ?>


<div class="card">
    <div class="card-header">
        <h1>Nuevo Pedido</h1>
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          <label for="" class="form-label">Fecha del Pedido</label>
          <input type="date"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Costo</label>
          <input type="text"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="Ingresa el costo del pedido">
        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Nombre del Producto</label>
          <input type="text"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="Ingresa el nombre del producto">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Cantidad</label>
          <input type="text"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="Ingresa la cantida del pedido">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Fecha de entrega</label>
          <input type="date"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Fecha de envio</label>
          <input type="date"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <h6>Estado</h6>
       <input type="text" class="form-control" id="opcion-seleccionada" readonly placeholder="Añade un estado al pedido">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Seleccionar
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-value="opcion1">Completo</a></li>
                <li><a class="dropdown-item" href="#" data-value="opcion2">En Reparto</a></li>
                <li><a class="dropdown-item" href="#" data-value="opcion3">Incompleto</a></li>
            </ul>
    </form>
    </div>
   
    <div class="card-footer text-muted">
    <a name="" id="" class="btn btn-success" href="index.php" role="button">Agregar Pedido</a>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>