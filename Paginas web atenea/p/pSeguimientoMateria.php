<?php
session_start();
$mama=$_POST["materias"];
if($mama=="todas"){
    header("Location:../seguimiento_educativo2.php");
}else{
    header("Location:../seguimiento_educativo.php?ma=".$_POST["materias"]."&m=".$_POST["mat"]);
}

?>