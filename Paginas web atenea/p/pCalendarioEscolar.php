<?php
session_start();
require_once 'admin/class/bd.php';
require_once 'admin/class/escalarImagenes.php';

$rutaImagen="admin/imagenes/agendaEscolar";
$hayImagen=false;
if(is_dir($rutaImagen)){
    $openi=opendir($rutaImagen);
    while($i=readdir($openi)){
        if($i!="." && $i!=".."){
            $archivoImagen=$i;
            $hayImagen=true;
        }
    }
}
$imagen=$rutaImagen."/".$archivoImagen;
$img=new imagenes($imagen, 411, 500);
$img->altoFijo();
$ancho=$img->ancho();
$alto=$img->alto();

$rutaPdf="admin/archivos/agendaEscolar";
$hayPdf=false;
if(is_dir($rutaPdf)){
    $openp=opendir($rutaPdf);
    while($p=readdir($openp)){
        if($p!="." && $p!=".."){
            $archivoPdf=$p;
            $hayPdf=true;
        }
    }
}
$pdf=$rutaPdf."/".$archivoPdf;
?>
