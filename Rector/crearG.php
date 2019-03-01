<?php
  session_name("loginUsuario");
  session_start();
  $eliminar=$_POST['eliminar'];
  if ($eliminar==true) {
    $_SESSION["eliminarG"]="SI";
  }else{
    $_SESSION["crearG"]="SI";
  }
  $_SESSION["grado"]=$_POST['grado'];
  $_SESSION["tipoG"]=$_POST['tipoG'];
  header("Location:RectorCrearGrado.php");
?>
