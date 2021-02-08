<?php
session_start();
session_destroy();
session_start();
require_once '../admin/class/bd.php';
$bd=new bd();

$usuario=htmlspecialchars($_POST["usuario"]);
$clave=htmlspecialchars($_POST["clave"]);

 if(empty($_POST["usuario"])){
var_dump($_POST);
}



$makeProfesores=$bd->query("select * from profesores where usuario='".$usuario."' and clave='".$clave."';");
$filaProfesores=$bd->fil($makeProfesores);
$colProfesores=$bd->col($makeProfesores);
if($colProfesores>0){
  $_SESSION["tipo"]="profesor";
  $_SESSION["login"]="yes";
  $_SESSION["nombre"]=$filaProfesores["apellidos"].", ".$filaProfesores["nombre"];
  $_SESSION["nombrer"]=$filaProfesores["nombre"]." ".$filaProfesores["apellidos"];
  $_SESSION["id"]=$filaProfesores["id"];
  $_SESSION["clave"]=$filaProfesores["clave"];
  $_SESSION["usuario"]=$filaProfesores["usuario"];
  header("Location:../loguin_profesores.php");
}
$makeAlumnos=$bd->query("select * from alumnos where usuario='".$usuario."' and clave='".$clave."';");
$filaAlumnos=$bd->fil($makeAlumnos);
$colAlumnos=$bd->col($makeAlumnos);
if($colAlumnos>0){
  $_SESSION["tipo"]="alumno";
  $_SESSION["login"]="yes";
  $_SESSION["nombre"]=$filaAlumnos["apellidos"].", ".$filaAlumnos["nombre"];
  $_SESSION["nombrer"]=$filaAlumnos["nombre"]." ".$filaAlumnos["apellidos"];
  $_SESSION["id"]=$filaAlumnos["id"];
  header("Location:../zona_del_alumno.php");
}
$makePadres=$bd->query("select * from padres where usuario='".$usuario."' and clave='".$clave."';");
$filaPadres=$bd->fil($makePadres);
$colPadres=$bd->col($makePadres);
if($colPadres>0){
  $_SESSION["tipo"]="padre";
  $_SESSION["login"]="yes";
  $_SESSION["nombre"]=$filaPadres["apellidos"].", ".$filaPadres["nombre"];
  $_SESSION["nombrer"]=$filaPadres["nombre"]." ".$filaPadres["apellidos"];
  $_SESSION["id"]=$filaPadres["id"];
  header("Location:../zona_del_padre.php");
}
if($colProfesores==0 && $colAlumnos==0 && $colPadres==0){
  header("Location:../no_login.php");
}


?>
