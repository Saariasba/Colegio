<?php
session_name("loginUsuario");
session_start();
$conexion=mysqli_connect("localhost","root","","mydb");//BASE DE DATOS
$_SESSION["consultaM"]="NO";
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
<html lang="es">

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
        <h2>Verifica tus notas en cada asignatura</h2><br>
        <form class="" action="consultaMaterias.php" method="post">
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
         <input type="submit" class="btn btn-success" value="Consultar"><br><br>
       </form>
       </div></div>
        <?php
        if ($_SESSION["consultaMaterias"]=="SI") {
          echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
            <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
           <div class='table-responsive'>
             <table class='table table-bordered table-hover table-condensed'><table-striped>
          <h2>Asignaturas</h2><br>";
          $anio=$_SESSION["año"];
          $periodo=$_SESSION["periodo"];
          $consulta="SELECT codigo,cursoprimaria_id_cursoprimaria FROM codigoprimaria where estudiante_persona_identificacion='$usuario' AND cursoprimaria_periodo_anio_id_anio=$anio and cursoprimaria_periodo_id_periodo='$periodo'";//BASE DE DATOS
          $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
          $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
          $tamaño = sizeof($fila);
          if ($tamaño>0) {
            $consulta="SELECT materia_id_materia,porcentaje,nota FROM notaprimaria where codigoprimaria_codigo='$fila[0]' AND codigoprimaria_cursoprimaria_periodo_anio_id_anio=$anio and codigoprimaria_cursoprimaria_periodo_id_periodo='$periodo' and codigoprimaria_cursoprimaria_id_cursoprimaria='$fila[1]'";
            $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            $tamaño = sizeof($fila);
            if ($tamaño>0) {
              echo"<tr>
                <th class='success'>Materia</th>
                <th class='success'>Porcentaje</th>
                <th class='success'>Nota</th>
              </tr>";
              for ($i=0; $i < $tamaño; $i++) {
                $dato=$fila[$i];
                echo"<tr>
                  <th class='warning'>$dato[0]</th>
                  <th class='warning'>$dato[1]</th>
                  <th class='warning'>$dato[2]</th>
                </tr>";
              }

            }else{
              echo"<tr>
                <th class='success'>El estado de las Materias en el año $anio:</th>
                <th class='warning'>No se encuentran registradas asignaturas</th>
              </tr>";
            }
          }else{//COMPONENTES-----------------------------------------------------------------------------
            //$consulta="SELECT codigo,cursootros_id_cursootros FROM codigootros where estudiante_persona_identificacion='$usuario' AND cursootros_periodo_anio_id_anio=$anio and cursootros_periodo_id_periodo='$periodo'";//BASE DE DATOS
            //$resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            //$fila=mysqli_fetch_row($resultado);//BASE DE DATOS
            //$tamaño = sizeof($fila);
            //if ($tamaño>0) {
            //  $consulta="SELECT materia_id_materia/*LOS COMPONENTES*/FROM notaotros where codigootros_codigo=$fila[0] AND codigootros_cursootros_periodo_anio_id_anio=$anio and codigootros_cursootros_periodo_id_periodo='$periodo' and codigootros_cursootros_id_curso_otros='$fila[1]'";
            //  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            //  $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            //  $tamaño = sizeof($fila);
            //  if ($tamaño>0) {
            //    echo"<tr>
            //      <th class='success'>Materia</th>
            //      <th class='success'>Primer Componente</th>
            //      <th class='success'>Segundo Componente</th>
            //    </tr>";
            //    for ($i=0; $i < $tamaño; $i++) {
            //      $dato=$fila[$i];
            //      echo"<tr>
            //        <th class='warning'>$dato[0]</th>
            //      </tr>";
            //    }
//
            //  }else{
                echo"<tr>
                  <th class='success'>El estado de las Materias en el año $anio:</th>
                  <th class='warning'>No se encuentran registradas asignaturas</th>
                </tr>";
          //    }
          //  }else{
          //    echo"<tr>
          //      <th class='success'>El estado de el Salon en el año $anio:</th>
          //      <th class='warning'>No se encuentra registrado en algún salon</th>
          //    </tr>";
          //  }
//
          }
        }
         ?>
       </table>
          </div>
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
