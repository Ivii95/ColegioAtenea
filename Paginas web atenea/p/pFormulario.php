<?php
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

if($_SESSION["tipo"]=="padre"){
    $idAlumno=$_SESSION["idAlumno"];
}elseif($_SESSION["tipo"]=="alumno"){
    $idAlumno=$_SESSION["id"];
}

$make=$bd->query("select * from alumnos where id='".$idAlumno."';");
$fila=$bd->fil($make);

$nombreAlumno=$fila["nombre"]." ".$fila["apellidos"];

$makeCurso=$bd->query("select * from cursos where id='".$fila["cursos"]."';");
$filaCurso=$bd->fil($makeCurso);
$salidaCurso=$filaCurso["curso"];

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
$directorio="atenea/admin/imagenesAlumnos/".$idAlumno;

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

$id=$_SESSION["id"];
$make=$bd->query("select * from padres where id='".$id."';");
$fila=$bd->fil($make);
$nombre=$fila["nombre"]." ".$fila["apellidos"];
$dni=$fila["dni"];

$makeAlumno=$bd->query("select * from alumnos where dniPadre='".$dni."' or dniMadre='".$dni."';");
$filaAlumno=$bd->fil($makeAlumno);
$sel="";
$sel.="<select style='background-color: #6a3f48; color: aliceblue;' id=\"alumno\" name=\"alumno\">\n";
$sel.="<option value=\"0\">Seleccionar alumno</option>\n";
do{
    
    if($filaAlumno["id"]==$_SESSION["idAlumno"]){
        $sel.="<option selected=\"selected\" value=\"".$filaAlumno["id"]."\">".$filaAlumno["apellidos"].", ".$filaAlumno["nombre"]."</option>\n";
    }else{
        $sel.="<option value=\"".$filaAlumno["id"]."\">".$filaAlumno["apellidos"].", ".$filaAlumno["nombre"]."</option>\n";
    }

}while($filaAlumno=$bd->fil($makeAlumno));
$sel.="</select>\n";
?>