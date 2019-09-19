<?php
/*------------------------------------------------------------------------------------------
 * Page
 * starter_wp_page_start
 * starter_wp_page_entry_header
 * starter_wp_page_entry_content
 * starter_wp_page_entry_footer
 * starter_wp_page_end
------------------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------------
 * starter_wp_page_start
------------------------------------------------------------------------------------------*/
// Show shortcodes before content
add_action( 'starter_wp_page_entry_content_start', 'starter_wp_page_shortcode_before' );
function starter_wp_page_shortcode_before() {
    $shortcode = get_post_meta( get_the_ID(), '_starter_wp_shortcode_before_content', true );
    echo do_shortcode($shortcode);
}
/*------------------------------------------------------------------------------------------
 * starter_wp_page_entry_header
------------------------------------------------------------------------------------------*/
// Show the featured image
add_action('starter_wp_page_entry_header','starter_wp_page_header');
if ( ! function_exists('starter_wp_page_header') ) {
    function starter_wp_page_header() {
        if ( has_post_thumbnail() ) {
            echo '<header class="entry-header">';
            echo '<div class="post-thumbnail">';
                the_post_thumbnail();
            echo '</div>';
            echo '</header>';
        } 
    }
}
// post title
function starter_wp_page_post_title() { 
    the_title('<h1 class="entry-title">','</h1>');
 }
/*------------------------------------------------------------------------------------------
 * starter_wp_page_entry_content
------------------------------------------------------------------------------------------*/
// entry content
add_action('starter_wp_page_entry_content','starter_wp_page_post_content');
function starter_wp_page_post_content() {
		/* translators: %s: Name of current post */
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'starter-wp' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
}
/*------------------------------------------------------------------------------------------
 * starter_wp_page_entry_footer
------------------------------------------------------------------------------------------*/
// Show the entry footer info (Categories and tags + edit link).
add_action( 'starter_wp_page_entry_footer', 'starter_wp_page_footer' );
if ( ! function_exists('starter_wp_page_footer') ) {
    function starter_wp_page_footer() {
        echo '<footer class="entry-footer">';
        echo "<div class=screen-reader-text entry-footer>";
        starter_wp_post_author();
        starter_wp_time_link();
        echo "</div>";
        starter_wp_edit_link();
        echo "</footer>";
    }
}
/*------------------------------------------------------------------------------------------
 * starter_wp_page_end
------------------------------------------------------------------------------------------*/
// Show shortcodes after content
add_action( 'starter_wp_page_entry_content_end', 'starter_wp_page_shortcode_after' );
function starter_wp_page_shortcode_after() {
    $shortcode = get_post_meta( get_the_ID(), '_starter_wp_shortcode_after_content', true );
    echo do_shortcode($shortcode);
}
