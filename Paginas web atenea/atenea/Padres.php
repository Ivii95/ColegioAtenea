<?php
class Padre
{
    public $id;
    public $nombre;
    public $calidad;
    public $dni;
    public $Alumnos;
    function __construct($id)
    {
        $this->id = $id;
    }
}