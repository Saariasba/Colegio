<?php
  session_name("loginUsuario");
  session_start();
    $_SESSION["consultarMA"]="SI";
    $_SESSION["anio"]=$_POST['anio'];
    $_SESSION["periodo"]=$_POST['periodo'];
  header("Location:RectorInsertarMateria.php");
?>
