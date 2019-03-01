<?php
  session_name("loginUsuario");
  session_start();
  $crear=$_POST['crear'];
  if ($crear==true) {
    $_SESSION["crearM"]="SI";
    $_SESSION["mes"]=$_POST['mes'];
  }else{
    $_SESSION["eliminarM"]="SI";
    $_SESSION["mes"]=$_POST['mes'];
  }
  header("Location:RectorCrearMes.php");
?>
