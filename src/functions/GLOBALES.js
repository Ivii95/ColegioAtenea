//Aqui definimos las variables globales de la aplicacion.
//Los que tienen "const" son constantes y no se pueden cambiar.
//Los que se definen como "var" se les puede añadir un dato en ejecucion.
export const PADRES = 'Padres'
export const ALUMNO = 'Alumno'
export const PROFESOR = 'Profesor'

//VARIABLES SESION
export var ID = 'id'
export var NAME = 'name'
export var SELECCION = 'user'


//URL DE LAS DIRECCIONES DEL SERVIDOR
export const URL_BASE = "http://localhost/atenea/"
export const DB_PROFESOR = URL_BASE + 'config.php?opcion=Profesor'
export const DB_ALUMNO = URL_BASE + 'config.php?opcion=Alumno'
export const DB_PADRES = URL_BASE + 'config.php?opcion=Padres'