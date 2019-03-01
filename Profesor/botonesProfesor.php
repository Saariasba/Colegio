<?php
    if ($_POST["cerrar"]) {
      header("Location:http://localhost/colegio/login.php");
    }elseif ($_POST["inicio"]) {
      header("Location:Profesor.php");
    }elseif ($_POST["informacion"]) {
      header("Location:ProfesorInformacion.php");
    }elseif ($_POST["director"]) {
      header("Location:ProfesorDirector.php");
    }
 ?>
