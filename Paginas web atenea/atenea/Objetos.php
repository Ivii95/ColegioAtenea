<?php
class Alumno
{
    public $id;
    public $nombre;
    public $curso;
    public $tutor;
    public $horatutoria;
    public $urlimagen;
    
    function __construct($id)
    {
        $this->id = $id;
    }
    
}
class Padre
{
    public $id;
    public $nombre;
    public $calidad;
    public $dni;
    function __construct($id)
    {
        $this->id = $id;
    }
}
