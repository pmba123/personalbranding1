<?php
/**
 * Starter WP Theme Customizer
 *
 * @package Starter WP
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function starter_wp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->remove_control('external_header_video');
    $wp_customize->remove_control('header_textcolor');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'starter_wp_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'starter_wp_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'starter_wp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function starter_wp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function starter_wp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function starter_wp_customize_preview_js() {
	wp_enqueue_script( 'starter-wp-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'starter_wp_customize_preview_js' );

/**
 * Configuration sample for the Kirki Customizer.
 * The function's argument is an array of existing config values
 * The function returns the array with the addition of our own arguments
 * and then that result is used in the kirki_config filter
 *
 * @param $config the configuration array
 *
 * @return array
 */
function starter_wp_configuration_styling( $config ) {
	return wp_parse_args( array(
		//'logo_image'   => 'https://aristath.github.io/kirki/images/logo.png',
		//'description'  => esc_attr__( 'The Customizer allows you to preview changes to your site before publishing them. You can navigate to different pages on your site within the preview. Edit shortcuts are shown for some editable elements.If you like the theme please leave a review', 'starter-wp' ),
		//'color_accent' => '#0091EA',
		//'color_back'   => '#FFFFFF',
        'disable_loader' => true,
	), $config );
}
add_filter( 'kirki_config', 'starter_wp_configuration_styling' );

/**
 * Add the theme configuration
 */
starter_wp_Kirki::add_config( 'starter_wp_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Panel
 */
starter_wp_Kirki::add_panel( 'starter_wp_options', array(
	'title'      => esc_attr__( 'Theme Options', 'starter-wp' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
) );

/**
 * Section
 */
starter_wp_Kirki::add_section( 'title_tagline', array(
	'title'      => esc_attr__( 'Site Identity', 'starter-wp' ),
	'priority'   => 5,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'header_image', array(
	'title'      => esc_attr__( 'Header Media', 'starter-wp' ),
	'priority'   => 10,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'top_header', array(
	'title'      => esc_attr__( 'Top Header', 'starter-wp' ),
	'priority'   => 15,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'hero', array(
	'title'      => esc_attr__( 'Hero', 'starter-wp' ),
	'priority'   => 20,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'features', array(
	'title'      => esc_attr__( 'Features', 'starter-wp' ),
	'priority'   => 25,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'layout', array(
	'title'      => esc_attr__( 'Layout', 'starter-wp' ),
	'priority'   => 30,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'colors', array(
	'title'      => esc_attr__( 'Colors', 'starter-wp' ),
	'priority'   => 35,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'background_image', array(
	'title'      => esc_attr__( 'Background Image', 'starter-wp' ),
	'priority'   => 40,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'social', array(
	'title'      => esc_attr__( 'Social', 'starter-wp' ),
	'priority'   => 45,
	'panel' => 'starter_wp_options',
) );
starter_wp_Kirki::add_section( 'premium', array(
	'title'      =>  esc_attr__( "Ready for more? go premium", 'starter-wp' ),
	'priority'   => 99,
	'panel' => 'starter_wp_options',
) );

/**
 * Site identity
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'spacing',
	'settings'    => 'brand_padding',
	'label'       => esc_html__( 'Brand padding', 'starter-wp' ),
	'section'     => 'title_tagline',
	'default'     => array(
		'top'    => '25px',
		'bottom' => '25px',
		'left'   => '0',
		'right'  => '0',
	),
    'output' => array(
		array(
			'element'  => '.site-header .site-branding',
			'property' => 'padding',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'spacing',
	'settings'    => 'main_menu_padding',
	'label'       => esc_html__( 'Main menu padding', 'starter-wp' ),
	'section'     => 'title_tagline',
	'default'     => array(
		'top'    => '35px',
		'bottom' => '35px',
		'left'   => '0',
		'right'  => '0',
	),
    'output' => array(
		array(
			'element'  => '.site-header .main-navigation',
			'property' => 'padding',
            'media_query' => '@media (min-width: 768px)'
		),
    ),
) );
/**
 * Header media
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'select',
	'settings'    => 'header_image_background_size',
	'label'       => esc_html__( 'Background size', 'starter-wp' ),
	'section'     => 'header_image',
    'active_callback' => 'has_header_image',
	'default'     =>'cover',
    'choices'     => array(
		'auto' => esc_attr__( 'Auto', 'starter-wp' ),
		'cover' => esc_attr__( 'Cover', 'starter-wp' ),
		'contain' => esc_attr__( 'Contain', 'starter-wp' ),
	),
    'output' => array(
		array(
			'element'  => '.has-header-media .site-header .header-media',
			'property' => 'background-size',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'select',
	'settings'    => 'header_image_background_position',
	'label'       => esc_html__( 'Background position', 'starter-wp' ),
	'section'     => 'header_image',
    'active_callback' => 'has_header_image',
	'default'     =>'center center',
    'choices'     => array(
        'left top'  => esc_attr__( 'Left Top', 'starter-wp' ),
        'left center'=> esc_attr__( 'Left Center', 'starter-wp' ),
        'left bottom'=> esc_attr__( 'Left Bottom', 'starter-wp' ),
        'right top'=> esc_attr__( 'Right Top', 'starter-wp' ),
        'right center'=> esc_attr__( 'Right Center', 'starter-wp' ),
        'right bottom'=> esc_attr__( 'Right Bottom', 'starter-wp' ),
        'center top'=> esc_attr__( 'Center Top', 'starter-wp' ),
        'center center'=> esc_attr__( 'Center Center', 'starter-wp' ),
        'center bottom'=> esc_attr__( 'Center Bottom', 'starter-wp' ),
	),
    'output' => array(
		array(
			'element'  => '.has-header-media .site-header .header-media',
			'property' => 'background-position',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'select',
	'settings'    => 'header_image_background_repeat',
	'label'       => esc_html__( 'Background repeat', 'starter-wp' ),
	'section'     => 'header_image',
    'active_callback' => 'has_header_image',
	'default'     => 'no-repeat',
    'choices'     => array(
        'repeat'  => esc_attr__( 'Repeat', 'starter-wp' ),
        'no-repeat'=> esc_attr__( 'No Repeat', 'starter-wp' ),
	),
    'output' => array(
		array(
			'element'  => '.has-header-media .site-header .header-media',
			'property' => 'background-repeat',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'dimension',
	'settings'    => 'header_image_background_min_height',
	'label'       => esc_html__( 'Background min height', 'starter-wp' ),
	'section'     => 'header_image',
	'default'     => '350px',
    'output' => array(
		array(
			'element'  => '.has-header-media .site-header',
			'property' => 'min-height',
		),
        array(
			'element'  => '.has-header-media .site-header .header-media',
			'property' => 'min-height',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'color',
	'settings'    => 'header_media_overlay',
	'label'       => esc_html__( 'Header media overlay color', 'starter-wp' ),
	'section'     => 'header_image',
	'default'     => 'rgba(255,255,255,.1)',
	'choices'     => array(
		'alpha' => true,
	),
    'output' => array(
		array(
			'element'  => '.has-header-media .site-header .header-media .overlay',
			'property' => 'background-color',
		),
    ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'select',
	'settings'    => 'header_media_color_scheme',
	'label'       => esc_html__( 'Color scheme', 'starter-wp' ),
	'section'     => 'header_image',
	'default'     => 'light',
    'choices'     => array(
        'light'  => esc_attr__( 'Light', 'starter-wp' ),
        'normal'=> esc_attr__( 'Normal', 'starter-wp' ),
	),
) );

/**
 * Top header
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'toggle',
	'settings'    => 'top_header_enable',
	'label'       => esc_html__( 'Enable top header', 'starter-wp' ),
	'section'     => 'top_header',
	'default'     =>'1',
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'textarea',
	'settings'    => 'top_header_text',
	'label'       => esc_html__( 'Cusotm text', 'starter-wp' ),
	'section'     => 'top_header',
	'default'     => esc_html__( 'Build your awesome website', 'starter-wp' ),
    'transport' => 'postMessage',
    'js_vars'   => array(
		array(
			'element'  => '.top-header .text',
			'function' => 'html',
			'property' => '',
		),
	)
) );
/**
 * Add hero
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'toggle',
	'settings'    => 'hero_enable',
	'label'       => __( 'Enable hero section', 'starter-wp' ),
	'section'     => 'hero',
	'default'     => '1',
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'hero_heading',
	'label'       => __( 'Hero title', 'starter-wp' ),
	'section'     => 'hero',
	'default'     => esc_html__( 'Easy to use', 'starter-wp' ),
    'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.hero h2.title',
			'function' => 'html',
			'property' => '',
		),
	)
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'hero_text',
	'label'       => __( 'Hero text', 'starter-wp' ),
	'section'     => 'hero',
	'default'     => esc_html__( 'WordPress Theme', 'starter-wp' ),
    'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.hero .text',
			'function' => 'html',
			'property' => '',
		),
	)
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'hero_button_text',
	'label'       => __( 'Hero button text', 'starter-wp' ),
	'section'     => 'hero',
	'default'     => esc_html( 'View Now', 'starter-wp' ),
    'transport' => 'postMessage',
    'js_vars'   => array(
    array(
			'element'  => '.hero .button',
			'function' => 'html',
			'property' => '',
		),
	)
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'hero_button_link',
	'label'       => __( 'Hero button link', 'starter-wp' ),
	'section'     => 'hero',
	'default'     => esc_url( 'www.iograficathemes.com', 'starter-wp' ),
    'sanitize_callback' => 'esc_url_raw',
) );
/**
 * Add Features
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'toggle',
	'settings'    => 'features_enable',
	'label'       => __( 'Enable features section', 'starter-wp' ),
	'section'     => 'features',
	'default'     => '1',
) );
//Features
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Features', 'starter-wp' ),
	'section'     => 'features',
	'priority'    => 10,
    'choices' => array(
        'limit' => 4
    ),
	'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('Feature', 'starter-wp' ),
	),
	'settings'    => 'features',

	'default'    => array(
		array(
            'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
			'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
            'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
		),
		array(
            'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
			'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
            'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
		),
        array(
            'feature_icon' => esc_attr__( 'icon-diamond', 'starter-wp' ),
			'feature_heading' => esc_attr__( 'Maecenas vel nulla', 'starter-wp' ),
            'feature_text' => esc_attr__( 'Lorem usce volutpat lectus justo, ut suscipit felis congue ut.', 'starter-wp' ),
		),
	),
	'fields' => array(
		'feature_icon' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Feature icon', 'starter-wp' ),
			'description' => esc_attr__( 'Icons: simplelineicons.com', 'starter-wp' ),
			'default'     => '',
		),
        'feature_heading' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Feature heading', 'starter-wp' ),
			'description' => esc_attr__( '', 'starter-wp' ),
			'default'     => '',
		),
		'feature_text' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Feature text', 'starter-wp' ),
			'description' => esc_attr__( '', 'starter-wp' ),
			'default'     => '',
        ),
	)
) );
/**
 * Layout
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'main_layout',
	'label'       => esc_html__( 'Main Layout', 'starter-wp' ),
	'section'     => 'layout',
	'default'     => 'right',
	'choices'     => array(
        'full'  => get_template_directory_uri() . '/assets/images/full.png',
		'right' => get_template_directory_uri() . '/assets/images/right.png',
		'left'  => get_template_directory_uri() . '/assets/images/left.png',
	),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'post_layout',
	'label'       => esc_html__( 'Post Layout', 'starter-wp' ),
	'section'     => 'layout',
	'default'     => 'right',
	'choices'     => array(
        'full'  => get_template_directory_uri() . '/assets/images/full.png',
		'right' => get_template_directory_uri() . '/assets/images/right.png',
		'left'  => get_template_directory_uri() . '/assets/images/left.png',
	),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'search_layout',
	'label'       => esc_html__( 'Search Layout', 'starter-wp' ),
	'section'     => 'layout',
	'default'     => 'right',
	'choices'     => array(
        'full'  => get_template_directory_uri() . '/assets/images/full.png',
		'right' => get_template_directory_uri() . '/assets/images/right.png',
		'left'  => get_template_directory_uri() . '/assets/images/left.png',
	),
) );
/**
 * Layout
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'main_layout',
	'label'       => esc_html__( 'Main Layout', 'starter-wp' ),
	'section'     => 'layout',
	'default'     => 'right',
	'choices'     => array(
        'full'  => get_template_directory_uri() . '/assets/images/full.png',
		'right' => get_template_directory_uri() . '/assets/images/right.png',
		'left'  => get_template_directory_uri() . '/assets/images/left.png',
	),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'post_layout',
	'label'       => esc_html__( 'Post Layout', 'starter-wp' ),
	'section'     => 'layout',
	'default'     => 'right',
	'choices'     => array(
        'full'  => get_template_directory_uri() . '/assets/images/full.png',
		'right' => get_template_directory_uri() . '/assets/images/right.png',
		'left'  => get_template_directory_uri() . '/assets/images/left.png',
	),
) );
/**
 * Color
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'color',
	'settings'    => 'accent_color',
	'label'       => __( 'Accent color', 'starter-wp' ),
	'section'     => 'colors',
	'default'     => '#9b4dca',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => false,
	),
    'output' => array(
		array(
			'element'  => 'a, .main-navigation ul li a:hover',
			'property' => 'color',
		),
	    array(
			'element'  => ".button,button,input[type='button'],input[type='reset'],input[type='submit']",
            'property' => 'border-color',
		),
        array(
			'element'  => ".button,button,input[type='button'],input[type='reset'],input[type='submit']",
			'property' => 'background-color',
		),
        array(
			'element'  => ".button-outline",
			'property' => 'border-color',
		),
        array(
			'element'  => ".button-outline, a.button.button-outline, ul.products li.product .button",
			'property' => 'color',
		), 
        array(
			'element'  => ".search-submit.button.button-clear",
			'property' => 'color',
		),
        array(
			'element'  => ".button-clear",
			'property' => 'color',
		),
         array(
			'element'  => ".features i",
			'property' => 'color',
		),
        array(
			'element'  => ".single .comments-title::after",
			'property' => 'background',
		),
        array(
			'element'  => ".single .comment-reply-title::after",
			'property' => 'background',
		),
        array(
			'element'  => ".single .related-posts-title::after",
			'property' => 'background',
		),       
        array(
			'element'  => ".blog .entry-title a:hover, .archive .entry-title a:hover, .search .entry-title a:hover",
			'property' => 'color',
		),
        array(
			'element'  => ".single-product div.product .woocommerce-tabs ul.tabs li.active a, .star-rating",
			'property' => 'color',
		),
        array(
			'element'  => ".single-product div.product .woocommerce-tabs ul.tabs li.active a",
			'property' => 'border-color',
		),
        array(
			'element'  => ".woocommerce.widget_products .product-title:hover",
			'property' => 'color',
		),
        array(
			'element'  => ".woocommerce.widget_recent_reviews a:hover",
			'property' => 'color',
		),
	),
) );

/**
 * Social
 */
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'toggle',
	'settings'    => 'social_footer_enable',
	'label'       => __( 'Enable social in Footer', 'starter-wp' ),
	'section'     => 'social',
	'default'     => '1',
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'toggle',
	'settings'    => 'social_header_enable',
	'label'       => __( 'Enable social in Header', 'starter-wp' ),
	'section'     => 'social',
	'default'     => '1',
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_facebook',
	'label'       => esc_html__( 'Facebook', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( 'https://www.facebook.com/iograficathemes/', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_twitter',
	'label'       => esc_html__( 'Twitter', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( 'https://twitter.com/iograficathemes', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_google',
	'label'       => esc_html__( 'Google Plus', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( 'https://plus.google.com/+Iograficathemes', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_pinterest',
	'label'       => esc_html__( 'Pinterest', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_tumblr',
	'label'       => esc_html__( 'Tumblr', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_instagram',
	'label'       => esc_html__( 'Instagram', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_linkedin',
	'label'       => esc_html__( 'Linkedin', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_dribbble',
	'label'       => esc_html__( 'Dribbble', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'text',
	'settings'    => 'social_youtube',
	'label'       => esc_html__( 'Youtube', 'starter-wp' ),
	'section'     => 'social',
	'default'     => esc_url( '', 'starter-wp' ),
) );
starter_wp_Kirki::add_field( 'starter_wp_theme', array(
	'type'        => 'custom',
	'settings'    => 'starter_wp_premium',
	'label'       => esc_html__( 'UPGRADE TO PREMIUM', 'starter-wp' ),
	'section'     => 'premium',
	'default'     => esc_html__( 'Have access to a tons of new options and functionalities.', 'starter-wp' ) . '<br><a style="display: inline-block; margin: 10px 0; background: #fc6e51;color: #ffffff; padding: 5px 10px;clear: both; text-decoration: none; border-radius:2px" href="https://iograficathemes.com/wordpress-themes/starter-wp" class"button button-primary">UPGRADE TO PREMIUM</a>',
) );