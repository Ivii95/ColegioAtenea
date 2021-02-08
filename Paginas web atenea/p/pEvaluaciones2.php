<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';
require_once 'admin/class/fecha.php';
$bd=new bd();

if($_SESSION["tipo"]=="padre"){
    $red="p/pMateriaEvaluacionPadres.php";
}elseif($_SESSION["tipo"]=="alumno"){
    $red="p/pMateriaEvaluacion.php";
}

if($_SESSION["tipo"]=="alumno"){
    $id=$_SESSION["id"];
    $make=$bd->query("select * from alumnos where id='".$id."';");
    $fila=$bd->fil($make);

    $nombreAlumno=$_SESSION["nombrer"];

    $alum=$id;

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
    //listado del seguimiento educativo
    $makeComboMaterias=$bd->query("select * from notasevaluaciones where idCurso='".$filaCurso["id"]."';");
    $filaComboMaterias=$bd->fil($makeComboMaterias);
    $colComboMaterias=$bd->col($makeComboMaterias);
    if($colComboMaterias>0){
        do{
            $matriz[]=$filaComboMaterias["idMateria"];
        }while($filaComboMaterias=$bd->fil($makeComboMaterias));
        $matrizMaterias=array_unique($matriz);
        $selec="<form name=\"form\" id=\"form\" method=\"post\" action=\"".$red."\">\n";
        $selec.="<select id=\"materias\" name=\"materias\">\n";
        $selec.="<option value=\"0\">Seleccionar Área</option>\n";
        $selec.="<option value=\"todas\">Ver todas</option>\n";
        foreach($matrizMaterias as $dato1){
            $makeMaterias=$bd->query("select * from asignaturas where id='".$dato1."';");
            $filaMaterias=$bd->fil($makeMaterias);
            $selec.="<option value=\"".$dato1."\">".$filaMaterias["asignatura"]."</option>\n";
        }
        $selec.="</select>\n";
        $selec.="<label>\n<input type=\"hidden\" id=\"mat\" name=\"mat\" value=\"true\"/>
                      <input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n
                      </label>\n
                </form>\n";
    }else{
        $selec="No hay evaluaciones disponibles";
    }
}else{
    $id=$_SESSION["idAlumno"];
    $make=$bd->query("select * from alumnos where id='".$id."';");
    $fila=$bd->fil($make);

    $alum=$id;

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
    //listado del seguimiento educativo
    $makeComboMaterias=$bd->query("select * from notasevaluaciones where idCurso='".$filaCurso["id"]."';");
    $filaComboMaterias=$bd->fil($makeComboMaterias);
    $colComboMaterias=$bd->col($makeComboMaterias);
    if($colComboMaterias>0){
        do{
            $matriz[]=$filaComboMaterias["idMateria"];
        }while($filaComboMaterias=$bd->fil($makeComboMaterias));
        $matrizMaterias=array_unique($matriz);
        $selec="<form name=\"form\" id=\"form\" method=\"post\" action=\"".$red."\">\n";
        $selec.="<select id=\"materias\" name=\"materias\">\n";
        $selec.="<option value=\"0\">Seleccionar Área</option>\n";
        $selec.="<option value=\"todas\">Ver todas</option>\n";
        foreach($matrizMaterias as $dato1){
            $makeMaterias=$bd->query("select * from asignaturas where id='".$dato1."';");
            $filaMaterias=$bd->fil($makeMaterias);
            $selec.="<option value=\"".$dato1."\">".$filaMaterias["asignatura"]."</option>\n";
        }
        $selec.="</select>\n";
        $selec.="<label>\n<input type=\"hidden\" id=\"mat\" name=\"mat\" value=\"true\"/>
                      <input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n
                      </label>\n
                </form>\n";
    }else{
        $selec="No hay evaluaciones disponibles";
    }
}
//motor de la lista

$makeEvaluacion=$bd->query("select * from notasevaluaciones where idCurso='".$fila["cursos"]."' and idAlumno='".$alum."' order by idEvaluacion desc;");
$filaEvaluacion=$bd->fil($makeEvaluacion);
$colsEvaluacion=$bd->col($makeEvaluacion);
if($colsEvaluacion>0){
    $salida="<table width=\"99%\" summary=\"Tabla que ofrece el seguimiento Educativo del alumno en todas las áreas, por fecha y tema.\">\n";
    $salida.="<caption>Todas las áreas</caption>\n";
    $salida.="<tr>\n";
    $salida.="<th width=\"25%\" class=\"tabla_eval2\" scope=\"col\">TRIMESTRE</th>\n";
    $salida.="<th width=\"64%\" class=\"tabla_eval2\" scope=\"col\">ÁREA</th>\n";
    $salida.="<th width=\"11%\" class=\"tabla_eval2\" scope=\"col\">NOTA</th>\n";
    $salida.="</tr>\n";
    do{
        $make1=$bd->query("select * from evaluaciones where id='".$filaEvaluacion["idEvaluacion"]."';");
        $fila1=$bd->fil($make1);
        $evaluacion=$fila1["nombre"];
        $make2=$bd->query("select * from asignaturas where id='".$filaEvaluacion["idMateria"]."';");
        $fila2=$bd->fil($make2);
        $materia=$fila2["asignatura"];
        $salida.="<tr>\n";
        $salida.="<td class=\"tabla_evalS\">".$evaluacion."</td>\n";
        $salida.="<td class=\"tabla_eval\">".$materia."</td>\n";
        $salida.="<td class=\"tabla_eval\">".$filaEvaluacion["nota"]."</td>\n";
        $salida.="</tr>\n";
    }while($filaEvaluacion=$bd->fil($makeEvaluacion));
    $salida.="</table>";
}

?>
 