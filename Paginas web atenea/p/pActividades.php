<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';
require_once 'admin/class/fecha.php';
require_once 'admin/class/lectivo.php';
$bd=new bd();

if(!isset($_GET["l"])){
    $gf=date("Y-m-d");
    $lectivo=lectivo($gf);
}else{
    $lectivo=$_GET["l"];
}
//paginacion
$variante=5;
if(!isset($_GET["p"]) || $_GET["p"]==1){
    $page=1;
    $limiteInferior=0;
}else{
    $page=$_GET["p"];
    $limiteInferior=($page-1)*$variante;
}
$limiteSuperior=$limiteInferior+$variante;

$estaPage=$_SERVER["PHP_SELF"];
if(isset($_GET["m"])){
    $mesActual=$_GET["m"];
}else{
    $mesActual=date("n");
}

$anyoActual=date("Y");
$test="select * from actividades where lectivo='".$lectivo."' and month(fecha)=".$mesActual." order by fecha desc limit ".$limiteInferior.",".$limiteSuperior.";";
$make=$bd->query("select * from actividades where lectivo='".$lectivo."' and month(fecha)=".$mesActual." order by fecha desc limit ".$limiteInferior.",".$limiteSuperior.";");
$fila=$bd->fil($make);
$col=$bd->col($make);

// motor de contenido
if($col>0){
    $makeTotal=$bd->query("select * from actividades where lectivo='".$lectivo."' and month(fecha)=".$mesActual.";");
    $colTotal=$bd->col($makeTotal);
    $numeroPaginasDouble=$colTotal/$variante;
    $resto=$colTotal%$variante;
    if($resto!=0){
        $numeroPaginas=((int)$numeroPaginasDouble)+1;
    }else{
        $numeroPaginas=((int)$numeroPaginasDouble);
    }

    do{
        $directorio="admin/imagenesActividades/".$fila["id"];
        $salida.="<div class=\"bloque_A\">\n";
        $f=new fecha($fila["fecha"]);
        $fff=$f->barraInvertida();
        if(is_dir($directorio)){
                    
            $salida.="<div class=\"fotos\">\n";
            $open=opendir($directorio);
            while($imagen=readdir($open)){
                if($imagen!="." && $imagen!=".."){
                    $rutaImagen=$directorio."/".$imagen;
                    $img=new imagenes($rutaImagen, 188,188);
                    $img->altoFijo();
                    $alto=$img->alto();
                    $ancho=$img->ancho();
                    $salida.="<a href=\"".$rutaImagen."\" target=\"_blank\" >
                        <img src=\"".$rutaImagen."\" width=\"".$ancho."\" height=\"".$alto."\" alt=\"Colegio Docente Atenea\" border=\"0\" /></a>\n";

                }
            }
            $salida.="</div>\n";
        }else{
             $salida.="<div class=\"fotos\">\n<a href=\"".$rutaImagen."\" target=\"_blank\" >
                        <img src=\"imagenes/sin-foto.gif\" alt=\"Colegio Docente Atenea\" border=\"0\" /></a></div>\n";
        }
        $salida.="<div class=\"fecha_publi2\">".$fff."</div>\n";
        $salida.="<div class=\"txt_general2\">\n";



        $gf23=date("Y-m-d");
        $lectivo23=lectivo($gf23);
        $makeLectivos3=$bd->query("select * from actividades where lectivo!='".$lectivo."';");
        $filaLectivos3=$bd->fil($makeLectivos3);
        $colLectivos3=$bd->col($makeLectivos3);
        if($colLectivos3>0){
            do{
                if(!$d3){
                    $mmm3=$bd->query("select month('".$filaLectivos3["fecha"]."');");
                    $ffff3=$bd->fil($mmm3);
                    $ttt3=$ffff3["month('".$filaLectivos3["fecha"]."')"];
                    $d3=false;
                }
            }while($filaLectivos3=$bd->fil($makeLectivos3));
        }

        $medida=strlen($fila["descripcion"]);
        if($medida>200){

            $cade=substr(strip_tags($fila["descripcion"]),0,200);
            $cade.="...<a href=\"actividad_unitaria.php?nm=".$fila["id"]."&l=".$lectivo."&m=".$ttt3."\" title=\"Más acerca de esta actividad\">+info</a>\n";
        }else{
            $cade=strip_tags($fila["descripcion"])." &nbsp;<a href=\"actividad_unitaria.php?nm=".$fila["id"]."&l=".$lectivo."&m=".$ttt3."\" title=\"Más acerca de esta actividad\">+info</a>\n";
        }
        $salida.="<h2>".$cade."</h2>\n";
        $salida.="</div>\n";
        if($fila["enlace"]!=""){
            $salida.="<div class=\"enlaces\"><a href=\"".$fila["enlace"]."\" target=\"_blank\">Enlace Web</a>
</div>\n";
            $ss2="&mdash;";
        }else{
            $ss2="";
        }
        $dir2="admin/archivosActividades/".$fila["id"];
        if(is_dir($dir2)){
            $open2=opendir($dir2);
            while($arar=readdir($open2)){
                if($arar!="." && $arar!=".."){
                    $trtr=$arar;
                }
            }
            $tutu=$dir2."/".$trtr;
            $salida.="<div class=\"enlaces\"><a href=\"".$tutu."\" target=\"_blank\">".$ss2."Descargar documento</a>
</div>\n";
        }
        $salida.="</div>\n";
    }while($fila=$bd->fil($make));
}
if($numeroPaginas>1){
    $siguiente=$page+1;
    $anterior=$page-1;
    if($page>1){
        $ant="<a href=\"".$estaPage."?m=".$mesActual."&l=".$lectivo."&p=".$anterior."\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    }else{
        $ant="";
    }
    $paginacion="<div class=\"paginacion\">".$ant."Pág. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
    if($page<$numeroPaginas){
        $paginacion.="<a href=\"".$estaPage."?m=".$mesActual."&l=".$lectivo."&p=".$siguiente."\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    }else{
        $paginacion.="</div>\n";
    }
}else{
    $paginacion="";
}
//años lectivos;
$gf2=date("Y-m-d");
$lectivo2=lectivo($gf2);
$makeLectivos=$bd->query("select * from actividades where lectivo!='".$lectivo."';");
$filaLectivos=$bd->fil($makeLectivos);
$colLectivos=$bd->col($makeLectivos);
if($colLectivos>0){
    $ll.="<div class=\"espaciador\"></div>\n";
    $ll.=" <div class=\"colum_drcha_actividades\">AÑOS anteriores</div>\n";
    do{
        if(!$d){
            $mmm=$bd->query("select month('".$filaLectivos["fecha"]."');");
            $ffff=$bd->fil($mmm);
            $ttt=$ffff["month('".$filaLectivos["fecha"]."')"];
            $d=false;
        }
        $matrizLectivos[]=$filaLectivos["lectivo"];
    }while($filaLectivos=$bd->fil($makeLectivos));
    $arrayLectivos=array_unique($matrizLectivos);
    foreach ($arrayLectivos as $dato){
        $ll.="<div class=\"cab_columndrcha\"><a href=\"".$estaPage."?p=".$page."&l=".$dato."&m=".$ttt."\" target=\"_parent\">Año Académico ".$dato."</a></div>\n";
    }
}
//listado meses
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
    $cont="select * from actividades where month(fecha)='".$mesHoy."' and lectivo='".$lectivo."';";
    //echo $cont."\n";
    $makeMes=$bd->query("select * from actividades where month(fecha)='".$mesHoy."' and lectivo='".$lectivo."';");
    $filaMes=$bd->fil($makeMes);
    $colMes=$bd->col($makeMes);
    if($colMes>0){
        switch($mesHoy){
            case "1":
                $mes="Enero";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[4]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "2":
                $mes="Febrero";
               $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[5].="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "3":
                $mes="Marzo";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[6]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "4":
                $mes="Abril";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[7]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "5":
                $mes="Mayo";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[8]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "6":
                $mes="Junio";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[9]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "7":
                $mes="Julio";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[10]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "8":
                $mes="Agosto";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[11]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "9":
                $mes="Septiembre";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[0]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "10":
                $mes="Octubre";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[1]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "11":
                $mes="Noviembre";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[2]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
            case "12":
                $mes="Diciembre";
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $matrizMes[3]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$estaPage."?m=".$mesHoy."&l=".$lectivo."\" target=\"_parent\">&nbsp;".$mes."</a></div>\n";
                break;
        }
    }
    $mesHoy++;
}
for($t=11;$t>=0;$t--){
    $sal.=$matrizMes[$t];
}
?>
