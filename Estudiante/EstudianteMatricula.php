<?php
session_name("loginUsuario");
session_start();
$conexion=mysqli_connect("localhost","root","","mydb");//BASE DE DATOS
$_SESSION["consultaMaterias"]="NO";
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
  <title>Estudiante</title>
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
          echo "<h2>Estudiante</h2>";
           ?>
        </div>
        <div class="col-sm-3 col-md-3">
          <br><br><br><br><br><br><br><br>
          <form class="" action="botonesEstudiante.php" method="post">
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
          <form class="" action="botonesEstudiante.php" method="post">
            <input type="submit" class="botones btn btn-primary" name="inicio" value="Inicio">
            <input type="submit" class="botones btn btn-primary" name="informacion" value="Información Personal">
            <input type="submit" class="botones btn btn-primary" name="calificaciones" value="Calificaciones">
            <input type="submit" class="botones btn btn-primary" name="matricula" value="Matricula y Pensión">
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
        <div class="enfoque2 col-xs-12 col-sm-12 col-md-12">
          <div class="enfoque col-xs-12 col-sm-12 col-md-12">
        <h2>Certifica tus pagos con la institución</h2><br>
        <form class="" action="consultaMatricula.php" method="post">
          <label for="option">Escoge el Año que deseas consultar:</label>
            <select class="form-control" name="option" id="option">
          <?php
          $consulta="select * from anio";//BASE DE DATOS
          $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
          $result=mysqli_fetch_all($resultado);//BASE DE DATOS
          $tam=sizeof($result);
          for ($i=0; $i < $tam; $i++) {
            $dato=$result[$i];
            echo "<option>$dato[0]</option>";
          }
          ?>
           </select>
           <label for="option2">Escoge el Mes que deseas consultar:</label>
             <select class="form-control" name="option2" id="option2">
           <?php
           $consulta="select * from mes";//BASE DE DATOS
           $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
           $result=mysqli_fetch_all($resultado);//BASE DE DATOS
           $tam=sizeof($result);
           for ($i=0; $i < $tam; $i++) {
             $dato2=$result[$i];
             echo "<option>$dato2[0]</option>";
           }
           ?>
         </select><br>
         <input type="submit" class="btn btn-success" value="Consultar"><br><br>
        </form>
      </div></div>
            <?php
            if($_SESSION["consultaM"]=="SI"){
              echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
                <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
                  <table class='table table-bordered table-hover table-condensed'><table-striped>
              <h2>Matricula:</h2><br>";
              $anioC = $_SESSION["matricula"];
              $consulta="select pagado from matricula where estudiante_persona_identificacion='$usuario' and anio_id_anio='$anioC'";//BASE DE DATOS
              $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
              $result=mysqli_fetch_row($resultado);//BASE DE DATOS
              $tam=sizeof($result);
              if($tam==0){
                echo"<tr>
                  <th class='success'>El estado de la Matricula en el año $anioC:</th>
                  <th class='warning'>No esta Registrado</th>
                </tr>";
              }else{
                echo "<tr>
                  <th class='success'>El estado de la Matricula en el año $anioC:</th>
                  <th class='warning'>$result[0]</th>
                </tr>";
              }
            }
             ?>
          </table>
          <table class="table table-bordered table-hover table-condensed"><table-striped>
            <?php
            if ($_SESSION["consultaM"]=="SI") {
              echo "<h2>Pension:</h2><br>";
              $mesC = $_SESSION["pension"];
              $consulta="select pagado from pension where estudiante_persona_identificacion='$usuario' and mes_anio_id_anio='$anioC' and mes_id_mes='$mesC'";//BASE DE DATOS
              $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
              $result=mysqli_fetch_row($resultado);//BASE DE DATOS
              $tam=sizeof($result);
              if($tam==0){
                echo"<tr>
                  <th class='success'>El estado de la Pension en el mes $mesC del año $anioC:</th>
                  <th class='warning'>No esta Registrado</th>
                </tr>";
              }else{
                echo "<tr>
                  <th class='success'>El estado de la Pension en el mes $mesC del año $anioC:</th>
                  <th class='warning'>$result[0]</th>
                </tr>";
              }
            }
             ?>
          </table>
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
