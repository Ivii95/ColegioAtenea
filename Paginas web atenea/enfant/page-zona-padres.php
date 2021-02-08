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



if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"]!="padre"){?>

    	<div class="container container-title">
    	    <h1 class="ztl-accent-font custom-header-title" style="color:#002749;">Tienes que estar logueado como padre para acceder a esta zona</h1>
    	</div>
    
<?php }else{ ?>
    <?php  require 'atenea/p/pZonaPadre.php'; ?>
   
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container" style="margin-top:50px;">
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
			
			  <div class="row">
			       <div style="text-align: center;" class="col-lg-12">
    			        <p>
                        <strong>Seleccione abajo para acceder a la información del alumno.</strong>
                        </p>
                         </div>
                               <?php echo $sel; ?>
                         
			    </div>
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php } ?>
    





<?php get_footer(); ?>



