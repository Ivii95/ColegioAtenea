<?php

session_start();

require_once 'admin/class/bd.php';

require_once 'admin/class/escalarImagenes.php';

require_once 'admin/class/fecha.php';

$bd = new bd();



$id = $_SESSION["id"];

$make = $bd->query("select * from alumnos where id='" . $id . "';");

$fila = $bd->fil($make);



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

//imagen del alumno

$directorio = "admin/imagenesAlumnos/" . $id;

if (is_dir($directorio)) {

    $open = opendir($directorio);

    while ($imagen = readdir($open)) {

        if ($imagen != "." && $imagen != "..") {

            $rutaImagen = $directorio . "/" . $imagen;
        }
    }

    $img = new imagenes($rutaImagen, 88, 105);

    $img->altoFijo();

    $ancho = $img->ancho();

    $alto = $img->alto();
} else {

    $rutaImagen = "imagenes/foto_alumno.gif";

    $ancho = 88;

    $alto = 105;
}



//listado del seguimiento educativo

$makeComboMaterias = $bd->query("select * from parciales where idCurso='" . $filaCurso["id"] . "';");

$filaComboMaterias = $bd->fil($makeComboMaterias);

$colComboMaterias = $bd->col($makeComboMaterias);

if ($colComboMaterias > 0) {

    do {

        $matriz[] = $filaComboMaterias["idMateria"];
    } while ($filaComboMaterias = $bd->fil($makeComboMaterias));

    $matrizMaterias = array_unique($matriz);

    $selec = "<form name=\"form\" id=\"form\" method=\"post\" action=\"p/pSeguimientoMateria.php\">\n";

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

    $selec = "No hay ejercicios disponibles";
}

//todos los ejercicios

//paginacion

$variante = 5;

if (!isset($_GET["p"]) || $_GET["p"] == 1) {

    $page = 1;

    $limiteInferior = 0;
} else {

    $page = $_GET["p"];

    $limiteInferior = ($page - 1) * $variante;
}

$limiteSuperior = $variante;

//

$makeEjercicios = $bd->query("select * from parciales where idCurso='" . $filaCurso["id"] . "' order by fecha desc limit " . $limiteInferior . "," . $limiteSuperior . ";");

$filaEjercicios = $bd->fil($makeEjercicios);

$colEjercicios = $bd->col($makeEjercicios);


$makeTotalEjercicios = $bd->query("select * from parciales where idCurso='" . $filaCurso["id"] . "';");

$filaTotalEjercicios = $bd->fil($makeTotalEjercicios);

$colTotalEjercicios = $bd->col($makeTotalEjercicios);



$numeroPaginasDouble = $colTotalEjercicios / $variante;

$resto = $colTotalEjercicios % $variante;

if ($resto != 0) {

    $numeroPaginas = ((int)$numeroPaginasDouble) + 1;
} else {

    $numeroPaginas = ((int)$numeroPaginasDouble);
}



if ($colEjercicios > 0) {

    do {
        //Iván
        /*$consultaM =  "select * from matriculas WHERE IdAlumno=" . $_GET["alumnoT"] . ";";
        $makeM = $bd->query($consultaM);
        $filaM = $bd->fil($makeM);
        $colM = $bd->col($makeM);
        if ($filaEjercicios["idMateria"] == $filaM["IdAsignatura"]) {*/
            $nota = "";

            $observaciones = "";

            $makeNotas = $bd->query("select * from notasparciales where idEjercicio='" . $filaEjercicios["id"] . "' and idAlumno='" . $id . "';");

            $filaNotas = $bd->fil($makeNotas);

            $f = new fecha($filaEjercicios["fecha"]);

            $fecha = $f->textoCompleto();

            if ($filaNotas["nota"] != "") {

                $nota = $filaNotas["nota"];
            } else {

                $nota = "Sin evaluar";
            }
            if ($filaNotas["observaciones"] != "") {

                $observaciones = $filaNotas["observaciones"];
            } else {

                $observaciones = "Sin observaciones";
            }

            //profesor

            $directorioProfesor = "admin/imagenesProfesor/" . $filaEjercicios["idProfesor"];

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

                $rutaImagenProfesor = "imagenes/foto_profesor.gif";

                $ancho2 = 88;

                $alto2 = 105;
            }

            $b .= "<div class=\"conten_foto_profesor\">\n";

            $b .= "<div class=\"foto_profesor\"><img src=\"" . $rutaImagenProfesor . "\" oncopy=\"alert('Opcion deshabilitada');return false\" oncontextmenu=\"alert('Opcion deshabilitada');return false\" alt=\"profesor\" width=\"" . $ancho2 . "\"/></div>\n";

            $b .= "<div class=\"nombre_profe\"><strong>PROFESOR</strong><br />\n";

            $b .= $filaEjercicios["profesor"] . "</div>\n";

            $b .= "<div class=\"area_profe2\"><strong>ÁREA</strong><br />\n";

            $b .= $filaEjercicios["materia"] . "</div>\n";

            $b .= "</div>\n";

            $b .= "<div class=\"bloque_rosa\">\n";

            $b .= "<div class=\"cab_descripcion_seg\">Descripción:</div>\n";

            $b .= "<div class=\"cab_descripcion_seg2\">" . $filaEjercicios["descripcion"] . "</div>\n";

            $b .= "<div class=\"linea_blanca\"></div>\n";

            $b .= "<div class=\"cab_fecha_seg\">Fecha:</div>\n";

            $b .= "<div class=\"cab_fecha_seg2\">" . $fecha . "</div>\n";

            $b .= "<div class=\"cab_hora_seg\"> Hora:</div>\n";

            $b .= "<div class=\"cab_hora_seg2\">" . $filaEjercicios["hora"] . "</div>\n";

            $b .= "<div class=\"linea_blanca\"></div>\n";

            $b .= "<div class=\"cab_descripcion_seg\">Calificación:</div>\n";

            $b .= "<div class=\"cab_nota_seg\">" . $nota . "</div>\n";

            $b .= "<div class=\"cab_observ_seg\">Observaciones:</div>\n";

            $b .= "<div class=\"cab_observ_seg2\">" . $observaciones . "</div>\n";

            $b .= "</div>\n";
        //}
    } while ($filaEjercicios = $bd->fil($makeEjercicios));
}

if ($numeroPaginas > 1) {

    $siguiente = $page + 1;

    $anterior = $page - 1;

    if ($page > 1) {

        $ant = "<a href=\"" . $estaPage . "?p=" . $anterior . "\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    } else {

        $ant = "";
    }

    $paginacion = "<div class=\"paginacion\">" . $ant . "Pág. " . $page . " / " . $numeroPaginas . "&nbsp;&nbsp;";

    if ($page < $numeroPaginas) {

        $paginacion .= "<a href=\"" . $estaPage . "?p=" . $siguiente . "\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    } else {

        $paginacion .= "</div>\n";
    }
} else {

    $paginacion = "";
}
