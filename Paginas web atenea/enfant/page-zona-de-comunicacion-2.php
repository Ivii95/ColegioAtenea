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
    	    <h1 class="ztl-accent-font custom-header-title" style="color:#002749;">Tienes que estar logueado como padre o como alumno para acceder a esta zona</h1>
    	</div>
    
<?php }else{ ?>
     
	 <?php 
	  if($_SESSION["tipo"]=="padre"){
		$idimagen=$_SESSION["idAlumno"];
	 }elseif($_SESSION["tipo"]=="alumno"){
		$idimagen=$_SESSION["id"];
	 }
          require $_SERVER['DOCUMENT_ROOT'].'/atenea/p/pComunicacionesPadre.php'; 
 
     ?>
   
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
			    <div style="margin-top: 60px;" class="row">
			 <div class="col-sm-12 col-md-2" style="margin-bottom: 15px; background-color: #FFCC66; border: thin solid #666666;text-align: center;" >
			 	<img src="<?php echo "https://colegioatenea.es/atenea/admin/imagenesAlumnos/".$idimagen."/".$idimagen.".JPG"; ?>" alt="alumno" width="150"/>
             </div>   
			       <?php  require 'divalumno.php'; ?>
			        
			    </div>
			    
<div style="text-align: center;" class="cabecera_comunic"><img src="https://colegioatenea.es/atenea/imagenes/zona_comunicacion.gif" alt="Estás en Seguimiento Educativo" width="178" height="12" /></div>
<div class="texto_padres" style="text-align: center;">En esta zona tus profesores publican información y documentos necesarios para la realización de tus trabajos y ejercicios.<br><strong>Selecciona abajo el área para ver lo que tu profesor ha publicado.</strong></div>
<div class="col-sm-12 col-lg-12 ">
<div class="tabla" style="margin-top:20px;">
<?php echo $listado; ?>
</div>
<?php echo $paginacion; ?>
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
				<div class="col-sm-12 col-md-12" style="text-align:center; padding:10px; margin:10px;">
                     <a href="../">
                        <button style="background-color: #6a3f48; border-color: #6a3f48; margin-top: 10px; padding: 8px 50px; " type="button" class="btn btn-info">Volver</button>
                     </a>
                    </div>   
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php } ?>
    





<?php get_footer(); ?>


