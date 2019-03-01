<?php
    if ($_POST["cerrar"]) {
      header("Location:http://localhost/colegio/login.php");
    }elseif ($_POST["inicio"]) {
      header("Location:Rector.php");
    }elseif ($_POST["informacion"]) {
      header("Location:RectorInformacion.php");
    }elseif ($_POST["crear"]) {
      header("Location:RectorCrearPersona.php");
    }elseif ($_POST["crearG"]) {
      header("Location:RectorCrearGrado.php");
    }elseif ($_POST["crearC"]) {
      header("Location:RectorCrearCurso.php");
    }elseif ($_POST["crearP"]) {
      header("Location:RectorCrearPeriodo.php");
    }elseif ($_POST["crearM"]) {
      header("Location:RectorCrearMes.php");
    }elseif ($_POST["crearA"]) {
      header("Location:RectorCrearAnio.php");
    }elseif ($_POST["informacionT"]) {
      header("Location:RectorInformacionTotal.php");
    }elseif ($_POST["insertarE"]) {
      header("Location:RectorInsertarEstudiantes.php");
    }elseif ($_POST["crearMA"]) {
      header("Location:RectorInsertarMateria.php");
    }
 ?>
