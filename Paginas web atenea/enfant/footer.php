<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 *
 * @package Enfant
 */
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
		<div class="sidebar-footer sidebar-ztl">
			<div class="container">
				<div class="row">
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="site-info">			
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<?php if ( get_theme_mod( 'show_footer_social','show' ) == 'show' ) {?>
							<ul class="ztl-social">
								<?php if ( get_theme_mod( 'facebook_social_link' ) ) { ?>
									<li> <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'facebook_social_link' ) ); ?>" title="Facebook"><i class="base-flaticon-facebook"></i></a></li>
								<?php } ?>

								<?php if ( get_theme_mod( 'youtube_social_link' ) ) { ?>
									<li> <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'youtube_social_link' ) );?>" title="Youtube"><i class="base-flaticon-youtube"></i></a></li>
								<?php } ?>

								<?php if ( get_theme_mod( 'twitter_social_link' ) ) { ?>
									<li> <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'twitter_social_link' ) ); ?>" title="Twitter"><i class="base-flaticon-twitter"></i></a></li>
								<?php } ?>

								<?php if ( get_theme_mod( 'linkedin_social_link' ) ) { ?>
									<li> <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'linkedin_social_link' ) ); ?>" title="Linkedin"><i class="base-flaticon-linkedin"></i></a></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
					<div class="col-sm-12 col-xs-12">
						<?php
							$allowed_tags = array(
								'i' => array(
									'class' => array(),
									'style' => array(),
									),
								'a' => array(
									'style' => array(),
									'href'=> array(),
									),
								'strong' => array(),
							);
						?>
						<div id="ztl-copyright">
						<?php
							// we allow some nice tags for this area
							if ( get_theme_mod( 'copyright_textbox' ) ) {
								echo wp_kses( get_theme_mod( 'copyright_textbox' ),$allowed_tags );							
							} else { 
						?>
							&copy; <?php echo date('Y'); ?>  <a href="<?php echo esc_url( home_url() ); ?>/"><?php esc_html( bloginfo( 'name' ) ); ?></a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( 'yes' == get_theme_mod( 'scroll_to_top' ) ) :  ?>
	<a href="#" class="ztl-scroll-top"><i class="fa fa-angle-up"></i></a>
<?php endif; ?>
<!-- #search-modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="search-title"><?php echo esc_html_e('¿Estás buscando algo?','enfant'); ?></div>
				<form role="search" autocomplete="off" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="search-wrapper">
						<input type="text" placeholder="<?php echo esc_html_e('Escribe aqui...', 'enfant'); ?>" class="search-input" autocomplete="off" value="" name="s" id="s">
						<span class="ztl-search-button ztl-button-three">
							<button type="submit" class="search-submit"><?php echo esc_html_e('Buscar', 'enfant'); ?></button>
						</span>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
