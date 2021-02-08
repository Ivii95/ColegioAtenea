<?php
/**
 * Enfant header image / header title template part
 *
 * @package Enfant
 */

// In case is page and has option to show header image.
$header_option = get_post_meta( get_the_ID(), 'enfant_header_option', true );
$breadcrumb_class = 'ztl-breadcrumb-'. get_theme_mod( 'show_breadcrumb','show' );

//Get header image
$header_image = get_header_image();

?>
<?php if ($header_option == 'hidden'){ ?>

<?php } else { ?>
    <div class="page-top custom-header">
        <div class="header-image <?php  echo esc_attr($breadcrumb_class); ?>">
            <div class="ztl-header-image" style="background-color:<?php echo esc_attr( get_theme_mod( 'title_background','#f2f2f2' ) ).";";
                if ( !empty( $header_image ) ) { echo "background-image: url(" . esc_url( $header_image ) . ")";}?>">
                <div class="container container-title">
                    <h1 class="ztl-accent-font custom-header-title"
                        style="color:<?php echo esc_attr( get_theme_mod( 'title_color','#002749' ) ); ?>;">
                        <?php echo enfant_get_title(); ?>
                    </h1>
                </div>
            </div>
            <?php if ( function_exists( 'breadcrumb_trail' ) && 'ztl-breadcrumb-show'==$breadcrumb_class): ?>
                <div class="ztl-breadcrumb-container">
                    <div class="container">
                        <?php breadcrumb_trail( array( 'show_browse' => false ) ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>
