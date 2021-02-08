<?php
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/escalarImagenes.php';
$bd = new bd();
$bd->query("SET NAMES 'utf8'");
$red = "https://colegioatenea.es/wp-admin/admin-post.php";
$mama = "";

if (isset($_GET["ma"])) {
    $mama = $_GET["ma"];
}


$i = 0;
//ACTIVAR CUANDO TENGAMOS EVALUACIONES REALES
if ($_SESSION["tipo"] == "padre") {
    $id = $_SESSION["idAlumno"];
} elseif ($_SESSION["tipo"] == "alumno") {
    $id = $_SESSION["id"];
}

$make = $bd->query("select * from alumnos where id='" . $id . "';");
$fila = $bd->fil($make);

$alum = $id;

$nombreAlumno = $fila["nombre"] . " " . $fila["apellidos"];

$makeCurso = $bd->query("select * from cursos where id='" . $fila["cursos"] . "';");
$filaCurso = $bd->fil($makeCurso);
$salidaCurso = $filaCurso["curso"];

$makeTutor = $bd->query("select * from tutorias where idCurso='" . $fila["cursos"] . "';");
$filaTutor = $bd->fil($makeTutor);
$colTutor = $bd->col($makeTutor);
if ($colTutor > 0) {
    $makeProfesor = $bd->query("select * from profesores where id='" . $filaTutor["idProfesor"] . "';");
    $filaProfesor = $bd->fil($makeProfesor);
    $nombreProfesor = $filaProfesor["nombre"] . " " . $filaProfesor["apellidos"];
    $horarioTutoria = $filaTutor["texto"];
}


$make2 = $bd->query("SELECT * FROM matriculas WHERE idAlumno='" . $id . "';");
$numeromatriculas = $bd->col($make2);


$make3 = $bd->query("SELECT idAsignatura FROM matriculas WHERE idAlumno='" . $id . "';");
while ($fila = $bd->fil($make3)) {
    $asignaturas[] = $fila["idAsignatura"];
}


$tabla = "<table style='border: 2px solid #660033; margin-top: 20px;'>
	<caption class='cap'>CALIFICACIONES</caption>
   <tr>
       <th class='tabla_seg2'>MATERIAS</th>
       <th class='tabla_seg2'>1ª EVAL</th>
       <th class='tabla_seg2'>2ª EVAL</th>
       <th class='tabla_seg2'>3ª EVAL</th>
       <th class='tabla_seg2'>EVAL ORD</th>
   </tr>";

foreach ($asignaturas as $dato1 => $valor) {
    $makeasig = $bd->query("select asignatura from asignaturas where id='" . $valor . "';");
    $filaMaterias = $bd->fil($makeasig);
    $nombre[] = $filaMaterias["asignatura"];
}

sort($nombre);



foreach ($nombre as $dato1 => $valor) {

    $makeasig = $bd->query("select id from asignaturas where asignatura='" . $valor . "';");
    $filaMaterias = $bd->fil($makeasig);

    $asignaturass[] = $filaMaterias["id"];
}



foreach ($asignaturass as $dato1 => $valor) {
    $i = 0;
    $evaluacion = 1;
    $makeasig = $bd->query("select asignatura from asignaturas where id='" . $valor . "';");
    $filaMaterias = $bd->fil($makeasig);
    $nombreasig = $filaMaterias["asignatura"];
    unset($notas);
    $tabla .= "<tr>
                   <td class='tabla_seg'>$nombreasig</td>";

    $makenota = $bd->query("select * from notasevaluaciones where idMateria='" . $valor . "' and idAlumno='" . $id . "' ORDER BY `notasevaluaciones`.`idEvaluacion` ASC;");
    $numeronotas = $bd->col($makenota);

    if ($numeronotas > 0) {
        while ($filanota = $bd->fil($makenota)) {
            if (is_null($filanota["nota"]) || empty($filanota["nota"])) {
                $notas[$i] = "No hay datos";
                $i++;
            } else if ($filanota["idEvaluacion"] == 1) {
                $notas[0] = $filanota["nota"];
                $i++;
            } else if ($filanota["idEvaluacion"] == 2) {
                $notas[1] = $filanota["nota"];
                $i++;
            } else if ($filanota["idEvaluacion"] == 3) {
                $notas[2] = $filanota["nota"];
                $i++;
            } else if ($filanota["idEvaluacion"] == 4) {
                $notas[3] = $filanota["nota"];
                $i++;
            }else{
                $notas[$i] = "No hay datos";
                $i++;
            }
            /*if (is_null($filanota["nota"]) || empty($filanota["nota"])) {
                $notas[$i] = "No hay datos";
                $i++;
                $evaluacion++;
            } else if ($filanota["idEvaluacion"] == $evaluacion){
                $notas[$i] = $filanota["nota"];
                $i++;
                $evaluacion++;
            }*/
        }

        $tabla .= "<td class='tabla_seg'>$notas[0]</td>";

        if (count($notas) > 1) {

            $tabla .= "<td class='tabla_seg'>$notas[1]</td>";


            $tabla .= "<td class='tabla_seg'>$notas[2]</td>";


            $tabla .= "<td class='tabla_seg'>$notas[3]</td>";
        } else {

            $tabla .= "<td class='tabla_seg'></td>";

            $tabla .= "<td class='tabla_seg'></td>";

            $tabla .= "<td class='tabla_seg'></td>";
        }
        $tabla .= "</tr>";
    } else {
        $tabla .= "<td>No Hay datos</td>
                   <td>No Hay datos</td>
                   <td>No Hay datos</td>
                   <td>No Hay datos</td>
                </tr>";
    }
}



$tabla .= "</table>";



//listado del seguimiento educativo
$makeComboMaterias = $bd->query("select * from notasevaluaciones where idCurso='" . $filaCurso["id"] . "' ORDER BY `notasevaluaciones`.`idEvaluacion` ASC;");
$filaComboMaterias = $bd->fil($makeComboMaterias);
$colComboMaterias = $bd->col($makeComboMaterias);
if ($colComboMaterias > 0) {
    do {
        $matriz[] = $filaComboMaterias["idMateria"];
    } while ($filaComboMaterias = $bd->fil($makeComboMaterias));
    $matrizMaterias = array_unique($matriz);
    $selec = "<form name=\"form\" id=\"form\" method=\"post\" action=\"" . $red . "\">\n";
    $selec .= "<input type=\"hidden\" name=\"action\" value=\"eva\">";
    $selec .= "<select id=\"materias\" name=\"materias\">\n";
    $selec .= "<option value=\"0\">Seleccionar Área</option>\n";
    $selec .= "<option value=\"todas\">Ver todas</option>\n";
    foreach ($matrizMaterias as $dato1) {
        $makeMaterias = $bd->query("select * from asignaturas where id='" . $dato1 . "';");
        $filaMaterias = $bd->fil($makeMaterias);
        $selec .= "<option value=\"" . $dato1 . "\">" . $filaMaterias["asignatura"] . "</option>\n";
    }
    $selec .= "</select>\n";
    $selec .= "<label>\n<input type=\"hidden\" id=\"mat\" name=\"mat\" value=\"true\"/>
                  <input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n
                  </label>\n
            </form>\n";
} else {
    $selec = "No hay evaluaciones disponibles";
}

//todos los ejercicios
//paginacion
$variante = 5;
if (!isset($_GET["pagi"]) || $_GET["pagi"] == 1) {
    $page = 1;
    $limiteInferior = 0;
} else {
    $page = $_GET["pagi"];
    $limiteInferior = ($page - 1) * $variante;
}
$limiteSuperior = $variante;

//
$makeEjercicios = $bd->query("select * from notasevaluaciones where idCurso='" . $filaCurso["id"] . "' and idAlumno='" . $id . "' and idMateria='" . $mama . "' limit " . $limiteInferior . "," . $limiteSuperior . " ORDER BY `notasevaluaciones`.`idEvaluacion` ASC;");
$filaEjercicios = $bd->fil($makeEjercicios);
$colEjercicios = $bd->col($makeEjercicios);

$makeTotalEjercicios = $bd->query("select * from notasevaluaciones where idCurso='" . $filaCurso["id"] . "' and idAlumno='" . $id . "'  and idMateria='" . $mama . "' ORDER BY `notasevaluaciones`.`idEvaluacion` ASC;");
$filaTotalEjercicios = $bd->fil($makeTotalEjercicios);
$colTotalEjercicios = $bd->col($makeTotalEjercicios);

$numeroPaginasDouble = $colTotalEjercicios / $variante;
$resto = $colTotalEjercicios % $variante;
if ($resto != 0) {
    $numeroPaginas = ((int) $numeroPaginasDouble) + 1;
} else {
    $numeroPaginas = ((int) $numeroPaginasDouble);
}

if ($colEjercicios > 0) {
    //profesor
    $directorioProfesor = "atenea/admin/imagenesProfesor/" . $filaEjercicios["idProfesor"];
    if (is_dir($directorioProfesor)) {
        $openp = opendir($directorioProfesor);
        while ($ip = readdir($openp)) {
            if ($ip != "." && $ip != "..") {
                $imagenp = $ip;
            }
        }
        $rutaImagenProfesor = $directorioProfesor . "/" . $imagenp;
        $img2 = new imagenes($rutaImagenProfesor, 88, 105);
        $img2->altoFijo();
        $ancho2 = $img2->ancho();
        $alto2 = $img2->alto();
    } else {
        $rutaImagenProfesor = "atenea/imagenes/foto_profesor.gif";
        $ancho2 = 88;
        $alto2 = 105;
    }
    //nombre del profesor
    $makeE = $bd->query("select * from profesores where id='" . $filaEjercicios["idProfesor"] . "';");
    $filaE = $bd->fil($makeE);
    $cadenaProfesor = $filaE["apellidos"] . ", " . $filaE["nombre"];
    //
    $makeMateria = $bd->query("select * from asignaturas where id='" . $filaEjercicios["idMateria"] . "';");
    $filaMateria = $bd->fil($makeMateria);
    $materia = ucwords($filaMateria["asignatura"]);
    $cadenaMateriaEval = $filaEval["nombre"] . " de " . $materia; //cadena Primera evaluacion de Matematicas
    //
    $b = "<div class=\"col-lg-2 col-sm-12 isma\">\n";
    $b .= "<div class=\"conten_foto_profesor\">\n";
    $b .= "<div class=\"foto_profesor\"><img class='sombrasimagenes' src=\"https://colegioatenea.es/" . $rutaImagenProfesor . "\" oncopy=\"alert('Opcion deshabilitada');return false\" oncontextmenu=\"alert('Opcion deshabilitada');return false\" alt=\"profesor\" width=\"" . $ancho2 . "\"/></div>\n";
    $b .= "<div class=\"nombre_profe\"><strong>PROFESOR</strong><br />\n";
    $b .= $cadenaProfesor . "</div>\n";
    $b .= "<div class=\"area_profe2\"><strong>ÁREA</strong><br />\n";
    $b .= $materia . "</div>\n";
    $b .= "</div>\n";
    $b .= "</div>\n";
    /////////////////////////////////////////////////////////
    do {

        $nota = "";
        $obs = "";
        $obs2 = "";
        if ($filaEjercicios["observacionesalumnos"] != "") {
            $obs = $filaEjercicios["observacionesalumnos"];
        } else {
            $obs = "Sin comentarios";
        }
        if ($filaEjercicios["observacionespadres"] != "") {
            $obs2 = $filaEjercicios["observacionespadres"];
        } else {
            $obs2 = "Sin comentarios";
        }
        if ($filaEjercicios["nota"] != "") {
            $nota = $filaEjercicios["nota"];
        } else {
            $nota = "Sin evaluar";
        }

        //makes
        $makeEval = $bd->query("select * from evaluaciones where id='" . $filaEjercicios["idEvaluacion"] . "';");
        $filaEval = $bd->fil($makeEval);
        $eval = $filaEval["cardinal"]; //trimestre



        $b .= "<div class=\"col-sm-12 col-lg-10 cab_descripcion_seg \">";
        $b .= "<p>Evaluación: " . $eval . "</p>";
        $b .= "<p>Área: " . $cadenaMateriaEval . "</p>";

        $b .= "<p>Calificación: " . $nota . "</p>";

        $b .= "<p>Observaciones del Tutor: " . $obs . "</p>";
        $b .= "<p>Observaciones del Tutor para los padres/tutores legales del alumno: " . $obs2 . "</p>";
        $b .= "</div>";
    } while ($filaEjercicios = $bd->fil($makeEjercicios));
}

if ($numeroPaginas > 1) {
    $siguiente = $page + 1;
    $anterior = $page - 1;
    if ($page > 1) {
        $val = esc_url(add_query_arg(array(
            'pagi' => $anterior
        ), 'https://colegioatenea.es/zona-padres/zona-padres-2/seguimiento-educativo/'));

        $ant = "<a href=\"" . $val . "\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    } else {
        $ant = "";
    }
    $paginacion = "<div class=\"paginacion\">" . $ant . "Pág. " . $page . " / " . $numeroPaginas . "&nbsp;&nbsp;";
    if ($page < $numeroPaginas) {
        $val = esc_url(add_query_arg(array(
            'pagi' => $siguiente
        ), 'https://colegioatenea.es/zona-padres/zona-padres-2/seguimiento-educativo/'));

        $paginacion .= "<a href=\"" . $val . "\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    } else {
        $paginacion .= "</div>\n";
    }
} else {
    $paginacion = "";
}
