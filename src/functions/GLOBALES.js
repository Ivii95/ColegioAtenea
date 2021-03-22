//Aqui definimos las variables globales de la aplicacion.
//Los que tienen "const" son constantes y no se pueden cambiar.
//Los que se definen como "var" se les puede añadir un dato en ejecucion.
//CONSTANTES
export const PADRES = 'Padres';
export const ALUMNO = 'Alumno';
export const PROFESOR = 'Profesor';
export const PRINCIPAL = 'Seleccion';
export const MOSTRAR_PADRES = 'Mostrar_Padres';
export const MOSTRAR_ALUMNO = 'Mostrar_Alumno';
export const MOSTRAR_PROFESOR = 'Mostrar_Profesor';
export const MOSTRAR_ALUMNO_COMUNICACION = 'Mostrar_Alumno_Comunicacion';


//VARIABLES SESION
export var ID_ALUMNO = '485'
export var ID_PADRE = ''
export var ID_PROFESOR = ''
export var USERNAME = ''
export var NAME = 'name'
export var SELECCION = 'user'


//URL DE LAS DIRECCIONES DEL SERVIDOR
export const IP_ = "192.168.0.210"
export const URL_BASE = "http://" + IP_ + "/atenea/"
export const DB_PROFESOR = URL_BASE + 'config.php?opcion=' + PROFESOR
export const DB_ALUMNO = URL_BASE + 'config.php?opcion=' + ALUMNO
export const DB_PADRES = URL_BASE + 'config.php?opcion=' + PADRES
//SELECTORES DE USUARIO
export const SELECT_ALUMNO = URL_BASE + 'config.php?opcion=' + MOSTRAR_ALUMNO + '&id='
export const SELECT_PADRES = URL_BASE + 'config.php?opcion=' + MOSTRAR_PADRES + '&id='
export const SELECT_PROFESOR = URL_BASE + 'config.php?opcion=' + MOSTRAR_PROFESOR + '&id=' 
export const SELECT_ALUMNO_COMUNICACIONES = URL_BASE + 'config.php?opcion=' + MOSTRAR_ALUMNO_COMUNICACION + '&id='