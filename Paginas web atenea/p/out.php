<?php
session_start();
session_destroy();
header("Location:../salida_sistema.php");
?>
