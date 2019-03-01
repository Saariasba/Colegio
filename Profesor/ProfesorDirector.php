<?php
session_name("loginUsuario");
session_start();
$conexion=mysqli_connect("localhost","root","","mydb");//BASE DE DATOS
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
        <div class="enfoque2 col-xs-12 col-sm-12 col-md-12">
          <div class="enfoque col-xs-12 col-sm-12 col-md-12">
        <h2>Notas del curso</h2><br>
        <form class="" action="consultaNotas.php" method="post">
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
           <br>
           <label for="option2">Escoge el Periodo que deseas consultar:</label>
             <select class="form-control" name="option2" id="option2">
           <?php
           $a=date("Y");
           $consulta="select id_periodo from periodo where '$a' = anio_id_anio";//BASE DE DATOS
           $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
           $result=mysqli_fetch_all($resultado);//BASE DE DATOS
           $tam=sizeof($result);
           for ($i=0; $i < $tam; $i++) {
             $dato2=$result[$i];
             echo "<option>$dato2[0]</option>";
           }
           ?>
         </select><br>
         <label for="option3">Escoge la Materia que deseas consultar:</label>
           <select class="form-control" name="option3" id="option3">
         <?php
         $a=date("Y");
         $consulta="select id_materia from materia";//BASE DE DATOS
         $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
         $result=mysqli_fetch_all($resultado);//BASE DE DATOS
         $tam=sizeof($result);
         for ($i=0; $i < $tam; $i++) {
           $dato2=$result[$i];
           echo "<option>$dato2[0]</option>";
         }
         ?>
       </select><br>
         <input type="submit" class="btn btn-success" value="Consultar">
       </form><br>
       <div class="table-responsive">
         <table class="table table-bordered table-hover table-condensed"><table-striped>
       <?php
       if ($_SESSION["consultaNotas"]=="SI") {
         $anioC = $_SESSION["año"];
         $periodoC = $_SESSION["periodo"];
         $materiaC = $_SESSION["materia"];
         $consulta="select id_cursoprimaria from cursoprimaria where '$periodoC'= periodo_id_periodo and '$anioC'= periodo_anio_id_anio and '$usuario'= profesor_persona_identificacion";//BASE DE DATOS
         $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
         $result=mysqli_fetch_row($resultado);//BASE DE DATOS
           if ($result>0) {
             $curso=$result[0];
             echo "<h2>Notas del curso $result[0] en la materia de $materiaC</h2>";
             $consulta="select codigo from codigoprimaria where '$periodoC'= cursoprimaria_periodo_id_periodo and '$anioC'= cursoprimaria_periodo_anio_id_anio and '$result[0]'= cursoprimaria_id_cursoprimaria";//BASE DE DATOS
             $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
             $result=mysqli_fetch_all($resultado);//BASE DE DATOS
             $tam=sizeof($result);
             echo"<tr>
               <th class='success'>Codigo</th>
               <th class='success'>Nota</th>
               <th class='success'>Porcentaje</th>
             </tr>";
             for ($i=0; $i < $tam; $i++) {
               $dato2=$result[$i];
               $consulta3="select nota,porcentaje from notaprimaria where '$periodoC'= codigoprimaria_cursoprimaria_periodo_id_periodo and '$anioC'= codigoprimaria_cursoprimaria_periodo_anio_id_anio and '$curso'= codigoprimaria_cursoprimaria_id_cursoprimaria and '$dato2[0]'= codigoprimaria_codigo";//BASE DE DATOS
               $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
               $result3=mysqli_fetch_row($resultado3);//BASE DE DATOS
               $uno=$result3[0];
               $dos=$result3[1];
               echo"<tr>
                 <th class='warning'>$dato2[0]</th>
                 <th class='warning'>$uno</th>
                 <th class='warning'>$dos</th>
               </tr>";
             }
           }else{
             echo "<h2>$result[0]</h2>";
           }
       }
        ?>
      </table>
      </div></div>
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
