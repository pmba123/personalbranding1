<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Starter_WP
 */
/*-------------------------------------------------------------------------------------------
 * Add a pingback url auto-discovery header for singularly identifiable articles.
------------------------------------------------------------------------------------------*/
function starter_wp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'starter_wp_pingback_header' );
/*-------------------------------------------------------------------------------------------
 * Wrapper for get_sidebar()
 ------------------------------------------------------------------------------------------*/
function starter_wp_get_sidebar( $sidebar = '' ) {
	// disable sidebar
	if ( ! apply_filters( 'starter_wp_show_sidebar', true ) ) {
		return false;
	} 

	return get_sidebar( apply_filters( 'starter_wp_get_sidebar', $sidebar ) );
}

/*-------------------------------------------------------------------------------------------
 * Remove sidebar
 ------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'starter_wp_remove_sidebar' ) ):
    function starter_wp_remove_sidebar() {
        
        if ( in_array( 'no-sidebar', get_body_class() )  ) {
            // Remove the sidebar.
            add_filter( 'starter_wp_show_sidebar', '__return_false' );
        }
    }
endif;
add_action( 'template_redirect', 'starter_wp_remove_sidebar',1 );