<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/fecha.php';
require_once 'admin/class/escalarImagenes.php';
$bd=new bd();

$mesActual=$_GET["m"];
$aaa=$_GET["a"];
$estaPage=$_SERVER["PHP_SELF"];

//paginacion
$variante=5;
if(!isset($_GET["p"]) || $_GET["p"]==1){
    $page=1;
    $limiteInferior=0;
}else{
    $page=$_GET["p"];
    $limiteInferior=($page-1)*$variante;
}
$limiteSuperior=$variante;
/////////////////////////////////////////////////////////

$make=$bd->query("select * from publicaciones where categoria='profesor' and month(fecha)='".$mesActual."' and year(fecha)='".$aaa."' order by fecha asc limit ".$limiteInferior.",".$limiteSuperior.";");
$fila=$bd->fil($make);
$cols=$bd->col($make);

$makeTotal=$bd->query("select * from publicaciones where categoria='profesor' and month(fecha)='".$mesActual."'  and year(fecha)='".$aaa."' order by fecha asc;");
$filaTotal=$bd->fil($makeTotal);
$colsTotal=$bd->col($makeTotal);

//numero de paginas
$numeroPaginasDouble=$colsTotal/$variante;
$resto=$colsTotal%$variante;
if($resto!=0){
    $numeroPaginas=((int)$numeroPaginasDouble)+1;
}else{
    $numeroPaginas=((int)$numeroPaginasDouble);
}
//////////////////////////////////////////////////////

if($cols>0){ //si existen publicaciones de este mes...
    do{
        $fecha="";
        $link="";
        $web="";
        $f=new fecha($fila["fecha"]);
        $fecha=$f->barraInvertida();
        //archivo
        $dira="admin/archivosPubli/profesor/".$fila["id"];
        if(is_dir($dira)){
            $opena=opendir($dira);
            while($ar=readdir($opena)){
                if($ar!="." && $ar!=".."){
                    $archivo=$ar;
                }
            }
            $rutaArchivo=$dira."/".$archivo;
            $rr="<a href=\"".$rutaArchivo."\" target=\"_blank\">Descargar documento</a><br />\n";
        }else{
            $rr="";
        }
        $dira2="admin/imagenesPubli/profesor/".$fila["id"];
        if(is_dir($dira2)){
            $opena2=opendir($dira2);
            while($ar2=readdir($opena2)){
                if($ar2!="." && $ar2!=".."){
                    $archivo2=$ar2;
                }
            }
            $rutaArchivo2=$dira2."/".$archivo2;
            $imgPadre=new imagenes($rutaArchivo2, 188, 188);
            $imgPadre->altoFijo();
            $anchop=$imgPadre->ancho();
            $rr2="<div class=\"fotos_rincon\"><a href=\"".$rutaArchivo2."\" oncopy=\"alert('Opcion deshabilitada');return false\" oncontextmenu=\"alert('Opcion deshabilitada');return false\" target=\"_blank\" title=\"Imagen de la publicación\"><img src=\"".$rutaArchivo2."\" border=\"0\" title=\"Imagen de la publicación\" alt=\"Imagen de la publicación\" width=\"".$anchop."\"/></a></div>\n";
        }else{
            $rr2="<div class=\"fotos_rincon\"><img src=\"imagenes/sin_foto.gif\" border=\"0\" title=\"Imagen no disponible\" alt=\"Imagen no disponible\" width=\"188\" /></div>\n";
        }
        //enlace
        if($fila["enlaces"]!=""){
            $enlace="<a href=\"".$fila["enlaces"]."\" target=\"_blank\">Enlace web</a>\n";
        }else{
            $enlace="";
        }
        $salida.="<div class=\"bloque_A\">\n";
        $salida.=$rr2;
        $salida.="<div class=\"fecha_publi2\">".$fecha."</div>\n";
        $salida.="<div class=\"publica_rincon\">Publicado por: <strong>".$fila["autor"]."</strong> </div>\n";
        $salida.="<div class=\"txt_general2\"><h2>".$fila["descripcion"]."</h2></div>\n";
        $salida.="<div class=\"enlaces\">\n";
        $salida.=$rr;        
        $salida.=$enlace;
        $salida.="</div>\n";
        $salida.="</div>\n";
    }while($fila=$bd->fil($make));
}
//paginaciones
if($numeroPaginas>1){
    $siguiente=$page+1;
    $anterior=$page-1;
    if($page>1){
        $ant="<a href=\"".$estaPage."?p=".$anterior."&m=".$mesActual."&a=".$_GET["a"]."\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    }else{
        $ant="";
    }
    $paginacion="<div class=\"paginacion\">".$ant."Pág. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
    if($page<$numeroPaginas){
        $paginacion.="<a href=\"".$estaPage."?p=".$siguiente."&m=".$mesActual."&a=".$_GET["a"]."\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    }else{
        $paginacion.="</div>\n";
    }
}else{
    $paginacion="";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//$indice=10;
//
//for($p=0;$p<$indice;$p++){
//    $t=$p+1;
//    if($p==0){
//        $repre=" and fecha>=(date_sub(curdate(),interval ".$t." month))";
//
//        $repre2="";
//    }else{
//        $repre=" and fecha>=(date_sub(curdate(),interval ".$t." month))";
//        $repre2=" and fecha<=(date_sub(curdate(),interval ".$p." month))";
//
//    }
//    $cons="select * from publicaciones where categoria='profesor' ".$repre2."".$repre.";";
//    echo $cons."<br/>";
//    $makeFecha=$bd->query($cons);
//    $filaFecha=$bd->fil($makeFecha);
//    $colsFecha=$bd->col($makeFecha);
//    echo $colsFecha;
//    if($colsFecha>0){
//        $makeMes=$bd->query("select month('".$filaFecha["fecha"]."');");
//        $filaMes=$bd->fil($makeMes);
//        $colsMes=$bd->col($makeMes);
//        $mesMes=$filaMes["month('".$filaFecha["fecha"]."')"];
//
//        switch($mesMes){
//            case "1":
//                $mes="Enero";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//                $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "2":
//                $mes="Febrero";
//               $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "3":
//                $mes="Marzo";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "4":
//                $mes="Abril";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "5":
//                $mes="Mayo";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "6":
//                $mes="Junio";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//              $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "7":
//                $mes="Julio";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "8":
//                $mes="Agosto";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "9":
//                $mes="Septiembre";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "10":
//                $mes="Octubre";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//               $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "11":
//                $mes="Noviembre";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//              $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//            case "12":
//                $mes="Diciembre";
//                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
//                $filaa=$bd->fil($makea);
//                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
//             $sali[]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesMes."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
//                break;
//        }
//        $ret=array_unique($sali);
//    foreach($ret as $dato){
//        $sal.=$dato;
//    }
//    }
//
//}
//listado de meses
$mesHoy=date("n");
$tt=date("n");
if($mesHoy<=12 && $mesHoy>=9){
    $resto=(12-$mesHoy)+8;
}else{
    $resto=8-$mesHoy;
}
for($i=0;$i<12;$i++){
    if($mesHoy>12){
        $mesHoy=1;
    }
    $makeMes=$bd->query("select * from publicaciones where categoria='profesor' and month(fecha)='".$mesHoy."' order by fecha asc;");
    $filaMes=$bd->fil($makeMes);
    $colMes=$bd->col($makeMes);
    if($colMes>0){
        switch($mesHoy){
            case "1":
                $mes="Enero";
                $matrizMes[4]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[4]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "2":
                $mes="Febrero";
                $matrizMes[5]=$mes;
               $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[5]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "3":
                $mes="Marzo";
                $matrizMes[6]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[6]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "4":
                $mes="Abril";
                $matrizMes[7]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[7]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "5":
                $mes="Mayo";
                $matrizMes[8]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[8]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "6":
                $mes="Junio";
                $matrizMes[9]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[9]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "7":
                $mes="Julio";
                $matrizMes[10]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[10]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "8":
                $mes="Agosto";
                $matrizMes[11]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[11]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "9":
                $mes="Septiembre";
                $matrizMes[0]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[0]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "10":
                $mes="Octubre";
                $matrizMes[1]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[1]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "11":
                $mes="Noviembre";
                $matrizMes[2]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[2]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
            case "12":
                $mes="Diciembre";
                $matrizMes[3]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[3]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&a=".$anyo."\" target=\"_parent\">&nbsp;".$mes." ".$anyo."</a></div>\n";
                break;
        }
    }
    $mesHoy++;
}
for($t=11;$t>=0;$t--){
    $sal.=$matrizMes[$t];
}
?>
