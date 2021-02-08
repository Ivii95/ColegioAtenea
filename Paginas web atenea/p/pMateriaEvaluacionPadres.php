<?php
$mama=$_POST["materias"];
if($mama=="todas"){
     header("Location:../evaluaciones2.php");
}else{
    header("Location:../evaluaciones_padres.php?ma=".$mama);
}
?>
