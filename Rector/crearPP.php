<?php
  session_name("loginUsuario");
  session_start();
  $crear=$_POST['crear'];
  if ($crear==true) {
    $_SESSION["crearP"]="SI";
    $_SESSION["periodo"]=$_POST['periodo'];
  }else{
    $_SESSION["eliminarP"]="SI";
    $_SESSION["periodo"]=$_POST['periodo'];
  }
  header("Location:RectorCrearPeriodo.php");
?>
