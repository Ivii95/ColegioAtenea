<?php

require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");


//paginacion
$variante=12;
if(!isset($_GET["pagina"]) || $_GET["pagina"]==1){
    $page=1;
    $limiteInferior=0;
}else{
    $page=$_GET["pagina"];
    $limiteInferior=($page-1)*$variante;
}
$limiteSuperior=$limiteInferior+$variante;


if($_SESSION["tipo"]=="padre"){
    $id=$_SESSION["idAlumno"];
}elseif($_SESSION["tipo"]=="alumno"){
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
    $listado="<table>";  
    $listado.="<tr>";  
    $listado.="<th class='tabla_seg2'>Fecha</th>";
    $listado.="<th class='tabla_seg2'>Área</th>";
    $listado.="<th class='tabla_seg2'>Titulo</th>";
    $listado.="<th class='tabla_seg2'>Contenido</th>";
    $listado.="<th class='tabla_seg2'>Publicado por:</th>";
    $listado.="</tr>";
    for($i=$limiteInferior;$i<$limiteSuperior;$i++){
        $st=strlen($matrizFinal[$i]);
        $detectar=substr($matrizFinal[$i],$st-1,1);
        if($detectar!="p"){
            $makeA=$bd->query("select * from comunicaciones where id='".$matrizFinal[$i]."';");
            $filaA=$bd->fil($makeA);
            $colA=$bd->col($makeA);
            if($colA>0){
                $f=new fecha($filaA["fecha"]);
                $fecha=$f->barraInvertida();
                $listado.="<tr>"; 
                $listado.="<td class='tabla_seg'>".$fecha."</td>";
                $makeQ=$bd->query("select * from asignaturas where id='".$filaA["materia"]."';");
                $filaQ=$bd->fil($makeQ);
                $listado.="<td class='tabla_seg'>".$filaQ["asignatura"]."</td>";
                
                $listado.="<td class='tabla_seg'>".$filaA["titulo"]."</td>";
                
                $listado.="<td class='tabla_seg'><a href=\"https://colegioatenea.es/zona-padres/zona-padres-2/comunicaciones-ampliada-padre?nm=".$matrizFinal[$i]."\" target=\"_parent\">Ver contenidos</a></td>";
                $makeW=$bd->query("select * from profesores where id='".$filaA["profesor"]."';");
                $filaW=$bd->fil($makeW);
                $cn=$filaW["nombre"]." ".$filaW["apellidos"];
                $listado.="<td class='tabla_seg'>".$cn."</td>";
                $listado.="</tr>";
              
            }
        }else{
            $makeA=$bd->query("select * from comunicacionesp where id='".$matrizFinal[$i]."';");
            $filaA=$bd->fil($makeA);
            $colA=$bd->col($makeA);
            if($colA>0){
                $f=new fecha($filaA["fecha"]);
                $fecha=$f->barraInvertida();
                $listado.="<tr>"; 
                $listado.="<td class='tabla_seg'>".$fecha."</td>";
                $makeQ=$bd->query("select * from asignaturas where id='".$filaA["materia"]."';");
                $filaQ=$bd->fil($makeQ);
                $listado.="<td class='tabla_seg'>".$filaQ["asignatura"]."</td>";
                
                $listado.="<td class='tabla_seg'>".$filaA["titulo"]."</td>";
                
                $listado.="<td class='tabla_seg'><a href=\"https://colegioatenea.es/zona-padres/zona-padres-2/comunicaciones-ampliada-padre?nm=".$matrizFinal[$i]."&per=true\" target=\"_parent\">Ver contenidos</a></td>";
                $makeW=$bd->query("select * from profesores where id='".$filaA["profesor"]."';");
                $filaW=$bd->fil($makeW);
                $cn=$filaW["nombre"]." ".$filaW["apellidos"];
                $listado.="<td class='tabla_seg'>".$cn."</td>";
                $listado.="</tr>";
                
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
        $ant="<a href=\"".$estaPage."?pagina=".$anterior."\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    }else{
        $ant="";
    }
    $paginacion="<div class=\"paginacion\">".$ant."Pág. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
    if($page<$numeroPaginas){
        $paginacion.="<a href=\"".$estaPage."?pagina=".$siguiente."\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    }else{
        $paginacion.="</div>\n";
    }
    }else{
        $paginacion="";
    }
    $listado.="</table>";
}

?>
