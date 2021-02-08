<?php

require $_SERVER['DOCUMENT_ROOT'].'/atenea/admin/class/bd.php';
$bd=new bd();

//------------------ Seleccionamos los alumnos cuyo DNI es el del padre o madre

$basedatos=new bd();

$id=$_SESSION["id"];
$make=$basedatos->query("select * from padres where id='".$id."';");
$fila=$basedatos->fil($make);

// Nombre y apellidos
$nombre=$fila["nombre"]." ".$fila["apellidos"];
// La calidad muestra si es padre o madre
$calidad=$fila["calidad"];
// Obtenemos el DNI
$dni=$fila["dni"];

if($calidad=="padre"){
	$makeQ=$basedatos->query("select * from alumnos where dniPadre='".$dni."';");
	while($filaQ=$basedatos->fil($makeQ)){
		$ID_hijos[]=$filaQ["id"];
		$NOMBRE_hijos[]=$filaQ["nombre"];
		$APELL_hijos[]=$filaQ["apellidos"];
		$CURSO_hijos[]=$filaQ["cursos"];
	}	
}elseif($calidad=="madre"){
     $makeQ=$basedatos->query("select * from alumnos where dniMadre='".$dni."';");
	 while($filaQ=$basedatos->fil($makeQ)){
		$ID_hijos[]=$filaQ["id"];
		$NOMBRE_hijos[]=$filaQ["nombre"];
		$APELL_hijos[]=$filaQ["apellidos"];
		$CURSO_hijos[]=$filaQ["cursos"];
	}
}

// Vamos a mostrar los ID de los hijos
/*
$longitud = count($ID_hijos);
for($i=0; $i<$longitud; $i++){
	$nombre=$NOMBRE_hijos[$i];
	$apellidos=$APELL_hijos[$i];
	$curso=$CURSO_hijos[$i];
	?>
	<script>
		alert('<?php echo "Hijo num. $i se llama $nombre $apellidos y cursa $curso"; ?>');
	</script>
	<?php
}
*/

//------------------ FIN

$make=$bd->query("select * from horarios where tipo='curso' order by curso asc;");
$fila=$bd->fil($make);
$cols=$bd->col($make);

$sel='<form target="_blank" style="text-align: center;"  name="form" id="form" method="post" action=p/pComboCursoHorario.php">';
$sel.='<select id="grupos" onchange="changeFunc(value);" name="grupos">';
$sel.="<option value=\"\" selected disabled >Seleccionar grupo</option>\n";
do{
	$comprobacion = false;
	// Si pertenece al curso....comprobacion cambia a "true" porque es cursado por alguno de los hijos
	$longitud = count($CURSO_hijos);
	for($i=0; $i<$longitud; $i++){
		if($fila["idCurso"]==$CURSO_hijos[$i])
			$comprobacion = true;
	}

	if($comprobacion){
		$sel.="<option value=\"".$fila["idCurso"]."\">".$fila["curso"]."</option>\n";
	}
}while($fila=$bd->fil($make));
$sel.="</select>\n";
//$sel.="<label><input type=\"submit\" name=\"Enviar\" id=\"Enviar\" value=\"Descargar\" />";
$sel.="</form>\n";
?>
