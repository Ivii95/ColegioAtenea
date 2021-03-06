<?php
//Uso un header para tener permiso a acceder a los archivos
header('Access-Control-Allow-Origin: *');
include_once('GLOBALES.php');
include_once('DBConfig.php');
include_once('Objetos.php');
header('Content-Type: application/json;');


//Obtengo la opción que elegí cuando hago el llamado en React-Native, puedes usar un "isset" si fuera el caso
$opcion = $_GET["opcion"];
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 1;
}
if (isset($_GET["user"])) {
    $user = $_GET["user"];
}
if (isset($_GET["pass"])) {
    $pass = $_GET["pass"];
}
//Uso la función de conexión
$conn = conecta_db();

//Realizo un switch, ya que como en mi caso necesitare varias opciones de búsqueda; esto, depende de la variable opción.
switch ($opcion) {
    case ALUMNO:
        $sql = 'SELECT * from ' . TABLA_ALUMNO;
        break;
    case PADRES:
        $sql = "SELECT * from " . TABLA_PADRES;
        break;
    case PROFESOR:
        $sql = 'SELECT * from ' . TABLA_PROFESORES;
        break;
    case MOSTRAR_ALUMNO:
        $alumno = new Alumno($id);
        $rsAlumno = mysqli_query($conn, "SELECT * from " . TABLA_ALUMNO . " WHERE id= " . $alumno->id);
        if ($rsAlumno) {
            $filaAlumno = mysqli_fetch_assoc($rsAlumno);
            $alumno->nombre = $filaAlumno["nombre"] . " " . $filaAlumno["apellidos"];
            $rsCurso = mysqli_query($conn, "SELECT * from " . TABLA_CURSOS . " WHERE id= " . $filaAlumno["cursos"]);
            $filaCurso = mysqli_fetch_assoc($rsCurso);
            $alumno->curso = $filaCurso["curso"];
            $rsTutor = mysqli_query($conn, "SELECT * from " . TABLA_TUTORIAS . " WHERE idCurso= " . $filaAlumno["cursos"]);
            $filaTutor = mysqli_fetch_assoc($rsTutor);
            $colTutor = mysqli_num_rows($rsTutor);
            if ($colTutor > 0) {
                $rsProfesor = mysqli_query($conn, "SELECT * from " . TABLA_PROFESORES . " WHERE id= " . $filaTutor["idProfesor"]);
                if ($rsProfesor) {
                    $filaProfesor = mysqli_fetch_assoc($rsProfesor);
                    $alumno->tutor = $filaProfesor["nombre"] . " " . $filaProfesor["apellidos"];
                    $alumno->horatutoria = $filaTutor["texto"];
                }
            }
        }
        $alumno->urlimagen = "https://colegioatenea.es/atenea/admin/imagenesAlumnos/" . $alumno->id . "/" . $alumno->id . ".JPG";
        $res = json_encode($alumno, JSON_NUMERIC_CHECK);
        break;
    case MOSTRAR_PADRES:
        $hijos = array();
        $hijos[4]['id'] = 10;
        $hijos[4]['ide'] = 'hijo';
        $hijos[4]['title'] = 'ADMIN';
        $hijos[4]['url'] = 'url';
        $padre = new Padre($id);
        $rsPadre = mysqli_query($conn, "SELECT * from " . TABLA_PADRES . " WHERE id= " . $padre->id);
        if ($rsPadre) {
            $filaPadre = mysqli_fetch_assoc($rsPadre);
            $padre->nombre = $filaPadre["nombre"] . " " . $filaPadre["apellidos"];
            $padre->calidad = $filaPadre["calidad"];
            $padre->dni = $filaPadre["dni"];

            if ($padre->calidad == "padre") {
                $rsAlumno = mysqli_query($conn, "SELECT * from " . TABLA_ALUMNO . " WHERE dniPadre LIKE '" . $padre->dni . "'");
                while ($rsAlumno) {
                    $filaAlumno = mysqli_fetch_assoc($rsAlumno);
                    $alumno = new Alumno($filaAlumno["id"]);
                    $hijos = $filaAlumno["nombre"];
                    $Alumnos = $alumno;
                }
            } else if ($padre->calidad == "madre") {
                $rsAlumno = mysqli_query($conn, "SELECT * from " . TABLA_ALUMNO . " WHERE dniMadre LIKE '" . $padre->dni . "'");
                if ($rsAlumno) {
                    $i = 5;
                    while ($filaAlumno = mysqli_fetch_assoc($rsAlumno)) {
                        $hijos[$i]['id'] = $filaAlumno["id"];
                        $hijos[$i]['ide'] = 'hijo';
                        $hijos[$i]['title'] = $filaAlumno["nombre"];
                        $hijos[$i]['url'] = 'url';
                        $padre->Alumnos = $hijos;
                        $i++;
                        //echo $padre->Alumnos . "|" . $alumno;
                    }
                }
            } else {
            }
        }
        $res = json_encode($padre, JSON_NUMERIC_CHECK);
        break;
    case MOSTRAR_PROFESOR:
        $sql = "SELECT * from " . TABLA_PROFESORES . " WHERE id=" . $id;
        break;
    case COMPROBAR_PROFESOR:
        $passencript = password_hash($pass, PASSWORD_BCRYPT, [4]);
        $sql = 'SELECT id,usuario,clave from ' . TABLA_PROFESORES . '';
        $rs = mysqli_query($conn, $sql);
        while ($fila = mysqli_fetch_assoc($rs)) {
            $item = $fila;
            if ($item['usuario'] == $user && $item['clave'] == $passencript) {
                $sql = "SELECT * from " . TABLA_PROFESORES . " WHERE id=" + $item['id'];
            }
        }
        break;
    case MOSTRAR_ALUMNO_COMUNICACION:
        $alumno = new Alumno($id);
        $Comunicaciones = array();
        $rsAlumno = mysqli_query($conn, "SELECT * from " . TABLA_ALUMNO . " WHERE id= " . $alumno->id);
        if ($rsAlumno) {
            $filaAlumno = mysqli_fetch_assoc($rsAlumno);
            $alumno->nombre = $filaAlumno["nombre"] . " " . $filaAlumno["apellidos"];
            //CURSOS
            $rsCurso = mysqli_query($conn, "SELECT * from " . TABLA_CURSOS . " WHERE id= " . $filaAlumno["cursos"]);
            $filaCurso = mysqli_fetch_assoc($rsCurso);
            $alumno->curso = $filaCurso["curso"];
            //TUTORIAS
            $rsTutor = mysqli_query($conn, "SELECT * from " . TABLA_TUTORIAS . " WHERE idCurso= " . $filaAlumno["cursos"]);
            $filaTutor = mysqli_fetch_assoc($rsTutor);
            $colTutor = mysqli_num_rows($rsTutor);
            //Entra en el bucle
            if ($colTutor > 0) {
                $rsProfesor = mysqli_query($conn, "SELECT * from " . TABLA_PROFESORES . " WHERE id= " . $filaTutor["idProfesor"]);
                if ($rsProfesor) {
                    $filaProfesor = mysqli_fetch_assoc($rsProfesor);
                    $alumno->tutor = $filaProfesor["nombre"] . " " . $filaProfesor["apellidos"];
                    $alumno->horatutoria = $filaTutor["texto"];
                }
            }
        }
        $rsComunicaciones = mysqli_query($conn, "SELECT * from " . TABLA_COMUNICACIONES . " WHERE curso= '" . $filaAlumno["cursos"] . "'order by fecha desc;");
        $filaComunicaciones = mysqli_fetch_assoc($rsComunicaciones);
        $colComunicaciones = mysqli_num_rows($rsComunicaciones);
        $rsComunicacionesesp = mysqli_query($conn, "SELECT * from " . TABLA_COMUNICACIONESP . " WHERE alumno= '" . $alumno->id . "'order by fecha desc;");
        $filaComunicacionesesp = mysqli_fetch_assoc($rsComunicaciones);
        $colComunicacionesp = mysqli_num_rows($rsComunicaciones);
        while ($filaComunicaciones = mysqli_fetch_assoc($rsComunicaciones)) {
            $matriz[] = $filaComunicaciones["id"];
        }
        if ($colComunicaciones > 0 && $colComunicacionesp == 0) {
            $matrizFinal = $matriz;
        } elseif ($colComunicacionesp > 0 && $colComunicaciones == 0) {
            $matrizFinal = $matrizp;
        }
        $cuenta = count($matriz);
        if ($cuenta > 0) {
            for ($i = 0; $i < $cuenta; $i++) {
                $st = strlen($matriz[$i]);
                $detectar = substr($matriz[$i], $st - 1, 1);
                if ($detectar != "p") {
                    $rsW = mysqli_query($conn, "select * from comunicaciones where id='" . $matriz[$i] . "';");
                    $filaW = mysqli_fetch_assoc($rsW);
                    $colA = mysqli_num_rows($rsW);
                    if ($colA > 0) {

                        $rsA = mysqli_query($conn, "select * from comunicaciones where id='" . $matriz[$i] . "';");
                        $filaA = mysqli_fetch_assoc($rsA);
                        $comunicacion = new Comunicacion($filaA["id"]);
                        $comunicacion->fecha = $filaA["fecha"];
                        $comunicacion->materia = $filaA["materia"];


                        //$comunicacion->asignatura = $filaA["asignatura"];

                        $comunicacion->url = "https://colegioatenea.es/zona-padres/zona-padres-2/comunicaciones-ampliada-padre?nm=" . $matriz[$i];
                        $comunicacion->titulo = $filaA["titulo"];
                        $comunicacion->profesor = $filaAlumno["nombre"] . " " . $filaAlumno["apellidos"];
                        $Comunicaciones[] = $comunicacion;
                    }
                }
            }
        }
        echo json_encode($Comunicaciones, JSON_FORCE_OBJECT);
        break;
    case '':
        break;
}


//Imprimo la variable con el array codificado y con el null, según sea el caso.
if (isset($sql)) {
    //Realizo la consulta
    $rs = mysqli_query($conn, $sql);

    //Creo un array, el nombre va a tu gusto.
    $array = array();

    //Pregunto si la consulta es correcta.
    if ($rs) {
        //Hago ciclo "mientras" para obtener los datos "mientras" la consulta exista, importante que sea por assoc, ya que solo te devuelve una forma de parametro
        while ($fila = mysqli_fetch_assoc($rs)) {
            //Guardo los resultados mapeados en el array creado
            //$item = $fila;
            //$json = json_encode($item);
            //$array[] = array_map('utf8_encode', $fila);
            $array[] = $fila;
        }
        //Codifico el array anterior en una variable para que lo retorne
        $res = json_encode($array, JSON_NUMERIC_CHECK);
    } else {
        //Si la consulta no se hizo me retorna la variable como null
        $res = null;
        echo mysqli_error($conn);
    }
    //Cierro la consulta
    mysqli_close($conn);
    //Hago que el archivo PHP (si lo necesito abrir para hacer pruebas) me lo devuelva como json
    echo $res;
}
//Cierro la consulta
mysqli_close($conn);
