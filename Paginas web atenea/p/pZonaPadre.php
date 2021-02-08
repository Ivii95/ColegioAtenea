<?php

require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
$bd=new bd();
$bd->query("SET NAMES 'utf8'");

$id=$_SESSION["id"];
$make=$bd->query("select * from padres where id='".$id."';");
$fila=$bd->fil($make);
$nombre=$fila["nombre"]." ".$fila["apellidos"];
$calidad=$fila["calidad"];
$dni=$fila["dni"];


$sel='<div class="combo">';
$sel.=' <form name="form" style="text-align: center; margin-bottom:100px;" id="form" method="post" action="https://colegioatenea.es/wp-admin/admin-post.php">';
$sel.='<select id="alumnos" name="alumnos">\n';
$sel.="<option>Seleccionar alumno</option>\n";
if($calidad=="padre"){
    $makeQ=$bd->query("select * from alumnos where dniPadre='".$dni."';");
    $filaQ=$bd->fil($makeQ);
    do{
        $sel.="<option value=\"".$filaQ["id"]."\">".$filaQ["apellidos"].", ".$filaQ["nombre"]."</option>\n";
    }while($filaQ=$bd->fil($makeQ));
}elseif($calidad=="madre"){
     $makeQ=$bd->query("select * from alumnos where dniMadre='".$dni."';");
    $filaQ=$bd->fil($makeQ);
    do{
        $sel.="<option value=\"".$filaQ["id"]."\">".$filaQ["apellidos"].", ".$filaQ["nombre"]."</option>\n";
    }while($filaQ=$bd->fil($makeQ));
}
$sel.="</select>\n";
$sel.='<input type="hidden" name="action" value="sele">';
$sel.="<label>\n";
$sel.="<input type=\"submit\" class=\"btn btn-success\" name=\"Enviar\" id=\"Enviar\" value=\"Enviar\" />\n";
$sel.="</label>\n";
$sel.="</form>\n";
$sel.="</div>\n";
?>
