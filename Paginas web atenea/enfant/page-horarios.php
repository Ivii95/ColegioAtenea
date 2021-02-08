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
get_template_part( 'template-parts/header' ); ?>

 <?php  require $_SERVER['DOCUMENT_ROOT'].'/atenea/p/pHorarioGrupo.php'; ?>
 
<script>

   function changeFunc($i) {
      
     document.getElementById("txtHint").innerHTML = '<img class="imageneshorarios" src="https://colegioatenea.es/atenea/imagenes/horario/'+$i+'/'+$i+'.jpg"></img>';
     document.getElementById("botondescargar").innerHTML='<a href="https://colegioatenea.es/atenea/imagenes/horario/'+$i+'/Horarios de Grupo '+$i+'.pdf"><button style=" margin-top:10px; background-color: #6a3f48; border-color: #6a3f48;" type="button" class="btn btn-info">Descargar</button></a>';
   }

  </script>

<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
			    <div style="text-align:center; margin-top:40px;" class="row">
			       
    			        <p style="text-align: center;">
                        <strong>Seleccione el grupo que desea consultar.</strong>
                        </p>
                         
                               <?php echo $sel; ?>
                               <span  id="botondescargar">
                               </span>
                              
                               
			        </div>
			        
			        <span id="txtHint">
                       
                    </span>
			   
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
    

    





<?php get_footer(); ?>

