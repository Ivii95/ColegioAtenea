<?php

/**
 * WooCommerce behavior and settings
 */

/*
 * Change number or products per row to 3
*/
add_filter('loop_shop_columns', 'enfant_loop_columns');
function enfant_loop_columns()
{
    return 3; // 3 products per row
}


/**
 * Change Add to cart text to Nothing
 */
add_filter('woocommerce_product_add_to_cart_text', 'enfant_archive_custom_cart_button_text');    // 2.1 +
function enfant_archive_custom_cart_button_text()
{
    return;
}


/**
 * Change Add to cart with Add to Cart
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'enfant_custom_cart_button_text');    // 2.1 +
function enfant_custom_cart_button_text()
{
    return esc_html__('Add to Cart', 'enfant');
}


/**
 * Set number of products per page
 */

// Display 9 products per page. Goes in functions.php
add_filter('loop_shop_per_page', 'enfant_products_per_page', 20);
function enfant_products_per_page()
{
    $enfant_products_per_page = get_theme_mod('shop_products_per_page');
    if (!empty($enfant_products_per_page)) {
        return (int) $enfant_products_per_page;
    }
    return 9;
}


add_filter('woocommerce_output_related_products_args', 'enfant_related_products_columns');
function enfant_related_products_columns($args)
{
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}

/**
 * Remove product title from single product page
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);


/**
 * Add cart items number in header bar
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start(); ?>
    <span class="ztl-cart-quantity"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
<?php
    $fragments['span.ztl-cart-quantity'] = ob_get_clean();
    return $fragments;
}

add_filter('woocommerce_isma', 'ismael', 10, 2);

function ismael($user, $password)
{

    $usuario = $user;
    $clave = $password;


    $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
    mysqli_query($link, "SET NAMES 'utf8'");



    $stmt = mysqli_prepare($link, "select id,nombre,apellidos from padres where usuario=? and clave=?");
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $clave);

    // ejecutar la consulta 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);




    if ($num_rows = mysqli_stmt_num_rows($stmt) > 0) {

        // ligar variables de resultado 
        mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);

        // obtener valor 
        mysqli_stmt_fetch($stmt);


        // cerrar sentencia 
        mysqli_stmt_close($stmt);
        $_SESSION["time"] = time();
        $_SESSION["tipo"] = "padre";
        $_SESSION["login"] = "yes";
        $_SESSION["nombre"] = $apellidos . ", " . $nombre;
        $_SESSION["nombrer"] = $nombre . " " . $apellidos;
        $_SESSION["id"] = $id;

        wp_redirect(get_home_url() . '/zona-padres');
        exit;
    } else {

        $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
        mysqli_query($link, "SET NAMES 'utf8'");
        $stmt = mysqli_prepare($link, "select id,nombre,apellidos from alumnos where usuario=? and clave=?");
        mysqli_stmt_bind_param($stmt, "ss", $usuario, $clave);

        // ejecutar la consulta 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);




        if ($num_rows = mysqli_stmt_num_rows($stmt) > 0) {

            // ligar variables de resultado 
            mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);

            // obtener valor 
            mysqli_stmt_fetch($stmt);


            // cerrar sentencia 
            mysqli_stmt_close($stmt);
            $_SESSION["time"] = time();
            $_SESSION["tipo"] = "alumno";
            $_SESSION["login"] = "yes";
            $_SESSION["nombre"] = $apellidos . ", " . $nombre;
            $_SESSION["nombrer"] = $nombre . " " . $apellidos;
            $_SESSION["id"] = $id;
            wp_redirect(get_home_url() . '/zona-padres-2');
            exit;
        } else {
            $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
            mysqli_query($link, "SET NAMES 'utf8'");
            $stmt = mysqli_prepare($link, "select id,nombre from equipodirectivo where usuario=? and clave=?");
            mysqli_stmt_bind_param($stmt, "ss", $usuario, $clave);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if ($num_rows = mysqli_stmt_num_rows($stmt) > 0) {
                
                mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);
                mysqli_stmt_fetch($stmt);
                 mysqli_stmt_close($stmt);
                $_SESSION["time"] = time();
                $_SESSION["tipo"] = "equipo";
                $_SESSION["login"] = "yes";
                $_SESSION["nombre"] = $apellidos . ", " . $nombre;
                $_SESSION["nombrer"] = $nombre . " " . $apellidos;
                $_SESSION["id"] = $id;
                wp_redirect(get_home_url() . '/equipo-directivo-gestion');
                exit;
            } else {
                $link = mysqli_connect("localhost", "colegioa_user", "McElWyEtLqSm#160216", "colegioa_db339212955");
                mysqli_query($link, "SET NAMES 'utf8'");
                $stmt = mysqli_prepare($link, "select id,nombre,apellidos from profesores where usuario=? and clave=?");
                mysqli_stmt_bind_param($stmt, "ss", $usuario, $clave);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if ($num_rows = mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $id, $nombre, $apellidos);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
                    $_SESSION["time"] = time();
                    $_SESSION["tipo"] = "profesor";
                    $_SESSION["login"] = "yes";
                    $_SESSION["nombre"] = $apellidos . ", " . $nombre;
                    $_SESSION["nombrer"] = $nombre . " " . $apellidos;
                    $_SESSION["id"] = $id;
                    wp_redirect(get_home_url() . '/atenea/admin/profesorado.php');
                    //wp_redirect(get_home_url() . '/profesorado_wp');
                    exit;
                } else {
                    wp_redirect(get_home_url() . '/zona-padres/mi-cuenta');
                    //wp_redirect(get_home_url() . '/atenea/admin/profesorado.php');
                    exit;
                }
            }
        }
    }
}

add_action('cerrar_sesion', 'cierra_sesion');

function cierra_sesion()
{
    session_start();
    session_destroy();
}


?>