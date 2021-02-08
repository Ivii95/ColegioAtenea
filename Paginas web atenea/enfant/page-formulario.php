<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Enfant
 */


 

get_header();
get_template_part( 'template-parts/header' ); 

if($_SESSION["tipo"]!="padre" && $_SESSION["tipo"]!="alumno"){?>

    	<div class="container container-title">
    	    <h1 class="ztl-accent-font custom-header-title" style="color:#002749;">Tienes que estar logueado como padre para acceder a esta zona</h1>
    	</div>
    
<?php }else{ ?>
    <?php  require $_SERVER['DOCUMENT_ROOT'].'/atenea/p/pFormulario.php'; ?>
   
	<div id="primary" class="content-area" style="background-color: #ffcc6729;" >
		<main id="main" class="site-main">
			<div class="container" style="background-color: #ffcc675c;  box-shadow: 5px 10px 8px #888888; margin-bottom:40px; margin-top:20px;  border-radius: 7px;">
			    <div class="row" style="margin-top:50px;">
        			        
        			 <div class="col-sm-12 col-md-2" style="background-color: #ffcc67; border: thin solid #666666;text-align: center;" >
                        <img src="<?php echo "https://colegioatenea.es/".$rutaImagen; ?>" alt="alumno" width="150"/>
                     </div>   
			         <?php  require 'divalumno2.php'; ?>
			        
			    </div>
			    <div class="row formulario">
			        <p style="background: blanchedalmond; border: 1px dotted #660032; padding: 10px;"> Por favor, sírvase en rellenar este formulario para contactar con el tutor del alumno.<br/>
                        <b>Los campos marcados con (*) son obligatorios.</b></p>
			         <form style ="line-height: 40px;" id="form2" name="form2" method="post" onsubmit="return comprobar(this);" action="https://colegioatenea.es/atenea/p/sendEmail.php">
                        <label><b>*Nombre</b></label></br>
                        <input name="nombre" type="text" class="espacio_campos" id="nombre" size="40" /></br>
                        <label><b>*Padre, Madre o Tutor legal del Alumno:</b></label></br>
                        <?php echo $sel; ?> </br>
                        <label><b>*E-mail de contacto:</b></label></br>
                        <input name="email" type="text" class="espacio_campos" id="email" size="40" /> </br>
                        <label><b>*Teléfono de contacto:</b></label></br>
                        <input name="telefono" type="text" class="espacio_campos" id="telefono" size="40" /> </br>
                        <label><b>Texto del mensaje:</b></label></br>
                        <textarea name="textos" id="textos"  rows="3" size="40" style="width: 50%; margin-bottom:10px;"></textarea><br/>
                        <input name="Borrar" type="reset" class="btn btn-danger" value="Borrar" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="Enviar" type="submit" class="btn btn-success" value="Enviar" />
                            
                    </form>
			    </div>       
			    
			   
				<?php
				while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/page' );
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // end of the loop.
				?>
			</div>
			  
                    	<div class="col-sm-12 col-md-12" style="text-align:center; padding:10px; margin:10px;">
                             <a href="../">
                                <button style="background-color: #6a3f48; border-color: #6a3f48; margin-top: 10px; padding: 8px 50px; " type="button" class="btn btn-info">Volver</button>
                             </a>
                        </div>    
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php } ?>
    

<script type="text/javascript">
<!--
    function valida_correo(email){
        regx = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;
        return regx.test(email);
    }
    function comprobar(frm){
        nombre=frm.nombre.value;
        alumno=frm.alumno.value;
        email=frm.email.value;
        telefono=frm.telefono.value;

        if (email!=""){
		valor=valida_correo(email);
	}else{
		valor=false;
	}

        if(nombre=="" || nombre.length<5){
            alert("Debe introducir un nombre y apellidos (mínimo 5 caracteres)");
            frm.nombre.focus();
            return false;
        }else if(alumno=="0"){
            alert("Debe seleccionar un alumno.");
            frm.alumno.focus();
            return false;
        }else if(!valor){
            alert("Debe introducir un correo electrónico con un formato válido.")
            frm.email.focus();
            return false;
        }else if(!(/^\d{9}$/.test(telefono)) || telefono==""){
            alert("Debe introducir un número de teléfono válido.")
            frm.telefono.focus();
            return false;
        }else{
            return true;
        }
    }
-->
</script>



<?php get_footer(); ?>
