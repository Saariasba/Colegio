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
  <title>Rector</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="estile.css">
</head>

<body >
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
          echo "<h2>Rector</h2>";
           ?>
        </div>
        <div class="col-sm-3 col-md-3">
          <br><br><br><br><br><br><br><br>
          <form class="" action="botonesRector.php" method="post">
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
            <form class="" action="botonesRector.php" method="post">
              <input type="submit" class="botones btn btn-primary" name="inicio" value="Inicio">
              <input type="submit" class="botones btn btn-primary" name="informacion" value="Información Personal">
              <input type="submit" class="botones btn btn-primary" name="crear" value="Crear Persona">
              <input type="submit" class="botones btn btn-primary" name="crearG" value="Crear Grado">
              <input type="submit" class="botones btn btn-primary" name="crearC" value="Crear Curso">
              <input type="submit" class="botones btn btn-primary" name="crearP" value="Crear Periodo">
              <input type="submit" class="botones btn btn-primary" name="crearM" value="Crear Mes">
              <input type="submit" class="botones btn btn-primary" name="crearA" value="Crear Año">
              <input type="submit" class="botones btn btn-primary" name="crearMA" value="Crear Materia">
              <input type="submit" class="botones btn btn-primary" name="informacionT" value="Información por persona">
              <input type="submit" class="botones btn btn-primary" name="insertarE" value="Insertar Estudiante">
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
            <h2>Ingresar Estudiantes</h2>
            <br>
            <form class="" action="asignarC.php" method="post">
              <h4>Año: </h4><select class="form-control" name="anio">
                <?php
                $consulta="select id_anio from anio";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño>0) {
                  for ($i=0; $i < $tamaño; $i++) {
                    $dato=$fila[$i];
                    echo "<option>$dato[0]</option>";
                  }
                }else{
                  echo "<option>No se han encontrado Años registrados</option>";
                }
                 ?>
                </select><br>
              <h4>Periodo: </h4><select class="form-control" name="periodo">
                <option>Primero</option>
                <option>Segundo</option>
                <option>Tercero</option>
                <option>Cuarto</option>
              </select><br>
              <h4>Grado: </h4><select class="form-control" name="grado">
                <?php
                $consulta="select nombre from grado";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño>0) {
                  for ($i=0; $i < $tamaño; $i++) {
                    $dato=$fila[$i];
                    echo "<option>$dato[0]</option>";
                  }
                }else{
                  echo "<option>No se han encontrado Años registrados</option>";
                }
                 ?>
              </select><br>
              <input type="submit" class="trans btn btn-primary" name="consultar" value="Consultar"><br><br>
             </form>
           </div>
        </div>
        <?php
              if ($_SESSION["asignarC"]=="SI") {
                $_SESSION["asignarC"]="NO";
                echo "
                <div class='enfoque4 col-xs-12 col-sm-12 col-md-12'>
                  <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
                    <br>";
                $periodo = $_SESSION["periodo"];
                $grado = $_SESSION["grado"];
                $anio = $_SESSION["anio"];
                $consulta="select * from primaria where grado_nombre ='$grado'";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño>0) {
                  $tipo="Primaria";
                }else{
                  $tipo="Otros";
                }
                if ($tipo=="Primaria") {
                  $consulta="select grado_nombre from primaria where grado_nombre='$grado'";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                  $tamaño = sizeof($fila);
                  if ($tamaño>0) {
                    for ($i=0; $i < $tamaño; $i++) {
                      $dato=$fila[$i];
                      $array[$i]=$dato[0];
                      $consulta="select id_cursoprimaria,profesor_persona_identificacion from cursoprimaria where periodo_id_periodo='$periodo' and periodo_anio_id_anio='$anio' and primaria_grado_nombre='$dato[0]';";//BASE DE DATOS
                      $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                      $fila2=mysqli_fetch_all($resultado);//BASE DE DATOS
                      $tamaño2 = sizeof($fila2);
                      echo "<div class='col-xs-12 col-sm-12 col-md-12'>
                      <h3><font color=#000000><b>En $anio en el periodo $periodo los Cursos de $dato[0] son:</b></font></h3><br>
                      </div>";
                      echo "<div class='atras2 col-xs-12 col-sm-12 col-md-12'><br>";
                      if ($tamaño2>0) {
                          for ($j=0; $j <$tamaño2 ; $j++) {
                            $dato2=$fila2[$j];
                            $listadecursos[$j]=$dato2[0];
                            $consulta3="select nombres,apellidos from persona where identificacion='$dato2[1]';";//BASE DE DATOS
                            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                            $fila3=mysqli_fetch_row($resultado3);//BASE DE DATOS
                            echo "<center><h4><b>$dato2[0]</b></h4><h4><b>$fila3[0] $fila3[1]</b></h4></center><br>";
                            $consulta3="select codigo,estudiante_persona_identificacion from codigoprimaria where cursoprimaria_id_cursoprimaria='$dato2[0]' and cursoprimaria_periodo_id_periodo='$periodo' and cursoprimaria_periodo_anio_id_anio='$anio';";//BASE DE DATOS
                            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                            $fila3=mysqli_fetch_all($resultado3);//BASE DE DATOS
                            $tamaño3 = sizeof($fila3);
                            echo "<table class='table table-bordered table-hover table-condensed'><table-striped>";
                            if ($tamaño3>0) {
                              echo"<tr>
                                <th class='success'>Codigo</th>
                                <th class='success'>identificación</th>
                                <th class='success'>Nombre completo</th>
                              </tr>";
                              for ($k=0; $k < $tamaño3 ; $k++) {
                                $dato3=$fila3[$k];
                                $consulta4="select nombres,apellidos from persona where identificacion='$dato3[1]';";//BASE DE DATOS
                                $resultado4= mysqli_query($conexion,$consulta4);//BASE DE DATOS
                                $fila4=mysqli_fetch_row($resultado4);//BASE DE DATOS
                                echo"<tr>
                                  <th class='success'>$dato3[0]</th>
                                  <th class='success'>$dato3[1]</th>
                                  <th class='success'>$fila4[0] $fila4[1]</th>
                                </tr>";
                              }
                            }else {
                                echo"<tr>
                                  <th class='success'>No se encuentra registrado ningún Estudiante</th>
                                </tr>";
                            }
                            echo "</table>";
                          }
                      }else {
                        echo "<center><h4><b>No se encuentran Cursos Registrados</b></h4></center><br>";
                      }
                      $consulta4="select persona_identificacion from estudiante;";//BASE DE DATOS
                      $resultado4= mysqli_query($conexion,$consulta4);//BASE DE DATOS
                      $fila4=mysqli_fetch_all($resultado4);//BASE DE DATOS
                      $tam = sizeof($fila4);
                      if ($tam>0) {
                        echo "<br><center><h4><b>Estudiantes sin Curso Asignado </b></h4></center><br>";
                        echo "<table class='table table-bordered table-hover table-condensed'><table-striped>";
                        echo"<tr>
                          <th class='success'>identificación</th>
                          <th class='success'>Nombre completo</th>
                        </tr>";
                        for ($i=0; $i < $tam; $i++) {
                          $dato5=$fila4[$i];
                          $consulta5="select codigo from codigoprimaria where cursoprimaria_periodo_id_periodo='$periodo' and cursoprimaria_periodo_anio_id_anio='$anio' and estudiante_persona_identificacion='$dato5[0]';";//BASE DE DATOS
                          $resultado5= mysqli_query($conexion,$consulta5);//BASE DE DATOS
                          $fila5=mysqli_fetch_row($resultado5);//BASE DE DATOS
                          $tam2 = sizeof($fila5);
                          ////////////////////////////////////////////////////////////////////////////////
                          $consulta6="select codigo from codigootros where cursootros_periodo_id_periodo='$periodo' and cursootros_periodo_anio_id_anio='$anio' and estudiante_persona_identificacion='$dato5[0]';";//BASE DE DATOS
                          $resultado6= mysqli_query($conexion,$consulta6);//BASE DE DATOS
                          $fila6=mysqli_fetch_row($resultado6);//BASE DE DATOS
                          $tam3 = sizeof($fila6);
                          if ($tam2>0 || $tam3>0) {
                          }else {
                            $consulta7="select nombres,apellidos from persona where identificacion='$dato5[0]';";//BASE DE DATOS
                            $resultado7= mysqli_query($conexion,$consulta7);//BASE DE DATOS
                            $fila7=mysqli_fetch_row($resultado7);//BASE DE DATOS
                            echo"<tr>
                              <th class='warning'>$dato5[0]</th>
                              <th class='warning'>$fila7[0] $fila7[1]</th>
                            </tr>";
                          }
                        }
                        echo "</table>";
                      }
                      echo "</div>";
                    }
                  }else{
                    echo "<h2>No se han encontrado Grados registrados</h2>";
                  }
                }elseif ($tipo=="Otros") {
                  $consulta="select grado_nombre from otros where grado_nombre='$grado'";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                  $tamaño = sizeof($fila);
                  if ($tamaño>0) {
                    for ($i=0; $i < $tamaño; $i++) {
                      $dato=$fila[$i];
                      $array[$i]=$dato[0];
                      $consulta="select id_cursootros,profesor_persona_identificacion from cursootros where periodo_id_periodo='$periodo' and periodo_anio_id_anio='$anio' and otros_grado_nombre='$dato[0]';";//BASE DE DATOS
                      $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                      $fila2=mysqli_fetch_all($resultado);//BASE DE DATOS
                      $tamaño2 = sizeof($fila2);
                      echo "<div class='col-xs-12 col-sm-12 col-md-12'>
                      <h3><font color=#000000><b>En $anio en el periodo $periodo los Cursos de $dato[0] son:</b></font></h3><br>
                      </div>";
                      echo "<div class='atras2 col-xs-12 col-sm-12 col-md-12'><br>";
                      if ($tamaño2>0) {
                          for ($j=0; $j <$tamaño2 ; $j++) {
                            $dato2=$fila2[$j];
                            $consulta3="select nombres,apellidos from persona where identificacion='$dato2[1]';";//BASE DE DATOS
                            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                            $fila3=mysqli_fetch_row($resultado3);//BASE DE DATOS
                            echo "<center><h4><b>$dato2[0]</b></h4><h4><b>$fila3[0] $fila3[1]</b></h4></center><br>";
                            $consulta3="select codigo,estudiante_persona_identificacion from codigootros where cursootros_id_cursootros='$dato2[0]' and cursootros_periodo_id_periodo='$periodo' and cursootros_periodo_anio_id_anio='$anio';";//BASE DE DATOS
                            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                            $fila3=mysqli_fetch_all($resultado3);//BASE DE DATOS
                            $tamaño3 = sizeof($fila3);
                            echo "<table class='table table-bordered table-hover table-condensed'><table-striped>";
                            if ($tamaño3>0) {
                              echo"<tr>
                                <th class='success'>Codigo</th>
                                <th class='success'>identificación</th>
                                <th class='success'>Nombre completo</th>
                              </tr>";
                              for ($k=0; $k < $tamaño3 ; $k++) {
                                $dato3=$fila3[$k];
                                $consulta4="select nombres,apellidos from persona where identificacion='$dato3[1]';";//BASE DE DATOS
                                $resultado4= mysqli_query($conexion,$consulta4);//BASE DE DATOS
                                $fila4=mysqli_fetch_row($resultado4);//BASE DE DATOS
                                echo"<tr>
                                  <th class='success'>$dato3[0]</th>
                                  <th class='success'>$dato3[1]</th>
                                  <th class='success'>$fila4[0] $fila4[1]</th>
                                </tr>";
                              }
                            }else {
                                echo"<tr>
                                  <th class='success'>No se encuentra registrado ningún Estudiante</th>
                                </tr>";
                            }
                            echo "</table>";
                          }
                      }else {
                        echo "<center><h4><b>No se encuentran Cursos Registrados</b></h4></center><br>";
                      }
                      $consulta4="select persona_identificacion from estudiante;";//BASE DE DATOS
                      $resultado4= mysqli_query($conexion,$consulta4);//BASE DE DATOS
                      $fila4=mysqli_fetch_all($resultado4);//BASE DE DATOS
                      $tam = sizeof($fila4);
                      if ($tam>0) {
                        echo "<br><center><h4><b>Estudiantes sin Curso Asignado </b></h4></center><br>";
                        echo "<table class='table table-bordered table-hover table-condensed'><table-striped>";
                        echo"<tr>
                          <th class='success'>identificación</th>
                          <th class='success'>Nombre completo</th>
                        </tr>";
                        for ($i=0; $i < $tam; $i++) {
                          $dato5=$fila4[$i];
                          $consulta5="select codigo from codigoprimaria where cursoprimaria_periodo_id_periodo='$periodo' and cursoprimaria_periodo_anio_id_anio='$anio' and estudiante_persona_identificacion='$dato5[0]';";//BASE DE DATOS
                          $resultado5= mysqli_query($conexion,$consulta5);//BASE DE DATOS
                          $fila5=mysqli_fetch_row($resultado5);//BASE DE DATOS
                          $tam2 = sizeof($fila5);
                          ////////////////////////////////////////////////////////////////////////////////
                          $consulta6="select codigo from codigootros where cursootros_periodo_id_periodo='$periodo' and cursootros_periodo_anio_id_anio='$anio' and estudiante_persona_identificacion='$dato5[0]';";//BASE DE DATOS
                          $resultado6= mysqli_query($conexion,$consulta6);//BASE DE DATOS
                          $fila6=mysqli_fetch_row($resultado6);//BASE DE DATOS
                          $tam3 = sizeof($fila6);
                          if ($tam2>0 || $tam3>0) {
                          }else {
                            $consulta7="select nombres,apellidos from persona where identificacion='$dato5[0]';";//BASE DE DATOS
                            $resultado7= mysqli_query($conexion,$consulta7);//BASE DE DATOS
                            $fila7=mysqli_fetch_row($resultado7);//BASE DE DATOS
                            echo"<tr>
                              <th class='warning'>$dato5[0]</th>
                              <th class='warning'>$fila7[0] $fila7[1]</th>
                            </tr>";
                          }
                        }
                        echo "</table>";
                      }
                      echo "</div>";
                    }
                  }else{
                    echo "<h2>No se han encontrado Grados registrados</h2>";
                  }
                }
                echo "</div></div>";
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'><br>
                  <div class='atras2 col-xs-12 col-sm-12 col-md-12'>
                  <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
                  <form class='' action='asignarC.php' method='post'>
                  <h4>Identificación: </h4><input class='form-control' name='id' type='text' placeholder='Identificación'><br>
                  <h4>Curso: </h4><select class='form-control' name='curso'>";
                    $tamaño = sizeof($listadecursos);
                    if ($tamaño>0) {
                      for ($i=0; $i < $tamaño; $i++) {
                        echo "<option>$listadecursos[$i]</option>";
                      }
                    }else{
                      echo "<option>No se Encuentran Cursos registrados</option>";
                    }
                  echo "</select><br>
                  </form></div></div>";
                  ////////////////EPARACION DE DIV///////////////////////
                  echo "<br><div class='atras2 col-xs-12 col-sm-12 col-md-12'>
                    <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
                  <form class='' action='asignarC.php' method='post'>
                  <h4>Grado: </h4><select class='form-control' name='grado'>";
                    $consulta="select nombre from grado";//BASE DE DATOS
                    $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                    $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                    $tamaño = sizeof($fila);
                    if ($tamaño>0) {
                      for ($i=0; $i < $tamaño; $i++) {
                        $dato=$fila[$i];
                        echo "<option>$dato[0]</option>";
                      }
                    }else{
                      echo "<option>No se han encontrado Años registrados</option>";
                    }

                  echo "</select><br>
                  </form></div></div>";
                  echo "</div>";
              }
              ?>
          </div>
       </div>
    </section>
  </div>


  <footer>
    <div class="container">
      <h6>Copyright © 2017 / Diseño y Web Cristhian Contreras, Santiago Arias</h6><h6>santiagoarias9803@gmail.com</h6>
    </div>
  </footer>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
