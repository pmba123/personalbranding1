<?php

if ( ! function_exists( 'starter_wp_setup' ) ) :

	function starter_wp_setup() {
/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on starter-wp, use a find and replace
		 * to change 'starter-wp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'starter-wp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'css/editor-style.css' );

		 /*
	 	 * Enable support for Post Thumbnails on posts and pages.
	 	 *
	 	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 	 */
	 	add_theme_support( 'post-thumbnails' );

		// Register menus
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'starter-wp' ),
			'secondary' => __( 'Secondary Menu', 'starter-wp' ),
			'footer'    => __( 'Footer Menu', 'starter-wp' )
		) );
        // post formats support
        add_theme_support( 'post-formats', array( 'video', 'gallery' ) );
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

		/**
		 * Enable support for custom logo
		 *
		 * @since 1.0.0
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 300,
			'height'      => 50,
			'flex-height' => true,
			'flex-width'  => true
		) );


		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
        //custom background
        add_theme_support( 'custom-background' );
	}
endif;
add_action( 'after_setup_theme', 'starter_wp_setup' );
