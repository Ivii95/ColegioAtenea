<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';
require_once 'admin/class/fecha.php';
$bd=new bd();

//paginacion
$variante=5;
if(!isset($_GET["p"]) || $_GET["p"]==1){
    $page=1;
    $limiteInferior=0;
}else{
    $page=$_GET["p"];
    $limiteInferior=($page-1)*$variante;
}
$limiteSuperior=$limiteInferior+$variante;


$id=$_SESSION["id"];
$make=$bd->query("select * from alumnos where id='".$id."';");
$fila=$bd->fil($make);



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
//listado de comunicaciones
$makeComunicaciones=$bd->query("select * from comunicaciones where curso='".$fila["cursos"]."' order by fecha desc;");
$filaComunicaciones=$bd->fil($makeComunicaciones);
$colsComunicaciones=$bd->col($makeComunicaciones);

$makeComunicacionesp=$bd->query("select * from comunicacionesp where alumno='".$id."' order by fecha desc;");
$filaComunicacionesp=$bd->fil($makeComunicacionesp);
$colsComunicacionesp=$bd->col($makeComunicacionesp);
do{
    $matriz[]=$filaComunicaciones["id"];
}while($filaComunicaciones=$bd->fil($makeComunicaciones));
do{
    $matrizp[]=$filaComunicacionesp["id"];
}while($filaComunicacionesp=$bd->fil($makeComunicacionesp));

if($colsComunicaciones>0 && $colsComunicacionesp==0){
    $matrizFinal=$matriz;
}elseif($colsComunicacionesp>0 && $colsComunicaciones==0){
    $matrizFinal=$matrizp;
}elseif($colsComunicaciones>0 && $colsComunicacionesp>0){
    $cantidad1=count($matriz);
    $cantidad2=count($matrizp);
    $iteraciones=$cantidad1+$cantidad2;
    $indice1=0;
    $indice2=0;

    for ($i=0;$i<$iteraciones;$i++){
        $makeFecha1=$bd->query("select * from comunicaciones where id='".$matriz[$indice1]."';");
        $filaFecha1=$bd->fil($makeFecha1);
        $colsFecha1=$bd->col($makeFecha1);
        $fechafecha1=explode("-",$filaFecha1["fecha"]);

        $makeFecha2=$bd->query("select * from comunicacionesp where id='".$matrizp[$indice2]."';");
        $filaFecha2=$bd->fil($makeFecha2);
        $colsFecha2=$bd->col($makeFecha2);
        $fechafecha2=explode("-",$filaFecha2["fecha"]);

        if($colsFecha1>0){
            $mk1=mktime(0,0,0,$fechafecha1[2],$fechafecha1[1],$fechafecha1[0]);
        }else{
            $mk1=null;
        }
        if($colsFecha2>0){
            $mk2=mktime(0,0,0,$fechafecha2[2],$fechafecha2[1],$fechafecha2[0]);
        }else{
            $mk2=null;
        }
        if($mk1>$mk2){
            $matrizFinal[]=$matriz[$indice1];
            $indice1++;
        }else{
            $matrizFinal[]=$matrizp[$indice2]."p";
            $indice2++;
        }
    }
}

$cuenta=count($matrizFinal);
if($cuenta>0){
    $makeY=$bd->query("update alumnos set comunicaciones='0' where id='".$id."';");

    $listado="<div class=\"cab_fecha\">Fecha</div>\n";
    $listado.="<div class=\"cab_area\">Área</div>\n";
    $listado.="<div class=\"cab_contenido\">Contenido</div>\n";
    $listado.="<div class=\"cab_publicado\">Publicado por:</div>\n";
    for($i=$limiteInferior;$i<$limiteSuperior;$i++){
        $st=strlen($matrizFinal[$i]);
        $detectar=substr($matrizFinal[$i],$st-1,1);
        if($detectar!="p"){
            $makeA=$bd->query("select * from comunicaciones where id='".$matrizFinal[$i]."';");
            $filaA=$bd->fil($makeA);
            $colA=$bd->col($makeA);
            if($colA>0){
                $feo="";
                $makePro=$bd->query("select * from coms where idComunicacion='".$matrizFinal[$i]."' and idAlumno='".$id."';");
                $colsPro=$bd->col($makePro);
                if($colsPro>0){
                    $feo="<b><a href=\"comunicaciones_ampliada.php?nm=".$matrizFinal[$i]."\" target=\"_parent\">Ver contenidos</a></b>";
                }else{
                    $feo="<a href=\"comunicaciones_ampliada.php?nm=".$matrizFinal[$i]."\" target=\"_parent\">Ver contenidos</a>";
                }
                $f=new fecha($filaA["fecha"]);
                $fecha=$f->barraInvertida();
                $listado.="<div class=\"cab_fecha2\">".$fecha."</div>\n";
                $makeQ=$bd->query("select * from asignaturas where id='".$filaA["materia"]."';");
                $filaQ=$bd->fil($makeQ);
                $listado.="<div class=\"cab_area2\">".$filaQ["asignatura"]."</div>\n";
                $listado.="<div class=\"cab_contenido2\">".$feo."</div>\n";
                $makeW=$bd->query("select * from profesores where id='".$filaA["profesor"]."';");
                $filaW=$bd->fil($makeW);
                $cn=$filaW["nombre"]." ".$filaW["apellidos"];
                $listado.="<div class=\"cab_publicado2\">".$cn."</div>\n";
            }
        }else{
            $makeA=$bd->query("select * from comunicacionesp where id='".$matrizFinal[$i]."';");
            $filaA=$bd->fil($makeA);
            $colA=$bd->col($makeA);
            if($colA>0){
                $feo="";
                $makePro=$bd->query("select * from comsp where idComunicacion='".$matrizFinal[$i]."' and idAlumno='".$id."';");
                $colsPro=$bd->col($makePro);
                if($colsPro>0){
                    $feo="<b><a href=\"comunicaciones_ampliada.php?nm=".$matrizFinal[$i]."&per=true\" target=\"_parent\">Ver contenidos</a></b>";
                }else{
                    $feo="<a href=\"comunicaciones_ampliada.php?nm=".$matrizFinal[$i]."&per=true\" target=\"_parent\">Ver contenidos</a>";
                }
                $f=new fecha($filaA["fecha"]);
                $fecha=$f->barraInvertida();
                $listado.="<div class=\"cab_fecha2\">".$fecha."</div>\n";
                $makeQ=$bd->query("select * from asignaturas where id='".$filaA["materia"]."';");
                $filaQ=$bd->fil($makeQ);
                $listado.="<div class=\"cab_area2\">".$filaQ["asignatura"]."</div>\n";
                $listado.="<div class=\"cab_contenido2\">".$feo."</div>\n";
                $makeW=$bd->query("select * from profesores where id='".$filaA["profesor"]."';");
                $filaW=$bd->fil($makeW);
                $cn=$filaW["nombre"]." ".$filaW["apellidos"];
                $listado.="<div class=\"cab_publicado2\">".$cn."</div>\n";
            }
        }
    }
    //cadea de paginación
    $numeroPaginasDouble=$cuenta/$variante;
    $resto=$cuenta%$variante;
    if($resto!=0){
        $numeroPaginas=((int)$numeroPaginasDouble)+1;
    }else{
        $numeroPaginas=((int)$numeroPaginasDouble);
    }
    if($numeroPaginas>1){
    $siguiente=$page+1;
    $anterior=$page-1;
    if($page>1){
        $ant="<a href=\"".$estaPage."?p=".$anterior."\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    }else{
        $ant="";
    }
    $paginacion="<div class=\"paginacion\">".$ant."Pág. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
    if($page<$numeroPaginas){
        $paginacion.="<a href=\"".$estaPage."?p=".$siguiente."\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    }else{
        $paginacion.="</div>\n";
    }
    }else{
        $paginacion="";
    }
}

?>
