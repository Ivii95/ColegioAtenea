<?php
session_start();

/**
 * Funcion que captura los valores de una
 * petición POST o GET de HTTP.
 */
function logueara(){

	if(!isset($_POST['usuario']) || !isset($_POST['clave']) || !isset($_POST['modo'])):
	    wp_redirect( get_home_url() . '/atenea/admin?error=login');
		exit;


    endif;

	// Verificamos que los 3 campos tengan valores
	if( empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['modo']) ):
		// Enviamos al usuario a la misma página con una variable GET de error.
		wp_redirect( get_home_url() . '/atenea/admin?error=login');
		exit;

	endif;

    if(preg_match("/^[1-4]{1}/",$_POST['modo'])){
        $usuario = sanitize_text_field( $_POST['usuario'] );
        $clave = sanitize_text_field( $_POST['clave'] );

		/*
       $paswdencript = password_hash($clave, PASSWORD_BCRYPT,[4]);
       echo $paswdencript;
       die();
  		*/
        $modo = $_POST['modo'];

        switch($modo){
        	case "1":
        		$tabla="super";
        		break;
        	case "2":
        		$tabla="administrador";
        		break;
        	case "3":
        		$tabla="usuarios";
        		break;
        	case "4":
        		$tabla="profesores";
        		break;
        }



        $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");

      $stmt = mysqli_prepare($link,"select id,usuario,clave from {$tabla} where usuario=? ");
        mysqli_stmt_bind_param($stmt,"s", $usuario);

 /* ejecutar la consulta */
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);


if($num_rows = mysqli_stmt_num_rows($stmt)>0){

    /* ligar variables de resultado */
    mysqli_stmt_bind_result($stmt, $id,$user,$pasw);

    /* obtener valor */
    mysqli_stmt_fetch($stmt);


    /* cerrar sentencia */
    mysqli_stmt_close($stmt);



if (password_verify($clave, $pasw)) {
   switch($modo){
		case "1":
			$_SESSION["login"]="super";
			$location="administrador.php";
			break;
		case "2":
			$_SESSION["login"]="administrador";
			$location="administrador.php";
			break;
		case "3":
			$_SESSION["login"]="usuario";
            $_SESSION["usuario"]=$id;
			$location="usuarios.php";
			break;
		case "4":
			$_SESSION["login"]="profesor";
			$_SESSION["profesor"]=$id;
			$location="profesorado.php";
       			$maket=mysqli_query($link,"select * from tutorias where idProfesor='{$id}';");
                $colT=mysqli_num_rows($maket);
                        if($colT>0){
                            $_SESSION["tutor"]="yes";
                        }else{
                            $_SESSION["tutor"]="no";
                        }
			break;
	}



  wp_redirect(get_home_url().'/atenea/admin/'.$location); exit;
} else {
   wp_redirect( get_home_url() . '/atenea/admin?error=login');  exit;
}




}else{

     wp_redirect( get_home_url() . '/atenea/admin?error=login');  exit;
}
    }else{
         wp_redirect( get_home_url() . '/atenea/admin?error=login'); exit;
    }


}
add_action('admin_post_nopriv_logina', 'logueara'); // Para usuarios no logueados
add_action('admin_post_logina', 'logueara'); // Para usuarios logueados





function loguear(){

	// Verificamos que los 2 campos tengan valores
	if( empty( $_POST['username'] ) || empty( $_POST['password'] ) ):

		// Enviamos al usuario a la misma página con una variable GET de error.
		wp_redirect( get_home_url() . '/zona-padres'); exit;
		exit;

	endif;


	// SIEMPRE SE DEBEN SANITIZAR LOS VALORES
$usuario     = sanitize_text_field( $_POST['username'] );
$clave    = sanitize_text_field( $_POST['password'] );



$link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
mysqli_query($link,"SET NAMES 'utf8'");
$stmt = mysqli_prepare($link,"select id,nombre,apellidos from padres where usuario=? and clave=?");
mysqli_stmt_bind_param($stmt,"ss", $usuario, $clave);

 /* ejecutar la consulta */
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);




if($num_rows = mysqli_stmt_num_rows($stmt)>0){

    /* ligar variables de resultado */
    mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);

    /* obtener valor */
    mysqli_stmt_fetch($stmt);


    /* cerrar sentencia */
    mysqli_stmt_close($stmt);
  $_SESSION["time"] = time();
  $_SESSION["tipo"]="padre";
  $_SESSION["login"]="yes";
  $_SESSION["nombre"]=$apellidos.", ".$nombre;
  $_SESSION["nombrer"]=$nombre." ".$apellidos;
  $_SESSION["id"]=$id;

  wp_redirect( get_home_url() . '/zona-padres'); exit;
}else{

    $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
    mysqli_query($link,"SET NAMES 'utf8'");
    $stmt = mysqli_prepare($link,"select id,nombre,apellidos from alumnos where usuario=? and clave=?");
    mysqli_stmt_bind_param($stmt,"ss", $usuario, $clave);

 /* ejecutar la consulta */
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);




    if($num_rows = mysqli_stmt_num_rows($stmt)>0){

        /* ligar variables de resultado */
        mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);

        /* obtener valor */
        mysqli_stmt_fetch($stmt);


        /* cerrar sentencia */
        mysqli_stmt_close($stmt);
        $_SESSION["time"] = time();
        $_SESSION["tipo"]="alumno";
        $_SESSION["login"]="yes";
        $_SESSION["nombre"]=$apellidos.", ".$nombre;
        $_SESSION["nombrer"]=$nombre." ".$apellidos;
        $_SESSION["id"]=$id;
        wp_redirect( get_home_url() . '/zona-padres-2'); exit;

    }else{
        wp_redirect( get_home_url() . '/zona-padres'); exit;
    }




}
}
add_action('admin_post_nopriv_login', 'loguear'); // Para usuarios no logueados
add_action('admin_post_login', 'loguear'); // Para usuarios logueados


function alumno(){

$_SESSION["idAlumno"]=$_POST["alumnos"];


 wp_redirect( get_home_url() . '/zona-padres-2'); exit;


}
add_action('admin_post_nopriv_sele', 'alumno'); // Para usuarios no logueados
add_action('admin_post_sele', 'alumno'); // Para usuarios logueados



function add_custom_query_var( $vars ){
    //CUIDADO AQUI: LAS VARIABLES PASADAS POR $_GET[] NO PUEDEN SER SOLO UNA LETRA WORDPRESS NO LO DEJA, TIENE QUE SER MAS DE DOS LETRAS ES DECIR "m" NO SE PUEDE, DEBERIA DE SER "mes"
  $vars[] = "mes";
  $vars[] = "anio";
  $vars[] = "pagi";
  $vars[] = "ma";
  return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );



function seguimientomateria(){

    $materia=$_POST["materias"];
    if($materia=="todas" || $materia=="0" ){
         header("Location:https://colegioatenea.es/zona-padres/zona-padres-2/seguimiento-educativo/");
    }else{
        header("Location:https://colegioatenea.es/zona-padres/zona-padres-2/seguimiento-educativo?ma=".$materia);
    }

}
add_action('admin_post_nopriv_segui', 'seguimientomateria'); // Para usuarios no logueados
add_action('admin_post_segui', 'seguimientomateria'); // Para usuarios logueados

function evaluacionmateria(){

    $materia=$_POST["materias"];
    if($materia=="todas" || $materia=="0" ){
         header("Location:https://colegioatenea.es/zona-padres/zona-padres-2/evaluaciones-padres/");
    }else{
        header("Location:https://colegioatenea.es/zona-padres/zona-padres-2/evaluaciones-padres?ma=".$materia);
    }

}
add_action('admin_post_nopriv_eva', 'evaluacionmateria'); // Para usuarios no logueados
add_action('admin_post_eva', 'evaluacionmateria'); // Para usuarios logueados

?>
