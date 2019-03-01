<?php
  session_name("loginUsuario");
  session_start();
  if ($_POST["crear"]==true) {
    $_SESSION["crearC"]="SI";
    $_SESSION["nombre"]=$_POST["nombre"];
    $_SESSION["grado"]=$_POST["grado"];
    $_SESSION["director"]=$_POST["director"];
  }elseif ($_POST["eliminar"]==true) {
    $_SESSION["eliminarC"]="SI";
    $_SESSION["nombre"]=$_POST["nombre"];
    $_SESSION["grado"]=$_POST["grado"];
    $_SESSION["director"]=$_POST["director"];
  }
  header("Location:RectorCrearCurso.php");
?>
