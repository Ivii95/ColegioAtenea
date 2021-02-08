<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/fecha.php';
$bd=new bd();

$make=$bd->query("select * from noticias order by fecha desc limit 0,5;");
$fila=$bd->fil($make);
$cols=$bd->col($make);
if($cols>0){
    do{
        $f=new fecha($fila["fecha"]);
        $fff=$f->barraInvertida();
        $salida.="<div class=\"fecha_news\">".$fff."</div> \n";
        $texto=strip_tags($fila["descripcion"]);
        $cantidad=strlen($texto);
        if($cantidad>80){
            $t=substr($texto,0,77)."...";
        }else{
            $t=$fila["descripcion"];
        }
        $salida.=" <div class=\"news\"><h2><a href=\"noticia_unitaria.php?nm=".$fila["id"]."\" target=\"_parent\">".$t."</a></h2></div>\n";
    }while($fila=$bd->fil($make));
}

?>
