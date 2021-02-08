<?php
session_start();
require_once '../admin/class/bd.php';
$bd=new bd();

$make=$bd->query("select * from alumnos where id='".$_POST["alumno"]."';");
$fila=$bd->fil($make);
$cols=$bd->col($make);

$makeTutor=$bd->query("select * from tutorias where idCurso='".$fila["cursos"]."';");
$filaTutor=$bd->fil($makeTutor);
$colTutor=$bd->col($makeTutor);
if($colTutor>0){
    $makeProfesor=$bd->query("select * from profesores where id='".$filaTutor["idProfesor"]."';");
    $filaProfesor=$bd->fil($makeProfesor);
    $destinatario=$filaProfesor["email"];
}
$makeAlumno=$bd->query("select * from alumnos where id='".$_POST["alumno"]."';");
$filaAlumno=$bd->fil($makeAlumno);
$nombreAlumno=$filaAlumno["nombre"]." ".$filaAlumno["apellidos"];
$asunto = "Contacto";
$cuerpo = "
<html>
<head>
   <title>Contacto</title>
</head>
<body>

<p>
Este mensaje lo envía <b>".$_POST["nombre"]."</b> como padre/madre/tutor del alumno <b>".$nombreAlumno."</b>.
</p>
<p><b>Datos de contacto:</b>
<ul>
<li><b>Email: </b>".$_POST["email"]."</li>
<li><b>Teléfono: </b>".$_POST["telefono"]."</li>
</ul>
</p>
<p>
<b>Mensaje:</b><br />".$_POST["textos"]."
</p>
</body>
</html>
";

//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";

//dirección del remitente
$headers .= "From: ".$_POST["nombre"]." <".$_POST["email"].">\r\n";

if(mail($destinatario,$asunto,$cuerpo,$headers)){
    header("Location:https://colegioatenea.es/zona-padres");
}else{
    header("Location:http://google.es");
}
?>
