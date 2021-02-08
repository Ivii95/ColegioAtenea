<?php
$mama=$_POST["materias"];
if($mama=="todas"){
     header("Location:../evaluaciones2.php");
}else{
    header("Location:../evaluaciones.php?ma=".$mama);
}
?>
