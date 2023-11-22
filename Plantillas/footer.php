<!DOCTYPE html>
<html>
<head>
    <title>Tu página</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        footer {
            margin-top: auto;
            /* Puedes ajustar estos estilos según tu diseño */
            background-color: #f8f9fa; /* Color de fondo del footer */
            padding: 20px;
        }
    </style>
</head>
<body>
    <main>
        <!-- Tu contenido -->
        <!-- Inicio del Footer -->
        <footer class="mi-seccion text-center text-lg-start bg-light text-muted">
            <!-- Contenido del footer -->
            <!-- Section: Social media -->
            <section class="mi-seccion d-flex justify-content-center justify-content-lg-between p-1 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Contacta con nosotros:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <!-- Agrega tus otras redes sociales aquí -->
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>MedicInventory
                            </h6>
                            <p>
                                Sistema de inventario para llevar el control adecuado de medicamentos.
                            </p>
                        </div>
                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">Desarrollado por:</h6>
                            <div>
                                Nicolas Riaño <br>
                                Ronaldo Barragan <br>
                                Sergio Gomez<br>
                                Felipe Forero <br>
                                Javier Escobar<br>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">Contactanos:</h6>
                            <p>medicinventory@gmail.com</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
<script>
$(document).ready(function(){
    $("#tabla_id").DataTable({
        "pageLength": 3,
        "lengthMenu": [
            [3, 10, 25, 50],
            [3, 10, 25, 50]
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
    });
});
</script>


<!-- Alertas de borrado custom -->
<script>
        function borrar(id){
            
            Swal.fire({
            title: "Desea eliminar el registro?",
  
            showCancelButton: true,
            confirmButtonText: "Si, Borrar"
  
            }).then((result) => {
    
            if (result.isConfirmed) {
             window.location="index.php?txtID="+id;

                } 
            });
            //index.php?txtID=
        }

    </script>
</html>
