<?php 
include("../../database.php");
  if($_POST){
    print_r($_POST);
    // Recolectar datos (método post)
    // Recolectar datos (método post)
    $persona = (isset($_POST["idPersona"]) ? $_POST["idPersona"] : "");
    $nombreP = (isset($_POST["nombreP"]) ? $_POST["nombreP"] : "");
    $apellidosP = (isset($_POST["apellidosP"]) ? $_POST["apellidosP"] : "");
    $telefonoP = (isset($_POST["telefonoP"]) ? $_POST["telefonoP"] : "");
    $numeroP = (isset($_POST["numeroP"]) ? $_POST["numeroP"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    $cedulaP = (isset($_POST["cedulaP"]) ? $_POST["cedulaP"] : "");
    $idRol = (isset($_POST["idRol"]) ? $_POST["idRol"] : "");

    // Inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO persona (idPersona,nombreP,apellidosP,telefonoP,numeroP,correo,cedulaP,ROL_idRol)
    VALUES (null, :nombreP, :apellidosP, :telefonoP, :numeroP, :correo, :cedulaP, :idRol) ");

      // Asignar valores que tienen un solo :variable
    $sentencia->bindParam(":nombreP", $nombreP);
    $sentencia->bindParam(":apellidosP", $apellidosP);
    $sentencia->bindParam(":telefonoP", $telefonoP);
    $sentencia->bindParam(":numeroP", $numeroP);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":cedulaP", $cedulaP);
    $sentencia->bindParam(":idRol", $idRol);

    $sentencia->execute();
    header("location:index.php");
    }
      // Obtener roles desde la base de datos
      $sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
      $sentenciaRoles->execute();
      $roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../Plantillas/header.php"); ?> <!--include para que el menu se muestre en todos los apartados -->
<br>

Datos del User
<div class="card"> <!-- bs5cardheadfoot -->
    <div class="card-header">
        Datos del Usuario
    </div>
    <div class="card-body">
    <form action="" method="post"> <!--form:post-->
        <div class="mb-3">
            <!--bs5forminput abajo-->
          <label for="nombreP" class="form-label">Nombre</label>
          <input type="text"
            class="form-control" name="nombreP" id="nombreP" aria-describedby="helpId" placeholder="Ingrese su nombre">
          
        </div>
        <div class="mb-3">
          <label for="apellidosP" class="form-label">Apellido</label>
          <input type="text"
            class="form-control" name="apellidosP" id="apellidosP" aria-describedby="helpId" placeholder="Ingrese su apellido...">

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Telefono</label>
          <input type="number"
            class="form-control" name="telefonoP" id="telefonoP" aria-describedby="helpId" placeholder="Ingrese su telefono">

        </div>
          <div class="mb-3">
          <label for="numeroP" class="form-label">Numero</label>
          <input type="number"
            class="form-control" name="numeroP" id="numeroP" aria-describedby="helpId" placeholder="Ingrese su telefono">

        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="email"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ingrese su correo">
        </div>
        <div class="mb-3">
          <label for="cedulaP" class="form-label">Cedula:</label>
          <input type="text"
            class="form-control" name="cedulaP" id="cedulaP" aria-describedby="helpId" placeholder="Ingrese su cedula">
        </div>
        <!-- bs5formselectcustom sirve para hacer una seleccion del (Rol) eje:
        esto se tomara de una base de datos que tendra los roles abajo-->
        <!-- menu despegable del rol abajo -->
        <div class="mb-3"> 
            <label for="idRol" class="form-label">Rol</label>
            <select class="form-select form-select-lg" name="idRol" id="idRol">
            <?php foreach ($roles as $rol) { ?>
            <option value="<?php echo $rol['idRol']; ?>"><?php echo $rol['nombreRol']; ?></option>
            <?php } ?>
            </select>
        </div>
        <!-- bs5formemail abajo -->
        
        <!-- bs5buttondefault para los botones  add user abajo -->
        <button type="submit" class="btn btn-success">Agregar Usuario</button>
        <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    </div>
    <div class="card-footer text-muted">
       
    </div>
</div>
<?php include("../../Plantillas/footer.php"); ?>