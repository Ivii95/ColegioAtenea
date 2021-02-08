<?php
/**
 * The template for displaying category pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * @package Enfant
 */

get_header();
get_template_part('template-parts/header');
?>

<div class="category-listing clearfix">
    <div class="container">
        <div class="row">
            <?php
            $staff_sidebar_option = get_theme_mod('staff_sidebar_option', 'none');

            if ('none' == $staff_sidebar_option) {
                $bootstrap_container_left_classes = '';
                $bootstrap_container_right_classes = '';
            } elseif ('right' == $staff_sidebar_option) {
                $bootstrap_container_left_classes = enfant_get_bc('8', '8', '8', '');
                $bootstrap_container_right_classes = enfant_get_bc('4', '4', '4', '');
            }
            ?>
            <div class="clearfix <?php echo esc_attr($bootstrap_container_left_classes); ?>">
                <?php
                    if ( have_posts() ) {
                        $counter = 0;
                        while ( have_posts() ) {
                            $counter ++;
                            the_post();
                            get_template_part( 'template-parts/member' );
                            if ( 0 == $counter % 2 ) {
                                echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
                            }
                            echo '<div class="clearfix visible-xs"></div>';
                        }
                    } else {
                        get_template_part( 'content', 'none' );
                    }

                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => esc_html__('Previous', 'enfant'),
                        'next_text' => esc_html__('Next', 'enfant'),
                    ));
                ?>
            </div>
            <?php if (!empty($bootstrap_container_right_classes)) { ?>
                <div class="category-sidebar-right  <?php echo esc_attr($bootstrap_container_right_classes); ?>">
                    <?php if (is_active_sidebar('sidebar')) : ?>
                        <?php dynamic_sidebar('sidebar'); ?>
                    <?php endif; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer() ?>
