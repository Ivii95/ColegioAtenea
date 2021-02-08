<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';
$bd=new bd();

$id=$_SESSION["id"];
$make=$bd->query("select * from alumnos where id='".$id."';");
$fila=$bd->fil($make);

$makeAl=$bd->query("select * from coms where idAlumno='".$id."';");
$colsAl=$bd->col($makeAl);
$makeAl2=$bd->query("select * from comsp where idAlumno='".$id."';");
$colsAl2=$bd->col($makeAl2);

if($colsAl2>0 || $colsAl>0){
    $comunicaciones=true;
}else{
    $comunicaciones=false;
}

$makeCurso=$bd->query("select * from cursos where id='".$fila["cursos"]."';");
$filaCurso=$bd->fil($makeCurso);
$salidaCurso=$filaCurso["curso"];

//tutor
$makeTutor=$bd->query("select * from tutorias where idCurso='".$fila["cursos"]."';");
$filaTutor=$bd->fil($makeTutor);
$colTutor=$bd->col($makeTutor);
if($colTutor>0){
    $makeProfesor=$bd->query("select * from profesores where id='".$filaTutor["idProfesor"]."';");
    $filaProfesor=$bd->fil($makeProfesor);
    $nombreProfesor=$filaProfesor["nombre"]." ".$filaProfesor["apellidos"];
    $horarioTutoria=$filaTutor["texto"];
}
//imagen del alumno
$directorio="admin/imagenesAlumnos/".$id;
if(is_dir($directorio)){
    $open=opendir($directorio);
    while($imagen=readdir($open)){
        if($imagen!="." && $imagen!=".."){
            $rutaImagen=$directorio."/".$imagen;
        }
    }
    $img=new imagenes($rutaImagen, 88, 105);
    $img->altoFijo();
    $ancho=$img->ancho();
    $alto=$img->alto();
}else{
    $rutaImagen="imagenes/foto_alumno.gif";
    $ancho=88;
    $alto=105;
}
?>
