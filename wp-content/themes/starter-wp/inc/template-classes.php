<?php
/*-------------------------------------------------------------------------------------------
 * Body classes
------------------------------------------------------------------------------------------*/
function starter_wp_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    if ( has_custom_header() && (is_home() && is_front_page() || is_front_page() ) )  {
        $classes[] = 'has-header-media';
        if ( get_theme_mod('header_media_color_scheme','light')=='light') {
            $classes[] = 'light-header-scheme';
        } else {
            $classes[] = 'normal-header-scheme';
        }
    }
	if (
		! is_active_sidebar( 'sidebar-1' ) ||
		! apply_filters( 'starter_wp_show_sidebar', true ) ||
		is_page_template( 'page-templates/page-full-width.php' ) ||
        get_theme_mod('search_layout','right')=='full' && (is_search() || in_array( 'search',$classes ) ) || 
        is_404() ||
        get_theme_mod('main_layout','right')=='full' &&  ( in_array( 'blog', $classes  ) ||	in_array( 'archive', $classes  ) ) ||
        get_theme_mod('post_layout','right')=='full' && in_array( 'single', $classes ) 
	) {
		$classes[] = 'no-sidebar';
	}

	return $classes;

}
add_filter( 'body_class', 'starter_wp_body_classes' );
/*-------------------------------------------------------------------------------------------
 * Site content wrap
------------------------------------------------------------------------------------------*/
function starter_wp_site_content_wrap() {

	$classes = array();
	
    $classes[] = 'site-content-wrap';
    $classes[] = 'col-container';
    
    //archive
    if ( get_theme_mod('main_layout','right')=='left' && ( in_array( 'blog', get_body_class() ) || in_array( 'archive', get_body_class() ) ) ) {
        
        $classes[] = 'sidebar-left';
        
    }
    //single
    if ( get_theme_mod('post_layout','right')=='left' && ( in_array( 'single', get_body_class() ) ) ) {
        
        $classes[] = 'sidebar-left';
        
    }
    //page
    if (in_array('page-template-page-left-sidebar', get_body_class() ) ) {
        
        $classes[] = 'sidebar-left';
        
    }
    //search
    if ( get_theme_mod('search_layout','right')=='left' && ( in_array( 'search', get_body_class() ) ) ) {
        
        $classes[] = 'sidebar-left';
    }
    //slim
    if ( get_post_meta( get_the_ID(), '_starter_wp_slim', 1) && is_page_template( 'page-templates/page-full-width.php' )) {
        
        $classes[] = 'slim';
    }
    //end
    $classes = apply_filters( 'starter_wp_primary_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}
/*-------------------------------------------------------------------------------------------
 * Primary classes
------------------------------------------------------------------------------------------*/
function starter_wp_primary_classes() {

	$classes = array();
	
    $classes[] = 'content-area';
    
    if ( is_active_sidebar( 'sidebar-1' ) && !in_array('no-sidebar', get_body_class() ) )  {
		$classes[] = 'col-two-third';
	}

    $classes = apply_filters( 'starter_wp_primary_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}
/*-------------------------------------------------------------------------------------------
 * Secondary classes
------------------------------------------------------------------------------------------*/
function starter_wp_secondary_classes() {

	$classes = array();
    
    $classes[] = 'col-one-third';
	
    $classes[] = 'widget-area';

	$classes = apply_filters( 'starter_wp_secondary_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}
/*-------------------------------------------------------------------------------------------
 * Site header wrap classes
------------------------------------------------------------------------------------------*/
function starter_wp_site_header_wrap_classes() {

	$classes = array();
    
    $classes[] = 'col-container';
	
    $classes[] = 'site-header-wrap';
    
	$classes = apply_filters( 'starter_wp_site_header_wrap_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}
/*-------------------------------------------------------------------------------------------
 * Page header wrap classes
------------------------------------------------------------------------------------------*/
function starter_wp_page_header_wrap_classes() {

	$classes = array();
    	
    $classes[] = 'page-header-wrap';
    
    $classes[] = 'col-container';
    
	$classes = apply_filters( 'starter_wp_page_header_wrap_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}

/*-------------------------------------------------------------------------------------------
 * Site branding classes
------------------------------------------------------------------------------------------*/
function starter_wp_site_branding_classes() {

	$classes = array();
    
    $classes[] = 'site-branding';
	
    $classes[] = 'col-one-third';

	$classes = apply_filters( 'starter_wp_site_branding_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}
/*-------------------------------------------------------------------------------------------
 * Site primary nav classes
------------------------------------------------------------------------------------------*/
function starter_wp_primary_nav_classes() {

	$classes = array();
    
    $classes[] = 'main-navigation';
	
    $classes[] = 'col-two-third';

	$classes = apply_filters( 'starter_wp_primary_nav_classes', $classes );

	if ( $classes ) {
		return '' . implode( ' ', $classes );
	}

}