<?php
session_start();
require_once '../admin/class/bd.php';
$bd=new bd();

$curso=$_POST["grupos"];

$make=$bd->query("select * from horarios where tipo='curso' and idCurso='".$curso."';");
$fila=$bd->fil($make);
$cols=$bd->col($make);
$id=$fila["id"];
$dir="../admin/archivos/horariosCursos/".$id;
if(is_dir($dir)){
    $open=opendir($dir);
    while($archivo=readdir($open)){
        if($archivo!="." && $archivo!=".."){
            $ar=$archivo;
        }
    }
}
$ruta="../admin/archivos/horariosCursos/".$id."/".$ar;
header("Location:".$ruta);

?>
