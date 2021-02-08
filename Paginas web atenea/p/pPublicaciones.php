<?php
session_start();
require_once 'admin/class/bd.php';
$bd=new bd();

$make=$bd->query("select * from cabecerapublicaciones where id='1';");
$fila=$bd->fil($make);

$texto=$fila["texto"];
$correo=$fila["email"];
?>
