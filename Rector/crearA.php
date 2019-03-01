<?php
  session_name("loginUsuario");
  session_start();
  $eliminar=$_POST['eliminar'];
  if ($eliminar==true) {
    $_SESSION["eliminarA"]="SI";
  }else{
    $_SESSION["crearA"]="SI";
  }
  $_SESSION["anio"]=$_POST['anio'];
  header("Location:RectorCrearAnio.php");
?>
