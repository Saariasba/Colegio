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
            <h2>Crear curso</h2>
            <br>
            <form class="" action="crearC.php" method="post">
              <h4>Año: </h4><select class="form-control" name="anio">
                <?php
                $consulta="select id_anio from anio";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño>0) {
                  $tamaño--;
                  for ($i=$tamaño; $i >= 0; $i--) {
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
              <h4>Tipo: </h4><select class="form-control" name="tipo">
                <option>Primaria</option>
                <option>Otros</option>
              </select><br>
              <input type="submit" class="trans btn btn-primary" name="consultar" value="Consultar"><br><br>
             </form>
           </div>
        </div>
        <?php
              if ($_SESSION["consultarC"]=="SI") {
                echo "
                <div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
                  <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
                    <br>
                    <table class='table table-bordered table-hover table-condensed'><table-striped>";
                $periodo = $_SESSION["periodo"];
                $tipo = $_SESSION["tipo"];
                $anio = $_SESSION["anio"];
                if ($tipo=="Primaria") {
                  $consulta="select grado_nombre from primaria";//BASE DE DATOS
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
                      echo "<tr>
                              <th class='danger'><font size=4 color=#000000>Cursos de $dato[0]:</font></th>
                              <th class='danger'></th>
                            </tr>";
                      if ($tamaño2>0) {
                          for ($m=0; $m <$tamaño2 ; $m++) {
                            $dato2=$fila2[$m];
                            $consulta3="select nombres,apellidos from persona where identificacion='$dato2[1]';";//BASE DE DATOS
                            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                            $fila3=mysqli_fetch_row($resultado3);//BASE DE DATOS
                            echo "<tr>
                                    <th class='warning'>*  $dato2[0]</th>
                                    <th class='warning'>*  $fila3[0] $fila3[1]</th>
                                  </tr>";
                          }
                      }else {
                        echo "<tr>
                                <th class='warning'>*No se han encontrado Cursos registrados</th>
                                <th class='warning'>*No se ha encontrado Director de Curso</th>
                              </tr>";
                      }
                    }
                  }else{
                    echo "<h2>No se han encontrado Grados registrados</h2>";
                  }
                }elseif ($tipo=="Otros") {
                    $consulta="select grado_nombre from Otros";//BASE DE DATOS
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
                        echo "<tr>
                                <th class='danger'><font size=4 color=#000000>Cursos de $dato[0]:</font></th>
                                <th class='danger'></th>
                              </tr>";
                        if ($tamaño2>0) {
                            for ($i=0; $i <$tamaño2 ; $i++) {
                              $dato2=$fila2[$i];
                              $consulta3="select nombres,apellidos from persona where identificacion='$dato2[1]';";//BASE DE DATOS
                              $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
                              $fila3=mysqli_fetch_row($resultado3);//BASE DE DATOS
                              echo "<tr>
                                      <th class='warning'>*  $dato2[0]</th>
                                      <th class='warning'>*  $fila3[0] $fila3[1]</th>
                                    </tr>";
                            }
                        }else {
                          echo "<tr>
                                  <th class='warning'>*No se han encontrado Cursos registrados</th>
                                  <th class='warning'>*No se ha encontrado Director de Curso</th>
                                </tr>";
                        }
                      }
                    }else{
                      echo "<h2>No se han encontrado Grados registrados</h2>";
                    }
                }
              }
              ?>
              </table>
          </div>
        </div>

          <?php
          if ($_SESSION["consultarC"]=="SI") {
            echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
            <div class='enfoque col-xs-12 col-sm-12 col-md-12'>
              <form class='' action='crearCC.php' method='post'><br>";
            echo "<h4>Nuevo Curso: </h4><input class='form-control' name='nombre' type='text' placeholder='Nombre'><br>
            <h4>Grado: </h4><select class='form-control' name='grado'>";
            $tam=sizeof($array);
            if ($tam>0) {
              for ($i=0; $i < $tam ; $i++) {
                echo"<option>$array[$i]</option>";
              }
            }else{
              echo"<option>No Existen Grados</option>";
            }
            echo "</select><br>
            <h4>Director de Curso: </h4><select class='form-control' name='director'>";
              $consulta="select persona_identificacion from profesor";//BASE DE DATOS
              $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
              $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
              $tamaño = sizeof($fila);
              if ($tamaño>0) {
                for ($i=0; $i < $tamaño; $i++) {
                  $dato=$fila[$i];
                  $array2[$i]=$dato[0];
                  $consulta="select nombres,apellidos from persona where identificacion='$dato[0]';";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  $fila2=mysqli_fetch_all($resultado);//BASE DE DATOS
                  $tamaño2 = sizeof($fila2);
                      for ($j=0; $j <$tamaño2 ; $j++) {
                        $dato2=$fila2[$j];
                        echo"<option>$dato[0] - $dato2[0] $dato2[1]</option>";
                      }
                }
              }else{
                echo"<option>No se encuentra registrado ningún profesor</option>";
              }
            echo"</select><br>
            <input type='submit' class='trans btn btn-primary' name='crear' value='Crear'>
            <input type='submit' class='trans btn btn-danger' name='eliminar' value='Eliminar'><br><br>";
          }
          if ($_SESSION["crearC"]=="SI") {
            $_SESSION["crearC"]="NO";
            $nombre = $_SESSION["nombre"];
            $grado = $_SESSION["grado"];
            $director = $_SESSION["director"];
            $num=$director[0];
            $director=$num;
            if ($nombre==null) {
              echo '<script language="javascript">alert("No se han ingresado los datos");</script>';
            }else{
              $_SESSION["consultarC"]="NO";
              if ($tipo=="Primaria") {
                $consulta="INSERT INTO `cursoprimaria` (`id_cursoprimaria`, `periodo_id_periodo`, `periodo_anio_id_anio`, `primaria_grado_nombre`, `profesor_persona_identificacion`) VALUES ('$nombre', '$periodo', '$anio', '$grado', '$director');";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                if ($resultado != 0) {
                  echo '<script language="javascript">alert("Se ha creado el Curso");</script>';
                }else {
                  echo '<script language="javascript">alert("No Ha sido posible crear el Curso");</script>';
                }
              }else{
                $consulta="INSERT INTO `cursootros` (`id_cursootros`, `periodo_id_periodo`, `periodo_anio_id_anio`, `otros_grado_nombre`, `profesor_persona_identificacion`) VALUES ('$nombre', '$periodo', '$anio', '$grado', '$director');";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                if ($resultado != 0) {
                  echo '<script language="javascript">alert("Se ha creado el Curso");</script>';
                }else {
                  echo '<script language="javascript">alert("No Ha sido posible crear el Curso");</script>';
                }
              }
            }
          }elseif ($_SESSION["eliminarC"]=="SI") {
            $_SESSION["eliminarC"]="NO";
            $nombre = $_SESSION["nombre"];
            $grado = $_SESSION["grado"];
            $director = $_SESSION["director"];
            $num=$director[0];
            $director=$num;
            if ($nombre==null) {
              echo '<script language="javascript">alert("No se han ingresado los datos");</script>';
            }else{
              $_SESSION["consultarC"]="NO";
              if ($tipo=="Primaria") {
                $consulta="DELETE FROM `cursoprimaria` WHERE `cursoprimaria`.`id_cursoprimaria` = '$nombre' AND `cursoprimaria`.`periodo_id_periodo` = '$periodo' AND `cursoprimaria`.`periodo_anio_id_anio` = '$anio';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $consulta="select primaria_grado_nombre from cursoprimaria where id_cursoprimaria= '$nombre';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño == 1) {
                  echo '<script language="javascript">alert("No Ha sido posible eliminar el Curso");</script>';
                }else {
                  echo '<script language="javascript">alert("Se ha eliminado el Curso");</script>';
                }
              }else{
                $consulta="DELETE FROM `cursootros` WHERE `cursootros`.`id_cursootros` = '$nombre' AND `cursootros`.`periodo_id_periodo` = '$periodo' AND `cursootros`.`periodo_anio_id_anio` = '$anio';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $consulta="select otros_grado_nombre from cursootros where id_cursootros= '$nombre';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño == 1) {
                  echo '<script language="javascript">alert("No Ha sido posible eliminar el Curso");</script>';
                }else {
                  echo '<script language="javascript">alert("Se ha eliminado el Curso");</script>';
                }
              }
          }
        }
          ?>
         </form>
       </div>
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
