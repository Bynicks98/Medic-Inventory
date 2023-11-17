<?php
$GLOBALS['database_path'] = "/ruta/a/tu/database.php";
$url_base = '/MedicInven';
include_once("funciones.php");


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Verifica si la sesión está establecida y contiene 'idPersona'
if (!isset($_SESSION['idPersona']) || empty($_SESSION['idPersona'])) {
  echo "No tiene autorización";
  header("Location: /MedicInven/login.php");
  die();
} else {
  // Aquí asumo que $conexion está definido y conectado a la base de datos
  $rolUsuario = obtenerRolUsuario($conexion);
    $_SESSION['nombreRol'] = $rolUsuario;
    
  
}

// if (session_status() == PHP_SESSION_NONE) {
//   session_start();
// }

// $varsesion = $_SESSION['idPersona'];

// if ($varsesion == null || $varsesion == '') {
//   echo "no tiene autorizacion";
//   header("Location: /MedicInven/login.php");
//   die();

// } else {
//   function obtenerRolUsuario($conexion)
//   {

//     $idPersona = $_SESSION['idPersona'];
//     $sentencia = $conexion->prepare("SELECT ROL_idRol FROM persona WHERE idPersona = :idPersona");
//     $sentencia->bindParam(":idPersona", $idPersona);
//     $sentencia->execute();
//     $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

//     return isset($resultado['ROL_idRol']) ? $resultado['ROL_idRol'] : 'Administrador';
//   }

//   $_SESSION['idPersona'] = obtenerRolUsuario($conexion);
//   var_dump($_SESSION['idPersona']);
// }


?>

<?php


?>
<!--la urlbase es para que al momento de volver a linkearse el mismo "Medicamentos no de error"-->


<!doctype html>
<html lang="en">

<head>



  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- libreria vanilla datatable abajo -->
  <!-- <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script> -->

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- lib de alertas eliminar sure? abajo  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <Style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      /* Elimina márgenes predeterminados del body */
    }

    main {
      flex: 1;
    }

    .mi-seccion {
      margin-top: 1px;
      /* ajusta este valor según tus necesidades */
    }

    footer {
      position: sticky;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.05);
      width: 100%;
      text-align: center;
      padding-bottom: 5px;
      margin-top: auto;
      /* Asegura que el footer esté pegado al fondo */
    }
  </Style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="/MedicInven" aria-current="page">Medic-Inventory<span
                class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Medicamentos/medicacate.php">Medicamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Roles/">Roles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Usuarios/">Usuarios</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Formula Medica/">Formula Medica</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Distribuidor/">Distribuidor</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Sucursales/">Sucursal</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Pedido/">Pedidos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Pago/">Pagos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Devoluciones/">Devoluciones</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Proveedores/">Proveedores</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categorias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo $url_base; ?>/Secciones/Categorias/">Categoria</a></li>
              <li><a class="dropdown-item" href="<?php echo $url_base; ?>/Secciones/Subcategorias/">SubCategoria</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="d-flex align-items-center alerta-container">
        <ul class="nav navbar-nav">
          <li>
            <a href="vistafrontal.php"><i class="fas fa-exclamation-triangle text-warning alerta-icono"
                data-nombre="'  '" data-lote="'  '"></i></a>
          </li>
        </ul>
      </div>
      <div>&nbsp;&nbsp;&nbsp;</div>
      <div class="d-flex align-items-center ">
        <ul class="nav navbar-nav">
          <li>
            <form class="d-flex ">
              <input class="form-control me-2;" type="text" placeholder="Search">
              <button class="btn btn-primary" type="button">Search</button>
            </form>
          </li>
        </ul>
      </div>
      <div>&nbsp;&nbsp;&nbsp;</div>

      <div class="align-items-center d-grid gap-2 d-md-flex justify-content-md-end">
        <ul class="nav navbar-nav">
          <li class="nav-item"><a class="nav-link p-1 btn btn-danger " href="/Medicinven/cerrar.php"
              style="color: white;margin-right: 5px;">Cerrar Sesión</a></li>
        </ul>
      </div>

    </nav>


    <!-- llamado del mensaje para ejecutar la alerta de la determinada accion -->
    <main class="container">
      <?php if (isset($_GET['mensaje'])) { ?>
        <script>
          Swal.fire({ icon: "success", title: "<?php echo $_GET['mensaje'] ?>" });

        </script>
      <?php } ?>

    </main>


    <!-- Bootstrap JS v5.2.1 (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-cSHfF1hGYyzxcWpSS5n5n5OApmf3p4pD9b2F8f5xJlVbVHYotMWa4HjgStC2vO5e"
      crossorigin="anonymous"></script>
</body>

</html>