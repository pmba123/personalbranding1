<?php
function cmb_show_on_post_format( $display, $post_format ) {
    if ( ! isset( $post_format['show_on']['key'] ) ) {
        return $display;
    }
    $post_id = 0;
    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }
    if ( ! $post_id ) {
        return $display;
    }
    $value  = get_post_format($post_id);
 
    if ( empty( $post_format['show_on']['key'] ) ) {
        return (bool) $value;
    }
    return $value == $post_format['show_on']['value'];
}
add_filter( 'cmb2_show_on', 'cmb_show_on_post_format', 10, 2 );

add_action( 'cmb2_admin_init', 'starter_wp_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function starter_wp_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_starter_wp_';
    /*------------------------------------------------------
	 * General
	 ------------------------------------------------------*/
    $cmb_general = new_cmb2_box( array(
		'id'            => 'starter_wp_mb_general',
		'title'         => __( 'Starter WP Settings', 'starter-wp' ),
		'object_types'  => array( 'post', 'page' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
        'remove_box_wrap' => false, 
		'cmb_styles' => true, 
	) );
	// Subtitle
	$cmb_general->add_field( array(
		'name'       => __( 'Subtitle', 'starter-wp' ),
		'desc'       => __( 'Add a subtitle', 'starter-wp' ),
		'id'         => $prefix . 'subtitle',
		'type'       => 'text',

	) );
    // Before content
	$cmb_general->add_field( array(
		'name'       => __( 'Before Content', 'starter-wp' ),
		'desc'       => __( 'Add your text or shortcode here', 'starter-wp' ),
		'id'         => $prefix . 'shortcode_before_content',
		'type'             => 'text',
     ) );
    // After content
	$cmb_general->add_field( array(
		'name'       => __( 'After Content', 'starter-wp' ),
		'desc'       => __( 'Add your text or shortcode here', 'starter-wp' ),
		'id'         => $prefix . 'shortcode_after_content',
		'type'             => 'text',
     ) );
	/*------------------------------------------------------
	 * Gallery post format mb
	 ------------------------------------------------------*/
	$cmb_gallery = new_cmb2_box( array(
		'id'            => 'starter_wp_mb_gallery',
		'title'         => __( 'Starter WP Gallery Settings', 'starter-wp' ),
		'object_types'  => array( 'post' ),
        'show_on'       => array( 'key' => 'post_format', 'value' => 'gallery' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );
    //gallery
    $cmb_gallery->add_field( array(
        'name' => 'Gallery',
        'desc' => __( 'Add an images gallery', 'starter-wp' ),
        'id'   => $prefix . 'gallery',
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Add or Upload images',
            'remove_image_text' => 'Remove Image',
            'file_text' => 'File:', 
            'file_download_text' => 'Download',
            'remove_text' => 'Remove',
        ),
    ) );
	/*------------------------------------------------------
	 * Video post format mb
	 ------------------------------------------------------*/
    $cmb_video = new_cmb2_box( array(
		'id'            => 'starter_wp_mb_video',
		'title'         => __( 'Starter WP Video Settings', 'starter-wp' ),
		'object_types'  => array( 'post' ), 
        'show_on'       => array( 'key' => 'post_format', 'value' => 'video' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
    //oEmbed
    $cmb_video->add_field( array(
        'name' => 'oEmbed',
        'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
        'id'   => $prefix . 'video',
        'type' => 'oembed',
    ) );
    /*------------------------------------------------------
	 * Full width page slim
	 ------------------------------------------------------*/
	$cmb_slim_layout = new_cmb2_box( array(
		'id'            => 'starter_wp_mb_slim',
		'title'         => __( 'Full Width Template Settings', 'starter-wp' ),
		'object_types'  => array( 'page' ),
		'show_on'       => array( 'key' => 'page-template', 'value' => 'page-templates/page-full-width.php' ),
		'context'       => 'side',
		'priority'      => 'low',
		'show_names'    => false, 
	) );
    //slim
    $cmb_slim_layout->add_field( array(
        'name' => 'Slim layout',
        'desc' => __( 'Enable slim layout.', 'starter-wp' ),
        'id'   => $prefix . 'slim',
        'type' => 'checkbox',
    ) );
}

