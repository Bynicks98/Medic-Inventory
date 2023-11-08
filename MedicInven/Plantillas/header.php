<?php
$url_base = '/MedicInven';
?>
<!--la urlbase es para que al momento de volver a linkearse el mismo "Medicamentos no de error"-->


<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="/MedicInven" aria-current="page">Medic-Inventory<span class="visually-hidden">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url_base; ?>/Secciones/Medicamentos/">Medicamentos</a>
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
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categorias</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $url_base; ?>/Secciones/Categorias/">Categoria</a></li>
            <li><a class="dropdown-item" href="<?php echo $url_base; ?>/Secciones/Subcategorias/">SubCategoria</a></li>
        </ul>
        
      </li>
    </ul>
    </div>
    <div class="d-flex align-items-center ">
    <ul class="nav navbar-nav" >
    <li ><form class="d-flex ">
        <input class="form-control me-2;" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form></li>
      </ul>
      </div>
    <div>&nbsp;&nbsp;&nbsp;</div>

      <div class="align-items-center d-grid gap-2 d-md-flex justify-content-md-end">
        <ul class="nav navbar-nav" >
            <li class="nav-item" ><button class="nav-link p-1 btn btn-primary " href="#" style="color: white;margin-right: 5px;">Iniciar Sesión</button></li>
        </ul>
      </div>
    
  </nav>
  
  

  <main class="container">
  </main>

  <!-- Bootstrap JS v5.2.1 (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-cSHfF1hGYyzxcWpSS5n5n5OApmf3p4pD9b2F8f5xJlVbVHYotMWa4HjgStC2vO5e" crossorigin="anonymous"></script>
</body>

</html>