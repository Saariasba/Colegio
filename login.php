<?php
session_name("loginUsuario");
session_start();
$_SESSION["autentificado"]= "NO";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Liceo BlackBoard</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="estilos.css">
</head>
  <body>
    <form class="col-xs-8" action="validar.php" method="post">
      <div class="row">
        <center>
          <div class="col-md-4">
            <img src="http://www.lipesauces.edu.co/images/joomlaplates/lipesauces.png" class="img-responsive">
          </div>
          <br>
          <br>
          <div class="col-md-8">
            <h1 class="text-success"><font color="black" face="Comic Sans MS,arial,verdana" >BlackBoard</font></h1>
          </div>
        </center>
      </div>
      <input type="text" placeholder="&#128272; Usuario" name="usuario" >
      <input type="password" placeholder="&#128272; Contraseña" name="clave" >
      <input type="submit" class="btn btn-primary" value="Ingresar">
    </form>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
