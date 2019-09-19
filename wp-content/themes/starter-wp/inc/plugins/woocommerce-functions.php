<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package starter_wp
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function starter_wp_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'starter_wp_woocommerce_setup' );

/*-------------------------------------------------------------------------------------------
 * Wrapper for get_sidebar()
 ------------------------------------------------------------------------------------------*/
function  starter_wp_woocommerce_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'WooCommerce Sidebar', 'starter-wp' ),
            'id' => 'sidebar-wc',
            'description' => __( 'Add widgets here to appear in your sidebar.', 'starter-wp' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
}
add_action( 'widgets_init', 'starter_wp_woocommerce_sidebar' );

function starter_wp_woocommerce_get_sidebar( $sidebar = 'wc' ) {
	// disable sidebar
	if ( ! apply_filters( 'starter_wp_woocommerce_show_sidebar', true ) ) {
		return false;
	} 

	return get_sidebar( apply_filters( 'starter_wp_woocommerce_get_sidebar', $sidebar ) );
}

/*-------------------------------------------------------------------------------------------
 * Remove sidebar
 ------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_woocommerce_remove_sidebar' ) ):
    function starter_wp_woocommerce_remove_sidebar() {
        
        if ( in_array( 'no-sidebar', get_body_class() )  ) {
            // Remove the sidebar.
            add_filter( 'starter_wp_woocommerce_show_sidebar', '__return_false' );
        }
    }
endif;
add_action( 'template_redirect', 'starter_wp_woocommerce_remove_sidebar',1 );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function starter_wp_woocommerce_scripts() {
	wp_enqueue_style( 'starter_wp-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'starter_wp-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'starter_wp_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function starter_wp_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'starter_wp_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function starter_wp_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'starter_wp_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function starter_wp_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'starter_wp_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function starter_wp_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'starter_wp_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function starter_wp_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'starter_wp_woocommerce_related_products_args' );
