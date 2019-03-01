<?php
    if ($_POST["cerrar"]) {
      header("Location:http://localhost/colegio/login.php");
    }elseif ($_POST["inicio"]) {
      header("Location:Administrativo.php");
    }elseif ($_POST["informacion"]) {
      header("Location:AdministrativoInformacion.php");
    }elseif ($_POST["crear"]) {
      header("Location:AdministrativoCrearPersona.php");
    }
 ?>
