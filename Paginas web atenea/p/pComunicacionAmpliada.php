<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';
require_once 'admin/class/fecha.php';
$bd=new bd();

$id=$_SESSION["id"];
$com=$_GET["nm"];

$make=$bd->query("select * from alumnos where id='".$id."';");
$fila=$bd->fil($make);

$makeDel=$bd->query("delete from coms where idComunicacion='".$com."' and idAlumno='".$id."';");

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
$directorioProfesor="admin/imagenesProfesor/".$filaQ["profesor"];
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
    $rutaImagenProfesor="imagenes/foto_profesor.gif";
    $ancho2=88;
    $alto2=105;
}
//
$salida.="<div class=\"bloque_comunicaciones\">\n";
$salida.="<div class=\"conten_foto_profesor\">\n";
$salida.="<div class=\"foto_profesor3\"><img src=\"".$rutaImagenProfesor."\" alt=\"profesor\" width=\"".$ancho2."\"/></div>\n";
$salida.="<div class=\"nombre_profe\"><strong>PROFESOR</strong><br />\n";
$salida.=$cadenaProfesor."</div>\n";
$salida.="<div class=\"area_profe\"><strong>ÁREA</strong><br />\n";
$salida.=$materia."</div>\n";
$salida.="</div>\n";
$salida.="<div class=\"bloque_verde\">\n";
$salida.="<div class=\"publica\"><strong>Publicado el:</strong> ".$fecha." </div>\n";
$salida.="<div class=\"txt_general\">".$filaQ["texto"]."</div>\n";
$salida.="<div class=\"enlaces\">";
$dir1="admin/archivos/comunicaciones/d1/".$filaQ["id"];
if(is_dir($dir1)){
    $open1=opendir($dir1);
    while($ar1=readdir($open1)){
        if($ar1!="." && $ar1!=".."){
            $archivo1=$ar1;
        }
    }
    $ruta1=$dir1."/".$archivo1;
    $salida.="<a href=\"".$ruta1."\" target=\"_blank\">Link del Documento</a><br />\n";
}
$dir2="admin/archivos/comunicaciones/d2/".$filaQ["id"];
if(is_dir($dir2)){
    $open2=opendir($dir2);
    while($ar2=readdir($open2)){
        if($ar2!="." && $ar2!=".."){
            $archivo2=$ar2;
        }
    }
    $ruta2=$dir2."/".$archivo2;
    $salida.="<a href=\"".$ruta2."\" target=\"_blank\">Link del Documento</a><br />\n";
}
$dir3="admin/archivos/comunicaciones/d3/".$filaQ["id"];
if(is_dir($dir3)){
    $open3=opendir($dir3);
    while($ar3=readdir($open3)){
        if($ar3!="." && $ar3!=".."){
            $archivo3=$ar3;
        }
    }
    $ruta3=$dir3."/".$archivo3;
    $salida.="<a href=\"".$ruta3."\" target=\"_blank\">Link del Documento</a><br />\n";
}
if($filaQ["enlace"]!=""){
    $salida.="<br /><a href=\"".$filaQ["enlace"]."\" target=\"_blan<br />k\">Link web</a></div>\n";
}else{
    $salida.="</div>";
}
$salida.="</div>\n";
$salida.="<div class=\"texto_entrar2\"><a href=\"comunicaciones.php\" target=\"_parent\">Ver todas las comunicaciones</a></div>\n";
$salida.="<div class=\"boton_entrar\"><a href=\"comunicaciones.php\" target=\"_parent\"><img src=\"imagenes/boton_retroceso.gif\" alt=\"entrar\" width=\"27\" height=\"27\" border=\"0\" /></a></div>\n";
$salida.="</div>\n"
?>
