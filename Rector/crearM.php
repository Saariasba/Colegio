<?php
  session_name("loginUsuario");
  session_start();
  $consultar=$_POST['consultar'];
  $crear=$_POST['enviar'];
  $eliminar=$_POST['eliminar'];
  if ($consultar==true ) {
    $_SESSION["mostrarM"]="SI";
    $_SESSION["anio"]=$_POST['anio'];
  }elseif ($crear==true) {
    $_SESSION["crearM"]="SI";
    $_SESSION["mes"]=$_POST['mes'];
  }elseif ($eliminar=true) {
    $_SESSION["eliminarM"]="SI";
    $_SESSION["mes"]=$_POST['mes'];
  }
  header("Location:RectorCrearMes.php");
?>
