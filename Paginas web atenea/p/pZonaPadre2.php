<?php
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="padre"){
    $id=$_SESSION["idAlumno"];
}elseif(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="alumno"){
    $id=$_SESSION["id"];
}



$make=$bd->query("select * from alumnos where id='".$id."';");
$fila=$bd->fil($make);

$nombreAlumno=$fila["nombre"]." ".$fila["apellidos"];
//CURSOS
$makeCurso=$bd->query("select * from cursos where id='".$fila["cursos"]."';");
$filaCurso=$bd->fil($makeCurso);
$salidaCurso=$filaCurso["curso"];
//TUTORIAS
$makeTutor=$bd->query("select * from tutorias where idCurso='".$fila["cursos"]."';");
$filaTutor=$bd->fil($makeTutor);
$colTutor=$bd->col($makeTutor);
//Entra en el bucle
if($colTutor>0){
    $makeProfesor=$bd->query("select * from profesores where id='".$filaTutor["idProfesor"]."';");
    $filaProfesor=$bd->fil($makeProfesor);
    $nombreProfesor=$filaProfesor["nombre"]." ".$filaProfesor["apellidos"];
    $horarioTutoria=$filaTutor["texto"];
    $tutor=true;
}else{
    $tutor=false;
}
//imagen del alumno
$directorio="atenea/admin/imagenesAlumnos/".$id;

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
    $rutaImagen="atenea/imagenes/foto_alumno.gif";
    $ancho=88;
    $alto=105;
}
?>
