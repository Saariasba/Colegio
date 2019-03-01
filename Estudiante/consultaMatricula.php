<?php
  session_name("loginUsuario");
  session_start();
  $_SESSION["consultaM"]="SI";
  $_SESSION["matricula"]=$_POST['option'];
  $_SESSION["pension"]=$_POST['option2'];
  header("Location:EstudianteMatricula.php");
?>
