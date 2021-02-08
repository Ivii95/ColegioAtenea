<?php
function conecta_db()
{
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $db = "atenea";

    $conn = mysqli_connect($servidor, $usuario, $clave, $db);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
        exit(0);
    }

    return $conn;
}
