<?php
session_name("loginUsuario");
session_start();
$conexion=mysqli_connect("localhost","root","","mydb");//BASE DE DATOS
$_SESSION["consultaNotas"]="NO";
if ($_SESSION["autentificado"] != "SI") {
    header("Location:http://localhost/colegio/login.php");
} else {
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

     if($tiempo_transcurrido >= 600) {
      header("Location:http://localhost/colegio/login.php");
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Profesor</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="estile.css">
</head>

<body>
  <header>
    <div class="container">
      <section class="row">
        <div class="col-xs-6 col-sm-2 col-md-2">
          <img src="http://www.lipesauces.edu.co/images/joomlaplates/lipesauces.png" class="img-responsive">
        </div>
        <div class="col-xs-6 col-sm-7 col-md-7">
          <?php
          $usuario=$_SESSION["usuario"];
          $consulta="select nombres from persona where identificacion='$usuario'";//BASE DE DATOS
          $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
          $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
          $tamaño = sizeof($fila);
          if($tamaño==1){
            $nombres=$fila[0];
          }else{
            $nombres="No tiene nombre registrado";
          }
          $consulta="select apellidos from persona where identificacion='$usuario'";//BASE DE DATOS
          $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
          $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
          $tamaño = sizeof($fila);
          if($tamaño==1){
            $apellidos=$fila[0];
          }else{
            $nombres="No tiene apellidos registrado";
          }
          echo "<h2>Liceo Pedagogico Los Sauces</h2>";
          echo "<h2>$nombres $apellidos</h2>";
          echo "<h2>Profesor</h2>";
           ?>
        </div>
        <div class="col-sm-3 col-md-3">
          <br><br><br><br><br><br><br><br>
          <form class="" action="botonesProfesor.php" method="post">
            <input type="submit" class="trans btn btn-danger" name="cerrar" value="Cerrar Sesion">
          </form>
        </div>
      </section>
    </div>
  </header>
  <div class="container">
    <section class="color1 row">
      <div class="col-xs-9 col-sm-5 col-md-4">
        <div class="botonesA col-md-11">
          <br>
          <center>
            <form class="" action="botonesProfesor.php" method="post">
              <input type="submit" class="botones btn btn-primary" name="inicio" value="Inicio">
              <input type="submit" class="botones btn btn-primary" name="informacion" value="Información Personal">
              <input type="submit" class="botones btn btn-primary" name="ingresarnotas" value="Ingresar Notas">
              <input type="submit" class="botones btn btn-primary" name="director" value="Director De Curso">
            </form>
          </center>
          <br>
            <img src="cap.png" class="img-responsive">
            <br>
              <img src="ab.png" class="img-responsive">
            <br>
        </div>
      </div>
      <div class="atras col-xs-12 col-sm-7 col-md-8">
        <br>  <div class="col-md-3"></div>
              <div class="col-md-5">
                  <h2>Bienvenido Estudiante</h2>
                  <br>
                  <img src="pie.png" class="img-responsive">
              </div>
              <div class="col-md-4"></div>
          </div>
    </section>
  </div>


  <footer>
    <div class="container">
      <h6>Copyright © 2017 / Diseño y Web Santiago Arias</h6><h6>santiagoarias9803@gmail.com</h6>
    </div>
  </footer>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
