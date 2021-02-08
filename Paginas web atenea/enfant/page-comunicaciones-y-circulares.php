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

if($_SESSION["tipo"]!="padre"){?>

    	<div class="container container-title">
    	    <h1 class="ztl-accent-font custom-header-title" style="color:#002749;">Tienes que estar logueado como padre para acceder a esta zona</h1>
    	</div>
    
<?php }else{ ?>
<?php 
$vari=get_query_var( 'mes' );
$vari2=get_query_var( 'anio' );
  
        if(!empty($vari)){
            require $_SERVER['DOCUMENT_ROOT'].'/atenea/p/rinconPadresM.php'; 
	    }else{
            require $_SERVER['DOCUMENT_ROOT'].'/atenea/p/pRinconPadres.php'; 
	    }
	    
	  
	    
        ?>
   

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
			    <div class="row" style="margin-top:50px;">
                  <div class="col-sm-10" style="text-align: center; ">
                     
                      <h2 style="font-size: xx-large;">COMUNICACIONES</h2><br/>
                      
                        <?php    
                           echo $salida."<br/>";
                        ?>
                      
                        <?php echo $paginacion; ?>
                  </div>
                  
                  
                  <div class="col-sm-2 columnarincon" >
                      <h2 style="font-size: larger; margin-top: 10px;">Archivo de comunicaciones</h2><br/>
                        <?php echo $sal; ?>
                  </div>
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



