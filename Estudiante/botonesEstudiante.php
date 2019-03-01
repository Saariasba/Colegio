<?php
    if ($_POST["cerrar"]) {
      header("Location:http://localhost/colegio/login.php");
    }elseif ($_POST["inicio"]) {
      header("Location:Estudiante.php");
    }elseif ($_POST["informacion"]) {
      header("Location:EstudianteInformacion.php");
    }elseif ($_POST["matricula"]) {
      header("Location:EstudianteMatricula.php");
    }elseif ($_POST["calificaciones"]) {
      header("Location:EstudianteCalificaciones.php");
    }
 ?>
