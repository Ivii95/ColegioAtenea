<?php
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

if($_SESSION["tipo"]=="padre"){
    $id=$_SESSION["idAlumno"];
}elseif($_SESSION["tipo"]=="alumno"){
    $id=$_SESSION["id"];
}
$com=$_GET["nm"];

$make=$bd->query("select * from alumnos where id='".$id."';");
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
$makeQ=$bd->query("select * from comunicaciones where id='".$com."';");
$filaQ=$bd->fil($makeQ);

$makeW=$bd->query("select * from profesores where id='".$filaQ["profesor"]."';");
$filaW=$bd->fil(($makeW));
$cadenaProfesor=$filaW["nombre"]." ".$filaW["apellidos"];

$makeArea=$bd->query("select * from asignaturas where id='".$filaQ["materia"]."';");
$filaArea=$bd->fil($makeArea);
$materia=$filaArea["asignatura"];

$f=new fecha($filaQ["fecha"]);
$fecha=$f->textoCompleto();

//profesor
$directorioProfesor="atenea/admin/imagenesProfesor/".$filaQ["profesor"];
if(is_dir($directorioProfesor)){
    $openp=opendir($directorioProfesor);
    while($ip=readdir($openp)){
        if($ip!="." && $ip!=".."){
            $imagenp=$ip;
        }
    }
    $rutaImagenProfesor=$directorioProfesor."/".$imagenp;
    $img2=new imagenes($rutaImagenProfesor, 88, 105);
    $img2->altoFijo();
    $ancho2=$img2->ancho();
    $alto2=$img2->alto();
}else{
    $rutaImagenProfesor="atenea/imagenes/foto_profesor.gif";
    $ancho2=88;
    $alto2=105;
}
//
$salida.="<div class=\"bloque_comunicaciones\">\n";

$salida.="<div class=\"col-lg-2 col-sm-12 isma\">";
$salida.="<div class=\"foto_profesor\"><img class=\"sombrasimagenes\" src=\"https://colegioatenea.es/".$rutaImagenProfesor."\" alt=\"profesor\" width=\"".$ancho2."\"/></div>\n";
$salida.="<div class=\"nombre_profe\"><strong>PROFESOR</strong><br />\n".$cadenaProfesor."</div>\n";
$salida.="<div class=\"area_profe2\"><strong>ÁREA</strong><br />\n".$materia."</div>\n";
$salida.="</div>\n";

$salida.="<div class=\"col-sm-12 col-lg-10 cab_descripcion_seg \">";

$salida.="<p><strong>Publicado el:</strong> ".$fecha." </p>\n";
$salida.="<p>".$filaQ["texto"]."</p>\n";
$salida.="<p>";
$dir1="atenea/admin/archivos/comunicaciones/d1/".$filaQ["id"];
if(is_dir($dir1)){
    $open1=opendir($dir1);
    while($ar1=readdir($open1)){
        if($ar1!="." && $ar1!=".."){
            $archivo1=$ar1;
        }
    }
    $ruta1=$dir1."/".$archivo1;
    $salida.="<a href=\"https://colegioatenea.es/".$ruta1."\" target=\"_blank\">Link del Documento</a><br />\n";
}
$dir2="atenea/admin/archivos/comunicaciones/d2/".$filaQ["id"];
if(is_dir($dir2)){
    $open2=opendir($dir2);
    while($ar2=readdir($open2)){
        if($ar2!="." && $ar2!=".."){
            $archivo2=$ar2;
        }
    }
    $ruta2=$dir2."/".$archivo2;
    $salida.="<a href=\"https://colegioatenea.es/".$ruta2."\" target=\"_blank\">Link del Documento</a><br />\n";
}
$dir3="atenea/admin/archivos/comunicaciones/d3/".$filaQ["id"];
if(is_dir($dir3)){
    $open3=opendir($dir3);
    while($ar3=readdir($open3)){
        if($ar3!="." && $ar3!=".."){
            $archivo3=$ar3;
        }
    }
    $ruta3=$dir3."/".$archivo3;
    $salida.="<a href=\"https://colegioatenea.es/".$ruta3."\" target=\"_blank\">Link del Documento</a><br />\n";
}
if($filaQ["enlace"]!=""){
    $salida.="<br /><a href=\"".$filaQ["enlace"]."\" target=\"_blan<br />k\">Link web</a></p>\n";
}else{
    $salida.="</p>";
}
$salida.="</div>\n";
$salida.="</div>\n"
?>
