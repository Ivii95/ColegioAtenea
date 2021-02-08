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
            // blog full width
            $sidebar_option = get_theme_mod('category_sidebar_option', 'right');
            $layout_option = get_theme_mod('category_layout_option', 'one_column');
            $ess_grid_alias = get_theme_mod('ess_grid_alias', 'enfant-blog');
            $thumbnail_size = 'enfant-blog-full';

            if ('none' == $sidebar_option) {
                $bootstrap_container_left_classes = enfant_get_bc('12', '12', '12', '');
                $bootstrap_container_right_classes = '';
            } elseif ('right' == $sidebar_option) {
                $bootstrap_container_left_classes = enfant_get_bc('8', '8', '8', '');
                $bootstrap_container_right_classes = enfant_get_bc('4', '4', '4', '');
            }
            ?>
            <div class="clearfix <?php echo esc_attr($bootstrap_container_left_classes); ?>">
                <?php

                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        if ($layout_option == 'one_column') {
                            get_template_part('template-parts/post');
                        } elseif ($layout_option == 'ess_grid') {
                            $my_posts_array[] = get_the_ID();
                        }
                    }
                    if (!empty($my_posts_array) && $layout_option == 'ess_grid') {
                        //we apply a grid to the posts in this page. Customer has the option to choose the grid
                        $str = '[ess_grid alias="' . esc_attr($ess_grid_alias) . '" posts=' . implode(',', $my_posts_array) . ']';
                        echo apply_filters('ztl_shortcode_filter', $str);
                    }

                } else {
                    get_template_part('content', 'none');
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
