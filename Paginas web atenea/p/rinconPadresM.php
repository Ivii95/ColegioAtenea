<?php
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

$mesActual=$_GET["mes"];
$aaa=$_GET["anio"];
$estaPage=$_SERVER["PHP_SELF"];

$salida="";

//paginacion
$variante=5;
if(!isset($_GET["pagi"]) || $_GET["pagi"]==1){
    $page=1;
    $limiteInferior=0;
}else{
    $page=$_GET["pagi"];
    $limiteInferior=($page-1)*$variante;
}
$limiteSuperior=$variante;
/////////////////////////////////////////////////////////

$make=$bd->query("select * from publicaciones where categoria='padre' and month(fecha)='".$mesActual."' and year(fecha)='".$aaa."' order by fecha desc limit ".$limiteInferior.",".$limiteSuperior.";");
$fila=mysqli_fetch_assoc($make);
$cols=mysqli_num_rows($make);

$makeTotal=$bd->query("select * from publicaciones where categoria='padre' and month(fecha)='".$mesActual."'  and year(fecha)='".$aaa."' order by fecha desc;");
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
        
        //ARCHIVO
        $dira="atenea/admin/archivosPubli/padre/".$fila["id"];
        if(is_dir($dira)){
            $opena=opendir($dira);
            while($ar=readdir($opena)){
                if($ar!="." && $ar!=".."){
                    $archivo=$ar;
                }
            }
            $rutaArchivo=$dira."/".$archivo;
            $rr="<a href=\"https://colegioatenea.es/".$rutaArchivo."\" target=\"_blank\">Descargar documento</a><br />\n";
        }else{
            $rr="";
        }
        
        //IMAGEN
        $dira2="atenea/admin/imagenesPubli/padre/".$fila["id"];
       
   
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
            $rr2="<div class=\"fotos_rincon\"><a href=\"https://colegioatenea.es/".$rutaArchivo2."\" target=\"_blank\" title=\"Imagen de la publicación\"><img src=\"https://colegioatenea.es/".$rutaArchivo2."\" title=\"Imagen de la publicación\" border=\"0\" alt=\"Imagen de la publicación\" width=\"".$anchop."\"/></a></div>\n";
        }else{
            $rr2="<div class=\"fotos_rincon\"><img src=\"https://colegioatenea.es/atenea/imagenes/sin_foto.gif\" border=\"0\" title=\"Imagen no disponible\" alt=\"Imagen no disponible\" width=\"188\" /></div>\n";
        }
        
        //ENLACE
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
         $salida.="<hr style = 'border: solid 2px #6a3f48; background-color: #6a3f48;'>";
    }while($fila=mysqli_fetch_assoc($make));
}
//paginaciones
if($numeroPaginas>1){
    $siguiente=$page+1;
    $anterior=$page-1;
    if($page>1){
         $val= esc_url( add_query_arg(array(
                    'pagi' => $anterior
                    ),'https://colegioatenea.es/zona-padres/comunicaciones-y-circulares/'));
                    
        $ant="<a href=\"".$val."\" target=\"_parent\">&laquo;Anterior&nbsp;</a>";
    }else{
        $ant="";
    }
    $paginacion="<div class=\"paginacion\">".$ant."P��g. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
    if($page<$numeroPaginas){
        $val= esc_url( add_query_arg(array(
                    'pagi' => $siguiente
                    ),'https://colegioatenea.es/zona-padres/comunicaciones-y-circulares/'));
                    
        $paginacion.="<a href=\"".$val."\" target=\"_parent\">Siguiente&raquo;</a></div>\n";
    }else{
        $paginacion.="</div>\n";
    }
}else{
    $paginacion="";
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
$indice=10;
for($p=0;$p<$indice;$p++){
    $t=$p+1;
    if($p==0){
        $repre=" and fecha>=(date_sub(curdate(),interval ".$t." month))";
        $repre2="";
    }else{
        $repre=" and fecha>=(date_sub(curdate(),interval ".$t." month))";
        $repre2=" and fecha<=(date_sub(curdate(),interval ".$p." month))";
    }
    $cons="select * from publicaciones where categoria='padre' ".$repre2."".$repre.";";
    $makeFecha=$bd->query($cons);
    $filaFecha=$bd->fil($makeFecha);
    $colsFecha=$bd->col($makeFecha);

    if($colsFecha>0){
        $makeMes=$bd->query("select month('".$filaFecha["fecha"]."');");
        $filaMes=$bd->fil($makeMes);
        $colsMes=$bd->col($makeMes);
        $mesMes=$filaMes["month('".$filaFecha["fecha"]."')"];
        
        switch($mesMes){
            case "1":
                $mes="Enero";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "2":
                $mes="Febrero";
               $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "3":
                $mes="Marzo";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "4":
                $mes="Abril";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>"; 
                break;
            case "5":
                $mes="Mayo";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
              $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "6":
                $mes="Junio";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "7":
                $mes="Julio";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "8":
                $mes="Agosto";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "9":
                $mes="Septiembre";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "10":
                $mes="Octubre";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "11":
                $mes="Noviembre";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "12":
                $mes="Diciembre";
                $makea=$bd->query("select extract(year from '".$filaFecha["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaFecha["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesMes,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $sali[]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
        }
        
    }
}
$ret=array_unique($sali);

$sal="";
foreach($ret as $dato){
    $sal.=$dato;
}
?>
