<?php 
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: /MedicInven/login.php");
exit();

//$sentenciaUpdateMedicamento && $sentenciaUpdateMedicamento->execute()

// function obtenerRolUsuario($conexion)
// {

//   $idPersona = $_SESSION['idPersona'];
//   $sentencia = $conexion->prepare("SELECT ROL_idRol FROM persona WHERE idPersona = :idPersona");
//   $sentencia->bindParam(":idPersona", $idPersona);
//   $sentencia->execute();
//   $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

//   return isset($resultado['ROL_idRol']) ? $resultado['ROL_idRol'] : 'Administrador';
// }

// $_SESSION['idPersona'] = obtenerRolUsuario($conexion);
// var_dump($_SESSION['idPersona']);


// echo isset($Tipo_pedido);
// echo isset($fechaPedido);
// echo isset($costoPedido);
// echo isset($nombreProductoSeleccionado);
// echo isset($cantidadP);
// echo isset($Fecha_entrega);
// echo isset($Fecha_envio);
// echo isset($estadoPedidoSeleccionado);
// echo isset($idPedidoEditar);
// echo isset($SUCURSALIPS_idSUCURSALIPS);
// echo isset($DISTRIBUIDOR_idDISTRIBUIDOR);
// echo isset($PAGO_idPAGO);
// echo isset($MEDICAMENTO_idMEDICAMENTO);
// echo isset($MEDICAMENTO_Persona_idPersona);
// echo isset($MEDICAMENTO_PERSONA_ROL_idRol);
// echo isset($MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA);
// echo isset($MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA);
// echo isset($FORMULAMEDICA_idFORMULA);


 
    // // Lógica para actualizar la cantidad de unidades en la tabla 'medicamento' según el tipo de pedido
    // if ($Tipo_pedido === "Entrada") {
    //     $diferenciaCantidad = $cantidadP - $cantidadPedidoOriginal;
  
    //     // Lógica para una entrada de medicamento
    //     $sentenciaUpdateMedicamento = $conexion->prepare("UPDATE medicamento SET cantidadUnidades = cantidadUnidades + :diferenciaCantidad WHERE idMEDICAMENTO = :medicamentoID");
  
    //   } elseif ($Tipo_pedido === "Salida") {
    //     $diferenciaCantidad = $cantidadPedidoOriginal - $cantidadP;
  
    //     // Lógica para una salida de medicamento
    //     $sentenciaUpdateMedicamento = $conexion->prepare("UPDATE medicamento SET cantidadUnidades = cantidadUnidades - :diferenciaCantidad WHERE idMEDICAMENTO = :medicamentoID");
  
    //   }
  
    //   if (isset($sentenciaUpdateMedicamento)) {
    //     // Redireccionar a la página principal después de editar el pedido
    //     $sentenciaUpdateMedicamento->bindParam(":diferenciaCantidad", $diferenciaCantidad);
    //     $sentenciaUpdateMedicamento->bindParam(":medicamentoID", $MEDICAMENTO_idMEDICAMENTO);
    //     if ($sentenciaUpdateMedicamento->execute()) {
    //       header("Location: index.php");
    //       exit();
    //     } else {
    //       // Mensaje de error al actualizar la cantidad de unidades
    //       echo "Error al actualizar la cantidad de unidades del medicamento.";
    //       print_r($sentenciaUpdateMedicamento->errorInfo());
    //     }
    //   } else {
    //     echo "Error: La sentencia para actualizar el medicamento no está definida.";
    //   }
?>
