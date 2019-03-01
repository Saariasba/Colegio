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
              <h2>Seleccione el Año:</h2><br>
            <form class="" action="crearM.php" method="post">
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
                  echo "No existen años registrados";
                }
                 ?>
              </select><br>
              <input type="submit" class="trans btn btn-primary" name="consultar" value="Consultar"><br><br>
            </form>
          </div>
        </div>
        <?php
        if ($_SESSION["mostrarM"]=="SI") {
          $anio=$_SESSION["anio"];
          echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
            <div class='enfoque3 col-xs-12 col-sm-12 col-md-12col-xs-12 col-sm-12 col-md-12'>
          <h2>Lista de Meses Creados:</h2><br>
          <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'><table-striped>";
              $consulta="select id_mes from mes where anio_id_anio='$anio'";//BASE DE DATOS
              $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
              $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
              $tamaño = sizeof($fila);
              if ($tamaño>0) {
                echo "<tr>
                        <th class='danger'>Mes:</th>
                      </tr>";
                for ($i=0; $i < $tamaño; $i++) {
                  $dato=$fila[$i];
                  echo "<tr>
                          <th class='warning'>*  $dato[0]</th>
                        </tr>";
                }
              }else{
                echo "<tr>
                  <th class='warning'>No se han encontrado Meses registrados</th>
                </tr>";
              }
          echo "</table>
          </div></div></div>";
          echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
          <div class='enfoque col-xs-12 col-sm-12 col-md-12'>
            <br>
            <form class='' action='crearMM.php' method='post'>
              <h4>Mes: </h4><select class='form-control' name='mes'>
              <option>Enero</option>
              <option>Febrero</option>
              <option>Marzo</option>
              <option>Abril</option>
              <option>Mayo</option>
              <option>Junio</option>
              <option>Julio</option>
              <option>Agosto</option>
              <option>Septiembre</option>
              <option>Octubre</option>
              <option>Noviembre</option>
              <option>Diciembre</option>
              </select><br>
              <input type='submit' class='trans btn btn-primary' name='crear' value='Crear'>
              <input type='submit' class='trans btn btn-danger' name='eliminar' value='Eliminar'><br><br>
             </form>";
             if ($_SESSION["crearM"]=="SI") {
                $_SESSION["crearM"]="NO";
                $_SESSION["mostrarM"]="NO";
                 $mes = $_SESSION["mes"];
                  $consulta="INSERT INTO `mes` (`id_mes`, `anio_id_anio`) VALUES ('$mes', '$anio');";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  if ($resultado != 0) {
                    echo '<script language="javascript">alert("Se ha creado el Mes");</script>';
                  }else {
                    echo '<script language="javascript">alert("No Ha sido posible crear el Mes");</script>';
                  }
             }elseif ($_SESSION["eliminarM"]=="SI") {
               $_SESSION["eliminarM"]="NO";
               $_SESSION["mostrarM"]="NO";
               $mes = $_SESSION["mes"];
                $consulta="select id_mes from mes where id_mes= '$mes' and anio_id_anio='$anio';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
                $tamaño = sizeof($fila);
                if ($tamaño == 1) {
                  echo '<script language="javascript">alert("Se ha eliminado el Mes");</script>';
                }else {
                  echo '<script language="javascript">alert("No Ha sido posible eliminar el Mes");</script>';
                }
                $consulta="DELETE FROM `mes` WHERE `mes`.`id_mes` = '$mes' AND `mes`.`anio_id_anio` = '$anio';";//BASE DE DATOS
                $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
             }
          echo "</div></div>";
        }
         ?>
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
