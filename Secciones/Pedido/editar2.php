<?php
include("../../database.php");

$sentenciaNombresMedicamentos = $conexion->prepare("SELECT idMEDICAMENTO, nombreMedica FROM medicamento");
$sentenciaNombresMedicamentos->execute();
$nombresMedicamentos = $sentenciaNombresMedicamentos->fetchAll(PDO::FETCH_ASSOC);

$sentenciaidsucursal = $conexion->prepare("SELECT idSUCURSAL, nombreIps  FROM sucursalips");
$sentenciaidsucursal->execute();
$idsucursal = $sentenciaidsucursal->fetchAll(PDO::FETCH_ASSOC);

$sentenciaDistribuidores = $conexion->prepare("SELECT idDISTRIBUIDOR, nombreDistri FROM distribuidor");
$sentenciaDistribuidores->execute();
$distribuidores = $sentenciaDistribuidores->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPagos = $conexion->prepare("SELECT idPAGO, ReferenciaPago FROM pago");
$sentenciaPagos->execute();
$pagos = $sentenciaPagos->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPersonas = $conexion->prepare("SELECT idPersona, nombreP FROM persona");
$sentenciaPersonas->execute();
$personas = $sentenciaPersonas->fetchAll(PDO::FETCH_ASSOC);

$sentenciaRoles = $conexion->prepare("SELECT idRol, nombreRol FROM rol");
$sentenciaRoles->execute();
$roles = $sentenciaRoles->fetchAll(PDO::FETCH_ASSOC);

$sentenciaCategorias = $conexion->prepare("SELECT idCATEGORIA, nombreCat FROM categoria");
$sentenciaCategorias->execute();
$categorias = $sentenciaCategorias->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSubcategorias = $conexion->prepare("SELECT idSUBCATEGORIA, nombreSubcat FROM subcategoria");
$sentenciaSubcategorias->execute();
$subcategorias = $sentenciaSubcategorias->fetchAll(PDO::FETCH_ASSOC);

$sentenciaformula = $conexion->prepare("SELECT idFORMULA, Referenciaformula FROM formulamedica");
$sentenciaformula->execute();
$formulaM = $sentenciaformula->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';
  $sentencia = $conexion->prepare("SELECT * from pedido where idPEDIDO = :idPEDIDO");
  $sentencia->bindParam(":idPEDIDO", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  if ($registro) {

    $idPEDIDO = $registro["idPEDIDO"];
    $Tipo_pedido = $registro["Tipo_pedido"];
    $fechaPedido = $registro["fechaPedido"];
    $costoPedido = $registro["costoPedido"];
    $Nombre_Producto = $registro["Nombre_Producto"];
    $cantidadP = $registro["cantidadP"];
    $Fecha_entrega = $registro["Fecha_entrega"];
    $Fecha_envio = $registro["Fecha_envio"];
    $EstadoP = $registro["EstadoP"];
    $SUCURSALIPS_idSUCURSALIPS = $registro["SUCURSALIPS_idSUCURSALIPS"];
    $DISTRIBUIDOR_idDISTRIBUIDOR = $registro["DISTRIBUIDOR_idDISTRIBUIDOR"];
    $PAGO_idPAGO = $registro["PAGO_idPAGO"];
    $MEDICAMENTO_idMEDICAMENTO = $registro["MEDICAMENTO_idMEDICAMENTO"];
    $MEDICAMENTO_Persona_idPersona = $registro["MEDICAMENTO_Persona_idPersona"];
    $MEDICAMENTO_PERSONA_ROL_idRol = $registro["MEDICAMENTO_PERSONA_ROL_idRol"];
    $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = $registro["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"];
    $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = $registro["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"];
    $FORMULAMEDICA_idFORMULA = $registro["FORMULAMEDICA_idFORMULA"];
    $nombreProductoSeleccionado = $registro["MEDICAMENTO_idMEDICAMENTO"];
    $estadoPedidoSeleccionado = $registro["EstadoP"];
  }
}

if ($_POST) {
  $idPEDIDO = (isset($_POST["idPEDIDO"]) ? $_POST["idPEDIDO"] : "");
  $Tipo_pedido = (isset($_POST["Tipo_pedido"]) ? $_POST["Tipo_pedido"] : "");
  $fechaPedido = (isset($_POST["fechaPedido"]) ? $_POST["fechaPedido"] : "");
  $costoPedido = (isset($_POST["costoPedido"]) ? $_POST["costoPedido"] : "");
  $Nombre_Producto = (isset($_POST["Nombre_Producto"]) ? $_POST["Nombre_Producto"] : "");
  $cantidadP = (isset($_POST["cantidadP"]) ? $_POST["cantidadP"] : "");
  $Fecha_entrega = (isset($_POST["Fecha_entrega"]) ? $_POST["Fecha_entrega"] : "");
  $Fecha_envio = (isset($_POST["Fecha_envio"]) ? $_POST["Fecha_envio"] : "");
  $EstadoP = (isset($_POST["EstadoP"]) ? $_POST["EstadoP"] : "");
  $SUCURSALIPS_idSUCURSALIPS = (isset($_POST["SUCURSALIPS_idSUCURSALIPS"]) ? $_POST["SUCURSALIPS_idSUCURSALIPS"] : "");
  $DISTRIBUIDOR_idDISTRIBUIDOR = (isset($_POST["DISTRIBUIDOR_idDISTRIBUIDOR"]) ? $_POST["DISTRIBUIDOR_idDISTRIBUIDOR"] : "");
  $PAGO_idPAGO = (isset($_POST["PAGO_idPAGO"]) ? $_POST["PAGO_idPAGO"] : "");
  $MEDICAMENTO_idMEDICAMENTO = (isset($_POST["MEDICAMENTO_idMEDICAMENTO"]) ? $_POST["MEDICAMENTO_idMEDICAMENTO"] : "");
  $MEDICAMENTO_Persona_idPersona = (isset($_POST["MEDICAMENTO_Persona_idPersona"]) ? $_POST["MEDICAMENTO_Persona_idPersona"] : "");
  $MEDICAMENTO_PERSONA_ROL_idRol = (isset($_POST["MEDICAMENTO_PERSONA_ROL_idRol"]) ? $_POST["MEDICAMENTO_PERSONA_ROL_idRol"] : "");
  $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = (isset($_POST["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"]) ? $_POST["MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"] : "");
  $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = (isset($_POST["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"]) ? $_POST["MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"] : "");
  $FORMULAMEDICA_idFORMULA = (isset($_POST["FORMULAMEDICA_idFORMULA"]) ? $_POST["FORMULAMEDICA_idFORMULA"] : "");
  $nombreProductoSeleccionado = (isset($_POST["MEDICAMENTO_idMEDICAMENTO"])) ? $_POST["MEDICAMENTO_idMEDICAMENTO"] : "";
  $estadoPedidoSeleccionado = (isset($_POST["EstadoP"])) ? $_POST["EstadoP"] : "";

  $sentenciaActualizarPedido = $conexion->prepare("UPDATE pedido SET Tipo_pedido = :Tipo_pedido, fechaPedido = :fechaPedido, 
  costoPedido = :costoPedido, Nombre_Producto = :Nombre_Producto, cantidadP = :cantidadP, Fecha_entrega = :Fecha_entrega, 
  Fecha_envio = :Fecha_envio, EstadoP = :EstadoP, SUCURSALIPS_idSUCURSALIPS = :SUCURSALIPS_idSUCURSALIPS, DISTRIBUIDOR_idDISTRIBUIDOR = :DISTRIBUIDOR_idDISTRIBUIDOR
  , PAGO_idPAGO = :PAGO_idPAGO, MEDICAMENTO_idMEDICAMENTO = :MEDICAMENTO_idMEDICAMENTO ,MEDICAMENTO_Persona_idPersona = :MEDICAMENTO_Persona_idPersona, 
  MEDICAMENTO_PERSONA_ROL_idRol = :MEDICAMENTO_PERSONA_ROL_idRol, MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA = :MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA
  , MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA = :MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA, FORMULAMEDICA_idFORMULA = :FORMULAMEDICA_idFORMULA WHERE idPEDIDO = :idPedido");

  $sentenciaActualizarPedido->bindParam(":Tipo_pedido", $Tipo_pedido);
  $sentenciaActualizarPedido->bindParam(":fechaPedido", $fechaPedido);
  $sentenciaActualizarPedido->bindParam(":costoPedido", $costoPedido);
  $sentenciaActualizarPedido->bindParam(":Nombre_Producto", $nombreProductoSeleccionado);
  $sentenciaActualizarPedido->bindParam(":cantidadP", $cantidadP);
  $sentenciaActualizarPedido->bindParam(":Fecha_entrega", $Fecha_entrega);
  $sentenciaActualizarPedido->bindParam(":Fecha_envio", $Fecha_envio);
  $sentenciaActualizarPedido->bindParam(":EstadoP", $estadoPedidoSeleccionado);
  $sentenciaActualizarPedido->bindParam(":idPedido", $idPedidoEditar);
  $sentenciaActualizarPedido->bindParam(":SUCURSALIPS_idSUCURSALIPS", $SUCURSALIPS_idSUCURSALIPS);
  $sentenciaActualizarPedido->bindParam(":DISTRIBUIDOR_idDISTRIBUIDOR", $DISTRIBUIDOR_idDISTRIBUIDOR);
  $sentenciaActualizarPedido->bindParam(":PAGO_idPAGO", $PAGO_idPAGO);
  $sentenciaActualizarPedido->bindParam(":MEDICAMENTO_idMEDICAMENTO", $MEDICAMENTO_idMEDICAMENTO);
  $sentenciaActualizarPedido->bindParam(":MEDICAMENTO_Persona_idPersona", $MEDICAMENTO_Persona_idPersona);
  $sentenciaActualizarPedido->bindParam(":MEDICAMENTO_PERSONA_ROL_idRol", $MEDICAMENTO_PERSONA_ROL_idRol);
  $sentenciaActualizarPedido->bindParam(":MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA", $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA);
  $sentenciaActualizarPedido->bindParam(":MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA", $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA);
  $sentenciaActualizarPedido->bindParam(":FORMULAMEDICA_idFORMULA", $FORMULAMEDICA_idFORMULA);

  $sentenciaActualizarPedido->execute();

  $mensaje = "Registro actualizado";
  header("Location:index.php?mensaje=" . $mensaje);
}
?>

<script>
  document.getElementById('MEDICAMENTO_idMEDICAMENTO').addEventListener('change', function () {
    var selectedProductId = this.value;

    // Enviar solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);

          // Actualizar el select de categorías
          var categorySelect = document.getElementById('MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA');
          categorySelect.innerHTML = '<option value="">Selecciona una categoría</option>';
          response.categories.forEach(function (category) {
            var option = document.createElement('option');
            option.value = category.idCATEGORIA;
            option.textContent = category.nombreCat;
            categorySelect.appendChild(option);
          });

          // Actualizar el select de subcategorías
          var subcategorySelect = document.getElementById('MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA');
          subcategorySelect.innerHTML = '<option value="">Selecciona una subcategoría</option>';
          response.subcategories.forEach(function (subcategory) {
            var option = document.createElement('option');
            option.value = subcategory.idSUBCATEGORIA;
            option.textContent = subcategory.nombreSubcat;
            subcategorySelect.appendChild(option);
          });
        } else {
          console.error('Hubo un error al obtener las categorías y subcategorías.');
        }
      }
    };

    // Enviar la solicitud POST al servidor con el ID del producto seleccionado
    xhr.open('POST', 'obtener_categorias_subcategorias.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('productoId=' + selectedProductId);
  });
</script>



<?php include("../../Plantillas/header.php"); ?>

<div class="card">
  <div class="card-header">
    <h1>Editar Pedido</h1>
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
      <input type="hidden" name="Tipo_pedido" id="Tipo_pedido" value="">
      <div>
        <h6>Tipo de Pedido</h6>
        <input type="text" class="form-control" id="opcion-seleccionada" readonly
          placeholder="Añade un estado al pedido" value="<?php echo isset($Tipo_pedido) ? $Tipo_pedido : ''; ?>">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Seleccionar
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#" data-value="Entrada">Entrada de medicamento</a></li>
          <li><a class="dropdown-item" href="#" data-value="Salida">Salida de medicamento</a></li>
        </ul>
      </div>
      <script>
        document.querySelectorAll('.dropdown-item').forEach(item => {
          item.addEventListener('click', event => {
            const selectedValue = event.target.dataset.value;
            document.getElementById('Tipo_pedido').value = selectedValue;
            document.getElementById('opcion-seleccionada').value = selectedValue;
          });
        });
      </script>

      <div class="mb-3">
        <label for="fechaPedido" class="form-label">Fecha del Pedido</label>
        <input type="date" class="form-control" name="fechaPedido" id="fechaPedido" aria-describedby="helpId"
          placeholder="" value="<?php echo isset($fechaPedido) ? $fechaPedido : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="costoPedido" class="form-label">Costo</label>
        <input type="text" class="form-control" name="costoPedido" id="costoPedido" aria-describedby="helpId"
          placeholder="Ingresa el costo del pedido" value="<?php echo isset($costoPedido) ? $costoPedido : ''; ?>">
      </div>
      <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
      <div class="mb-3">
        <label for="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA" class="form-label">Categoría del Medicamento</label>
        <select class="form-select" name="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA"
          id="MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA" required>
          <option value="">Selecciona una categoría</option>
          <?php foreach ($categorias as $categoria) { ?>
            <option value="<?php echo $categoria['idCATEGORIA']; ?>" <?php if (isset($MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA) && $MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA == $categoria['idCATEGORIA'])
                 echo 'selected'; ?>>
              <?php echo $categoria['nombreCat']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA" class="form-label">Subcategoría del Medicamento</label>
        <select class="form-select" name="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA"
          id="MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA" required>
          <option value="">Selecciona una subcategoría</option>
          <?php foreach ($subcategorias as $subcategoria) { ?>
            <option value="<?php echo $subcategoria['idSUBCATEGORIA']; ?>" <?php if (isset($MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA) && $MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA == $subcategoria['idSUBCATEGORIA'])
                 echo 'selected'; ?>>
              <?php echo $subcategoria['nombreSubcat']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="MEDICAMENTO_idMEDICAMENTO" class="form-label">Nombre del Producto</label>
        <select class="form-select" name="MEDICAMENTO_idMEDICAMENTO" id="MEDICAMENTO_idMEDICAMENTO" required>
          <option value="">Selecciona un medicamento</option>
          <?php foreach ($nombresMedicamentos as $medicamento) { ?>
            <option value="<?php echo $medicamento['idMEDICAMENTO']; ?>" <?php if (isset($MEDICAMENTO_idMEDICAMENTO) && $MEDICAMENTO_idMEDICAMENTO == $medicamento['idMEDICAMENTO'])
                 echo 'selected'; ?>>
              <?php echo $medicamento['nombreMedica']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="cantidadP" class="form-label">Cantidad</label>
        <input type="text" class="form-control" name="cantidadP" id="cantidadP" aria-describedby="helpId"
          placeholder="Ingresa la cantida del pedido" value="<?php echo isset($cantidadP) ? $cantidadP : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="Fecha_entrega" class="form-label">Fecha de entrega</label>
        <input type="date" class="form-control" name="Fecha_entrega" id="Fecha_entrega" aria-describedby="helpId"
          placeholder="" value="<?php echo isset($Fecha_entrega) ? $Fecha_entrega : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="Fecha_envio" class="form-label">Fecha de envio</label>
        <input type="date" class="form-control" name="Fecha_envio" id="Fecha_envio" aria-describedby="helpId"
          placeholder="" value="<?php echo isset($Fecha_envio) ? $Fecha_envio : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="SUCURSALIPS_idSUCURSALIPS" class="form-label">Sucursal</label>
        <select class="form-select" name="SUCURSALIPS_idSUCURSALIPS" id="SUCURSALIPS_idSUCURSALIPS" required>
          <option value="">Seleccion de sucursal</option>
          <?php foreach ($idsucursal as $idSUCUR) { ?>
            <option value="<?php echo $idSUCUR['idSUCURSAL']; ?>" <?php if (isset($SUCURSALIPS_idSUCURSALIPS) && $SUCURSALIPS_idSUCURSALIPS == $idSUCUR['idSUCURSAL'])
                 echo 'selected'; ?>>
              <?php echo $idSUCUR['nombreIps']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="DISTRIBUIDOR_idDISTRIBUIDOR" class="form-label">Distribuidor</label>
        <select class="form-select" name="DISTRIBUIDOR_idDISTRIBUIDOR" id="DISTRIBUIDOR_idDISTRIBUIDOR" required>
          <option value="">Selecciona un distribuidor</option>
          <?php foreach ($distribuidores as $distribuidor) { ?>
            <option value="<?php echo $distribuidor['idDISTRIBUIDOR']; ?>" <?php if (isset($DISTRIBUIDOR_idDISTRIBUIDOR) && $DISTRIBUIDOR_idDISTRIBUIDOR == $distribuidor['idDISTRIBUIDOR'])
                 echo 'selected'; ?>>
              <?php echo $distribuidor['nombreDistri']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="PAGO_idPAGO" class="form-label">Referencia de pago</label>
        <select class="form-select" name="PAGO_idPAGO" id="PAGO_idPAGO" required>
          <option value="">Selecciona la Referencia</option>
          <?php foreach ($pagos as $pago) { ?>
            <option value="<?php echo $pago['idPAGO']; ?>" <?php if (isset($PAGO_idPAGO) && $PAGO_idPAGO == $pago['idPAGO'])
                 echo 'selected'; ?>>
              <?php echo $pago['ReferenciaPago']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="MEDICAMENTO_Persona_idPersona" class="form-label">Nombre de la Persona</label>
        <select class="form-select" name="MEDICAMENTO_Persona_idPersona" id="MEDICAMENTO_Persona_idPersona" required>
          <option value="">Selecciona una persona</option>
          <?php foreach ($personas as $persona) { ?>
            <option value="<?php echo $persona['idPersona']; ?>" <?php if (isset($MEDICAMENTO_Persona_idPersona) && $MEDICAMENTO_Persona_idPersona == $persona['idPersona'])
                 echo 'selected'; ?>>
              <?php echo $persona['nombreP']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="MEDICAMENTO_PERSONA_ROL_idRol" class="form-label">Rol de la Persona</label>
        <select class="form-select" name="MEDICAMENTO_PERSONA_ROL_idRol" id="MEDICAMENTO_PERSONA_ROL_idRol" required>
          <option value="">Selecciona un rol</option>
          <?php foreach ($roles as $rol) { ?>
            <option value="<?php echo $rol['idRol']; ?>" <?php if (isset($MEDICAMENTO_PERSONA_ROL_idRol) && $MEDICAMENTO_PERSONA_ROL_idRol == $rol['idRol'])
                 echo 'selected'; ?>>
              <?php echo $rol['nombreRol']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="FORMULAMEDICA_idFORMULA" class="form-label">Formula medica</label>
        <select class="form-select" name="FORMULAMEDICA_idFORMULA" id="FORMULAMEDICA_idFORMULA" required>
          <option value="">Selecciona la formula medica</option>
          <?php foreach ($formulaM as $ForMed) { ?>
            <option value="<?php echo $ForMed['idFORMULA']; ?>" <?php if (isset($FORMULAMEDICA_idFORMULA) && $FORMULAMEDICA_idFORMULA == $ForMed['idFORMULA'])
                 echo 'selected'; ?>>
              <?php echo $ForMed['Referenciaformula']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div>
        <input type="hidden" name="EstadoP" id="EstadoP" value="">
        <div>
          <h6>Estado</h6>
          <input type="text" class="form-control" id="opcion-seleccionada" readonly
            placeholder="Añade un estado al pedido"
            value="<?php echo isset($estadoPedidoSeleccionado) ? $estadoPedidoSeleccionado : ''; ?>">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Seleccionar
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-value="Completo">Completo</a></li>
            <li><a class="dropdown-item" href="#" data-value="En Reparto">En Reparto</a></li>
            <li><a class="dropdown-item" href="#" data-value="Incompleto">Incompleto</a></li>
          </ul>
        </div>
        <script>
          document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', event => {
              const selectedValue = event.target.dataset.value;
              document.getElementById('EstadoP').value = selectedValue;
              document.getElementById('opcion-seleccionada').value = selectedValue;
            });
          });
        </script>
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-success" name="agregarPed">Agregar Pedido</button>
          <!-- bs5button-a  para link cancel que nos lleva devuelta al index del user abajo-->
          <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </div>
      </div>
    </form>
  </div>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      // Código para establecer las opciones seleccionadas automáticamente
      document.querySelectorAll('input[type="text"]').forEach(inputField => {
        const inputName = inputField.getAttribute('name');
        const selectElement = document.querySelector(`select[name="${inputName}"]`);

        if (selectElement) {
          const selectedValue = inputField.value;
          Array.from(selectElement.options).forEach(option => {
            if (option.value === selectedValue) {
              option.selected = true;
            }
          });
        }
      });
    });
  </script>

</div>

<?php include("../../Plantillas/footer.php"); ?>