<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Enfant
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <section class="error-404 not-found">
                <div class="page-content">
                    <div class="ztl-404">
                        <h1 class="page-title ztl-error-code"><?php esc_html_e( '404', 'enfant' ); ?></h1>
                        <div class="ztl-404-page-description ztl-font-light"><?php esc_html_e( 'Ooops! That page can not be found.', 'enfant' ); ?></div>
                        <div class="ztl-404-page-directions">
                            <?php esc_html_e( 'We&rsquo;re sorry, but we can&rsquo;t seem to find the page which you requested.', 'enfant' ); ?>
                            <br/>
                            <?php esc_html_e( 'This might be because you have typed the web address incorrectly.', 'enfant' ); ?>
                        </div>
                        <div class="ztl-button-one">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'enfant' ); ?></a>
                        </div>
                    </div>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
