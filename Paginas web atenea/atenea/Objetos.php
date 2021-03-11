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
class Comunicacion
{
    public $id;
    public $fecha;
    public $materia;
    public $asignatura;
    public $url;
    public $titulo;
    public $profesor;
    function __construct($id)
    {
        $this->id = $id;
    }
}