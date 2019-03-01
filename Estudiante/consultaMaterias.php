<?php
session_name("loginUsuario");
session_start();
$_SESSION["consultaMaterias"]="SI";
$_SESSION["año"]=$_POST['option'];
$_SESSION["periodo"]=$_POST['option2'];
header("Location:EstudianteCalificaciones.php");
 ?>
