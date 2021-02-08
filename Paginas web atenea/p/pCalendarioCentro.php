<?php

require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/fecha.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

$salida="";
$estaPage=$_SERVER["PHP_SELF"];

if(isset($_GET["mes"])){
    $mesActual=$_GET["mes"];
}else{
    $mesActual=date("n");
}
$anyoActual=date("Y");

if($mesActual>=9 && $mesActual<=12){
    $anyoActual=date("Y");
}elseif($mesActual<9){
    $anyoActual=date("Y");
}

if(!isset($_GET["anio"]) || $_GET["anio"]=="" ){
    $anyoActual=date("Y");
}else{
    $anyoActual=$_GET["anio"];
}

$consulta="select * from agenda where tipo='centro' and month(fecha)=".$mesActual." and year(fecha)=".$anyoActual." order by fecha asc;";
$make=$bd->query($consulta);
$fila=$bd->fil($make);
$col=$bd->col($make);

if($col>0){
    do{
        $f=new fecha($fila["fecha"]);
        $fecha=$f->textoCompleto();
        $salida.="<div class=\"bloque_A2\">\n";
        $salida.="<div class=\"fechatitulo\">".$fecha."</div>\n";
        $salida.="<div><h2>".$fila["descripcion"]."</h2></div>\n";
         $salida.="<hr width='20%'>\n";
        $salida.="</div>\n";
    }while($fila=$bd->fil($make));
}
/////////////////////////////////////////////////////////////////////////////////////////////
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
    $makeMes=$bd->query("select * from agenda where tipo='centro' and month(fecha)='".$mesHoy."' order by fecha asc;");
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[4]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[5]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[6]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[7]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[8]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[9]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[10]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[11]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[0]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[1]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[2]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
                    ),'https://colegioatenea.es/zona-padres/calendario-del-centro/'));
                    
                $matrizMes[3]="<div class=\"enlaces_drcha\">&#8226;<a href=\"".$val."\" target=\"_parent\" style='color:white;'>&nbsp;".$mes." ".$anyo."</a></div>\n";
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
$bd->liberar($make);
?>
