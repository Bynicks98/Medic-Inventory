<?php include("Plantillas/header.php"); 

// Verifica si la sesión está iniciada y el rol está definido
if (isset($_SESSION['rol'])) 
  $rol = $_SESSION['rol'];

  // Dependiendo del rol, muestra contenido diferente
  switch ($rol) {
      case 1: // Administrador
          echo "<h1 class='display-5 fw-bold'>Bienvenido a MedicInventory, Administrador</h1>";
          break;
      case 2: // Asistente de bodega
          echo "<h1 class='display-5 fw-bold'>Bienvenido a MedicInventory, Asistente de Bodega</h1>";
          break;
      case 3: // Lector
          echo "<h1 class='display-5 fw-bold'>Bienvenido a MedicInventory, Lector</h1>";
          break;
      default:
          echo "<h1 class='display-5 fw-bold'>Bienvenido a MedicInventory</h1>";
  }
  
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
<div class="p-5 mb-4 bg-light rounded-3" style="text-align: center;">
  <div class="container-fluid py-5" >
    <?php if (isset($_SESSION['nombreP'])) { ?>
      <h1 class="display-5 fw-bold" >Bienvenido a MedicInventory</h1>
      <p  style="text-align: center; ">Usuario: <?php echo $_SESSION['nombreP']; ?></p>
      <img  src="./imagenes/logoMI.png" class="img1">
      <a href="MedicInven/Imagenes/hola.php" clase="btn btn success"></a>
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