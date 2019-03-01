<?php
  session_name("loginUsuario");
  session_start();
  $consultar=$_POST['consultar'];
  $crear=$_POST['enviar'];
  $eliminar=$_POST['eliminar'];
  if ($consultar==true ) {
    $_SESSION["mostrarP"]="SI";
    $_SESSION["anio"]=$_POST['anio'];
  }elseif ($crear==true) {
    $_SESSION["crearP"]="SI";
    $_SESSION["periodo"]=$_POST['periodo'];
  }elseif ($eliminar=true) {
    $_SESSION["eliminarP"]="SI";
    $_SESSION["periodo"]=$_POST['periodo'];
  }
  header("Location:RectorCrearPeriodo.php");
?>
