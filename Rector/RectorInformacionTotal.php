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
        <div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
        <div class="enfoque col-xs-12 col-sm-12 col-md-12">
          <br>
          <form class="" action="editarP.php" method="post">
            <h4>Identificacion: </h4><input class="form-control" type="text" name="identificacion" placeholder="Identificación"><br>
            <input type="submit" class="trans btn btn-primary" name="consultar" value="Consultar"><br><br>
          </form>
        </div>
        </div>
        <?php
        if ($_SESSION["informacionT"]=="NO") {
          echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'><br>
          <div class='enfoque3 col-xs-12 col-sm-12 col-md-12'>
          <h2>Rector</h2>
          <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'><table-striped>";
            $consulta="select persona_identificacion from rector ";//BASE DE DATOS
            $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            $tamaño = sizeof($fila);
            if($tamaño>0){
              echo "<tr>
                <th class='success'>identificacion:</th>
                <th class='success'>Nombres</th>
                <th class='success'>Apellidos</th>
                <th class='success'>Edad</th>
                <th class='success'>Genero</th>
                <th class='success'>Tipo de identificación</th>
              </tr>";
              for ($i=0; $i < $tamaño; $i++) {
                $dato=$fila[$i];
                $consulta2="select * from persona where identificacion='$dato[0]'";//BASE DE DATOS
                $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
                $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
                $tamaño2 = sizeof($fila2);
                  echo "<tr>
                    <th class='warning'>$fila2[0]</th>
                    <th class='warning'>$fila2[1]</th>
                    <th class='warning'>$fila2[2]</th>
                    <th class='warning'>$fila2[3]</th>
                    <th class='warning'>$fila2[4]</th>
                    <th class='warning'>$fila2[5]</th>
                  </tr>";
              }
            }else{
              echo "<tr>
                <th class='warning'>No se encuentran registrados</th>
              </tr>";
            }
          echo "</table></div>";

          echo "<h2>Administrativo</h2>
          <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'><table-striped>";
            $consulta="select persona_identificacion from administrativo ";//BASE DE DATOS
            $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            $tamaño = sizeof($fila);
            if($tamaño>0){
              echo "<tr>
                <th class='success'>identificacion:</th>
                <th class='success'>Nombres</th>
                <th class='success'>Apellidos</th>
                <th class='success'>Edad</th>
                <th class='success'>Genero</th>
                <th class='success'>Tipo de identificación</th>
              </tr>";
              for ($i=0; $i < $tamaño; $i++) {
                $dato=$fila[$i];
                $consulta2="select * from persona where identificacion='$dato[0]'";//BASE DE DATOS
                $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
                $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
                $tamaño2 = sizeof($fila2);
                  echo "<tr>
                    <th class='warning'>$fila2[0]</th>
                    <th class='warning'>$fila2[1]</th>
                    <th class='warning'>$fila2[2]</th>
                    <th class='warning'>$fila2[3]</th>
                    <th class='warning'>$fila2[4]</th>
                    <th class='warning'>$fila2[5]</th>
                  </tr>";
              }
            }else{
              echo "<tr>
                <th class='warning'>No se encuentran registrados</th>
              </tr>";
            }
          echo "</table></div>";
          echo "<h2>Profesor</h2>
          <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'><table-striped>";
            $consulta="select persona_identificacion from profesor ";//BASE DE DATOS
            $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            $tamaño = sizeof($fila);
            if($tamaño>0){
              echo "<tr>
                <th class='success'>identificacion:</th>
                <th class='success'>Nombres</th>
                <th class='success'>Apellidos</th>
                <th class='success'>Edad</th>
                <th class='success'>Genero</th>
                <th class='success'>Tipo de identificación</th>
              </tr>";
              for ($i=0; $i < $tamaño; $i++) {
                $dato=$fila[$i];
                $consulta2="select * from persona where identificacion='$dato[0]'";//BASE DE DATOS
                $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
                $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
                $tamaño2 = sizeof($fila2);
                  echo "<tr>
                    <th class='warning'>$fila2[0]</th>
                    <th class='warning'>$fila2[1]</th>
                    <th class='warning'>$fila2[2]</th>
                    <th class='warning'>$fila2[3]</th>
                    <th class='warning'>$fila2[4]</th>
                    <th class='warning'>$fila2[5]</th>
                  </tr>";
              }
            }else{
              echo "<tr>
                <th class='warning'>No se encuentran registrados</th>
              </tr>";
            }
          echo "</table></div>";
          echo "<h2>Estudiante</h2>
          <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'><table-striped>";
            $consulta="select persona_identificacion from estudiante ";//BASE DE DATOS
            $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
            $fila=mysqli_fetch_all($resultado);//BASE DE DATOS
            $tamaño = sizeof($fila);
            if($tamaño>0){
              echo "<tr>
                <th class='success'>identificacion:</th>
                <th class='success'>Nombres</th>
                <th class='success'>Apellidos</th>
                <th class='success'>Edad</th>
                <th class='success'>Genero</th>
                <th class='success'>Tipo de identificación</th>
              </tr>";
              for ($i=0; $i < $tamaño; $i++) {
                $dato=$fila[$i];
                $consulta2="select * from persona where identificacion='$dato[0]'";//BASE DE DATOS
                $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
                $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
                $tamaño2 = sizeof($fila2);
                  echo "<tr>
                    <th class='warning'>$fila2[0]</th>
                    <th class='warning'>$fila2[1]</th>
                    <th class='warning'>$fila2[2]</th>
                    <th class='warning'>$fila2[3]</th>
                    <th class='warning'>$fila2[4]</th>
                    <th class='warning'>$fila2[5]</th>
                  </tr>";
              }
            }else{
              echo "<tr>
                <th class='warning'>No se encuentran registrados</th>
              </tr>";
            }
          echo "</table></div>
          </div><HR />
          </div>";

        }else{
          $id=$_SESSION["identificacion1"];
          $consulta2="select * from persona where identificacion='$id'";//BASE DE DATOS
          $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
          $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
          $tamaño2 = sizeof($fila2);
          echo "<div class='enfoque2 col-xs-12 col-sm-12 col-md-12'>
            <div class='enfoque col-xs-12 col-sm-12 col-md-12'>
            <form class='' action='editarP.php' method='post'>
              <br><h4>Identificación: </h4><input class='form-control' name='identificacion' type='text' placeholder='Identificación' value='$fila2[0]'>
              <h4>Nombres: </h4><input class='form-control' name='nombres' type='text' placeholder='Nombres'value='$fila2[1]'>
              <h4>Apellidos: </h4><input class='form-control' name='apellidos' type='text' placeholder='Apellidos' value='$fila2[2]'>
              <h4>Edad: </h4><input class='form-control' name='edad' type='number' placeholder='Edad' value='$fila2[3]'>
              <h4>Genero: </h4><select class='form-control' name='genero'>";
              if ($fila2[4]=="Masculino") {
                 echo "<option>Masculino</option>
                 <option>Femenino</option>";
              }else{
                echo "<option>Femenino</option>
                <option>Masculino</option>";
              }
             echo "</select>
             <h4>Tipo de identificación: </h4><select class='form-control' name='tipoId' value='$fila2[5]'>";
             if ($fila2[5]=="Tarjeta de Identidad") {
                echo "<option>Tarjeta de Identidad</option>
                      <option>Cedula</option>
                      <option>Pasaporte</option>
                      <option>Cedula de Extranjeria</option>";
             }elseif ($fila2[5]=="Cedula") {
               echo "<option>Cedula</option>
                     <option>Tarjeta de Identidad</option>
                     <option>Pasaporte</option>
                     <option>Cedula de Extranjeria</option>";
             }elseif ($fila2[5]=="Pasaporte") {
               echo "<option>Pasaporte</option>
                     <option>Cedula</option>
                     <option>Tarjeta de Identidad</option>
                     <option>Cedula de Extranjeria</option>";
             }elseif ($fila2[5]=="Cedula de Extranjeria") {
               echo "<option>Cedula de Extranjeria</option>
                     <option>Pasaporte</option>
                     <option>Cedula</option>
                     <option>Tarjeta de Identidad</option>";
             }
             echo"</select>";
            $consulta2="select * from usuarios where persona_identificacion='$id'";//BASE DE DATOS
            $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
            $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
            $muestra =$fila2[2];
            echo"<h4>Tipo de Persona: </h4><select class='form-control' name='tipoPersona'>
                <option>$muestra</option>
                </select>
           <h4>Contraseña: </h4><input class='form-control' name='clave' type='text' placeholder='Contraseña' value='$fila2[1]'><br>
           <input type='submit' class='trans btn btn-danger' name='actualizar' value='Actualizar'><br><br>
          </form> </div>
        </div>";
        }
        if ($_SESSION["editar"]=="SI") {
          $id=$_SESSION["identificacion1"];
          $_SESSION["editar"]="NO";
          $identificacion = $_SESSION["identificacion2"];
          $nombres = $_SESSION["nombres2"];
          $apellidos = $_SESSION["apellidos2"];
          $edad = $_SESSION["edad2"];
          $genero = $_SESSION["genero2"];
          $tipoId = $_SESSION["tipoId2"];
          $tipoPersona = $_SESSION["tipoPersona2"];
          $clave = $_SESSION["clave2"];
          if ($identificacion = null || $nombres = null || $apellidos = null || $edad = null || $genero = null ||  $tipoId = null || $tipoPersona = null || $clave = null) {
            echo '<script language="javascript">alert("Datos Incompletos");</script>';
          }else{
            $consulta2="UPDATE `persona` SET `identificacion` = '$identificacion', `nombres` = '$nombres', `apellidos` = '$apellidos', `edad` = '$edad', `genero` = '$genero', `tipo_identificacion` = '$tipoId' WHERE `persona`.`identificacion` = '$id';";//BASE DE DATOS
            $resultado2= mysqli_query($conexion,$consulta2);//BASE DE DATOS
            $fila2=mysqli_fetch_row($resultado2);//BASE DE DATOS
            $tamaño2 = sizeof($fila2);
            $consulta3="UPDATE `usuarios` SET `persona_identificacion` = '$identificacion', `clave` = '$clave', `tipo` = '$tipoPersona' WHERE `usuarios`.`persona_identificacion` = '$id';";//BASE DE DATOS
            $resultado3= mysqli_query($conexion,$consulta3);//BASE DE DATOS
            $fila3=mysqli_fetch_row($resultado3);//BASE DE DATOS
            $tamaño3 = sizeof($fila3);
            echo '<script language="javascript">alert("Datos Actualizados Correctamente");</script>';
          }
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
