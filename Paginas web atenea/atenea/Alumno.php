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
