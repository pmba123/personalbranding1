<?php
/*------------------------------------------------------------------------------------------
 * Single Post
 * starter_wp_article_start
 * starter_wp_article_entry_header
 * starter_wp_article_entry_content
 * starter_wp_article_entry_footer
 * starter_wp_article_end
------------------------------------------------------------------------------------------*/
// Remove hetry class
function starter_wp_remove_hentry( $classes ) {
    if ( is_singular() ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
    return $classes;
}
add_filter( 'post_class','starter_wp_remove_hentry' );

add_action( 'starter_wp_page_header_wrapper_end', 'starter_wp_article_subtitle', 5 );
function starter_wp_article_subtitle() {
    if (!empty( get_post_meta( get_the_ID(), '_starter_wp_subtitle', true ) ) ) {
        echo '<p class="subtitle">' . get_post_meta( get_the_ID(), '_starter_wp_subtitle', true ) . '</p>';
    }
}
/*------------------------------------------------------------------------------------------
 * starter_wp_article_start
------------------------------------------------------------------------------------------*/
// Show shortcodes before content
add_action( 'starter_wp_article_entry_content_start', 'starter_wp_article_shortcode_before' );
function starter_wp_article_shortcode_before() {
    $shortcode = get_post_meta( get_the_ID(), '_starter_wp_shortcode_before_content', true );
    echo do_shortcode($shortcode);
}
/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_header
------------------------------------------------------------------------------------------*/
add_action('starter_wp_article_entry_header','starter_wp_article_header');
if ( ! function_exists('starter_wp_article_header') ) {
    function starter_wp_article_header() { 
        echo '<header class="entry-header">';
        starter_wp_article_thumbnail();
        echo '</header>';
    }
}
//article image
function starter_wp_article_thumbnail() {
    if (!has_post_format() && has_post_thumbnail()) {
        echo '<div class="post-thumbnail">';
            the_post_thumbnail();
        echo '</div>';
    }
    //gallery
    $images = get_post_meta( get_the_ID(), '_starter_wp_gallery', 1 );
    if ( !empty( $images ) && has_post_format( 'gallery' ) ) :
        echo '<div class="flexslider"><ul class="slides">';
            foreach ( (array) $images as $attachment_id => $attachment_url ) {
                echo '<li>' . wp_get_attachment_image( $attachment_id, 'large' ) . '</li>';
            }
        echo '</ul></div>';
    endif; 
    //video
    $video = esc_url( get_post_meta( get_the_ID(), '_starter_wp_video', 1 ) );
    if ( !empty( $video ) && has_post_format( 'video' ) ) : 
        echo '<div class="video">';
            echo wp_oembed_get( $video );
        echo '</div>';
    endif;
}

//breadcrumbs
function starter_wp_single_page_breadcrumbs() {
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<div class="breadcrumbs">','</div>');
    }
}

// post title
function starter_wp_article_post_title() { 
    the_title('<h1 class="entry-title">','</h1>');
 }

/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_content
------------------------------------------------------------------------------------------*/
// entry content
add_action('starter_wp_article_entry_content','starter_wp_article_post_content');
function starter_wp_article_post_content() {
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'starter-wp' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'starter-wp' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
}
/*------------------------------------------------------------------------------------------
 * starter_wp_article_entry_footer
------------------------------------------------------------------------------------------*/
// Show the entry footer info (Categories and tags + edit link).
add_action( 'starter_wp_article_entry_footer', 'starter_wp_article_footer' );
if ( ! function_exists('starter_wp_article_footer') ) {
    function starter_wp_article_footer() {
        echo '<footer class="entry-footer">';
            starter_wp_post_author();
            starter_wp_time_link();
            starter_wp_post_categories();
            starter_wp_post_tags();
            starter_wp_edit_link();
        echo '</footer>';
    }
}
/*------------------------------------------------------------------------------------------
 * starter_wp_article_end
------------------------------------------------------------------------------------------*/
// Show shortcodes after content
add_action( 'starter_wp_article_entry_content_end', 'starter_wp_article_shortcode_after' );
function starter_wp_article_shortcode_after() {
    $shortcode = get_post_meta( get_the_ID(), '_starter_wp_shortcode_after_content', true );
    echo do_shortcode($shortcode);
}


/*-------------------------------------------------------------------------------------------
 * Load the biography template after the entry content on a single post.
 *------------------------------------------------------------------------------------------*/
function starter_wp_show_author_box() {

	if ( is_singular( 'post' ) && '' !== get_the_author_meta( 'description' ) ) {
		starter_wp_author_info_box();
	}

}
add_action( 'starter_wp_article_end', 'starter_wp_show_author_box' );
/*-------------------------------------------------------------------------------------------
 * Show related posts
 *------------------------------------------------------------------------------------------*/
function starter_wp_show_related_posts() {

	if ( is_singular( 'post' ) ) {
		starter_wp_related_posts_categories();
	}

}
add_action( 'starter_wp_article_end', 'starter_wp_show_related_posts' );