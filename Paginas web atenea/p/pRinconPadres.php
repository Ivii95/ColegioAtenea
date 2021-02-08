<?php
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/escalarImagenes.php';

$bd=new bd();

$bd->query("SET NAMES 'utf8'");

$mesActual=date("n");

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

$anyoActual=date("Y");

//$test="select * from publicaciones where lectivo='".$lectivo."' and month(fecha)=".$mesActual." order by fecha desc limit ".$limiteInferior.",".$limiteSuperior.";";

$make=$bd->query("select * from publicaciones where categoria='padre' and month(fecha)='".$mesActual."' and year(fecha)='".$anyoActual."' order by fecha desc limit ".$limiteInferior.",".$limiteSuperior.";");
$fila=mysqli_fetch_assoc($make);
$cols=mysqli_num_rows($make);



$makeTotal=$bd->query("select * from publicaciones where categoria='padre' and month(fecha)='".$mesActual."' and year(fecha)='".$anyoActual."' order by fecha desc;");
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
            $rr2="<div class=\"fotos_rincon\"><img src=\"https://colegioatenea.es/atenea/imagenes/sin_foto.gif\" title=\"Imagen no disponible\" alt=\"Imagen no disponible\" width=\"188\" /></div>\n";
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
        $salida.="<div><h2>".$fila["descripcion"]."</h2></div>\n";
        $salida.="<div class=\"enlaces\">\n";
        $salida.=$rr;
        $salida.=$enlace;
        $salida.="</div>\n";
        $salida.="</div>\n";
         $salida.="<hr style = 'border: solid 2px #6a3f48; background-color: #6a3f48;'>";
    }while($fila=mysqli_fetch_assoc($make));
}else{
    $salida="Aún no hay comunicaciones en este mes";
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
    $paginacion="<div class=\"paginacion\">".$ant."Pág. ".$page." / ".$numeroPaginas."&nbsp;&nbsp;";
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





















////////////////////////////////////////COLUMNA DEL RINCON DE PADRES///////////////////////////////////////








$mesHoy=date("n");
$tt=date("n");
$anyoHOY=date("Y");

if($mesHoy<=12 && $mesHoy>=9){
    $resto=(12-$mesHoy)+8;
}else{
    $resto=8-$mesHoy;
}

for($i=0;$i<12;$i++){
	
    if($mesHoy>12){
        $mesHoy=1;
    }
	
    if(isset($_GET["t"])&&$_GET["t"]=="1"){echo $mesHoy."*";}
	
    $makeMes=$bd->query("select * from publicaciones where categoria='padre' and month(fecha)='".$mesHoy."' order by fecha desc;");
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
                  $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[4]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "2":
                $mes="Febrero";
                $matrizMes[5]=$mes;
               $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                  $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[5]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "3":
                $mes="Marzo";
                $matrizMes[6]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[6]="<div>&#8226;<a  style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "4":
                $mes="Abril";
                $matrizMes[7]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[7]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "5":
                $mes="Mayo";
                $matrizMes[8]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                  $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[8]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "6":
                $mes="Junio";
                $matrizMes[9]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[9]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "7":
                $mes="Julio";
                $matrizMes[10]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                  $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[10]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "8":
                $mes="Agosto";
                $matrizMes[11]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[11]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
             
                break;
            case "9":
                $mes="Septiembre";
                $matrizMes[0]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[0]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "10":
                $mes="Octubre";
                $matrizMes[1]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[1]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "11":
                $mes="Noviembre";
                $matrizMes[2]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                 $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[2]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
            case "12":
                $mes="Diciembre";
                $matrizMes[3]=$mes;
                $makea=$bd->query("select extract(year from '".$filaMes["fecha"]."');");
                $filaa=$bd->fil($makea);
                $anyo=$filaa["extract(year from '".$filaMes["fecha"]."')"];
                  $val= esc_url( add_query_arg(array(
                    'mes' => $mesHoy,
                    'anio' => $anyo,
                    ),'https://colegioatenea.es/comunicaciones-y-circulares/'));
                    
                $matrizMes[3]="<div>&#8226;<a style='color:white;' href=\"".$val."\" > &nbsp;".$mes." ".$anyo." </a></div>";
                break;
        }

    }
    $mesHoy++;
}


$sal="";
for($t=11;$t>=0;$t--){
    if(isset($matrizMes[$t])){
        $sal.=$matrizMes[$t];
    }
    
}
?>
