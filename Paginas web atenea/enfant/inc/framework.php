<?php

/**
 * Enfant  special functions and definitions
 *
 * @package Enfant
 */

/*
 -----------------------------------------------------------------------------------*/
/*
   Function to output different bootstrap classes
/*-----------------------------------------------------------------------------------*/

function enfant_get_bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
{
    $bootstrap_classes = '';
    if (!empty($col_lg)) {
        $bootstrap_classes .= "col-lg-$col_lg ";
    }
    if (!empty($col_md)) {
        $bootstrap_classes .= "col-md-$col_md ";
    }
    if (!empty($col_sm)) {
        $bootstrap_classes .= "col-sm-$col_sm ";
    }
    if (!empty($col_xs)) {
        $bootstrap_classes .= "col-xs-$col_xs ";
    }
    return $bootstrap_classes;
}

function enfant_bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
{
    echo esc_attr(enfant_get_bc($col_lg, $col_md, $col_sm, $col_xs));
}


function enfant_get_bc_all($column)
{
    return "col-lg-$column col-md-$column col-sm-$column";
}

function enfant_bc_all($column)
{
    echo esc_attr(enfant_get_bc_all($column));
}


/*
 -----------------------------------------------------------------------------------*/
/*
   Function to convert HEX code to RGBA
/*-----------------------------------------------------------------------------------*/
function enfant_hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    // Return default if no color provided
    if (empty($color)) {
        return $default;
    }

    // Sanitize $color if "#" is provided
    if ('#' == $color[0]) {
        $color = substr($color, 1);
    }

    // Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    // Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    // Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode(',', $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(',', $rgb) . ')';
    }

    // Return rgb(a) color string
    return $output;
}


/*
 -----------------------------------------------------------------------------------*/
/*
   Excerpt functions
/*-----------------------------------------------------------------------------------*/
function enfant_excerpt($len = 20, $link = true)
{
    $limit = $len + 1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    $num_words = count($excerpt);
    if ($num_words >= $len) {
        array_pop($excerpt);
    }
    $excerpt = implode(' ', $excerpt);
    if ($link) {
        echo apply_filters('enfant_excerpt_more', $excerpt); // WPCS: XSS OK.
    } else {
        echo esc_html($excerpt);
    }
}

function enfant_excerpt_more_link($excerpt)
{
    return esc_html($excerpt) . ' <a class="read-more" href="' . esc_url(get_permalink(get_the_ID())) . '"> [&hellip;]</a>';
}

add_filter('enfant_excerpt_more', 'enfant_excerpt_more_link');


/*
 -----------------------------------------------------------------------------------*/
/*
   Make subcategories to use parent category
/*-----------------------------------------------------------------------------------*/

function enfant_load_cat_parent_template($template)
{

    $cat_id = absint(get_query_var('cat'));
    $category = get_category($cat_id);

    $templates = array();

    if (!is_wp_error($category)) {
        $templates[] = "category-{$category->slug}.php";
    }

    $templates[] = "category-$cat_id.php";

    // trace back the parent hierarchy and locate a template
    if (!is_wp_error($category)) {
        $category = $category->parent ? get_category($category->parent) : '';

        if (!empty($category)) {
            if (!is_wp_error($category)) {
                $templates[] = "category-{$category->slug}.php";
            }

            $templates[] = "category-{$category->term_id}.php";
        }
    }

    $templates[] = 'category.php';
    $template = locate_template($templates);

    return $template;
}

add_action('category_template', 'enfant_load_cat_parent_template');


/*
 -----------------------------------------------------------------------------------*/
/*
   If category show only the category name
/*-----------------------------------------------------------------------------------*/
function enfant_get_the_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    return $title;
}

add_filter('get_the_archive_title', 'enfant_get_the_archive_title');


/*
 -----------------------------------------------------------------------------------*/
/*
   Sanitize a hex color containing #
/*-----------------------------------------------------------------------------------*/
function enfant_sanitize_hex_color($color)
{
    if ('' === $color) {
        return '';
    }

    // 3 or 6 hex digits, or the empty string.
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color)) {
        return $color;
    }
}


/*
 -----------------------------------------------------------------------------------*/
/*
   Item title
/*-----------------------------------------------------------------------------------*/

function enfant_get_title() {

    $post_id = get_the_ID();

    if ( is_home() ) {
        if ( get_option( 'page_for_posts', true ) ) {
            return get_the_title( get_option( 'page_for_posts', true ) );
        } else {
            return esc_html__( 'Latest Posts', 'enfant' );
        }
    } elseif ( is_archive() ) {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        if ( $term ) {
            return apply_filters( 'single_term_title', $term->name, $post_id );
        } elseif ( is_post_type_archive() ) {
            return apply_filters( 'the_title', get_queried_object()->labels->name, $post_id );
        } elseif ( is_day() ) {
            return sprintf( esc_html__( 'Daily Archives: %s', 'enfant' ), get_the_date() );
        } elseif ( is_month() ) {
            return sprintf( esc_html__( 'Monthly Archives: %s', 'enfant' ), get_the_date( 'F Y' ) );
        } elseif ( is_year() ) {
            return sprintf( esc_html__( 'Yearly Archives: %s', 'enfant' ), get_the_date( 'Y' ) );
        } elseif ( is_author() ) {
            $author = get_queried_object();
            return sprintf( esc_html__( 'Author: %s', 'enfant' ), $author->display_name );
        } else {
            return single_cat_title( '', false );
        }
    } elseif ( is_search() ) {
        return sprintf( esc_html__( 'Search Results For "%s"', 'enfant' ), get_search_query() );
    } elseif ( is_404() ) {
        return esc_html__( 'Not Found', 'enfant' );
    } elseif ( function_exists('tribe_get_events_title') && get_post_type() == 'tribe_events' && !is_single() ) {
        return tribe_get_events_title();
    } else {
        return get_the_title();
    }
}


/**
 * Get first element of input if array
 */
function enfant_get_first($data)
{
    if (is_array($data)) {
        return reset($data);
    }
}

/**
 * Custom Password protected page form
 */
add_filter( 'the_password_form', 'enfant_custom_password_form' );
function enfant_custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="ztl-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
        <span>' . esc_html__( 'This content is password protected. To view it please enter your password below:','enfant' ) . '</span>
        <div class="ztl-password">
            <div>
              <input id="' . $label . '" class="ztl-input" type="password" name="post_password" placeholder='.esc_attr__('Password', 'enfant') .' required="">
            </div>
            <div class="ztl-button-three  ztl-password-button">
              <button>' . esc_attr__('Enter', 'enfant') . '</button>
            </div>
        </div>
    </form>';
    return $o;
}