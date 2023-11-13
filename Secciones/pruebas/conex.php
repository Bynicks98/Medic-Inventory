<?php
 $conex= mysqli_connect("localhost","root","","medicinventory");
 
?>

// funcion para indicar la alerta de los Medicamentos
<script>
    document.addEventListener("DOMContentLoaded", function () {
      const alertaContainer = document.querySelector('.alerta-container');

      // Función para manejar el clic en el ícono de alerta
      function mostrarInformacionMedicamento(nombre, lote) {
        alert(`Este medicamento (${nombre}) con lote ${lote} está cerca de su fecha de vencimiento.`);
      }

      // Obtén todos los elementos con la clase "alerta-icono"
      const alertaIconos = document.querySelectorAll('.alerta-icono');

      // Agrega un evento de clic a cada elemento
      alertaIconos.forEach((icono) => {
        icono.addEventListener('click', function () {
          // Obtiene el nombre y el lote del medicamento desde los atributos de datos
          const nombreMedicamento = this.getAttribute('data-nombre');
          const loteMedicamento = this.getAttribute('data-lote');

          // Llama a la función para mostrar la información del medicamento
          mostrarInformacionMedicamento(nombreMedicamento, loteMedicamento);
        });
      });
    });
  </script>