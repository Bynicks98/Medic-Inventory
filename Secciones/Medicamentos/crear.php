<?php 
include("../../database.php");
  if($_POST){
    
    // Recolectar datos (método post)
    // Recolectar datos (método post)
    $descripcionMedica = (isset($_POST["descripcionMedica"]) ? $_POST["descripcionMedica"] : "");
    $fechaVencimientoMedica = (isset($_POST["fechaVencimientoMedica"]) ? $_POST["fechaVencimientoMedica"] : "");
    $cantidadCajas = (isset($_POST["cantidadCajas"]) ? $_POST["cantidadCajas"] : "");
    $noLoteMedica = (isset($_POST["noLoteMedica"]) ? $_POST["noLoteMedica"] : "");
    $valorUnitMedica = (isset($_POST["valorUnitMedica"]) ? $_POST["valorUnitMedica"] : "");
    $fechaFabricacionMedica = (isset($_POST["fechaFabricacionMedica"]) ? $_POST["fechaFabricacionMedica"] : "");
    $nombreMedica = (isset($_POST["nombreMedica"]) ? $_POST["nombreMedica"] : "");
    $cantidadUnidades = (isset($_POST["cantidadUnidades"]) ? $_POST["cantidadUnidades"] : "");
    $idCATEGORIA = (isset($_POST["SUBCATEGORIA_CATEGORIA_idCATEGORIA"]) ? $_POST["SUBCATEGORIA_CATEGORIA_idCATEGORIA"] : "");
    $idSUBCATEGORIA = (isset($_POST["SUBCATEGORIA_idSUBCATEGORIA"]) ? $_POST["SUBCATEGORIA_idSUBCATEGORIA"] : "");
    $idRol = (isset($_POST["Persona_ROL_idRol"]) ? $_POST["Persona_ROL_idRol"] : "");
    $idPersona = (isset($_POST["Persona_idPersona"]) ? $_POST["Persona_idPersona"] : "");
    $sentencia = $conexion->prepare("INSERT INTO medicamento (idMEDICAMENTO, descripcionMedica, fechaVencimientoMedica, cantidadCajas, noLoteMedica, valorUnitMedica, fechaFabricacionMedica, nombreMedica, cantidadUnidades, SUBCATEGORIA_CATEGORIA_idCATEGORIA, SUBCATEGORIA_idSUBCATEGORIA, Persona_idPersona, Persona_ROL_idRol)
    VALUES (null, :descripcionMedica, :fechaVencimientoMedica, :cantidadCajas, :noLoteMedica, :valorUnitMedica, :fechaFabricacionMedica, :nombreMedica, :cantidadUnidades, :idCATEGORIA, :idSUBCATEGORIA, :idPersona, :idRol)");
    
      // Asignar valores que tienen un solo :variable
    $sentencia->bindParam(":descripcionMedica", $descripcionMedica);
    $sentencia->bindParam(":fechaVencimientoMedica", $fechaVencimientoMedica);
    $sentencia->bindParam(":cantidadCajas", $cantidadCajas);
    $sentencia->bindParam(":noLoteMedica", $noLoteMedica);
    $sentencia->bindParam(":valorUnitMedica", $valorUnitMedica);
    $sentencia->bindParam(":fechaFabricacionMedica", $fechaFabricacionMedica);
    $sentencia->bindParam(":nombreMedica", $nombreMedica);
    $sentencia->bindParam(":cantidadUnidades", $cantidadUnidades);
    $sentencia->bindParam(":idCATEGORIA", $idCATEGORIA);
    $sentencia->bindParam(":idSUBCATEGORIA", $idSUBCATEGORIA);
    $sentencia->bindParam(":idRol", $idRol);
    $sentencia->bindParam(":idPersona", $idPersona);

    $sentencia->execute();
    header("location:index.php");
    }
    $sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
    $sentenciaRoles->execute();
    $roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaPersona = $conexion->prepare("SELECT idPersona, nombreP FROM persona");
    $sentenciaPersona->execute();
    $Persona = $sentenciaPersona->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaCat = $conexion->prepare("SELECT idCATEGORIA, nombreCat  FROM categoria");
    $sentenciaCat->execute();
    $Categorias = $sentenciaCat->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaSubcat = $conexion->prepare("SELECT * FROM `subcategoria` JOIN categoria on subcategoria.idSUBCATEGORIA = categoria.idCATEGORIA");
    $sentenciaSubcat->execute();
    $Subcategorias = $sentenciaSubcat ->fetchAll(PDO::FETCH_ASSOC);
    //   // Obtener roles desde la base de datos
    //   $sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
    //   $sentenciaRoles->execute();
    //   $roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

?>









<?php include("../../Plantillas/header.php"); ?>
<br>

<div class="card">
    <div class="card-header">
        Datos del Medicamento
    </div>
    <div class="card-body">

    <form action="" method="post">
        <div class="mb-3">
          <label for="nombreMedica" class="form-label">Nombre </label>
          <input type="text"
            class="form-control" name="nombreMedica" id="nombreMedica" aria-describedby="helpId" placeholder="Añade un nombre a tu medicamento">
          
        </div>   
        <div class="mb-3">
          <label for="descripcionMedica" class="form-label">Descripcion del medicamento</label>
          <input type="text"
            class="form-control" name="descripcionMedica" id="descripcionMedica" aria-describedby="helpId" placeholder="Agrega el tipo de tu medicamento">

        </div>    
        <div class="mb-3">
          <label for="fechaFabricacionMedica" class="form-label">Fecha de Fabricacion</label>
          <input type="date"
          
            class="form-control" name="fechaFabricacionMedica" id="fechaFabricacionMedica" aria-describedby="helpId" placeholder="elija la fecha de fabricacion">
         
        </div>   
        <div class="mb-3">
          <label for="fechaVencimientoMedica" class="form-label">Fecha de Vencimiento</label>
          <input type="date"
            class="form-control" name="fechaVencimientoMedica" id="fechaVencimientoMedica" aria-describedby="helpId" placeholder="elija la fecha de fabricacion.">
          
        </div>
        </div>    
        <div class="mb-3">
          <label for="cantidadCajas" class="form-label">Cantidad de cajas</label>
          <input type="text"
            class="form-control" name="cantidadCajas" id="cantidadCajas" aria-describedby="helpId" placNumero de cajasbricacion">
         
        </div>   
        <div class="mb-3">
          <label for="cantidadUnidades" class="form-label">Cantidad de Unidades</label>
          <input type="text"
            class="form-control" name="cantidadUnidades" id="ica" id="cantidadUnidades" aria-describedby="helpId" placeholder="elija la fecha de fabricacion">
         
        </div>   
        <div class="mb-3">
          <label for="valorUnitMedica" class="form-label">valorUnitMedica</label>
          <input type="text"
            class="form-control" name="valorUnitMedica" id="ica" id="valorUnitMedica" aria-describedby="helpId" placeholder="elija la fecha de fabricacion">
         
        </div>   
        <div class="mb-3">
          <label for="noLoteMedica" class="form-label">noLoteMedica</label>
          <input type="text"
            class="form-control" name="noLoteMedica" id="ica" id="noLoteMedica" aria-describedby="helpId" placeholder="elija la fecha de fabricacion">
         
        </div>   
        
       <!-- FK categoria y subcategoria -->
       <div class="mb-3"> 
            <label for="idCATEGORIA" class="form-label">CATEGORIA</label>
            <select class="form-select form-select-lg" name="SUBCATEGORIA_CATEGORIA_idCATEGORIA" id="idCATEGORIA">
            <?php foreach ($Categorias as $medicamento) { ?>
            <option value="<?php echo $medicamento['idCATEGORIA']; ?>"><?php echo $medicamento['nombreCat']; ?></option>
            <?php } ?>
            </select>
        </div>
               <div class="mb-3"> 
            <label for="idSUBCATEGORIA" class="form-label">SUBCATEGORIA</label>
            <select class="form-select form-select-lg" name="SUBCATEGORIA_idSUBCATEGORIA" id="idSUBCATEGORIA">
            <?php foreach ($Subcategorias as $medicamento) { ?>
            <option value="<?php echo $medicamento['idSUBCATEGORIA']; ?>"><?php echo $medicamento['nombreSubcat']; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="mb-3"> 
            <label for="idRol" class="form-label">Rol</label>
            <select class="form-select form-select-lg" name="Persona_ROL_idRol" id="idRol">
            <?php foreach ($roles as $medicamento) { ?>
            <option value="<?php echo $medicamento['idRol']; ?>"><?php echo $medicamento['nombreRol']; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="mb-3"> 
            <label for="idPersona" class="form-label">Persona</label>
            <select class="form-select form-select-lg" name="Persona_idPersona" id="idPersona">
            <?php foreach ($Persona as $medicamento) { ?>
            <option value="<?php echo $medicamento['idPersona']; ?>"><?php echo $medicamento['nombreP']; ?></option>
            <?php } ?>
            </select>
        </div>
        <!--  -->
        
                <!-- bs5buttondefault para los botones  add user abajo -->
                <button type="submit" class="btn btn-success" name="agregarMed">Agregar Medicamento</button>
                <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
                 <a name="cancel" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Plantillas/footer.php"); ?>