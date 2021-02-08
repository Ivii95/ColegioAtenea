<?php
$mama=$_POST["materias"];
if($mama=="todas"){
     header("Location:../seguimiento_educativo2.php");
}else{
    header("Location:../seguimiento_educativo_padres.php?ma=".$mama);
}
?>
