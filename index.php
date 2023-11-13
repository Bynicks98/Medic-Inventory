<?php include("Plantillas/header.php"); 


?><!--include para que el menu se muestre en todos los apartados -->

<br>
<br>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
</head>

<body>

</body>

</html>
<!-- abajo nombre de la persona iniciada -->
<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <?php if (isset($_SESSION['nombreP'])) { ?>
      <h1 class="display-5 fw-bold">Bienvenido a MedicInventory</h1>
      <p class="col-md-8 fs-4">Usuario: <?php echo $_SESSION['nombreP']; ?></p>
      <button class="btn btn-primary btn-lg" type="button">Example button</button>
      <img src="Imagenes/stich.jpg">
      <a href="Imagenes/hola.php" clase="btn btn success">Hola</a>
    <?php } else { ?>
      <p>No has iniciado sesión.</p>
    <?php } ?>
  </div>
</div>
<!-- el que esta abajo es el normal sin el nombre de la persona -->
<!-- <div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bienvenido a MedicInventory</h1>
    <p class="col-md-8 fs-4">Usuario :</p>
    <button class="btn btn-primary btn-lg" type="button">Example button</button>
    <img src="Imagenes/stich.jpg">
    <a href="Imagenes/hola.php" clase="btn btn success">Hola</a>
  </div>
</div> -->


<?php include("Plantillas/footer.php"); ?>