<?php
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'] . '/atenea/admin/class/escalarImagenes.php';
$bd = new bd();
$bd->query("SET NAMES utf8");

if ($_SESSION["tipo"] == "padre") {
    $red = "https://colegioatenea.es/wp-admin/admin-post.php";
} elseif ($_SESSION["tipo"] == "alumno") {
    $red = "https://colegioatenea.es/wp-admin/admin-post.php";
}

if ($_SESSION["tipo"] == "alumno") {
    $id = $_SESSION["id"];
    $make = $bd->query("select * from alumnos where id='" . $id . "';");
    $fila = $bd->fil($make);

    $nombreAlumno = $_SESSION["nombrer"];

    $alum = $id;

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



    //listado del seguimiento educativo. *PARA EL ALUMNO (NOTA POR ISMAEL VALLE)
    $makeComboMaterias = $bd->query("select * from parciales where idCurso='" . $filaCurso["id"] . "';");
    $filaComboMaterias = $bd->fil($makeComboMaterias);
    $colComboMaterias = $bd->col($makeComboMaterias);
    if ($colComboMaterias > 0) {
        do {
            $matriz[] = $filaComboMaterias["idMateria"];
        } while ($filaComboMaterias = $bd->fil($makeComboMaterias));
        $matrizMaterias = array_unique($matriz);
        $selec = "<form name=\"form\" id=\"form\" method=\"post\" action=\"" . $red . "\">\n";
        $selec .= "<input type=\"hidden\" name=\"action\" value=\"segui\">";
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
} else {
    $id = $_SESSION["idAlumno"];
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
    //listado del seguimiento educativo. *PARA EL PADRE (NOTA POR ISMAEL VALLE)

    $makeComboMaterias = $bd->query("select * from parciales where idCurso='" . $filaCurso["id"] . "';");
    $filaComboMaterias = $bd->fil($makeComboMaterias);
    $colComboMaterias = $bd->col($makeComboMaterias);
    if ($colComboMaterias > 0) {
        do {
            $matriz[] = $filaComboMaterias["idMateria"];
        } while ($filaComboMaterias = $bd->fil($makeComboMaterias));
        $matrizMaterias = array_unique($matriz);
        $selec = "<form name=\"form\" id=\"form\" method=\"post\" action=\"" . $red . "\">\n";
        $selec .= "<input type=\"hidden\" name=\"action\" value=\"segui\">";
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
}

//motor de la lista
//paginacion

$variante = 10;
if (!isset($_GET["pagi"]) || $_GET["pagi"] == 1) {
    $page = 1;
    $limiteInferior = 0;
} else {
    $page = $_GET["pagi"];
    $limiteInferior = ($page - 1) * $variante;
}
$limiteSuperior = $variante;

$cons = "select * from parciales where idCurso='" . $fila["cursos"] . "'  order by fecha desc limit " . $limiteInferior . "," . $limiteSuperior . ";";
$makeEvaluacion = $bd->query($cons);
$filaEvaluacion = $bd->fil($makeEvaluacion);

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

if ($colTotalEjercicios > 0) {
    $salida = "<table style='border: 2px solid #660033; margin-top: 20px;' width=\"99%\" summary=\"Tabla que ofrece el seguimiento Educativo del alumno en todas las áreas, por fecha y tema.\">\n";
    $salida .= "<caption class='cap'>Todas las áreas</caption>\n";
    $salida .= "<tr>\n";
    $salida .= "<th width=\"15%\" class=\"tabla_seg2\" scope=\"col\">FECHA</th>\n";
    $salida .= "<th width=\"35%\" class=\"tabla_seg2\" scope=\"col\">ÁREA</th>\n";
    $salida .= "<th width=\"39%\" class=\"tabla_seg2\" scope=\"col\">TEMA</th>\n";
    $salida .= "<th width=\"11%\" class=\"tabla_seg2\" scope=\"col\">NOTA</th>\n";
    $salida .= "</tr>\n";
    do {
        //Iván
        $consultaM =  "select * from matriculas WHERE IdAlumno=" . $id . ";";
        $makeM = $bd->query($consultaM);
        $filaM = $bd->fil($makeM);
        $colM = $bd->col($makeM);
        do {
            if ($filaEvaluacion["idMateria"] == $filaM["IdAsignatura"]) {
                $cons2 = "select * from notasparciales where idEjercicio='" . $filaEvaluacion["id"] . "' and idAlumno='" . $alum . "';";
                $make1 = $bd->query($cons2);
                $fila1 = $bd->fil($make1);
                $cols1 = $bd->col($make1);
                $f = new fecha($filaEvaluacion["fecha"]);
                $fecha = $f->barraInvertida();
                $salida .= "<tr>\n";
                $salida .= "<td class=\"tabla_seg\">" . $fecha . "</td>\n";
                $salida .= "<td class=\"tabla_seg\">" . $filaEvaluacion["materia"] . "</td>\n";
                $salida .= "<td class=\"tabla_seg\">" . $filaEvaluacion["titulo"] . "</td>\n";
                if ($fila1["nota"] != "") {
                    $salida .= "<td class=\"tabla_seg\">" . $fila1["nota"] . "</td>\n";
                } else {
                    $salida .= "<td class=\"tabla_seg\">S/E</td>\n";
                }
                $salida .= "</tr>\n";
            }
        } while ($filaM = $bd->fil($makeM));
    } while ($filaEvaluacion = $bd->fil($makeEvaluacion));
    $salida .= "</table>";
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
