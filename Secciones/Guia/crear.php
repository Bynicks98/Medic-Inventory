<?php include("../../Plantillas/header.php"); ?>

crear X
<div class="card">
    <div class="card-header">
        Guia a asignar
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"><!--el enctype permite adjuntar archivos como fotos o pdfs de momento no-->
        <div class="mb-3">
          <label for="" class="form-label">Name</label>
          <input type="text"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Name</label>
          <input type="text"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">

        </div>
        <!-- ejemplo del enctype abajo (Foto) se sigue usando el bs5forminput -->
        <div class="mb-3">
          <label for="" class="form-label">Foto</label>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">

        </div>
         <div class="mb-3"> <!--bs5formfile (PDF) ejemplo -->
          <label for="cv" class="form-label">CV(PDF)</label>
          <input type="file" class="form-control" name="cv" id="cv" placeholder="curriculum-vitae" aria-describedby="fileHelpId">

        </div>
        
    </form>
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>