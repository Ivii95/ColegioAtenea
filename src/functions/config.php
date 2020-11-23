<?php
//Uso un header para tener permiso a acceder a los archivos
header("Access-Control-Allow-Origin: *");

//Realizo función de conexión a la base de datos
function conecta_db(){
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $db = "platziVideo";

    $conn = mysqli_connect($servidor, $usuario, $clave, $db);

    if(mysqli_connect_errno()){
        echo mysqli_connect_error();
        exit(0);
    }

    return $conn;
}

//Obtengo la opción que elegí cuando hago el llamado en React-Native, puedes usar un "isset" si fuera el caso
$opcion = $_GET["opcion"];

//Uso la función de conexión
$conn = conecta_db();

//Realizo un switch, ya que como en mi caso necesitare varias opciones de búsqueda; esto, depende de la variable opción.
switch($opcion){
    case 1:
        $sql = "SELECT * from movie";
    break;
}

//Realizo la consulta
$rs = mysqli_query($conn, $sql);

//Creo un array, el nombre va a tu gusto.
$array = array();

//Pregunto si la consulta es correcta.
if($rs){
	//Hago ciclo "mientras" para obtener los datos ""mientras" la consulta exista, importante que sea por assoc, ya que solo te devuelve una forma de parametro
    while($fila = mysqli_fetch_assoc($rs)){
        //Guardo los resultados mapeados en el array creado
        $array[] = array_map('utf8_encode', $fila);
    }
	//Codifico el array anterior en una variable para que lo retorne
    $res = json_encode($array, JSON_NUMERIC_CHECK);
}else{
	//Si la consulta no se hizo me retorna la variable como null
    $res = null;
    echo mysqli_error($conn);
}

//Cierro la consulta
mysqli_close($conn);

//Hago que el archivo PHP (si lo necesito abrir para hacer pruebas) me lo devuelva como json
header('Content-Type: application/json');

//Imprimo la variable con el array codificado y con el null, según sea el caso.
echo $res;
