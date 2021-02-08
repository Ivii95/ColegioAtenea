<?php
/**
 * Enfant Theme Customizer
 *
 * @package Enfant
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function enfant_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'enfant_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function enfant_customize_preview_js() {
	wp_enqueue_script( 'enfant_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'enfant_customize_preview_js' );

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function enfant_customizer( $wp_customize ) {

	// Add Theme General Settings *************************
	$wp_customize->add_section(
		'options_general',
		array(
			'title' => esc_html__( 'General Settings', 'enfant' ),
			'description' => esc_html__( 'Structure Settings', 'enfant' ),
			'priority' => 15,
		)
	);

	/* boxed layout / full width */
	$wp_customize->add_setting(
		'layout_mode' ,
		array(
			'default' => 'full',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'layout_mode',
		array(
			'label' => esc_html__( 'Site Layout', 'enfant' ),
			'section' => 'options_general',
			'type' => 'radio',
			'choices' => array(
				'full' => esc_html__( 'Full width layout','enfant' ),
				'boxed' => esc_html__( 'Boxed layout','enfant' ),
			),
			'priority'   => 10,
		)
	);

	/* boxed layout / full width */
	$wp_customize->add_setting(
		'scroll_to_top' ,
		array(
			'default' => 'yes',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'scroll_to_top',
		array(
			'label' => esc_html__( 'Scroll to Top Button', 'enfant' ),
			'section' => 'options_general',
			'type' => 'radio',
			'choices' => array(
				'yes' => esc_html__( 'Yes','enfant' ),
				'no' => esc_html__( 'No','enfant' ),
			),
			'priority'   => 15,
		)
	);

    /* search button from header */
    $wp_customize->add_setting(
        'show_search_icon' ,
        array(
            'default' => 'yes',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_search_icon',
        array(
            'label' => esc_html__( 'Show Search', 'enfant' ),
            'section' => 'options_general',
            'type' => 'radio',
            'choices' => array(
                'yes' => esc_html__( 'Yes','enfant' ),
                'no' => esc_html__( 'No','enfant' ),
            ),
            'priority'   => 20,
        )
    );


    /* search button from header */
    $wp_customize->add_setting(
        'show_cart_icon' ,
        array(
            'default' => 'yes',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_cart_icon',
        array(
            'label' => esc_html__( 'Show Cart', 'enfant' ),
            'section' => 'options_general',
            'type' => 'radio',
            'choices' => array(
                'yes' => esc_html__( 'Yes','enfant' ),
                'no' => esc_html__( 'No','enfant' ),
            ),
            'priority'   => 30,
        )
    );



	// Main website font
	$wp_customize->add_setting(
		'main_font_google' ,
		array(
			'default' => 'Lato',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'main_font_google',
		array(
			'label' => esc_html__( 'Main Font', 'enfant' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 30,
		)
	);

	// Accent website font
	$wp_customize->add_setting(
		'accent_font_google' ,
		array(
			'default' => 'Montserrat',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'accent_font_google',
		array(
			'label' => esc_html__( 'Accent Font', 'enfant' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 50,
		)
	);


	// Main website font
	$wp_customize->add_setting(
		'fonts_subset' ,
		array(
			'default' => 'Latin',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'fonts_subset',
		array(
			'label' => esc_html__( 'Fonts subset', 'enfant' ),
			'section' => 'options_general',
			'type' => 'text',
			'priority'   => 60,
			'description' => esc_html__( 'Please add the subset you want. Eg. Latin, Cyrillic', 'enfant' ),
		)
	);


    // Google maps api key
    $wp_customize->add_setting(
        'google_maps_api_key' ,
        array(
            'default' => 'AIzaSyDuklOQ79qeWRyU1cDr29QsevDd9uJSXBw',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'google_maps_api_key',
        array(
            'label' => esc_html__( 'Google maps API key', 'enfant' ),
            'section' => 'options_general',
            'type' => 'text',
            'priority'   => 70,
            'description' => esc_html__( 'Please add your own Google Maps API key. You are using a default one that may reach its calls limit anytime', 'enfant' ),
        )
    );


	// Add Theme Header Section *************************
	$wp_customize->add_section(
		'options_header',
		array(
			'title' => esc_html__( 'Header', 'enfant' ),
			'description' => esc_html__( 'Site Header Settings', 'enfant' ),
			'priority' => 20,
		)
	);



	// Add First Logo Settings
	$wp_customize->add_setting(
		'logo_first' ,
		array(
			'default' => get_template_directory_uri() . '/images/logo_first.png',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_first',
			array(
				'label' => esc_html__( 'Logo First Image', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'logo_first',
				'priority'   => 3,
			)
		)
	);

	// Add First Logo HiRes Settings
	$wp_customize->add_setting(
		'hires_logo_first' ,
		array(
			'default' => get_template_directory_uri() . '/images/logo_first@2x.png',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hires_logo_first',
			array(
				'label' => esc_html__( 'High Resolution Logo First Image', 'enfant' ),
				'description' => esc_html__( 'Image should be twice as large as logo above with "@2x" added to filename.', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'hires_logo_first',
				'priority'   => 4,
			)
		)
	);



	// Add Second Logo Settings
	$wp_customize->add_setting(
		'logo_second' ,
		array(
			'default' => get_template_directory_uri() . '/images/logo_second.png',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_second',
			array(
				'label' => esc_html__( 'Logo Second Image', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'logo_second',
				'priority'   => 5,
			)
		)
	);

	// Add Logo Second HiRes Settings
	$wp_customize->add_setting(
		'hires_logo_second' ,
		array(
			'default' => get_template_directory_uri() . '/images/logo_second@2x.png',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hires_logo_second',
			array(
				'label' => esc_html__( 'High Resolution Logo Second Image', 'enfant' ),
				'description' => esc_html__( 'Image should be twice as large as logo above with "@2x" added to filename.', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'hires_logo_second',
				'priority'   => 6,
			)
		)
	);

	// Logo width setting/control
	$wp_customize->add_setting(
		'logo_width' ,
		array(
			'default' => '140',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'logo_width',
		array(
			'label' => esc_html__( 'Logo Width (max)', 'enfant' ),
			'section' => 'options_header',
			'type' => 'number',
			'priority'   => 10,
		)
	);

	// Header background color
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'default' => '#002749', // dark blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label' => esc_html__( 'Header Background Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'header_background_color',
				'priority' => 14,
			)
		)
	);



	// Menu background color
	$wp_customize->add_setting(
		'menu_background_color',
		array(
			'default' => '#ffffff', // white
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_background_color',
			array(
				'label' => esc_html__( 'Menu Background Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_background_color',
				'priority' => 15,
			)
		)
	);


	// Menu Fonts Size
	$wp_customize->add_setting(
		'menu_font_size',
		array(
			'default' => 15,
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'menu_font_size',
		array(
			'label' => esc_html__( 'Menu Font Size (px)', 'enfant' ),
			'section' => 'options_header',
			'settings' => 'menu_font_size',
			'priority' => 25,
			'type' => 'number',
		)
	);


	// Menu Fonts Weight
	$wp_customize->add_setting(
		'menu_font_weight',
		array(
			'default' => 700,
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'menu_font_weight',
		array(
			'label' => esc_html__( 'Menu Font Weight', 'enfant' ),
			'section' => 'options_header',
			'settings' => 'menu_font_weight',
			'priority' => 30,
			'type' => 'number',
		)
	);



	// Menu First Color
	$wp_customize->add_setting(
		'menu_first_color',
		array(
			'default' => '#002749',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_first_color',
			array(
				'label' => esc_html__( 'Menu First Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_first_color',
				'description' => esc_html__( 'Used as: menu text color for first level', 'enfant' ),
				'priority' => 32,
			)
		)
	);


	// Menu Second Color
	$wp_customize->add_setting(
		'menu_second_color',
		array(
			'default' => '#ff4e31',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_second_color',
			array(
				'label' => esc_html__( 'Menu Second Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_second_color',
				'description' => esc_html__( 'Used as: sub-menu background color, mobile menu burger color', 'enfant' ),
				'priority' => 35,
			)
		)
	);


	// Menu Third Color
	$wp_customize->add_setting(
		'menu_third_color',
		array(
			'default' => '#848484',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_third_color',
			array(
				'label' => esc_html__( 'Menu Third Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_third_color',
				'description' => esc_html__( 'Used as: sub-menu text color on second level items for resolution < 768px', 'enfant' ),
				'priority' => 37,
			)
		)
	);

	// Menu Fourth Color
	$wp_customize->add_setting(
		'menu_fourth_color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_fourth_color',
			array(
				'label' => esc_html__( 'Menu Fourth Color', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_fourth_color',
				'description' => esc_html__( 'Used as: sub-menu text color for resolution > 768px', 'enfant' ),
				'priority' => 39,
			)
		)
	);


	// Menu Border color
	$wp_customize->add_setting(
		'menu_border_color',
		array(
			'default' => '#f2f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_border_color',
			array(
				'label' => esc_html__( 'Menu Border Line', 'enfant' ),
				'section' => 'options_header',
				'settings' => 'menu_border_color',
				'description' => esc_html__( 'Fixed menu border. Used to better delimit menu area.', 'enfant' ),
				'priority' => 42,
			)
		)
	);


	// Show breadcrumb
    // Option to show social in footer
    $wp_customize->add_setting(
        'show_breadcrumb',
        array(
            'default' => 'show',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'show_breadcrumb',
        array(
            'type' => 'radio',
            'label' => esc_html__( 'Show/Hide Breadcrumb','enfant' ),
            'section' => 'options_header',
            'choices' => array(
                'show' => 'Show',
                'hide' => 'Hide',
            ),
            'priority' => 50,
        )
    );


    // Custom title background
    $wp_customize->add_setting(
        'title_background',
        array(
            'default' => '#f2f2f2',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_background',
            array(
                'label' => esc_html__( 'Title Background', 'enfant' ),
                'section' => 'options_header',
                'settings' => 'title_background',
                'description' => esc_html__( 'Custom title background. If you set a header image will cover this color', 'enfant' ),
                'priority' => 52,
            )
        )
    );


    // Custom title background
    $wp_customize->add_setting(
        'title_color',
        array(
            'default' => '#002749',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_color',
            array(
                'label' => esc_html__( 'Title Background', 'enfant' ),
                'section' => 'options_header',
                'settings' => 'title_color',
                'description' => esc_html__( 'Custom title color.', 'enfant' ),
                'priority' => 54,
            )
        )
    );





	// Colors section ******************************
	// Theme second color
	$wp_customize->add_setting(
		'theme_first_color',
		array(
			'default' => '#ff4e31', // red
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_first_color',
			array(
				'label' => esc_html__( 'Theme First Color', 'enfant' ),
				'section' => 'colors',
				'settings' => 'theme_first_color',
				'priority' => 5,
			)
		)
	);

	// Theme second color
	$wp_customize->add_setting(
		'theme_second_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_second_color',
			array(
				'label' => esc_html__( 'Theme Second Color', 'enfant' ),
				'section' => 'colors',
				'settings' => 'theme_second_color',
				'priority' => 5,
			)
		)
	);

	// Post details color
	$wp_customize->add_setting(
		'detail_color',
		array(
			'default' => '#a0a0a0', // light grey
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'detail_color',
			array(
				'label' => esc_html__( 'Detail Color', 'enfant' ),
				'section' => 'colors',
				'settings' => 'detail_color',
				'priority' => 7,
			)
		)
	);

    // Border color
    $wp_customize->add_setting(
        'line_color',
        array(
            'default' => '#f2f2f2', // light grey
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'line_color',
            array(
                'label' => esc_html__( 'Line Color', 'enfant' ),
                'section' => 'colors',
                'settings' => 'line_color',
                'priority' => 9,
            )
        )
    );

	// Links colors
	$wp_customize->add_setting(
		'link_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label' => esc_html__( 'Links Color', 'enfant' ),
				'section' => 'colors',
				'settings' => 'link_color',
				'priority' => 34,
			)
		)
	);

	// Pagination first color
	$wp_customize->add_setting(
		'pagination_first_color',
		array(
			'default' => '#ff4e31', //red
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_first_color',
			array(
				'label'      => esc_html__( 'Pagination First Color', 'enfant' ),
				'section'    => 'colors',
				'settings'   => 'pagination_first_color',
				'priority'   => 90,
			)
		)
	);

	// Buttons text-color
	$wp_customize->add_setting(
		'pagination_second_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pagination_second_color',
			array(
				'label'      => esc_html__( 'Pagination Second Color', 'enfant' ),
				'section'    => 'colors',
				'settings'   => 'pagination_second_color',
				'priority'   => 100,
			)
		)
	);


	// Add Footer Section
	$wp_customize->add_section(
		'options_footer',
		array(
			'title' => esc_html__( 'Footer', 'enfant' ),
			'description' => esc_html__( 'Settings for colors, text and social links visibility in footer', 'enfant' ),
			'priority' => 25,
		)
	);

	// Footer background color
	$wp_customize->add_setting(
		'footer_sidebar_background_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_sidebar_background_color',
			array(
				'label'      => esc_html__( 'Footer Widget Area Background Color', 'enfant' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_sidebar_background_color',
				'priority'   => 5,
			)
		)
	);

	// Footer background color
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'default' => '#fffff', // white
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label'      => esc_html__( 'Footer Belt Background Color', 'enfant' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_background_color',
				'priority'   => 10,
			)
		)
	);

	// Copyright text color
	$wp_customize->add_setting(
		'copyright_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'copyright_color',
			array(
				'label'      => esc_html__( 'Copyright Font Color', 'enfant' ),
				'section'    => 'options_footer',
				'settings'   => 'copyright_color',
				'priority'   => 15,
			)
		)
	);

	// Copyright text
	$wp_customize->add_setting(
		'copyright_textbox',
		array(
			'default' => '2016 enfant Theme crafted with Love by Zoutula',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'copyright_textbox',
		array(
			'label' => esc_html__( 'Copyright Text','enfant' ),
			'section' => 'options_footer',
			'type' => 'text',
			'priority'   => 20,
		)
	);

	// Option to show social in footer
	$wp_customize->add_setting(
		'show_footer_social',
		array(
			'default' => 'show',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'show_footer_social',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Show/Hide Social Icons','enfant' ),
			'section' => 'options_footer',
			'choices' => array(
				'show' => 'Show',
				'hide' => 'Hide',
			),
			'priority' => 30,
		)
	);


	// Footer social icons color
	$wp_customize->add_setting(
		'footer_social_icons_color',
		array(
			'default' => '#002749', // blue
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_icons_color',
			array(
				'label'      => esc_html__( 'Social Icons Color', 'enfant' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_social_icons_color',
				'priority'   => 35,
			)
		)
	);

	// Footer social icons color
	$wp_customize->add_setting(
		'footer_social_icons_hover_color',
		array(
			'default' => '#ff4e31', // red
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_social_icons_hover_color',
			array(
				'label'      => esc_html__( 'Social Icons Hover Color', 'enfant' ),
				'section'    => 'options_footer',
				'settings'   => 'footer_social_icons_hover_color',
				'priority'   => 40,
			)
		)
	);

	// Add Section Social Links
	$wp_customize->add_section(
		'options_social',
		array(
			'title' => esc_html__( 'Social Links', 'enfant' ),
			'description' => esc_html__( 'Social links for your site', 'enfant' ),
			'priority' => 30,
		)
	);

	// Facebook social link
	$wp_customize->add_setting(
		'facebook_social_link',
		array(
			'default' => '',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'facebook_social_link',
		array(
			'label' => esc_html__( 'Facebook Link','enfant' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 10,
		)
	);

	// Twitter link
	$wp_customize->add_setting(
		'twitter_social_link',
		array(
			'default' => '',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'twitter_social_link',
		array(
			'label' => esc_html__( 'Twitter Link','enfant' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 30,
		)
	);

	// Youtube link
	$wp_customize->add_setting(
		'youtube_social_link',
		array(
			'default' => '',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'youtube_social_link',
		array(
			'label' => esc_html__( 'Youtube Link','enfant' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 40,
		)
	);

	// Linkedin link
	$wp_customize->add_setting(
		'linkedin_social_link',
		array(
			'default' => '',
			'sanitize_callback' => 'enfant_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'linkedin_social_link',
		array(
			'label' => esc_html__( 'Linkedin Link','enfant' ),
			'section' => 'options_social',
			'type' => 'text',
			'priority'   => 50,
		)
	);

	// Add Shop Section only in case WooCommerce is active
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_section(
			'options_shop',
			array(
				'title' => esc_html__('Shop', 'enfant'),
				'description' => esc_html__('Settings for WooCommerce pages', 'enfant'),
				'priority' => 32,
			)
		);

		//Shop sidebar layout
		$wp_customize->add_setting(
			'shop_sidebar_option',
			array(
				'default' => 'right',
				'sanitize_callback' => 'enfant_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'shop_sidebar_option',
			array(
				'label' => esc_html__('Shop Sidebar Layout', 'enfant'),
				'section' => 'options_shop',
				'type' => 'radio',
				'choices' => array(
					'right' => 'Right',
					'none' => 'None (full width)',
				),
				'priority' => 10,
			)
		);


		// Shop products per page
		$wp_customize->add_setting(
			'shop_products_per_page',
			array(
				'default' => '9',
				'sanitize_callback' => 'enfant_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'shop_products_per_page',
			array(
				'label' => esc_html__('Products per Page', 'enfant'),
				'section' => 'options_shop',
				'type' => 'number',
				'priority' => 20,
			)
		);
	}

    // Blog settings
    $wp_customize->add_section(
        'options_blog',
        array(
            'title' => esc_html__( 'Blog', 'enfant' ),
            'description' => esc_html__( 'Options for blog listing and more', 'enfant' ),
            'priority' => 35,
        )
    );


    // Blog sidebar layout
    $wp_customize->add_setting(
        'category_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'category_sidebar_option',
        array(
            'label' => esc_html__( 'Blog Sidebar', 'enfant' ),
            'section' => 'options_blog',
            'type' => 'radio',
            'choices'  => array(
                'right' => 'Right',
                'none' => 'None (full width)',
            ),
            'priority'   => 10,
        )
    );


    // Blog layout 1 column / grid
    $wp_customize->add_setting(
        'category_layout_option' ,
        array(
            'default' => 'one_column',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'category_layout_option',
        array(
            'label' => esc_html__('Blog Layout', 'enfant'),
            'section' => 'options_blog',
            'type' => 'radio',
            'choices' => array(
                'one_column' => esc_html__('One Column', 'enfant'),
                'ess_grid' => esc_html__('Essential Grid', 'enfant'),
            ),
            'priority' => 27,
        )
    );

    // Grid alias layout
    $wp_customize->add_setting(
        'ess_grid_alias' ,
        array(
            'default' => 'enfant-blog',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'ess_grid_alias',
        array(
            'label' => esc_html__( 'Essential Grid Alias E.g.: enfant-blog', 'enfant' ),
            'section' => 'options_blog',
            'type' => 'text',
            'priority'   => 28,
        )
    );



	// Add Section Staff
	$wp_customize->add_section(
		'options_staff',
		array(
			'title' => esc_html__( 'Staff', 'enfant' ),
			'description' => esc_html__( 'Options for staff listing and more', 'enfant' ),
			'priority' => 35,
		)
	);

    // Staff sidebar
    $wp_customize->add_setting(
        'staff_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'staff_sidebar_option',
        array(
            'label' => esc_html__( 'Staff Sidebar', 'enfant' ),
            'section' => 'options_staff',
            'type' => 'radio',
            'choices'  => array(
                'none' => 'None (full width)',
                'right' => 'Right',
            ),
            'priority'   => 10,
        )
    );

    // Staff items per page
    $wp_customize->add_setting(
        'staff_posts_per_page',
        array(
            'default' => '9',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'staff_posts_per_page',
        array(
            'label' => esc_html__('Staff Members per Page ', 'enfant'),
            'section' => 'options_staff',
            'type' => 'number',
            'priority' => 20,
        )
    );


    // Add Section Courses
    $wp_customize->add_section(
        'options_courses',
        array(
            'title' => esc_html__( 'Courses', 'enfant' ),
            'description' => esc_html__( 'Options for courses listing and more', 'enfant' ),
            'priority' => 36,
        )
    );

    // Courses sidebar
    $wp_customize->add_setting(
        'courses_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'courses_sidebar_option',
        array(
            'label' => esc_html__( 'Courses Sidebar', 'enfant' ),
            'section' => 'options_courses',
            'type' => 'radio',
            'choices'  => array(
                'none' => 'None (full width)',
                'right' => 'Right',
            ),
            'priority'   => 10,
        )
    );

    // Courses items per page
    $wp_customize->add_setting(
        'courses_posts_per_page',
        array(
            'default' => '9',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'courses_posts_per_page',
        array(
            'label' => esc_html__('Courses per Page ', 'enfant'),
            'section' => 'options_courses',
            'type' => 'number',
            'priority' => 20,
        )
    );




    // Add Section Events
    $wp_customize->add_section(
        'options_events',
        array(
            'title' => esc_html__( 'Events', 'enfant' ),
            'description' => esc_html__( 'Options for events listing and more', 'enfant' ),
            'priority' => 38,
        )
    );

    // Events sidebar
    $wp_customize->add_setting(
        'events_sidebar_option' ,
        array(
            'default' => 'right',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'events_sidebar_option',
        array(
            'label' => esc_html__( 'Events Sidebar', 'enfant' ),
            'section' => 'options_events',
            'type' => 'radio',
            'choices'  => array(
                'none' => esc_html__('None (full width)','enfant'),
                'right' => esc_html__('Right','enfant'),
            ),
            'priority'   => 10,
        )
    );

    // Events items per page
    $wp_customize->add_setting(
        'events_posts_per_page',
        array(
            'default' => '6',
            'sanitize_callback' => 'enfant_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'events_posts_per_page',
        array(
            'label' => esc_html__('Events per Page ', 'enfant'),
            'section' => 'options_events',
            'type' => 'number',
            'priority' => 20,
        )
    );


	// customizer styles
	wp_register_style( 'customizer_custom', get_template_directory_uri() . '/css/customizer.css' );
	wp_enqueue_style( 'customizer_custom' );

}
add_action( 'customize_register', 'enfant_customizer' );



function enfant_add_needed_google_fonts() {

	// get default menu font
	$protocol = is_ssl() ? 'https' : 'http';

	// get theme fonts
	$google_keyword_font_main = esc_attr( get_theme_mod( 'main_font_google','Lato' ) );
	$google_keyword_font_accent = esc_attr( get_theme_mod( 'accent_font_google','Montserrat' ) );


	if ( ! empty( $google_keyword_font_main ) ) {
		$google_weight_font_main = '300,400,500,700';
		$google_keyword_font_main_edited = str_replace( ' ', '+', $google_keyword_font_main );
	}


	if ( ! empty( $google_keyword_font_accent ) ) {
		$google_weight_font_accent = '300,400,500,700';
		$google_keyword_font_accent_edited = str_replace( ' ', '+', $google_keyword_font_accent );
	}

	//get the subset
	$google_font_subset = esc_attr( get_theme_mod( 'fonts_subset','' ) );
	if (!empty($google_font_subset)){
		$google_font_subset = '&subset='.str_replace(' ','',$google_font_subset);
	}

	wp_enqueue_style( 'enfant-fonts', $protocol . '://fonts.googleapis.com/css?family=' . $google_keyword_font_main_edited . ':' . $google_weight_font_main .'|'. $google_keyword_font_accent_edited. ':' .$google_weight_font_accent  . $google_font_subset);


}

add_action( 'wp_enqueue_scripts', 'enfant_add_needed_google_fonts' );



function enfant_add_css_to_stylesheet() {

	$styles['main_font'] = esc_attr( get_theme_mod( 'main_font_google', 'Lato' ) );
	$styles['accent_font'] = esc_attr( get_theme_mod( 'accent_font_google', 'Montserrat' ) );
	$styles['theme_first_color'] = esc_attr( get_theme_mod( 'theme_first_color','#fd503b' ) ); // first theme color red
	$styles['theme_second_color'] = esc_attr( get_theme_mod( 'theme_second_color','#002749' ) ); // second theme color blue
    $styles['title_background'] = esc_attr( get_theme_mod( 'title_background','#f2f2f2' ) ); // grey used for breadcrumb border too

    $styles['detail_color'] = esc_attr( get_theme_mod( 'detail_color', '#a0a0a0' ) ); //grey for details text
    $styles['line_color'] = esc_attr( get_theme_mod( 'line_color', '#f2f2f2' ) ); //light grey for detail post borders

	// menu font size
	$styles['menu_font_size'] = intval( get_theme_mod( 'menu_font_size',14 ) );
	// menu font weight
	$styles['menu_font_weight'] = intval( get_theme_mod( 'menu_font_weight', 600 ) );

	/**
	 * Menu Colors
	 */
	// menu first color
	$styles['menu_first_color'] = esc_attr( get_theme_mod( 'menu_first_color','#002749' ) );
	// menu second color
	$styles['menu_second_color'] = esc_attr( get_theme_mod( 'menu_second_color','#ff4e31' ) );
	//menu third color
	$styles['menu_third_color'] = esc_attr( get_theme_mod( 'menu_third_color','#848484' ) );
	//menu fourth color
	$styles['menu_fourth_color'] = esc_attr( get_theme_mod( 'menu_fourth_color','#ffffff' ) );

	// footer bg color
	$styles['footer_background_color'] = esc_attr( get_theme_mod( 'footer_background_color','#ffffff' ) ); // white
	// copyright text color
	$styles['copyright_color'] = esc_attr( get_theme_mod( 'copyright_color','#002749' ) ); // blue

	// header background-color
	$styles['menu_background_color'] = esc_attr( get_theme_mod( 'menu_background_color','#ffffff' ) ); // white
	$styles['menu_border_color'] = esc_attr( get_theme_mod( 'menu_border_color','#f2f2f2' ) ); // grey

	// buttons text color
	$styles['pagination_second_color'] = esc_attr( get_theme_mod( 'pagination_second_color','#002749' ) ); // blue
	// buttons background color
	$styles['pagination_first_color'] = esc_attr( get_theme_mod( 'pagination_first_color','#ff4e31' ) ); // red

	// link colors
	$styles['link_color'] = esc_attr( get_theme_mod( 'link_color', '#002749' ) ); // dark blue

	$styles['footer_sidebar_background_color'] = esc_attr( get_theme_mod( 'footer_sidebar_background_color', '#002749' ) ); // blue



	//social icons colors
	$styles['footer_social_icons_color'] = esc_attr( get_theme_mod( 'footer_social_icons_color', '#002749' ) );
	$styles['footer_social_icons_hover_color'] = esc_attr( get_theme_mod( 'footer_social_icons_hover_color', '#ff4e31' ) );


	$css = "
    body, aside a,
    .ztl-package-circle .period,
    .ztl-main-font{
        font-family: '{$styles['main_font']}',sans-serif;
    }

    .ztl-announcement .line-1,
    #search-modal .search-title,
    .sidebar-ztl h2,
    .ztl-counter .counter,
    .ztl-package-circle .item,
    .ztl-package-description span:first-child,
    .ztl-countdown .grid h1,
    .ztl-steps-carousel .number-step,
    .comment-reply-title,
    .comments-title,
    .ztl-contact-heading,
    .ztl-error-code,
    .ztl-404-page-description,
    .ztl-staff-item .variation-2 .staff-title,
    .ztl-heading,
    .page-top .entry-title,
    .ztl-course-item .course-title,
    .ztl-accordion h4 a,
    .ztl-accent-font,
    .enfant-navigation {
    	 font-family: '{$styles['accent_font']}',sans-serif;
    }
    
    .ztl-tabs .vc_tta-panel-title > a,
    .ztl-tabs .vc_tta-tabs-list .vc_tta-tab > a{
        color: {$styles['theme_first_color']} !important;
        border-color: {$styles['theme_first_color']};
    }
    
    .ztl-tabs .vc_active .vc_tta-panel-title > a span:after,
    .ztl-tabs .vc_tta-tabs-list .vc_active > a span:after {
         border-top: 10px solid {$styles['theme_first_color']};
    }
    
    .ztl-tabs .vc_active .vc_tta-panel-title > a,
    .ztl-tabs .vc_tta-tabs-list .vc_tta-tab > a:hover,
    .ztl-tabs .vc_tta-tabs-list .vc_active > a,
    .ztl-tabs .vc_tta-panel-title> a:hover {
        background-color:{$styles['theme_first_color']} !important;
        color: #ffffff !important;
        border:2px solid {$styles['theme_first_color']} !important;
    }
    
    .ztl-error-code,
    .ztl-404-page-description{
        color: {$styles['theme_second_color']};
    }

    .ztl-steps-carousel .owl-prev,
    .ztl-steps-carousel .owl-next,
    .ztl-testimonials-carousel .owl-prev,
    .ztl-testimonials-carousel .owl-next{
    	 font-family: '{$styles['accent_font']}',sans-serif;
    	 color: {$styles['theme_first_color']};
    	 border-color: {$styles['theme_first_color']};
    }

    .ztl-steps-carousel .owl-prev:hover,
    .ztl-steps-carousel .owl-next:hover,
    .ztl-testimonials-carousel .owl-prev:hover,
    .ztl-testimonials-carousel .owl-next:hover{
    	 font-family: '{$styles['accent_font']}',sans-serif;
    	 background-color: {$styles['theme_first_color']} !important;
    	 border-color: {$styles['theme_first_color']};
    	 color:#fff;
    }
    
    .ztl-testimonials-carousel .owl-dots .owl-dot{
         border-color: {$styles['theme_first_color']};
    }
    .ztl-testimonials-carousel .owl-dots .owl-dot:hover, 
    .ztl-testimonials-carousel .owl-dots .owl-dot.active{
        background-color: {$styles['theme_first_color']} !important;
    }
    
    .ztl-first-color{
       color: {$styles['theme_first_color']};
    }
    
    .ztl-accordion h4 a,
    .ztl-accordion h4 a:hover{
       color: {$styles['theme_second_color']} !important;
    }
    
    .ztl-accordion h4 a i:before,
    .ztl-accordion h4 a i:after{
        border-color: {$styles['theme_first_color']} !important;
    }

    .ztl-button-one a,
    .ztl-button-two a,
    .ztl-button-two span.ztl-action,
    .ztl-button-three a,
    .ztl-button-four a{
    	white-space: nowrap;
    }

    /*Button Style One*/
   
    .ztl-button-one a,
    .ztl-button-one button {
    	padding:10px 20px !important;
    	border-radius:28px;
    	border:solid 2px;
    	font-size:14px;
    	line-height:18px;
		transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
		font-weight:500;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
    }
    
    .ztl-button-one a,
    .ztl-button-one a:focus,
    .ztl-button-one button,
    .ztl-button-one button:focus {
    	color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	background-color: transparent !important;
    	text-decoration:none;

    }
    .ztl-button-one button:hover,
    .ztl-button-one button:active,
    .ztl-button-one a:hover,
    .ztl-button-one a:active {
    	color: #fff !important;
    	background-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;
    }
    

    /*Button Style Two*/

    .ztl-button-two a,
    .ztl-button-two span.ztl-action,
    .ztl-button-two button{
    	padding:10px 20px !important;
    	border-radius:28px;
    	border:solid 2px;
    	font-size:14px;
    	line-height:18px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:500;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
    }
    .ztl-button-two a,
    .ztl-button-two a:focus,    
    .ztl-button-two span.ztl-action,
    .ztl-button-two span.ztl-action:focus,
    .ztl-button-two button,
    .ztl-button-two button:focus{
    	color: #fff !important;
    	border-color: #fff !important;
    	background-color: transparent !important;
    	text-decoration:none;
    }
    .ztl-button-two button:hover,
    .ztl-button-two button:active,    
    .ztl-button-two span.ztl-action:hover,
    .ztl-button-two span.ztl-action:active,
    .ztl-button-two a:hover,
    .ztl-button-two a:active{
    	color: #fff !important;
    	background-color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;
    	cursor:pointer;
    }
    
    
    /*Button Style Three*/

    .ztl-button-three a,
    .ztl-button-three button,
    .ztl-button-three input[type=\"submit\"]{
    	padding:10px 20px !important;
    	border-radius:28px;
    	border:solid 2px;
    	font-size:14px;
    	line-height:18px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:500;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
    }
    .ztl-button-three a,
    .ztl-button-three a:focus,
    .ztl-button-three button,
    .ztl-button-three button:focus,
    .ztl-button-three input[type=\"submit\"],
    .ztl-button-three input[type=\"submit\"]:focus{
    	background-color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	color: #fff !important;
    	text-decoration:none;
    }
    .ztl-button-three button:hover,
    .ztl-button-three button:active,
    .ztl-button-three a:hover,
    .ztl-button-three a:active,
    .ztl-button-three input[type=\"submit\"]:hover,
    .ztl-button-three input[type=\"submit\"]:active {
    	color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	background-color: transparent !important;
    	text-decoration:none;
    	cursor:pointer;
    }


    /*Button Style Four*/

    .ztl-button-four a,
    .ztl-button-four button{
    	padding:10px 20px !important;
    	border-radius:28px;
    	border:solid 2px;
    	font-size:14px;
    	line-height:18px;
    	transition: all .2s ease-in-out;
    	-webkit-transition: all .2s ease-in-out;
		cursor:pointer;
		font-weight:500;
		font-family: '{$styles['accent_font']}',sans-serif;
		text-transform:uppercase;
		text-decoration:none;
		display:inline-block;
    }
    .ztl-button-four a,
    .ztl-button-four a:focus,
    .ztl-button-four button,
    .ztl-button-four button:focus{
    	background-color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	color: #ffffff !important;
    	text-decoration:none;
    }
    .ztl-button-four button:hover,
    .ztl-button-four button:active,
    .ztl-button-four a:hover,
    .ztl-button-four a:active{
    	color: #fff !important;
    	border-color: #fff !important;
    	background-color: transparent !important;
    	text-decoration:none;
    	cursor:pointer;
    }
    
    /* Enfant Navigation */
    .enfant-navigation .esg-navigationbutton:hover,
    .enfant-navigation .esg-filterbutton:hover,
    .enfant-navigation .esg-sortbutton:hover,
    .enfant-navigation .esg-sortbutton-order:hover,
    .enfant-navigation .esg-cartbutton-order:hover,
    .enfant-navigation .esg-filterbutton.selected{
        color: #fff !important;
    	background-color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	text-decoration:none;
    	cursor:pointer;
    	font-family: '{$styles['main_font']}',sans-serif;
    }
    
    .enfant-navigation .esg-filterbutton,
    .enfant-navigation .esg-navigationbutton,
    .enfant-navigation .esg-sortbutton,
    .enfant-navigation .esg-cartbutton{
    	color: {$styles['theme_first_color']} !important;
    	border-color: {$styles['theme_first_color']} !important;
    	background-color: transparent !important;
    	text-decoration:none;
    	font-family: '{$styles['main_font']}',sans-serif;
    }

    /* Shortcodes default colors */

    .ztl-divider.primary > span.circle{ border:2px solid {$styles['theme_first_color']}; }
	.ztl-divider.primary > span > span:first-child{ background-color: {$styles['theme_first_color']}; }
	.ztl-divider.primary > span > span:last-child{ background-color: {$styles['theme_first_color']}; }
	.ztl-divider.secondary > span{ background-color: {$styles['theme_first_color']}; }


	.ztl-widget-recent-posts ul > li > .ztl-recent-post-date span{
		color: {$styles['theme_first_color']} !important;
		font-size:24px;
		font-weight: bold;
	}

	.ztl-grid-post-date span,
	.eg-item-skin-enfant-blog-element-31 span,
	
	.ztl-event-date span{
		color: {$styles['theme_first_color']} !important;
		font-size:32px;
	}
	.ztl-event-info {
		color: {$styles['theme_second_color']};
	}

	#ztl-loader{
		border-top: 2px solid {$styles['theme_first_color']};
	}

	.ztl-list li:before{
		color:{$styles['theme_first_color']};
	}

    a,
    .ztl-link,
    .ztl-title-medium,
    .ztl-staff-item .staff-title,
    .no-results .page-title,
    .category-listing .title a {
        color: {$styles['link_color']};
    }
    .ztl-widget-recent-posts h6 a:hover{
        color: {$styles['link_color']};
    }
    .post-navigation .nav-previous a:hover,
    .post-navigation .nav-next a:hover{
        color: {$styles['link_color']};
    }
    
    a:visited,
    a:active,
    a:focus,
    .sidebar-right .menu a{
        color: {$styles['link_color']};
    }
    a:hover,
    .sidebar-right li>a:hover {
        color: {$styles['link_color']};
    }

    .ztl-social a{
        color: {$styles['footer_social_icons_color']};
    }
    .ztl-social a:hover{
        color: {$styles['footer_social_icons_hover_color']};
    }

    #ztl-shopping-bag .qty{
    	background-color:{$styles['menu_second_color']};
    	color:#fff;
    	font-family: '{$styles['accent_font']}',sans-serif;
    }
    
    #ztl-shopping-bag  a .ztl-cart-quantity,
    #ztl-shopping-bag  a:hover .ztl-cart-quantity{
        color:#fff;
    }

    #menu-toggle span {
        background-color:{$styles['menu_second_color']};
    }

    .main-navigation .menu-item-has-children > a:after{
    	color:{$styles['menu_second_color']};
    }

    #ztl-copyright{
        color: {$styles['copyright_color']};
    }

    #ztl-copyright a{
		text-decoration:underline;
		cursor:pointer;
		color: {$styles['copyright_color']};
    }

    .main-navigation a{
        font-size: {$styles['menu_font_size']}px;
        font-weight: {$styles['menu_font_weight']};
     }

    .main-navigation ul ul li{
    	background-color: {$styles['menu_second_color']} !important;
    }
    .main-navigation ul ul li:first-child:before {
		content: '';
		width: 0;
		height: 0;
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		border-bottom: 10px solid {$styles['menu_second_color']};
		position: absolute;
		top: -10px;
		left: 20px;
	}

	.main-navigation ul ul ul li:first-child:before {
		content: '';
		width: 0;
		height: 0;
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;
		border-right: 10px solid {$styles['menu_second_color']};
		position: absolute;
		left: -20px;;
		top: 23px;
	}

    .main-navigation ul ul li a,
    .main-navigation ul ul li:hover a{
        color: {$styles['menu_fourth_color']} !important;
    }
    
    .main-navigation .menu-item-has-children .menu-item-has-children > a:after{
        color: {$styles['menu_fourth_color']};
        -ms-transform: rotate(270deg);
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
        
    }

    .main-navigation a{
        color: {$styles['menu_first_color']} !important;
    }

    /*.main-navigation .current_page_item > a,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current-menu-ancestor > a,
    .main-navigation .sub-menu li.current-menu-item > a,
    .main-navigation .sub-menu li.current_page_item > a{
        color: {$styles['menu_second_color']} !important;
    }

	.main-navigation ul ul > li:hover > a {
    	 color: {$styles['menu_second_color']} !important;
	} */


	.ztl-tools-wrapper .item span{
		color:{$styles['menu_first_color']};
	}
	.ztl-tools-wrapper .item span:hover{
		color:{$styles['menu_second_color']};
	}

	#ztl-shopping-bag div:hover span{
		color:{$styles['menu_second_color']};
	}
	/*
    .main-navigation .current_page_item ul a,
    .main-navigation .current-menu-item ul a{
        color: {$styles['menu_first_color']} !important;
    }*/

    .post-navigation .ztl-icon-navigation  {
        color: {$styles['theme_first_color']};
    }
    
    .ztl-recent-post-date,
    .ztl-recent-post-date a,
    .category-listing .item .date,
    .category-listing .item .date a,{
        color: {$styles['theme_second_color']};
    }
    
    .ztl-recent-post-date a span,
    .ztl-single .date a span,
    .category-listing .item .date a span{
        color: {$styles['theme_first_color']};
        font-size: 32px; 
        font-weight:bold;
    }

    .tp-leftarrow,
    .tp-rightarrow{
        background-color:transparent !important;
    }
    
    .site-footer .site-info{
        background-color:{$styles['footer_background_color']};
    }
    .site-header{
        background-color:{$styles['menu_background_color']};
        border-color: {$styles['menu_border_color']};
    }
    
    .ztl-tools-wrapper .item,
    .category-listing .item .info,
    .ztl-post .info,
    .comment-navigation .nav-previous,
    .paging-navigation .nav-previous,
    .post-navigation .nav-previous,
    .comment-navigation .nav-next,
    .paging-navigation .nav-next,
    .post-navigation .nav-next,
    .ztl-course-item .course-description div,
    .ztl-course-description div,
    .ztl-course-item .course-description div:last-child,
    .ztl-course-description div:last-child {
    	border-color: {$styles['line_color']};
    }
    
    .comment article {
        border-bottom: 2px solid {$styles['line_color']};
    }
    
    .ztl-breadcrumb-container{
        border-color: {$styles['title_background']};
    }
    
    .category-listing .item:after{
        background-color: {$styles['line_color']};
    }

    .category-listing .item i,
    .ztl-post i,
    .ztl-widget-recent-posts ul>li>a+h6+span i{
        color: {$styles['theme_first_color']};
    }

    .ztl-scroll-top:hover{
        background-color: {$styles['theme_first_color']};
    }

    .pagination .page-numbers {
        color:{$styles['pagination_second_color']};
    }
    .pagination .current,
    .pagination .current:hover,
    .vc_tta-color-white.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading:hover {
        color:#ffffff !important;
        background-color:{$styles['pagination_first_color']} !important;
     }
    .pagination .page-numbers:hover {
        background-color: {$styles['pagination_first_color']};
        color:#ffffff;
    }
    .pagination .prev:hover,
    .pagination .next:hover {
        color:{$styles['pagination_first_color']};
        background-color:transparent !important;}

    .category-sidebar-right .widget_text li:before,
    .post-sidebar-right .widget_text li:before,
    .ztl-post-info:before{
        color:{$styles['theme_first_color']};
    }

    aside select {
        border-color: {$styles['line_color']};
    }

    aside caption{
    	color: {$styles['theme_second_color']};
    }
        
    .comment-author,
    .comments-title,
    .comment-reply-title,
    .ztl-course-item .course-title,
    .ztl-course-item .detail{
        color: {$styles['theme_second_color']} !important;
    }
    .sidebar-right .widget-title::after,
    .custom-header-title::after,
    .widget-title::after{
        background-color: {$styles['theme_first_color']};
    }
    .sidebar-footer{
        background-color: {$styles['footer_sidebar_background_color']};
    }
    .ztl-widget-category-container .author a,
    .ztl-widget-category-container .category,
    .ztl-widget-category-container .category a,
    .ztl-widget-category-container .entry-date,
    .ztl-widget-category-container .entry-date a,
    .category-listing .info a,
    .category-listing .info,
    .posted-on a, .byline,
    .byline .author a,
    .entry-footer, .comment-form,
    .entry-footer a,
    .ztl-post .info,
    .comment-metadata a,
    .ztl-post .info a,
    .ztl-breadcrumb-container,
    .ztl-staff-item .staff-position{
        color:{$styles['detail_color']};
    }
 
    @media only screen and (max-width: 767px) {
    	.main-navigation ul ul li a,
    	.main-navigation ul ul li:hover a{
    		color:{$styles['menu_third_color']} !important;
    	}
        .main-navigation ul li{
            border-bottom:1px solid {$styles['menu_border_color']};
        }
        .main-navigation ul ul li:first-child{
            border-top:1px solid {$styles['menu_border_color']};
        }
        .main-navigation .menu-item-has-children .menu-item-has-children > a:after{
        color: {$styles['menu_second_color']};
        -ms-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        
    }
    }
";

//boxed mode
if ( get_theme_mod( 'layout_mode' ) == 'boxed' ){
    $css .= "
        .wrapper {overflow: hidden;}
    ";
}

        //In case WooCommerce is activated we append custom styles
if ( class_exists( 'WooCommerce' ) ) {
	$css .= "
		.widget.woocommerce ul li .quantity,
		.widget.woocommerce ul li .amount,
		.woocommerce .widget_shopping_cart .total,
		.woocommerce.widget_shopping_cart .total,
		.woocommerce .product .amount,
		.price_slider_amount .price_label,
		.widget.woocommerce  .reviewer{
			color:{$styles['detail_color']};
		}
		.woocommerce a.button.added:after,
		.woocommerce div.product form.cart .variations label{
        	color: {$styles['theme_second_color']} !important;
    	}
    	
    	/*WooCommerce Notices*/
        .woocommerce a.remove,
        .woocommerce .widget_rating_filter ul li.chosen a:before,
        .woocommerce .widget_layered_nav ul li.chosen a:before,
        .woocommerce .widget_layered_nav_filters ul li a:before {
            color:{$styles['detail_color']} !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: {$styles['detail_color']}  transparent transparent !important;
        }
        
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent {$styles['detail_color']}  !important;
        }
        
        .woocommerce .woocommerce-message,
        .woocommerce .woocommerce-info,
        .woocommerce .woocommerce-error,
        .woocommerce select,
        .woocommerce-page select,
        .woocommerce form .form-row.woocommerce-invalid .select2-container,
        .woocommerce form .form-row.woocommerce-invalid input.input-text,
        .woocommerce form .form-row.woocommerce-invalid select,
        .woocommerce .select2-container--default .select2-selection--single {
            border-color: {$styles['line_color']} !important;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true],
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: {$styles['line_color']};
            color:#545454;
        }
        
        .woocommerce .select2-container .select2-choice,
        .woocommerce .quantity input,
        .woocommerce #reviews #comments ol.commentlist li .comment-text,
        .woocommerce table.shop_table,
        #add_payment_method table.cart td.actions .coupon .input-text,
        .woocommerce-cart table.cart td.actions .coupon .input-text,
        .coupon .input-text,
        .woocommerce-checkout table.cart td.actions .coupon .input-text,
        .woocommerce .quantity .qty,
        .select2-dropdown {
            border: 2px solid {$styles['line_color']};
        }
        
        #add_payment_method #payment div.payment_box,
        .woocommerce-cart #payment div.payment_box,
        .woocommerce-checkout #payment div.payment_box {
            background-color: {$styles['line_color']};
        }
        
        #add_payment_method #payment div.payment_box:before,
        .woocommerce-cart #payment div.payment_box:before,
        .woocommerce-checkout #payment div.payment_box:before {
            border: 2px solid {$styles['line_color']};
            border-top-color: transparent;
            border-left-color: transparent;
            border-right-color: transparent;
        }
        
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 2px solid {$styles['line_color']} !important;
        }
        
        .woocommerce table.shop_attributes {
            border-top: 2px dashed {$styles['line_color']};
        }
        
        .woocommerce table.shop_attributes td,
        .woocommerce table.shop_attributes th {
            border-bottom: 2px dashed {$styles['line_color']};
        }
        
        .woocommerce form .form-row.woocommerce-validated .select2-container,
        .woocommerce form .form-row.woocommerce-validated input.input-text,
        .woocommerce form .form-row.woocommerce-validated select{
              border-color: {$styles['line_color']};
        }
        
        #add_payment_method .cart-collaterals .cart_totals tr td,
        #add_payment_method .cart-collaterals .cart_totals tr th,
        .woocommerce-cart .cart-collaterals .cart_totals tr td,
        .woocommerce-cart .cart-collaterals .cart_totals tr th,
        .woocommerce-checkout .cart-collaterals .cart_totals tr td,
        .woocommerce-checkout .cart-collaterals .cart_totals tr th,
        .woocommerce table.shop_table tfoot th,
        .woocommerce table.shop_table td {
            border-top: 2px solid  {$styles['line_color']};
        }
        
        .woocommerce div.product .woocommerce-tabs ul.tabs::before,
        .woocommerce .wc-tab{
            border-bottom: 2px solid  {$styles['line_color']};
        }
        
        #add_payment_method #payment, 
        .woocommerce-checkout #payment,
        .woocommerce-MyAccount-navigation{
            background-color: {$styles['line_color']};
        }
        
        .woocommerce div.product .woocommerce-tabs ul.tabs li {
            border-radius: 0;
            border: solid 2px {$styles['line_color']};
            background-color: {$styles['line_color']};
        }
                
    	.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt{
			color: {$styles['theme_first_color']};
			border-color: {$styles['theme_first_color']} !important;
			background-color:transparent;
			text-transform:uppercase;
			font-family: {$styles['accent_font']};
		}
    	
    	.woocommerce #respond input#submit:hover,
    	.woocommerce a.button:hover,
    	.woocommerce button.button:hover,
    	.woocommerce input.button:hover,
    	.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce .single_add_to_cart_button:hover{
        	background-color:{$styles['theme_first_color']};
        	border-color: {$styles['theme_first_color']} !important;
        	color:#ffffff;
    	}
    	
		.woocommerce #respond input#submit.alt.disabled,
		.woocommerce #respond input#submit.alt.disabled:hover,
		.woocommerce #respond input#submit.alt:disabled,
		.woocommerce #respond input#submit.alt:disabled:hover,
		.woocommerce #respond input#submit.alt:disabled[disabled],
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
		.woocommerce a.button.alt.disabled,
		.woocommerce a.button.alt.disabled:hover,
		.woocommerce a.button.alt:disabled,
		.woocommerce a.button.alt:disabled:hover,
		.woocommerce a.button.alt:disabled[disabled],
		.woocommerce a.button.alt:disabled[disabled]:hover,
		.woocommerce button.button.alt.disabled,
		.woocommerce button.button.alt.disabled:hover,
		.woocommerce button.button.alt:disabled,
		.woocommerce button.button.alt:disabled:hover,
		.woocommerce button.button.alt:disabled[disabled],
		.woocommerce button.button.alt:disabled[disabled]:hover,
		.woocommerce input.button.alt.disabled,
		.woocommerce input.button.alt.disabled:hover,
		.woocommerce input.button.alt:disabled,
		.woocommerce input.button.alt:disabled:hover,
		.woocommerce input.button.alt:disabled[disabled],
		.woocommerce input.button.alt:disabled[disabled]:hover,
		.woocommerce input.button:disabled, 
		.woocommerce input.button:disabled[disabled],
		.woocommerce input.button:disabled:hover, 
		.woocommerce input.button:disabled[disabled]:hover{
            background-color: #ffffff;
            color:{$styles['theme_first_color']};
		}

		.woocommerce p.stars a,
		.woocommerce .star-rating:before,
		.woocommerce .star-rating {
			color:{$styles['theme_first_color']};
		}
		
		.woocommerce .star-rating::before {
		    color:{$styles['detail_color']} !important;
		}
		
		.woocommerce span.onsale,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range{
			background-color: {$styles['theme_first_color']};
		}

		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content{
			background-color:" . enfant_hex2rgba( $styles['theme_first_color'],0.5 ) . ";
		}
		.woocommerce-page #content h1,
		.woocommerce-page #content h2,
		.woocommerce-page #content h3,
		.woocommerce-thankyou-order-received,
		.woocommerce form .form-row label{
			color: {$styles['theme_second_color']};;
		}
		
        .woocommerce .widget_shopping_cart .total,
        .woocommerce.widget_shopping_cart .total {
            border-top: 2px solid {$styles['line_color']};
        }
        
        .woocommerce .cart_totals h2,
        .woocommerce-checkout h3,
        .woocommerce-account h3,
        .woocommerce-account h2,
        .woocommerce .woocommerce-tabs h2,
        .woocommerce .related.products h2{
            font-family: {$styles['accent_font']};
        } 
        
        .woocommerce form.checkout_coupon,
        .woocommerce form.login,
        .woocommerce form.register{
            border: 2px solid {$styles['line_color']};
            border-radius:0px;
        } 
        
        .woocommerce .order_details li {
            border-right: 2px solid {$styles['line_color']};
        }
        
        .woocommerce ul.products:after{
            background-color: {$styles['line_color']};
        }
        
        .woocommerce form  input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 50px {$styles['line_color']} inset;
        }

        .woocommerce form  input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 50px {$styles['line_color']} inset;
        }
        
        .ztl-checkbox-helper{
            background-color: {$styles['line_color']};
        }
            
        .woocommerce form .form-row input[type='text'],
        .woocommerce form .form-row input[type='tel'],
        .woocommerce form .form-row input[type='email'],
        .woocommerce form .form-row input[type='password']{
            background-color: {$styles['line_color']} !important;
            border: 2px solid {$styles['line_color']};
            border-radius: 28px;
            line-height: 18px;
            padding: 10px 20px;
        }
	";
}



	wp_add_inline_style( 'enfant-style', wp_strip_all_tags( $css ) );
}

add_action( 'wp_enqueue_scripts', 'enfant_add_css_to_stylesheet' );


// Sanitize text function
function enfant_sanitize_text( $input ) {
	return wp_kses_post( $input );
}
