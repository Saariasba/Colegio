<?php
  session_name("loginUsuario");
  session_start();
  $_SESSION["asignarC"]="SI";
  $_SESSION["anio"]=$_POST["anio"];
  $_SESSION["periodo"]=$_POST["periodo"];
  $_SESSION["grado"]=$_POST["grado"];
  header("Location:RectorInsertarEstudiantes.php");
?>