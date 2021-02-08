<?php
session_start();
require_once 'admin/class/bd.php';
$bd=new bd();


if(!isset($_GET["tutor"])){
    $make=$bd->query("select * from horarios where idProfesor='".$_SESSION["id"]."' and tipo='profesor';");
    $fila=$bd->fil($make);
    $cols=$bd->col($make);

    $make2=$bd->query("select * from horarios where idProfesor='".$_SESSION["id"]."' and tipo='profesor-curso';");
    $fila2=$bd->fil($make2);
    $cols2=$bd->col($make2);

    $sel.="<form id=\"frm\" name=\"frm\" action=\"p/pHorarioProfesor.php\" method=\"post\">\n";
    $sel.="<select id=\"horario\" name=\"horario\">\n";
    $sel.="<option value=\"0\">Seleccionar tipo de horario</option>\n";
    $dir1="admin/archivos/horariosProfesor/".$fila["id"];
    if(is_dir($dir1)){
        $sel.="<option value=\"1\">Horario profesor</option>\n";
    }
    $sel.="<option value=\"2\">Horario grupo</option>\n";
    $dir2="admin/archivos/horariosProfesorCurso/".$fila2["id"];
    if(is_dir($dir2)){
        $sel.="<option value=\"3\">Horario profesor y su grupo</option>\n";
    }
    
    $sel.="</select>\n";
    $sel.="<label>\n";
    $sel.="<input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n";
    $sel.="</label>\n";
    $sel.="</form>\n";
}else{
    $make=$bd->query("select * from horarios where idProfesor='".$_SESSION["id"]."' and tipo='profesor-curso';");
    $fila=$bd->fil($make);
    $cols=$bd->col($make);

    $sel.="<form id=\"frm\" name=\"frm\" action=\"p/pHorarioProfesor.php\" method=\"post\">\n";
    $sel.="<select id=\"horarioTutor\" name=\"horarioTutor\">\n";
    $sel.="<option value=\"0\">Seleccionar curso de tutoria</option>\n";
    do{
        $makeQ=$bd->query("select * from horarios where tipo='profesor-curso' and idProfesor='".$_SESSION["id"]."' and idCurso='".$fila["idCurso"]."';");
        $filaQ=$bd->fil($makeQ);
        $colsQ=$bd->col($makeQ);
        if($colsQ>0){
            $select=true;
            $ruta="admin/archivos/horariosProfesorCurso/".$filaQ["id"];
            if(is_dir($ruta)){
                $sel.="<option value=\"".$fila["id"]."\">".$fila["curso"]."</option>\n";
            }
        }        
    }while($fila=$bd->fil($make));
    $sel.="</select>\n";
    $sel.="<label>\n";
    $sel.="<input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n";
    $sel.="</label>\n";
    $sel.="</form>\n";
    if(!$select){
        $sel="";
    }
}

?>
 