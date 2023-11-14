<?php
include("../../database.php");
if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM persona WHERE idPersona=:idPersona");
  $sentencia->bindParam(":idPersona", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);  //ejecuta la consulta preparada y recupera la siguiente fila de resultados de la base de datos
  if ($registro) {
    $nombreP = $registro["nombreP"];
    $apellidosP = $registro["apellidosP"];
    $telefonoP = $registro["telefonoP"];
    $numeroP = $registro["numeroP"];
    $correo = $registro["correo"];
    $cedulaP = $registro["cedulaP"];
    $contrasena = $registro["contrasena"];
  }
}
if ($_POST) {

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $nombreP = (isset($_POST["nombreP"]) ? $_POST["nombreP"] : "");
  $apellidosP = (isset($_POST["apellidosP"]) ? $_POST["apellidosP"] : "");
  $telefonoP = (isset($_POST["telefonoP"]) ? $_POST["telefonoP"] : "");
  $numeroP = (isset($_POST["numeroP"]) ? $_POST["numeroP"] : "");
  $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
  $cedulaP = (isset($_POST["cedulaP"]) ? $_POST["cedulaP"] : "");
  $contrasena = (isset($_POST["contrasena"]) ? $_POST["contrasena"] : "");


  $sentencia = $conexion->prepare("UPDATE persona SET nombreP=:nombreP, apellidosP=:apellidosP, telefonoP=:telefonoP, numeroP=:numeroP, correo=:correo, cedulaP=:cedulaP, contrasena=:contrasena WHERE idPersona=:idPersona");


  $sentencia->bindParam(":nombreP", $nombreP);
  $sentencia->bindParam(":apellidosP", $apellidosP);
  $sentencia->bindParam(":telefonoP", $telefonoP);
  $sentencia->bindParam(":numeroP", $numeroP);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->bindParam(":cedulaP", $cedulaP);
  $sentencia->bindParam(":idPersona", $txtID);
  $sentencia->bindParam(":contrasena", $contrasena);

  $sentencia->execute();

  $mensaje = "Registro Actualizado";
  header("Location: index.php?mensaje=" . $mensaje);
  exit();
}
?>


<?php include("../../Plantillas/header.php"); ?>

<br>

Datos del User
<div class="card"> <!-- bs5cardheadfoot -->
  <div class="card-header">
    Datos del Usuario
  </div>
  <div class="card-body">
    <form action="" method="post"> <!--form:post-->

      <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">

      </div>
      <div class="mb-3">
        <!--bs5forminput abajo-->
        <label for="nombreP" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombreP" id="nombreP" aria-describedby="helpId"
          placeholder="Ingrese su nombre">

      </div>
      <div class="mb-3">
        <label for="apellidosP" class="form-label">Apellido</label>
        <input type="text" class="form-control" name="apellidosP" id="apellidosP" aria-describedby="helpId"
          placeholder="Ingrese su apellido...">

      </div>
      <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input type="number" class="form-control" name="telefonoP" id="telefonoP" aria-describedby="helpId"
          placeholder="Ingrese su telefono">

      </div>
      <div class="mb-3">
        <label for="numeroP" class="form-label">Numero</label>
        <input type="number" class="form-control" name="numeroP" id="numeroP" aria-describedby="helpId"
          placeholder="Ingrese su telefono">

      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
          placeholder="Ingrese su correo">
      </div>
      <div class="mb-3">
        <label for="cedulaP" class="form-label">Cedula:</label>
        <input type="text" class="form-control" name="cedulaP" id="cedulaP" aria-describedby="helpId"
          placeholder="Ingrese su cedula">
      </div>
      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="text" value="<?php echo $contrasena; ?>" class="form-control" name="contrasena" id="contrasena"
          aria-describedby="helpId" placeholder="Digite la contraseña de su rol...">
      </div>
      <!-- bs5formselectcustom sirve para hacer una seleccion del (Rol) eje:
        esto se tomara de una base de datos que tendra los roles abajo-->
      <!-- menu despegable del rol abajo -->

      <!-- bs5formemail abajo -->

      <!-- bs5buttondefault para los botones  add user abajo -->
      <button type="submit" class="btn btn-success">Editar Usuario</button>
      <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

  </div>
  <div class="card-footer text-muted">

  </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>