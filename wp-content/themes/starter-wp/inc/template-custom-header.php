<?php
/*------------------------------------------------------------------------------------*
 * CUSTOM HEADER SETUP
------------------------------------------------------------------------------------*/
function starter_wp_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'starter_wp_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header.jpeg',
		'default-text-color'     => '656361',
		'width'                  => 1366,
		'height'                 => 700,
		'flex-height'            => true,
		'video'					 => true,
		'video-active-callback'  => '',
		'wp-head-callback'       => 'starter_wp_header_style',
		'admin-head-callback'    => 'starter_wp_admin_header_style',
		'admin-preview-callback' => 'starter_wp_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'starter_wp_custom_header_setup' );
//register default header
register_default_headers( array(
    'default-image' => array(
        'url'           => get_stylesheet_directory_uri() . '/assets/images/header.jpeg',
        'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header.jpeg',
        'description'   => __( 'Default Header Image', 'starter-wp' )
    ),
) );

/*------------------------------------------------------------------------------------*
 * HEADER VIDEO SETTINGS
------------------------------------------------------------------------------------*/
function starter_wp_video_settings( $settings ) {
	$settings['minWidth'] 		= '100';
	$settings['minHeight'] 		= '100';	
	return $settings;
}
add_filter( 'header_video_settings', 'starter_wp_video_settings' );

if ( ! function_exists( 'starter_wp_header_style' ) ) :
/*------------------------------------------------------------------------------------*
 * HEADER STYLES
------------------------------------------------------------------------------------*/
function starter_wp_header_style() {
	$header_text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;