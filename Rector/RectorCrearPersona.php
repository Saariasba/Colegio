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
        <div class="enfoque2 col-xs-12 col-sm-12 col-md-12">
          <div class="enfoque col-xs-12 col-sm-12 col-md-12">
            <h2>Crear Nueva Persona</h2><br>
            <form class="" action="crear.php" method="post">
                <h4>Identificación: </h4><input class="form-control" name="identificacion" type="text" placeholder="Identificación">
                <h4>Nombres: </h4><input class="form-control" name="nombres" type="text" placeholder="Nombres">
                <h4>Apellidos: </h4><input class="form-control" name="apellidos" type="text" placeholder="Apellidos">
                <h4>Edad: </h4><input class="form-control" name="edad" type="number" placeholder="Edad">
                <h4>Genero: </h4><select class="form-control" name="genero">
                  <option>Masculino</option>
                  <option>Femenino</option>
               </select>
               <h4>Tipo de identificación: </h4><select class="form-control" name="tipoId">
                 <option>Tarjeta de Identidad</option>
                 <option>Cedula</option>
                 <option>Pasaporte</option>
                 <option>Cedula de Extranjeria</option>
              </select>
              <h4>Tipo de Persona: </h4><select class="form-control" name="tipoPersona">
                <option>Estudiante</option>
                <option>Administrativo</option>
                <option>Profesor</option>
                <option>Rector</option>
             </select>
             <h4>Contraseña: </h4><input class="form-control" name="clave" type="text" placeholder="Contraseña"><br>
             <input type="submit" class="trans btn btn-danger" name="enviar" value="Crear"><br><br>
            </form>
            <?php
            if ($_SESSION["crear"]=="SI") {
              $_SESSION["crear"]="NO";
              ////////////////////////////////////////////////////    Variables
              $identificacion = $_SESSION["identificacion"];
              $nombres = $_SESSION["nombres"];
              $apellidos = $_SESSION["apellidos"];
              $edad = $_SESSION["edad"];
              $genero = $_SESSION["genero"];
              $tipoId = $_SESSION["tipoId"];
              $tipoPersona = $_SESSION["tipoPersona"];
              $clave = $_SESSION["clave"];
              ////////////////////////////////////////////////////////////////////// Base de datos
              $consulta="select identificacion from persona where identificacion='$identificacion'";//BASE DE DATOS
              $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
              $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
              $tamaño = sizeof($fila);
              if ($tamaño>0) {
                  echo '<script language="javascript">alert("La Identificación ya se encuentra registrada");</script>';
              }else{
                if($identificacion==null || $nombres==null || $apellidos==null || $edad==null || $genero==null || $tipoId==null || $tipoPersona==null || $clave==null){
                  echo '<script language="javascript">alert("Datos no ingresados en su totalidad");</script>';
                }else {
                  $consulta="INSERT INTO `persona` (`identificacion`, `nombres`, `apellidos`, `edad`, `genero`, `tipo_identificacion`) VALUES ('$identificacion', '$nombres', '$apellidos', '$edad', '$genero', '$tipoId');";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  $consulta="INSERT INTO `usuarios` (`persona_identificacion`, `clave`, `tipo`) VALUES ('$identificacion', '$clave', '$tipoPersona');";//BASE DE DATOS
                  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  if ($tipoPersona=="Estudiante") {
                    $consulta="INSERT INTO `estudiante` (`persona_identificacion`, `clave`) VALUES ('$identificacion', '$clave');";//BASE DE DATOS
                    $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  }elseif ($tipoPersona=="Profesor") {
                    $consulta="INSERT INTO `profesor` (`persona_identificacion`, `clave`) VALUES ('$identificacion', '$clave');";//BASE DE DATOS
                    $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  }elseif ($tipoPersona=="Administrativo") {
                    $consulta="INSERT INTO `administrativo` (`persona_identificacion`, `clave`) VALUES ('$identificacion', '$clave');";//BASE DE DATOS
                    $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  }elseif ($tipoPersona=="Rector") {
                    $consulta="INSERT INTO `rector (`persona_identificacion`, `clave`) VALUES ('$identificacion', '$clave');";//BASE DE DATOS
                    $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
                  }
                    $_SESSION["crear"]="NO";
                    echo '<script language="javascript">alert("Se ha creado la persona satisfactoriamente");</script>';
                }
              }
            }
             ?>
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
