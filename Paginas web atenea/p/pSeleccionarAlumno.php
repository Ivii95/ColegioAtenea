<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/construmaex/wordpress/atenea/admin/class/bd.php';
$bd=new bd();


$_SESSION["idAlumno"]=$_POST["alumnos"];

$make=$bd->query("select * from alumnos where id='".$_SESSION["idAlumno"]."';");
$fila=$bd->fil($make);
$curso=$fila["cursos"];
$_SESSION["cursoAlumno"]=$curso;


header("Location:http://gesinformatica.es/colegio/wordpress/wp-content/themes/enfant/page-zona-padres2.php")
?>
