<?php
/**
 * Enfant functions and definitions
 *
 * @package Enfant
 */

define( 'VERSION', '2.02023' ); //used to force browser cache when new updates appear

/**
 * Zoutula helpers
 */
require get_template_directory() . '/inc/framework.php';


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* pixels */
}

if ( ! function_exists( 'enfant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function enfant_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Enfant, use a find and replace
		 * to change 'enfant' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'enfant', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'enfant-square-thumb', 300, 300, true ); // 300 wide by 300 tall, image is cropped due to true setting
		add_image_size( 'enfant-blog-full',1100,560,true ); // 1100 wide by 560 tall, image is cropped due to true setting
		add_image_size( 'enfant-4-3', 600, 450, true ); // 600 wide by 450 tall, image is cropped due to true setting
		add_image_size( 'enfant-square-big', 600, 600, true ); // 600 wide by 600 tall, image is cropped due to true setting
		add_image_size( 'enfant-column', 600, 840, true ); // 600 wide by 840 tall, image is cropped due to true setting
		add_image_size( 'enfant-wide', 600, 300, true ); // 600 wide by 300 tall, image is cropped due to true setting

		// Addd WooCommmerce support
		add_theme_support( 'woocommerce' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'enfant' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'enfant_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}
endif; // enfant_setup
add_action( 'after_setup_theme', 'enfant_setup' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function enfant_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'enfant' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'enfant' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar-right">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Header widget area
    register_sidebar( array(
        'name'          => esc_html__( 'Header', 'enfant' ),
        'id'            => 'sidebar-header',
        'description'   => esc_html__( 'Add widgets here to appear on Header.', 'enfant' ),
        'before_widget' => '<aside id="%1$s" class="widget header-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'enfant' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here to appear in footer.', 'enfant' ),
		'before_widget' => '<aside id="%1$s" class="widget col-sm-4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Enable Shop sidebar only if WooCommerce is active
	 */
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'enfant' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here to appear in WooCommerece sidebar.', 'enfant' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'enfant_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function enfant_scripts() {

	wp_enqueue_style( 'enfant-style', get_stylesheet_uri(), false, VERSION );
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style('enfant-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', false, VERSION);
	}
	wp_enqueue_style( 'enfant-style-responsive', get_template_directory_uri() . '/css/responsive.css', false, VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, VERSION );
    wp_enqueue_style( 'font-base-flaticon', get_template_directory_uri() . '/css/flaticon.css', false, VERSION );

	// enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), VERSION, true );

	// enfant custom JS
	wp_enqueue_script( 'enfant-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), VERSION, true );

	// waypoints & sticky & inview
	wp_enqueue_script( 'enfant-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array( 'jquery' ), VERSION, true );
	wp_enqueue_script( 'enfant-inview', get_template_directory_uri() . '/js/inview.min.js',array( 'jquery' ), VERSION, true );
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array( ), VERSION, true );

	wp_enqueue_script( 'underscore');
	wp_enqueue_script( 'enfant-js', get_template_directory_uri() . '/js/general.js', array( 'jquery','retina' ), VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'enfant_scripts' );


/**
 * Enqueue bootstrap before theme css
 */

function enfant_bootstrap() {
	// enqueue Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enfant_bootstrap', 9 );



function enfant_vcSetAsTheme() {
	vc_set_as_theme();
}
add_action( 'vc_before_init', 'enfant_vcSetAsTheme' );


//custom filter to parse a shortcode
add_filter( 'ztl_shortcode_filter', 'do_shortcode' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WooCommerce settings.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
* Load TGM Plugins activation
*/
require get_template_directory() . '/plugin-activation/activator.php';


require get_template_directory() . '/inc/prueba.php';

//función sacada de internet (wordpress) para obtener bien los precios



//código sacado de internet (wordpress) para que el plugin YITH oculte el carrito, que no lo esta ocultando

//no termina de ocultarlo, pero hace algo importante, el carrito no abre la pagina de carrito vació donde está el botón que te lleva a la tienda, con lo cual, sirve.

add_filter( 'ywctm_cart_widget_classes', 'my_ywctm_cart_widget_classes' );

function my_ywctm_cart_widget_classes( $classes ) {

	$classes[] = '.site-header-cart';

	return $classes;

	}
	
/* Añadir botones producto */
// Código puesto por mi para poner un botón "volver a la tienda" en la ficha de cada libro y otro botón "volver a la lista de libros" de ese curso

// Edito el 23/09/2020. Al añadir la Tienda de Uniformes y Ropa deportiva, el botón "volver a la tienda" debe redirigir a "tienda-online" y no a "tienda-de-libros"

// style="margin-left:5px;" es el separador entre los botones COMPRAR LISTA TIENDA (Gracias, Ismael)

add_action( 'woocommerce_after_add_to_cart_button', function() {
    $builder_product_link = 'https://colegioatenea.es/tienda-online/';
    ?>
	<a class="button" href="javascript:history.go(-1)" style="margin-left:5px;" >Lista</a>
   	<a class="button" href="<?php echo esc_url( $builder_product_link ); ?>" style="margin-left:5px;" ><?php esc_html_e( 'Tienda', 'text-domain' ); ?></a>
 	
    <?php
} );


/** 
* Modificaciones al menu de mi cuenta 
*/ 
//Código puesto por mi para modificar el "menú de mi cuenta". Se puede moficar el orden, los nombres, ocultar etiquetas, etc.
function my_account_menu_order() {
 $menuOrder = array(
 'dashboard'          => __( 'Inicio', 'woocommerce' ),
 'edit-account'    	  => __( 'Detalles de la cuenta', 'woocommerce' ),
 'edit-address'       => __( 'Dirección de Facturación', 'woocommerce' ),
 'orders'             => __( 'Mis compras online', 'woocommerce' ),
 'tienda-de-libros'   => __( 'TIENDA ONLINE', 'woocommerce' ),
 'downloads'          => __( 'Mis descargas', 'woocommerce' ),
 'customer-logout'    => __( 'Cerrar sesión', 'woocommerce' ),
  );
 return $menuOrder;
 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );

// las siguientes líneas de código son las que ocultan elementos del "menú de mi cuenta"

add_filter( 'woocommerce_account_menu_items', 'ocultar_descargas', 999 );
function ocultar_descargas( $items ) {
unset($items['downloads']);
return $items;
}

//las siguientes líneas de código sirven para añadir un elemento al menú. Primero es crear la variable, y despues, hay que ir a WordPress > Ajustes > Enlaces permanentes. Ahí, sin modificar ningún ajuste, se guardan los cambios para que se registre la nueva variable, sino no funcionará.
/**
  * Nuevas variables para la pagina de mi cuenta.
  */

 add_action( 'init', 'my_account_new_endpoints' );

 function my_account_new_endpoints() {
 	add_rewrite_endpoint( 'TIENDA ONLINE', EP_ROOT | EP_PAGES );
 }
 
 
// Vamos a unificar la pestaña Dirección de Facturación en Detalle de la cuenta
/* Unificando contenido de pestañas */
// Primero ocultamos la pestaña a mover (edit-address)
 
add_filter( 'woocommerce_account_menu_items', 'ocultar_direccion_facturacion', 999 );
function ocultar_direccion_facturacion( $items ) {
unset($items['edit-address']);
return $items;
}
 
// Luego mostramos el contenido de las direcciones en edit-account
 
add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address' );
return $items;

//Agregar nuevos estados de un pedido en el proceso de compra

/** 
 * Añadir nuevos estados a un pedido en Woocommerce
**/

// Registrar Estado del pedido Recogido
function wpex_wc_register_post_statuses() {
    register_post_status( 'wc-shipping-progress', array(
        'label'                     => _x( 'Recogido', 'WooCommerce Order status', 'text_domain' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'recogido (%s)', 'recogido (%s)', 'text_domain' )
    ) );
}
add_filter( 'init', 'wpex_wc_register_post_statuses' );

//Probando código para que los cambios de estado de pedidos se envien automaticamente.
add_filter( 'woocommerce_defer_transactional_emails', '__return_false' );


// Aceptar los términos y condiciones al Finalizar Compra en WC, por defecto

function jcms_wc_terms ($terms_is_checked) {
	return true;
}
add_filter ( ' woocommerce_terms_is_checked ' , ' jcms_wc_terms ' , 10 );
add_filter ( ' woocommerce_terms_is_checked_default ' , ' jcms_wc_terms ' , 10 );


/* Cambiar el texto SKU en WooCommerce por ISBN
*/

add_filter('gettext', 'change_sku', 999, 3);
 
function change_sku( $translated_text, $text, $domain ) {
if( $text == 'SKU' || $text == 'SKU:' ) return 'ISBN';
return $translated_text;
}

// Función para hacer logout sesión sin preguntar. NO FUNCIONA

add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result)
{
    /**
     * Allow logout without confirmation
     */
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : 'https://colegioatenea.es';
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}


//Añadimos los campos en una nueva sección
add_action( 'show_user_profile', 'agregar_campos_seccion' );
add_action( 'edit_user_profile', 'agregar_campos_seccion' );
 
function agregar_campos_seccion( $user ) {
?>
    <h3><?php _e('Datos Académicos'); ?></h3>
    
    <table class="form-table">
        <tr>
            <th>
                <label for="profesion"><?php _e('Profesion'); ?></label>
            </th>
            <td>
                <input type="text" name="profesion" id="profesion" class="regular-text"
                	value="<?php echo esc_attr( get_the_author_meta( 'profesion', $user->ID ) ); ?>" />
                <p class="description"><?php _e('Ingresa tu profesión'); ?></p>
            </td>
        </tr>
    </table>
<?php }

//Guardamos los nuevos campos
add_action( 'personal_options_update', 'grabar_campos_seccion' );
add_action( 'edit_user_profile_update', 'grabar_campos_seccion' );

function grabar_campos_seccion( $user_id ) {
	
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    if( isset($_POST['profesion']) ) {
        $profesion = sanitize_text_field($_POST['profesion']);
        update_user_meta( $user_id, 'profesion', $profesion );
    }
}

/**
* APLICA UN CUPON DE DESCUENTO DE 5€ PARA COMPRAR LA AGENDA SI COMPRAS MAS DE 100€ no funciona
*/

add_action( 'woocommerce_before_cart' , 'add_coupon_notice' );
add_action( 'woocommerce_before_checkout_form' , 'add_coupon_notice' );

function add_coupon_notice() {

        $cart_total = WC()->cart->get_subtotal();
        $minimum_amount = 100;
        $currency_code = get_woocommerce_currency();
        wc_clear_notices();

       if ( $cart_total < $minimum_amount ) {
              WC()->cart->remove_coupon( 'CUPONAGENDA' );
              wc_print_notice( "AHORRA 5€ DE LA AGENDA SI GASTAS MAS DE $minimum_amount $currency_code!", 'notice' );
        } else {
              WC()->cart->apply_coupon( 'CUPONAGENDA' );
              wc_print_notice( 'ACABAS DE AHORRAR 5€ EN TU PEDIDO!', 'notice' );
        }
          wc_clear_notices();
}



//* Personalización de la página de tienda de WooCommerce [NO FUNCIONA]
add_action( 'after_setup_theme', 'martin_custom_shop_woocommmerce' );

function martin_custom_shop_woocommmerce() {

    //remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    //remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
 
    //remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
    //remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
 
    //remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    //remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
 
    //remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
 
    //remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 
    //remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
 
    //remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
 
    //remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    //remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
 
    //remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    //remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
 
    //remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
 
    //remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

}