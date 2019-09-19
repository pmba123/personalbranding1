<?php
/*-------------------------------------------------------------------------------------------
 * Enqueue scripts and styles.
 *------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'starter_wp_add_footer_styles' ) ) :
    function starter_wp_add_footer_styles() {
        wp_enqueue_style( 'starter-wp-font', '//fonts.googleapis.com/css?family='. apply_filters( 'starter_wp_google_font', 'Roboto:300,300i,400,400i,700,700i&subset=latin-ext'));
        wp_enqueue_style( 'starter-wp-material-font',  'https://fonts.googleapis.com/icon?family=Material+Icons' );
    }
    add_action( 'get_footer', 'starter_wp_add_footer_styles' );
endif;

if ( ! function_exists( 'starter_wp_scripts' ) ) :
    function starter_wp_scripts() {
        wp_enqueue_style( 'starter-wp-style', get_stylesheet_uri() );
        wp_enqueue_script( 'starter-wp-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
         if ( has_custom_header() && (is_home() && is_front_page() || is_front_page() ) ) {
            wp_enqueue_script( 'starter-wp-vide', get_template_directory_uri() . '/assets/js/vidbg.js', array('jquery'), '1.1.1', true );
        }
        if ( is_singular() ) {
            wp_enqueue_script( 'starter-wp-flexslider', get_template_directory_uri() . '/assets/js/flexslider.js', array(), '2.6.3', true ); 
            wp_enqueue_script( 'starter-wp-fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array('jquery'), '1.1.0', true ); 
        }
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'starter_wp_scripts' );
endif;