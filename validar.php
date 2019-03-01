<?php
  $conexion=mysqli_connect("localhost","root","","mydb");//BASE DE DATOS
  $usuario=$_POST['usuario'];
  $clave=$_POST['clave'];
  $consulta="select * from usuarios where persona_identificacion='$usuario' and clave='$clave'";//BASE DE DATOS
  $resultado= mysqli_query($conexion,$consulta);//BASE DE DATOS
  $fila=mysqli_fetch_row($resultado);//BASE DE DATOS
  if($fila>0){
    session_name("loginUsuario");
    session_start();
    $_SESSION["incorrecta"]="NO";
    $_SESSION["autentificado"]= "SI";
    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
    $_SESSION["usuario"]=$usuario;
    $_SESSION["clave"]=$clave;
    if ($fila[2]=='Profesor') {
      header("Location:Profesor/Profesor.php");
    }elseif ($fila[2]=='Administrativo') {
      header("Location:Administrativo/Administrativo.php");
    }elseif ($fila[2]=='Estudiante') {
      header("Location:Estudiante/Estudiante.php");
    }elseif ($fila[2]=='Rector') {
      header("Location:Rector/Rector.php");
    }
   mysqli_free_result($resultado);//BASE DE DATOS
   mysqli_close($conexion);//BASE DE DATOS

  }else{
      mysqli_free_result($resultado);
      mysqli_close($conexion);
      header("Location:loginI.php");
  }
?>
